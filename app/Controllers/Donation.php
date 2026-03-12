<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Donation extends Controller
{

    public function index($campaign_id)
    {
        $data['campaign_id'] = $campaign_id;
        return view('donate',$data);
    }

public function save()
{
    $db = \Config\Database::connect();

    $campaign_id = $this->request->getPost('campaign_id');
    $amount = $this->request->getPost('amount');

    $data = [
        'campaign_id' => $campaign_id,
        'donor_name' => $this->request->getPost('donor_name'),
        'amount' => $amount,
        'payment_method' => 'GCash',
        'reference_number' => $this->request->getPost('reference'),
        'status' => 'pending'
    ];

    // save donation
    $db->table('donations')->insert($data);

    // update campaign total
    $builder = $db->table('campaigns');
    $builder->set('current_amount', "current_amount + $amount", false);
    $builder->where('id', $campaign_id);
    $builder->update();

    return redirect()->to('/campaign/'.$campaign_id);
}

}