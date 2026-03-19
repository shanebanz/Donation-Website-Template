<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$donations = $donations ?? [];
$summary = $summary ?? ['all' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0];
$currentStatus = $currentStatus ?? 'all';
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;

$statusLabelMap = [
    'all' => 'All',
    'pending' => 'Pending',
    'approved' => 'Approved',
    'rejected' => 'Rejected',
];
?>

<style>
.user-dash-head{
background:linear-gradient(135deg,#0f1713 0%,#1f2d25 56%,#31473a 100%);
border-radius:16px;
padding:24px;
color:#f4faf5;
margin-bottom:20px;
box-shadow:0 12px 24px rgba(15,22,18,.1);
}

.user-dash-head p{
margin:8px 0 0;
color:#d6e6db;
}

.status-cards{
display:grid;
grid-template-columns:repeat(4,minmax(150px,1fr));
gap:12px;
margin-bottom:18px;
}

.status-card{
background:#fff;
border:1px solid #dce6d8;
border-radius:12px;
padding:14px 16px;
box-shadow:0 4px 12px rgba(15,22,18,.06);
}

.status-card-title{
font-size:.82rem;
text-transform:uppercase;
letter-spacing:.55px;
color:#5f6a63;
margin-bottom:3px;
font-weight:700;
}

.status-card-value{
font-size:1.5rem;
font-weight:800;
color:#1b271f;
line-height:1;
}

.status-tabs{
background:#f7faf5;
padding:8px;
border-radius:12px;
border:1px solid #dce6d8;
margin-bottom:16px;
}

.status-tabs .nav-link{
border:none;
border-radius:9px;
font-weight:600;
padding:.5rem .9rem;
color:#495057;
}

.status-tabs .nav-link.active{
background:#5f7c2f;
color:#fff !important;
}

.history-wrap{
background:#fff;
border-radius:14px;
border:1px solid #dde6da;
box-shadow:0 8px 20px rgba(15,22,18,.08);
overflow:hidden;
}

.history-head{
padding:14px 16px;
border-bottom:1px solid #e8eee6;
font-weight:700;
color:#1b271f;
}

.history-table{
margin:0;
}

.history-table th{
font-size:.84rem;
text-transform:uppercase;
letter-spacing:.45px;
color:#5f6a63;
background:#f9fbf8;
}

.status-pill{
font-weight:700;
border-radius:999px;
padding:.34rem .6rem;
font-size:.75rem;
text-transform:uppercase;
letter-spacing:.35px;
}

.status-pending{background:#fff4db;color:#8a6510;}
.status-approved{background:#e6f7ea;color:#1e7e34;}
.status-rejected{background:#fde7e8;color:#b02a37;}

@media (max-width: 992px){
.status-cards{
grid-template-columns:repeat(2,minmax(140px,1fr));
}
}

@media (max-width: 576px){
.status-cards{
grid-template-columns:1fr;
}

.history-wrap{
border-radius:12px;
}

.history-head{
font-size:.92rem;
}
}
</style>

<section class="user-dash-head">
<h2 class="mb-0">My Donation Dashboard</h2>
<p>Track your donation statuses and review your complete campaign contribution history.</p>
</section>

<section class="status-cards">
<div class="status-card">
<div class="status-card-title">Total Donations</div>
<div class="status-card-value"><?= (int) ($summary['all'] ?? 0) ?></div>
</div>
<div class="status-card">
<div class="status-card-title">Pending</div>
<div class="status-card-value"><?= (int) ($summary['pending'] ?? 0) ?></div>
</div>
<div class="status-card">
<div class="status-card-title">Approved</div>
<div class="status-card-value"><?= (int) ($summary['approved'] ?? 0) ?></div>
</div>
<div class="status-card">
<div class="status-card-title">Rejected</div>
<div class="status-card-value"><?= (int) ($summary['rejected'] ?? 0) ?></div>
</div>
</section>

<ul class="nav nav-tabs status-tabs" role="tablist">
<?php foreach ($statusLabelMap as $key => $label): ?>
<li class="nav-item" role="presentation">
<a class="nav-link <?= $currentStatus === $key ? 'active' : '' ?>" href="/sinag-donation/public/dashboard?status=<?= $key ?>">
<?= $label ?>
<?php if (($summary[$key] ?? 0) > 0): ?>
<span class="badge <?= $currentStatus === $key ? 'bg-white text-success' : 'bg-success' ?> ms-1"><?= (int) $summary[$key] ?></span>
<?php endif; ?>
</a>
</li>
<?php endforeach; ?>
</ul>

<div class="history-wrap">
<div class="history-head">Donation History (<?= esc($statusLabelMap[$currentStatus] ?? 'All') ?>)</div>

<?php if (empty($donations)): ?>
<div class="p-3">
<div class="alert alert-light border mb-0">No donations found for this status.</div>
</div>
<?php else: ?>
<div class="table-responsive">
<table class="table history-table align-middle mb-0">
<thead>
<tr>
<th>Campaign</th>
<th>Amount</th>
<th>Reference</th>
<th>Status</th>
<th>Date</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($donations as $d): ?>
<tr>
<td><?= esc($d->campaign_title ?? 'Deleted Campaign') ?></td>
<td>PHP <?= number_format((float) ($d->amount ?? 0), 2) ?></td>
<td><?= esc($d->reference_number ?: '-') ?></td>
<td>
<?php $status = strtolower((string) ($d->status ?? 'pending')); ?>
<span class="status-pill status-<?= esc($status) ?>"><?= esc(ucfirst($status)) ?></span>
</td>
<td>
<?php if (! empty($d->created_at)): ?>
<?= esc(date('M d, Y h:i A', strtotime((string) $d->created_at))) ?>
<?php else: ?>
-
<?php endif; ?>
</td>
<td>
<?php if (! empty($d->campaign_id)): ?>
<a href="/sinag-donation/public/campaign/<?= (int) $d->campaign_id ?>" class="btn btn-sm btn-outline-secondary">View Campaign</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php endif; ?>
</div>

<?php if ($totalPages > 1): ?>
<nav aria-label="Donation pages" class="mt-3 mb-2">
<ul class="pagination justify-content-center">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?status=<?= esc($currentStatus) ?>&page=<?= $currentPage - 1 ?>">Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?status=<?= esc($currentStatus) ?>&page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?status=<?= esc($currentStatus) ?>&page=<?= $currentPage + 1 ?>">Next</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>
