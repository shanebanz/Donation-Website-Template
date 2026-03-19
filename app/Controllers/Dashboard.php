<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (! session()->get('user_id')) {
            return redirect()->to(base_url('login'))->with('error', 'Please login to view your dashboard.');
        }

        $db = \Config\Database::connect();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        if ($page < 1) {
            $page = 1;
        }

        $allowedStatus = ['all', 'pending', 'approved', 'rejected'];
        $status = strtolower((string) ($this->request->getGet('status') ?? 'all'));
        if (! in_array($status, $allowedStatus, true)) {
            $status = 'all';
        }

        $donorName = (string) (session()->get('name') ?? '');
        $anonymousMarker = '__ANON__:' . $donorName;

        $summaryBuilder = $db->table('donations')
            ->select('status, COUNT(*) AS total', false)
            ->groupStart()
                ->where('donor_name', $donorName)
                ->orWhere('donor_name', $anonymousMarker)
            ->groupEnd()
            ->groupBy('status');

        $summaryRows = $summaryBuilder->get()->getResultArray();

        $summary = [
            'all' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
        ];

        foreach ($summaryRows as $row) {
            $key = strtolower((string) ($row['status'] ?? ''));
            if (isset($summary[$key])) {
                $summary[$key] = (int) ($row['total'] ?? 0);
                $summary['all'] += (int) ($row['total'] ?? 0);
            }
        }

        $totalBuilder = $db->table('donations')
            ->groupStart()
                ->where('donor_name', $donorName)
                ->orWhere('donor_name', $anonymousMarker)
            ->groupEnd();
        if ($status !== 'all') {
            $totalBuilder->where('status', $status);
        }
        $totalItems = $totalBuilder->countAllResults();

        $totalPages = max(1, (int) ceil($totalItems / $perPage));
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $historyBuilder = $db->table('donations');
        $historyBuilder->select('donations.id, donations.campaign_id, donations.amount, donations.reference_number, donations.status, donations.created_at, campaigns.title AS campaign_title, campaigns.image AS campaign_image');
        $historyBuilder->join('campaigns', 'campaigns.id = donations.campaign_id', 'left');
        $historyBuilder->groupStart()
            ->where('donations.donor_name', $donorName)
            ->orWhere('donations.donor_name', $anonymousMarker)
        ->groupEnd();
        if ($status !== 'all') {
            $historyBuilder->where('donations.status', $status);
        }
        $historyBuilder->orderBy('donations.id', 'DESC');
        $historyBuilder->limit($perPage, ($page - 1) * $perPage);

        $donations = $historyBuilder->get()->getResult();

        return view('dashboard', [
            'donations' => $donations,
            'summary' => $summary,
            'currentStatus' => $status,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}