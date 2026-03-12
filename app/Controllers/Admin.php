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
return view('admin/dashboard');
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

$data['campaigns'] = $builder->get()->getResult();

return view('admin/campaigns',$data);

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

$builder = $db->table('donations');

$donation = $builder->where('id',$id)->get()->getRow();

$builder->where('id',$id)->update([
'status' => 'approved'
]);

return redirect()->to('/admin/donations');

}

public function reject($id)
{

$db = \Config\Database::connect();

$builder = $db->table('donations');

$builder->where('id',$id)->update([
'status' => 'rejected'
]);

return redirect()->to('/admin/donations');

}


}