<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$campaigns   = $campaigns   ?? [];
$currentTab  = $currentTab  ?? 'active';
$currentPage = $currentPage ?? 1;
$totalPages  = $totalPages  ?? 1;
$activeCount = $activeCount ?? 0;
$endedCount  = $endedCount  ?? 0;
?>

<style>
.dash-wrap{
display:grid;
grid-template-columns:1.2fr 1fr;
gap:18px;
margin-bottom:28px;
}

.dash-panel,
.dash-card{
background:#fff;
border-radius:16px;
padding:24px;
box-shadow:0 12px 24px rgba(15,22,18,.1);
}

.dash-panel{
background:linear-gradient(135deg,#0f1713 0%,#1f2d25 56%,#31473a 100%);
color:#f4faf5;
}

.dash-panel p{
color:#d3e4d8;
max-width:560px;
}

.dash-list{
margin:14px 0 0;
padding-left:18px;
color:#deebe1;
}

.quick-title{
font-size:1.2rem;
margin-bottom:14px;
}

.quick-link{
display:block;
border:1px solid #dde5d9;
border-radius:12px;
padding:12px 14px;
color:#1d2a22;
text-decoration:none;
font-weight:600;
margin-bottom:10px;
}

.quick-link:hover{
border-color:#9db183;
background:#f7faf5;
}

.dash-section-title{
font-size:1.25rem;
font-weight:700;
margin-bottom:16px;
color:#1a2419;
}

.campaign-tabs{
background:#f7faf5;
padding:8px;
border-radius:12px;
border:1px solid #dce6d8;
}

.campaign-tabs .nav-link{
border:none;
border-radius:9px;
font-weight:600;
padding:.55rem .95rem;
color:#495057;
}

.campaign-tabs .nav-link.active{
background:#5f7c2f;
color:#fff !important;
}

@media (max-width: 992px){
.dash-wrap{
grid-template-columns:1fr;
}
}
</style>

<section class="dash-wrap">
<div class="dash-panel">
<h2 class="mb-2">Welcome to SINAG Donation</h2>
<p>You are logged in. Explore campaigns, submit donations, and monitor transparent progress updates.</p>

<ul class="dash-list">
<li>Discover active campaigns</li>
<li>Track approved donation progress</li>
<li>Support causes with verified updates</li>
</ul>
</div>

<aside class="dash-card">
<h3 class="quick-title">Quick Actions</h3>
<a class="quick-link" href="/sinag-donation/public/campaigns">Browse All Campaigns</a>
<a class="quick-link" href="/sinag-donation/public/how-it-works">Read How It Works</a>
<a class="quick-link" href="/sinag-donation/public/admin">Go to Admin Panel</a>
</aside>
</section>

<div class="mb-2">
<span class="dash-section-title">Campaigns</span>
</div>

<ul class="nav nav-tabs mb-4 campaign-tabs">
<li class="nav-item">
<a class="nav-link <?= $currentTab === 'active' ? 'active' : '' ?>"
   href="/sinag-donation/public/dashboard?tab=active">
Active
<?php if($activeCount > 0): ?>
<span class="badge <?= $currentTab === 'active' ? 'bg-white text-success' : 'bg-success' ?> ms-1"><?= $activeCount ?></span>
<?php endif; ?>
</a>
</li>
<li class="nav-item">
<a class="nav-link <?= $currentTab === 'ended' ? 'active' : '' ?>"
   href="/sinag-donation/public/dashboard?tab=ended">
Ended
<?php if($endedCount > 0): ?>
<span class="badge <?= $currentTab === 'ended' ? 'bg-white text-secondary' : 'bg-secondary' ?> ms-1"><?= $endedCount ?></span>
<?php endif; ?>
</a>
</li>
</ul>

<div class="row">
<?php if(empty($campaigns)): ?>
<div class="col-12">
<div class="alert alert-light border">
<?= $currentTab === 'ended' ? 'No ended campaigns yet.' : 'No active campaigns at the moment.' ?>
</div>
</div>
<?php endif; ?>

<?php foreach($campaigns as $c): ?>
<div class="col-md-6 col-lg-4 mb-4 d-flex">
<div class="card shadow w-100">

<?php if(!empty($c->image)): ?>
<img src="/sinag-donation/public/uploads/<?= $c->image ?>" class="card-img-top" alt="<?= esc($c->title) ?>">
<?php else: ?>
<div style="height:200px;background:linear-gradient(135deg,#dbe5d7,#cfdac9);border-top-left-radius:14px;border-top-right-radius:14px;"></div>
<?php endif; ?>

<div class="card-body d-flex flex-column">
<?php if($currentTab === 'ended'): ?>
<div class="d-flex justify-content-between align-items-center mb-2">
<h5 class="card-title mb-0"><?= esc($c->title) ?></h5>
<span class="badge bg-secondary">Ended</span>
</div>
<?php else: ?>
<h5 class="card-title"><?= esc($c->title) ?></h5>
<?php endif; ?>

<p class="card-text text-muted" style="-webkit-line-clamp:3;display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;min-height:4.2rem;"><?= esc($c->description) ?></p>
<p class="small mb-1"><strong>Goal:</strong> ₱<?= number_format($c->goal_amount) ?></p>
<?php if(!empty($c->deadline)): ?>
<p class="small mb-3"><strong>Deadline:</strong> <?= date('M d, Y', strtotime($c->deadline)) ?></p>
<?php endif; ?>
<a href="/sinag-donation/public/campaign/<?= $c->id ?>" class="btn <?= $currentTab === 'ended' ? 'btn-outline-secondary' : 'btn-primary' ?> mt-auto">
<?= $currentTab === 'ended' ? 'View Details' : 'View Campaign' ?>
</a>
</div>

</div>
</div>
<?php endforeach; ?>
</div>

<?php if($totalPages > 1): ?>
<nav aria-label="Dashboard campaign pages" class="mt-2 mb-4">
<ul class="pagination justify-content-center">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?tab=<?= $currentTab ?>&page=<?= $currentPage - 1 ?>">&#8592; Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?tab=<?= $currentTab ?>&page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/dashboard?tab=<?= $currentTab ?>&page=<?= $currentPage + 1 ?>">Next &#8594;</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>