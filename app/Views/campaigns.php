<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$activeCampaigns = $activeCampaigns ?? [];
$endedCampaigns  = $endedCampaigns  ?? [];
$currentTab      = $currentTab      ?? 'active';
$currentPage     = $currentPage     ?? 1;
$totalPages      = $totalPages      ?? 1;
$activeCount     = $activeCount     ?? 0;
$endedCount      = $endedCount      ?? 0;
?>

<style>
.campaign-page-head{
background:linear-gradient(135deg,#0f1713 0%,#1e2c24 55%,#304538 100%);
border-radius:18px;
padding:28px;
color:#f4faf5;
margin-bottom:22px;
box-shadow:0 16px 30px rgba(12,21,16,.22);
display:grid;
grid-template-columns:1.1fr .9fr;
gap:18px;
align-items:center;
}

.campaign-page-head p{
color:#d4e3d9;
max-width:760px;
margin:8px 0 0;
}

.campaign-head-visual{
border-radius:14px;
min-height:220px;
background:
linear-gradient(130deg,rgba(15,23,19,.16),rgba(15,23,19,.45)),
url('/sinag-donation/public/uploads/ai-solar-lamps-sitio-pagasa.svg') center/cover no-repeat;
box-shadow:inset 0 0 0 1px rgba(255,255,255,.16);
}

.campaign-card{
height:100%;
}

.campaign-card .card-body{
display:flex;
flex-direction:column;
}

.campaign-title{
display:-webkit-box;
-webkit-line-clamp:2;
-webkit-box-orient:vertical;
overflow:hidden;
}

.campaign-description{
display:-webkit-box;
-webkit-line-clamp:3;
-webkit-box-orient:vertical;
overflow:hidden;
min-height:4.6rem;
}

.campaign-placeholder-image{
height:200px;
background:linear-gradient(135deg,#dbe5d7 0%,#cfdac9 100%);
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
}

.campaign-tabs .nav-link.active{
background:#5f7c2f;
color:#fff !important;
}

.campaign-meta{
color:#5a6658;
font-size:.95rem;
}

.campaign-meta strong{
color:#293628;
}

@media (max-width: 576px){
.campaign-page-head{
padding:18px;
border-radius:14px;
grid-template-columns:1fr;
}

.campaign-page-head p{
font-size:.93rem;
}

.campaign-head-visual{
min-height:170px;
}

.campaign-tabs{
overflow-x:auto;
flex-wrap:nowrap;
padding:6px;
}

.campaign-tabs .nav-link{
white-space:nowrap;
font-size:.9rem;
padding:.46rem .72rem;
}

.campaign-card .card-body{
padding:14px;
}

.campaign-card .card-img-top,
.campaign-placeholder-image{
height:170px;
}
}
</style>

<section class="campaign-page-head">
<div>
<h2 class="mb-0">Support a Campaign</h2>
<p>Choose a cause that matters to you. Contributions are reviewed and reflected in campaign progress once verified.</p>
</div>
<div class="campaign-head-visual" aria-hidden="true"></div>
</section>

<ul class="nav nav-tabs mb-4 campaign-tabs" role="tablist">
<li class="nav-item" role="presentation">
<a class="nav-link <?= $currentTab === 'active' ? 'active' : '' ?>"
   href="/sinag-donation/public/campaigns?tab=active">
Active Campaigns
<?php if($activeCount > 0): ?><span class="badge <?= $currentTab === 'active' ? 'bg-white text-success' : 'bg-success' ?> ms-1"><?= $activeCount ?></span><?php endif; ?>
</a>
</li>
<li class="nav-item" role="presentation">
<a class="nav-link <?= $currentTab === 'ended' ? 'active' : '' ?>"
   href="/sinag-donation/public/campaigns?tab=ended">
Expired or Done
<?php if($endedCount > 0): ?><span class="badge <?= $currentTab === 'ended' ? 'bg-white text-secondary' : 'bg-secondary' ?> ms-1"><?= $endedCount ?></span><?php endif; ?>
</a>
</li>
</ul>

<div class="row">

<?php $items = $currentTab === 'ended' ? $endedCampaigns : $activeCampaigns; ?>
<?php if(empty($items)): ?>
<div class="col-12">
<div class="alert alert-light border">
<?= $currentTab === 'ended' ? 'No expired or completed campaigns yet.' : 'No active campaigns at the moment.' ?>
</div>
</div>
<?php endif; ?>

<?php foreach($items as $c): ?>
<div class="col-md-6 col-lg-4 mb-4 d-flex">
<div class="card shadow campaign-card w-100">

<?php if(!empty($c->image)): ?>
<img src="/sinag-donation/public/uploads/<?= $c->image ?>" class="card-img-top" alt="<?= esc($c->title) ?>">
<?php else: ?>
<div class="campaign-placeholder-image"></div>
<?php endif; ?>

<div class="card-body">
<?php if($currentTab === 'ended'): ?>
<div class="d-flex justify-content-between align-items-center mb-2">
<h5 class="card-title mb-0 campaign-title"><?= esc($c->title) ?></h5>
<span class="badge bg-secondary">Ended</span>
</div>
<?php else: ?>
<h5 class="card-title campaign-title"><?= esc($c->title) ?></h5>
<?php endif; ?>

<p class="card-text campaign-description"><?= esc($c->description) ?></p>
<p class="campaign-meta"><strong>Goal:</strong> ₱<?= number_format($c->goal_amount) ?></p>
<?php if(!empty($c->deadline)): ?>
<p class="campaign-meta mb-3"><strong>Deadline:</strong> <?= date('M d, Y', strtotime($c->deadline)) ?></p>
<?php endif; ?>

<a href="/sinag-donation/public/campaign/<?= $c->id ?>"
   class="btn <?= $currentTab === 'ended' ? 'btn-outline-secondary' : 'btn-primary' ?> mt-auto">
<?= $currentTab === 'ended' ? 'View Details' : 'View Campaign' ?>
</a>
</div>
</div>
</div>
<?php endforeach; ?>

</div>

<?php if($totalPages > 1): ?>
<nav aria-label="Campaign pages" class="mt-2 mb-4">
<ul class="pagination justify-content-center">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/campaigns?tab=<?= $currentTab ?>&page=<?= $currentPage - 1 ?>">&#8592; Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/campaigns?tab=<?= $currentTab ?>&page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/campaigns?tab=<?= $currentTab ?>&page=<?= $currentPage + 1 ?>">Next &#8594;</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>