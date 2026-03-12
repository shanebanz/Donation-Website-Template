<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Campaign extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('campaigns');
        $data['campaigns'] = $builder->get()->getResult();

        return view('campaigns', $data);
    }

public function view($id)
{
    $db = \Config\Database::connect();

    // Get campaign
    $campaignBuilder = $db->table('campaigns');
    $campaign = $campaignBuilder->where('id',$id)->get()->getRow();

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