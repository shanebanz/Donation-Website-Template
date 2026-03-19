<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$deadlineText = !empty($campaign->deadline) ? date('M d, Y', strtotime($campaign->deadline)) : 'No deadline';
$safeProgress = max(0, min(100, (int) $progress));
$isAdminSession = (bool) session()->get('isAdmin');
?>

<style>
.campaign-detail-wrap{
display:grid;
grid-template-columns:1.15fr 1fr;
gap:24px;
align-items:start;
}

.campaign-visual,
.campaign-summary{
background:#fff;
border-radius:16px;
box-shadow:0 12px 24px rgba(16,24,19,.08);
}

.campaign-visual img,
.campaign-image-placeholder{
width:100%;
height:420px;
object-fit:cover;
border-radius:16px;
}

.campaign-image-placeholder{
background:linear-gradient(135deg,#dce7d8 0%,#cfdcc9 100%);
}

.campaign-summary{
padding:24px;
}

.campaign-kicker{
font-size:.88rem;
font-weight:600;
letter-spacing:.5px;
text-transform:uppercase;
color:#5f7c2f;
margin-bottom:6px;
}

.campaign-title{
font-size:2rem;
line-height:1.25;
margin-bottom:10px;
}

.campaign-meta{
display:flex;
gap:8px;
flex-wrap:wrap;
margin-bottom:16px;
}

.meta-pill{
padding:6px 10px;
font-size:.82rem;
font-weight:600;
border-radius:999px;
background:#eff4ea;
color:#3f5633;
}

.stat-grid{
display:grid;
grid-template-columns:repeat(2,minmax(0,1fr));
gap:10px;
margin:14px 0 16px;
}

.stat-box{
border:1px solid #e2e8de;
border-radius:12px;
padding:10px 12px;
background:#fafcf9;
}

.stat-label{
font-size:.8rem;
color:#667264;
text-transform:uppercase;
letter-spacing:.4px;
margin-bottom:2px;
}

.stat-value{
font-size:1.1rem;
font-weight:700;
color:#172118;
}

.progress-wrap{
margin:16px 0 22px;
}

.progress-caption{
display:flex;
justify-content:space-between;
font-weight:600;
font-size:.9rem;
margin-bottom:7px;
color:#566652;
}

.action-row{
display:flex;
gap:10px;
flex-wrap:wrap;
}

@media (max-width: 992px){
.campaign-detail-wrap{
grid-template-columns:1fr;
}

.campaign-visual img,
.campaign-image-placeholder{
height:300px;
}
}

@media (max-width: 576px){
.campaign-summary{
padding:16px;
}

.campaign-visual img,
.campaign-image-placeholder{
height:220px;
}

.campaign-meta{
gap:6px;
}

.meta-pill{
font-size:.76rem;
padding:5px 8px;
}

.stat-box{
padding:8px 9px;
}
}
</style>

<div class="campaign-detail-wrap">

<div class="campaign-visual">
<?php if(!empty($campaign->image)): ?>
<img src="/sinag-donation/public/uploads/<?= $campaign->image ?>" alt="<?= esc($campaign->title) ?>">
<?php else: ?>
<div class="campaign-image-placeholder"></div>
<?php endif; ?>
</div>

<div class="campaign-summary">
<p class="campaign-kicker mb-0">Featured Campaign</p>
<h1 class="campaign-title"><?= $campaign->title ?></h1>

<div class="campaign-meta">
<span class="meta-pill">Deadline: <?= $deadlineText ?></span>
<span class="meta-pill">Community Verified</span>
</div>

<p class="mb-3"><?= $campaign->description ?></p>

<div class="stat-grid">
<div class="stat-box">
<div class="stat-label">Goal</div>
<div class="stat-value">₱<?= number_format($campaign->goal_amount) ?></div>
</div>
<div class="stat-box">
<div class="stat-label">Raised</div>
<div class="stat-value">₱<?= number_format($total) ?></div>
</div>
</div>

<div class="progress-wrap">
<div class="progress-caption">
<span>Funding Progress</span>
<span><?= $safeProgress ?>%</span>
</div>
<div class="progress">
<div class="progress-bar bg-success" role="progressbar" style="width: <?= $safeProgress ?>%;">
<?= $safeProgress ?>%
</div>
</div>
</div>

<div class="action-row">
<?php if(!$isAdminSession): ?>
<a href="/sinag-donation/public/donate/<?= $campaign->id ?>" class="btn btn-success px-4">
Donate Now
</a>
<?php endif; ?>
<button class="btn btn-outline-secondary px-4">
Pledge to Help
</button>
</div>

<?php if($isAdminSession): ?>
<p class="text-muted small mt-2 mb-0">Admin accounts cannot submit donations.</p>
<?php endif; ?>
</div>

</div>

<?= $this->endSection() ?>