<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Donation extends Controller
{

public function index($id)
{
    if (session()->get('isAdmin')) {
        return redirect()->to(base_url('admin'))->with('error', 'Donation is available for regular users only.');
    }

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

    $paymentMethodsRaw = (string) env('payment.supported_methods', 'GCash,Google Pay');
    $paymentMethods = array_values(array_filter(array_map('trim', explode(',', $paymentMethodsRaw))));
    if (empty($paymentMethods)) {
        $paymentMethods = ['GCash'];
    }

    $data = [
        'campaign' => $campaign,
        'progress' => $progress,
        'paymentQrImage' => (string) env('payment.qr_image', '/sinag-donation/public/uploads/payment-qr.png'),
        'paymentAccountName' => (string) env('payment.account_name', 'SINAG Donation'),
        'paymentAccountNumber' => (string) env('payment.account_number', ''),
        'paymentMethods' => $paymentMethods,
    ];

    return view('donate', $data);
}

public function save()
{
    if (session()->get('isAdmin')) {
        return redirect()->to(base_url('admin'))->with('error', 'Donation is available for regular users only.');
    }

    $db = \Config\Database::connect();

    $campaign_id = $this->request->getPost('campaign_id');
    $amount = $this->request->getPost('amount');
    $isAnonymous = $this->request->getPost('is_anonymous') === '1';
    $rawDonorName = trim((string) $this->request->getPost('donor_name'));
    $sessionName = trim((string) (session()->get('name') ?? ''));

    if ($isAnonymous) {
        $ownerName = $sessionName !== '' ? $sessionName : ($rawDonorName !== '' ? $rawDonorName : 'Guest');
        $donorName = '__ANON__:' . $ownerName;
    } else {
        $donorName = $rawDonorName !== '' ? $rawDonorName : ($sessionName !== '' ? $sessionName : 'Anonymous');
    }

    $file = $this->request->getFile('proof');
    $proofName = null;

    if ($file && $file->isValid() && !$file->hasMoved())
    {
        $proofName = $file->getRandomName();
        $file->move('uploads', $proofName);
    }

    $data = [
        'campaign_id' => $campaign_id,
        'donor_name' => $donorName,
        'amount' => $amount,
        'payment_method' => (string) ($this->request->getPost('payment_method') ?: 'GCash'),
        'reference_number' => $this->request->getPost('reference'),
        'proof' => $proofName,
        'status' => 'pending'
    ];

    $db->table('donations')->insert($data);

    return redirect()->to(base_url('campaign/' . $campaign_id));
}

}