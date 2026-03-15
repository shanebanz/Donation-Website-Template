<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Campaign extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $this->seedDemoCampaignsIfMissing($db);

        $perPage = 6;
        $page    = (int) ($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;

        $today = date('Y-m-d');

        // Determine active tab from query string (default: active)
        $tab = $this->request->getGet('tab') === 'ended' ? 'ended' : 'active';

        $builder = $db->table('campaigns')->orderBy('id', 'DESC');

        // Fetch all to categorise, then paginate each tab separately
        $all = $builder->get()->getResult();

        $allActive = [];
        $allEnded  = [];

        foreach ($all as $campaign) {
            $deadline    = !empty($campaign->deadline) ? date('Y-m-d', strtotime((string) $campaign->deadline)) : null;
            $goalAmount  = (float) ($campaign->goal_amount ?? 0);
            $currentAmount = (float) ($campaign->current_amount ?? 0);

            $isDone    = $goalAmount > 0 && $currentAmount >= $goalAmount;
            $isExpired = !empty($deadline) && $deadline < $today;

            if ($isDone || $isExpired) {
                $allEnded[] = $campaign;
            } else {
                $allActive[] = $campaign;
            }
        }

        $sourceList   = $tab === 'ended' ? $allEnded : $allActive;
        $totalItems   = count($sourceList);
        $totalPages   = max(1, (int) ceil($totalItems / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $offset       = ($page - 1) * $perPage;
        $paged        = array_slice($sourceList, $offset, $perPage);

        $data['activeCampaigns'] = $tab === 'active' ? $paged : [];
        $data['endedCampaigns']  = $tab === 'ended'  ? $paged : [];

        // Counts for tab badges
        $data['activeCount']  = count($allActive);
        $data['endedCount']   = count($allEnded);

        $data['currentPage']  = $page;
        $data['totalPages']   = $totalPages;
        $data['currentTab']   = $tab;

        return view('campaigns', $data);
    }

    private function seedDemoCampaignsIfMissing($db): void
    {
        $builder = $db->table('campaigns');
        $fields = $db->getFieldNames('campaigns');
        $campaigns = [
            [
                'title' => 'Solar Lamps for Sitio Pag-asa',
                'description' => 'Help us install durable solar lamps for 120 households in Sitio Pag-asa so students can study at night and families can stay safe during power interruptions.',
                'goal_amount' => 85000,
                'image' => 'ai-solar-lamps-sitio-pagasa.svg',
                'current_amount' => 14500,
                'deadline' => date('Y-m-d', strtotime('+45 days')),
            ],
            [
                'title' => 'School Supplies for Barangay Malaya',
                'description' => 'Provide notebooks, pencils, and hygiene kits for 60 students in Barangay Malaya before the next school quarter starts.',
                'goal_amount' => 1800,
                'image' => 'ai-school-supplies-malaya.svg',
                'current_amount' => 350,
                'deadline' => date('Y-m-d', strtotime('+20 days')),
            ],
            [
                'title' => 'Medicines for Lola Rosa',
                'description' => 'Support a one-month maintenance medicine pack for Lola Rosa, a senior citizen managing hypertension and diabetes.',
                'goal_amount' => 1200,
                'image' => 'ai-medicines-lola-rosa.svg',
                'current_amount' => 900,
                'deadline' => date('Y-m-d', strtotime('+12 days')),
            ],
            [
                'title' => 'Rice Packs for 20 Families',
                'description' => 'Fund rice and canned goods for 20 families affected by recent flooding in low-lying areas.',
                'goal_amount' => 2000,
                'image' => 'ai-rice-packs-families.svg',
                'current_amount' => 2000,
                'deadline' => date('Y-m-d', strtotime('+5 days')),
            ],
            [
                'title' => 'Community First Aid Refill',
                'description' => 'Restock first aid essentials including bandages, antiseptics, and basic emergency medicines for barangay responders.',
                'goal_amount' => 1500,
                'image' => 'ai-community-first-aid.svg',
                'current_amount' => 250,
                'deadline' => date('Y-m-d', strtotime('+14 days')),
            ],
            [
                'title' => 'Typhoon Shelter Repair Fund',
                'description' => 'Repair damaged roofing panels and walling in an evacuation center used by families during storms.',
                'goal_amount' => 25000,
                'image' => 'ai-typhoon-shelter-repair.svg',
                'current_amount' => 8000,
                'deadline' => date('Y-m-d', strtotime('-10 days')),
            ],
        ];

        foreach ($campaigns as $campaignData) {
            $existing = $builder
                ->where('title', $campaignData['title'])
                ->get()
                ->getRow();

            $insert = [
                'title' => $campaignData['title'],
                'description' => $campaignData['description'],
                'goal_amount' => $campaignData['goal_amount'],
                'image' => $campaignData['image'],
            ];

            if (in_array('current_amount', $fields, true)) {
                $insert['current_amount'] = $campaignData['current_amount'];
            }

            if (in_array('deadline', $fields, true)) {
                $insert['deadline'] = $campaignData['deadline'];
            }

            if ($existing) {
                $builder->where('id', $existing->id)->update($insert);
                continue;
            }

            $builder->insert($insert);
        }
    }

public function view($id)
{
    $db = \Config\Database::connect();

    // Get campaign
    $campaignBuilder = $db->table('campaigns');
    $campaign = $campaignBuilder->where('id',$id)->get()->getRow();

    if (!$campaign) {
        return redirect()->to(base_url('campaigns'))->with('error', 'Campaign not found.');
    }

    // Get total approved donations
    $donationBuilder = $db->table('donations');
    $donationBuilder->selectSum('amount');
    $donationBuilder->where('campaign_id',$id);
    $donationBuilder->where('status','approved');

    $result = $donationBuilder->get()->getRow();

    $total = $result->amount ?? 0;

    // Calculate progress %
    $progress = 0;

    if($campaign->goal_amount > 0)
    {
        $progress = ($total / $campaign->goal_amount) * 100;
    }

    $data['campaign'] = $campaign;
    $data['progress'] = round($progress);
    $data['total'] = $total;

    return view('campaign_view',$data);
}
}