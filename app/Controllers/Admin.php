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

    $campaignBuilder = $db->table('campaigns');
    $totalCampaigns = $campaignBuilder->countAllResults();

    $donationBuilder = $db->table('donations');
    $totalDonations = $donationBuilder->countAllResults();

    $pendingBuilder = $db->table('donations');
    $pendingBuilder->where('status','pending');
    $pendingDonations = $pendingBuilder->countAllResults();

    $data['totalCampaigns'] = $totalCampaigns;
    $data['totalDonations'] = $totalDonations;
    $data['pendingDonations'] = $pendingDonations;

    return view('admin_dashboard',$data);
}

public function donations()
{
$db = \Config\Database::connect();

$builder = $db->table('donations');
$builder->select('donations.*, campaigns.title');

$builder->join('campaigns','campaigns.id = donations.campaign_id');

$data['donations'] = $builder->get()->getResult();

return view('admin/donations',$data);
}

public function campaigns()
{
    $db = \Config\Database::connect();

    $builder = $db->table('campaigns');
    $campaigns = $builder->get()->getResult();

    $data['campaigns'] = $campaigns;

    return view('admin_campaigns', $data);
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

return redirect()->to('/admin/campaigns');

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
        return redirect()->to('/admin/donations');
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

    return redirect()->to('/admin/donations');
}

public function reject($id)
{
    $db = \Config\Database::connect();

    $db->table('donations')
       ->where('id', $id)
       ->update(['status' => 'rejected']);

    return redirect()->to('/admin/donations');
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

    return redirect()->to('/admin/campaigns');
}


public function deleteCampaign($id)
{
    $db = \Config\Database::connect();

    $builder = $db->table('campaigns');

    $builder->where('id',$id)->delete();

    return redirect()->to('/admin/campaigns');
}

}