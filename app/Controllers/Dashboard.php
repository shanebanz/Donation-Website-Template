<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $perPage = 6;
        $page    = (int) ($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;

        $today = date('Y-m-d');
        $tab   = $this->request->getGet('tab') === 'ended' ? 'ended' : 'active';

        $all = $db->table('campaigns')->orderBy('id', 'DESC')->get()->getResult();

        $allActive = [];
        $allEnded  = [];

        foreach ($all as $c) {
            $deadline  = !empty($c->deadline) ? date('Y-m-d', strtotime((string) $c->deadline)) : null;
            $isDone    = (float)($c->goal_amount ?? 0) > 0 && (float)($c->current_amount ?? 0) >= (float)($c->goal_amount ?? 0);
            $isExpired = !empty($deadline) && $deadline < $today;

            if ($isDone || $isExpired) {
                $allEnded[] = $c;
            } else {
                $allActive[] = $c;
            }
        }

        $sourceList = $tab === 'ended' ? $allEnded : $allActive;
        $totalItems = count($sourceList);
        $totalPages = max(1, (int) ceil($totalItems / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $paged = array_slice($sourceList, ($page - 1) * $perPage, $perPage);

        return view('dashboard', [
            'campaigns'   => $paged,
            'currentTab'  => $tab,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'activeCount' => count($allActive),
            'endedCount'  => count($allEnded),
        ]);
    }
}