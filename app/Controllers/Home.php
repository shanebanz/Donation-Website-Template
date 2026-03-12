<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{

public function index()
{

$db = \Config\Database::connect();

$builder = $db->table('campaigns');

$data['campaigns'] = $builder->get()->getResult();

return view('campaigns',$data);

}

}