<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Donation extends Controller
{

public function index($id)
{
    $db = \Config\Database::connect();

    $builder = $db->table('campaigns');
    $builder->where('id', $id);

    $campaign = $builder->get()->getRow();

    if (!$campaign) {
        return redirect()->to(base_url('campaigns'))->with('error', 'Campaign not found.');
    }

    // calculate progress
    $progress = 0;

    if ($campaign && $campaign->goal_amount > 0) {
        $progress = min(100, ($campaign->current_amount / $campaign->goal_amount) * 100);
    }

    $data = [
        'campaign' => $campaign,
        'progress' => $progress
    ];

    return view('donate', $data);
}

public function save()
{
    $db = \Config\Database::connect();

    $campaign_id = $this->request->getPost('campaign_id');
    $amount = $this->request->getPost('amount');

    $file = $this->request->getFile('proof');
    $proofName = null;

    if ($file && $file->isValid() && !$file->hasMoved())
    {
        $proofName = $file->getRandomName();
        $file->move('uploads', $proofName);
    }

    $data = [
        'campaign_id' => $campaign_id,
        'donor_name' => $this->request->getPost('donor_name'),
        'amount' => $amount,
        'payment_method' => 'GCash',
        'reference_number' => $this->request->getPost('reference'),
        'proof' => $proofName,
        'status' => 'pending'
    ];

    $db->table('donations')->insert($data);

    return redirect()->to(base_url('campaign/' . $campaign_id));
}

}