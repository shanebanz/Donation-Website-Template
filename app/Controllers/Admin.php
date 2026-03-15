<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{

public function __construct()
{
    if(!session()->get('isAdmin'))
    {
        echo "Access Denied<br>";
        echo "You must be logged in as an admin to view this page.<br><br>";
        echo "<a href='/sinag-donation/public/login' class='btn btn-primary'>Login</a>";
        exit;
    }
}


public function index()
{
    $db = \Config\Database::connect();

    $this->ensureUserActivityColumn($db);

    $campaignBuilder = $db->table('campaigns');
    $totalCampaigns = $campaignBuilder->countAllResults();

    $donationBuilder = $db->table('donations');
    $totalDonations = $donationBuilder->countAllResults();

    $pendingBuilder = $db->table('donations');
    $pendingBuilder->where('status','pending');
    $pendingDonations = $pendingBuilder->countAllResults();

    $approvedBuilder = $db->table('donations');
    $approvedBuilder->selectSum('donations.amount', 'amount');
    $approvedBuilder->join('campaigns', 'campaigns.id = donations.campaign_id');
    $approvedBuilder->where('donations.status', 'approved');
    $approvedAmountRow = $approvedBuilder->get()->getRow();
    $totalMoneyGathered = (float) ($approvedAmountRow->amount ?? 0);

    $approvedCountBuilder = $db->table('donations');
    $approvedCountBuilder->where('status', 'approved');
    $approvedDonations = $approvedCountBuilder->countAllResults();

    $rejectedCountBuilder = $db->table('donations');
    $rejectedCountBuilder->where('status', 'rejected');
    $rejectedDonations = $rejectedCountBuilder->countAllResults();

    $userFields = $db->getFieldNames('users');
    $userBuilder = $db->table('users');
    $totalUsers = $userBuilder->countAllResults();

    $activeUsers = 0;
    $disabledUsers = 0;
    if (in_array('is_active', $userFields, true)) {
        $activeBuilder = $db->table('users');
        $activeBuilder->where('is_active', 1);
        $activeUsers = $activeBuilder->countAllResults();

        $disabledBuilder = $db->table('users');
        $disabledBuilder->where('is_active', 0);
        $disabledUsers = $disabledBuilder->countAllResults();
    }

    $topCampaigns = $db->table('campaigns')
        ->select("campaigns.title, COUNT(donations.id) as donation_count, COALESCE(SUM(CASE WHEN donations.status = 'approved' THEN donations.amount ELSE 0 END), 0) as approved_total", false)
        ->join('donations', 'donations.campaign_id = campaigns.id', 'left')
        ->groupBy('campaigns.id, campaigns.title')
        ->orderBy('approved_total', 'DESC')
        ->limit(5)
        ->get()
        ->getResult();

    $statusSummary = [
        'approved' => $approvedDonations,
        'pending' => $pendingDonations,
        'rejected' => $rejectedDonations,
    ];

    $data['totalCampaigns'] = $totalCampaigns;
    $data['totalDonations'] = $totalDonations;
    $data['pendingDonations'] = $pendingDonations;
    $data['approvedDonations'] = $approvedDonations;
    $data['rejectedDonations'] = $rejectedDonations;
    $data['totalMoneyGathered'] = $totalMoneyGathered;
    $data['totalUsers'] = $totalUsers;
    $data['activeUsers'] = $activeUsers;
    $data['disabledUsers'] = $disabledUsers;
    $data['topCampaigns'] = $topCampaigns;
    $data['statusSummary'] = $statusSummary;

    return view('admin/dashboard',$data);
}

public function users()
{
    $db = \Config\Database::connect();

    $this->ensureUserActivityColumn($db);
    $this->ensureRoleColumn($db);

    $perPage = 15;
    $page    = (int) ($this->request->getGet('page') ?? 1);
    if ($page < 1) $page = 1;

    $total      = $db->table('users')->countAllResults();
    $totalPages = max(1, (int) ceil($total / $perPage));
    if ($page > $totalPages) $page = $totalPages;

    $users = $db->table('users')
        ->select('id, name, email, role, is_verified, is_active')
        ->orderBy('id', 'DESC')
        ->limit($perPage, ($page - 1) * $perPage)
        ->get()
        ->getResultArray();

    foreach ($users as &$user) {
        $user['masked_email'] = $this->maskEmail((string) ($user['email'] ?? ''));
    }

    $data['users']       = $users;
    $data['currentPage'] = $page;
    $data['totalPages']  = $totalPages;

    return view('admin/users', $data);
}

public function disableUser($id)
{
    $db = \Config\Database::connect();
    $this->ensureUserActivityColumn($db);

    $user = $db->table('users')->where('id', $id)->get()->getRowArray();
    if (!$user) {
        return redirect()->to(base_url('admin/users'))->with('error', 'User not found.');
    }

    if (($user['role'] ?? '') === 'admin') {
        return redirect()->to(base_url('admin/users'))->with('error', 'Admin accounts cannot be disabled from this panel.');
    }

    $db->table('users')->where('id', $id)->update(['is_active' => 0]);

    return redirect()->to(base_url('admin/users'))->with('msg', 'User disabled successfully.');
}

public function enableUser($id)
{
    $db = \Config\Database::connect();
    $this->ensureUserActivityColumn($db);

    $user = $db->table('users')->where('id', $id)->get()->getRowArray();
    if (!$user) {
        return redirect()->to(base_url('admin/users'))->with('error', 'User not found.');
    }

    $db->table('users')->where('id', $id)->update(['is_active' => 1]);

    return redirect()->to(base_url('admin/users'))->with('msg', 'User enabled successfully.');
}

public function deleteUser($id)
{
    $db = \Config\Database::connect();

    $user = $db->table('users')->where('id', $id)->get()->getRowArray();
    if (!$user) {
        return redirect()->to(base_url('admin/users'))->with('error', 'User not found.');
    }

    if (($user['role'] ?? '') === 'admin') {
        return redirect()->to(base_url('admin/users'))->with('error', 'Admin accounts cannot be deleted from this panel.');
    }

    $db->table('users')->where('id', $id)->delete();

    return redirect()->to(base_url('admin/users'))->with('msg', 'User deleted successfully.');
}

public function donations()
{
    $db      = \Config\Database::connect();
    $perPage = 15;
    $page    = (int) ($this->request->getGet('page') ?? 1);
    if ($page < 1) $page = 1;

    $total = $db->table('donations')->countAllResults();
    $totalPages = max(1, (int) ceil($total / $perPage));
    if ($page > $totalPages) $page = $totalPages;

    $builder = $db->table('donations');
    $builder->select('donations.*, campaigns.title');
    $builder->join('campaigns', 'campaigns.id = donations.campaign_id');
    $builder->orderBy('donations.id', 'DESC');
    $builder->limit($perPage, ($page - 1) * $perPage);

    $data['donations']   = $builder->get()->getResult();
    $data['currentPage'] = $page;
    $data['totalPages']  = $totalPages;

    return view('admin/donations', $data);
}

public function campaigns()
{
    $db      = \Config\Database::connect();
    $perPage = 15;
    $page    = (int) ($this->request->getGet('page') ?? 1);
    if ($page < 1) $page = 1;

    $total      = $db->table('campaigns')->countAllResults();
    $totalPages = max(1, (int) ceil($total / $perPage));
    if ($page > $totalPages) $page = $totalPages;

    $campaigns = $db->table('campaigns')
        ->orderBy('id', 'DESC')
        ->limit($perPage, ($page - 1) * $perPage)
        ->get()
        ->getResult();

    $data['campaigns']   = $campaigns;
    $data['currentPage'] = $page;
    $data['totalPages']  = $totalPages;

    return view('admin/campaigns', $data);
}


public function createCampaign()
{
return view('admin/create_campaign');
}


public function storeCampaign()
{

$db = \Config\Database::connect();

$image = $this->request->getFile('image');

$imageName = null;

if($image && $image->isValid())
{
$imageName = $image->getRandomName();
$image->move('uploads',$imageName);
}

$builder = $db->table('campaigns');

$builder->insert([
'title' => $this->request->getPost('title'),
'description' => $this->request->getPost('description'),
'goal_amount' => $this->request->getPost('goal_amount'),
'image' => $imageName
]);

return redirect()->to(base_url('admin/campaigns'));

}

public function approve($id)
{
    $db = \Config\Database::connect();

    // get donation
    $donation = $db->table('donations')
                   ->where('id', $id)
                   ->get()
                   ->getRow();

    if(!$donation){
        return redirect()->to(base_url('admin/donations'));
    }

    // update donation status
    $db->table('donations')
       ->where('id', $id)
       ->update(['status' => 'approved']);

    // add amount to campaign total
    $db->table('campaigns')
       ->set('current_amount', 'current_amount + '.$donation->amount, false)
       ->where('id', $donation->campaign_id)
       ->update();

    return redirect()->to(base_url('admin/donations'));
}

public function reject($id)
{
    $db = \Config\Database::connect();

    $db->table('donations')
       ->where('id', $id)
       ->update(['status' => 'rejected']);

    return redirect()->to(base_url('admin/donations'));
}

public function editCampaign($id)
{
    $db = \Config\Database::connect();

    $builder = $db->table('campaigns');
    $campaign = $builder->where('id',$id)->get()->getRow();

    $data['campaign'] = $campaign;

    return view('admin_edit_campaign',$data);
}


public function updateCampaign($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('campaigns');

    $data = [
        'title' => $this->request->getPost('title'),
        'description' => $this->request->getPost('description'),
        'goal_amount' => $this->request->getPost('goal_amount'),
        'deadline' => $this->request->getPost('deadline')
    ];

    $file = $this->request->getFile('image');

    if($file && $file->isValid() && !$file->hasMoved())
    {
        $newName = $file->getRandomName();
        $file->move('uploads',$newName);
        $data['image'] = $newName;
    }

    $builder->where('id',$id)->update($data);

    return redirect()->to(base_url('admin/campaigns'));
}


public function deleteCampaign($id)
{
    $db = \Config\Database::connect();

    // Remove associated donations first to prevent orphaned records skewing analytics
    $db->table('donations')->where('campaign_id', $id)->delete();

    $db->table('campaigns')->where('id', $id)->delete();

    return redirect()->to(base_url('admin/campaigns'));
}

private function ensureUserActivityColumn($db)
{
    $fields = $db->getFieldNames('users');
    if (in_array('is_active', $fields, true)) {
        return;
    }

    $db->query('ALTER TABLE users ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1');
}

private function ensureRoleColumn($db)
{
    $fields = $db->getFieldNames('users');
    if (in_array('role', $fields, true)) {
        return;
    }

    $db->query("ALTER TABLE users ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'user'");
}

private function maskEmail(string $email): string
{
    if ($email === '' || !str_contains($email, '@')) {
        return 'hidden';
    }

    [$name, $domain] = explode('@', $email, 2);
    if ($name === '') {
        return 'hidden@' . $domain;
    }

    $visible = substr($name, 0, 1);
    return $visible . str_repeat('*', max(3, strlen($name) - 1)) . '@' . $domain;
}

}