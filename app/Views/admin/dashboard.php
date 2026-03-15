<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$totalStatus = max(1, $approvedDonations + $pendingDonations + $rejectedDonations);
$approvedPct = round(($approvedDonations / $totalStatus) * 100);
$pendingPct = round(($pendingDonations / $totalStatus) * 100);
$rejectedPct = round(($rejectedDonations / $totalStatus) * 100);
?>

<style>
.metric-card{
border:1px solid #e1e7e2;
border-radius:14px;
padding:16px;
background:#fff;
box-shadow:0 10px 18px rgba(15,20,18,.06);
height:100%;
}

.metric-label{
font-size:.82rem;
font-weight:600;
color:#5f6c63;
text-transform:uppercase;
letter-spacing:.4px;
}

.metric-value{
font-size:1.65rem;
font-weight:800;
color:#1a241e;
}

.metric-sub{
font-size:.88rem;
color:#6b766f;
}

.analytics-card{
border:1px solid #e3e9e4;
border-radius:14px;
padding:16px;
background:#fff;
box-shadow:0 10px 20px rgba(15,20,18,.06);
height:100%;
}

.analytics-title{
font-size:1.04rem;
font-weight:700;
margin-bottom:12px;
}

.status-row{
margin-bottom:10px;
}

.status-head{
display:flex;
justify-content:space-between;
font-size:.9rem;
margin-bottom:5px;
}

.status-track{
height:10px;
border-radius:999px;
background:#e6ece6;
overflow:hidden;
}

.status-bar{
height:100%;
}

.bar-approved{background:#3aa35f;}
.bar-pending{background:#c9a343;}
.bar-rejected{background:#c55858;}

.table-sm td,
.table-sm th{
padding:.55rem .45rem;
}
</style>

<h2 class="mb-4">Admin Dashboard</h2>

<div class="row g-3 mb-3">
<div class="col-md-6 col-xl-3">
<div class="metric-card">
<div class="metric-label">Total Money Gathered</div>
<div class="metric-value">₱<?= number_format($totalMoneyGathered, 2) ?></div>
<div class="metric-sub">Approved donations only</div>
</div>
</div>

<div class="col-md-6 col-xl-3">
<div class="metric-card">
<div class="metric-label">Total Donations</div>
<div class="metric-value"><?= $totalDonations ?></div>
<div class="metric-sub">Approved, pending, rejected</div>
</div>
</div>

<div class="col-md-6 col-xl-3">
<div class="metric-card">
<div class="metric-label">Total Campaigns</div>
<div class="metric-value"><?= $totalCampaigns ?></div>
<div class="metric-sub">All campaigns in platform</div>
</div>
</div>

<div class="col-md-6 col-xl-3">
<div class="metric-card">
<div class="metric-label">Users</div>
<div class="metric-value"><?= $totalUsers ?></div>
<div class="metric-sub">Active: <?= $activeUsers ?> | Disabled: <?= $disabledUsers ?></div>
</div>
</div>
</div>

<div class="row g-3">
<div class="col-lg-5">
<div class="analytics-card">
<h3 class="analytics-title">Donation Status Distribution</h3>

<div class="status-row">
<div class="status-head"><span>Approved</span><span><?= $approvedDonations ?> (<?= $approvedPct ?>%)</span></div>
<div class="status-track"><div class="status-bar bar-approved" style="width: <?= $approvedPct ?>%"></div></div>
</div>

<div class="status-row">
<div class="status-head"><span>Pending</span><span><?= $pendingDonations ?> (<?= $pendingPct ?>%)</span></div>
<div class="status-track"><div class="status-bar bar-pending" style="width: <?= $pendingPct ?>%"></div></div>
</div>

<div class="status-row mb-0">
<div class="status-head"><span>Rejected</span><span><?= $rejectedDonations ?> (<?= $rejectedPct ?>%)</span></div>
<div class="status-track"><div class="status-bar bar-rejected" style="width: <?= $rejectedPct ?>%"></div></div>
</div>
</div>
</div>

<div class="col-lg-7">
<div class="analytics-card">
<h3 class="analytics-title">Top Campaigns by Approved Funds</h3>

<div class="table-responsive">
<table class="table table-sm align-middle mb-0">
<thead>
<tr>
<th>Campaign</th>
<th>Approved Funds</th>
<th>Donation Entries</th>
</tr>
</thead>
<tbody>
<?php if(empty($topCampaigns)): ?>
<tr><td colspan="3" class="text-muted">No campaign data available yet.</td></tr>
<?php endif; ?>

<?php foreach($topCampaigns as $campaign): ?>
<tr>
<td><?= esc($campaign->title) ?></td>
<td>₱<?= number_format((float) $campaign->approved_total, 2) ?></td>
<td><?= (int) $campaign->donation_count ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

<?= $this->endSection() ?>