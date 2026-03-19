<!DOCTYPE html>
<html>

<head>

<title>SinagDonation</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/sinag-donation/public/css/style.css">

<link rel="stylesheet" href="/sinag-donation/public/css/skeleton-loader.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

:root{
--sinag-bg:#edf1f5;
--sinag-surface:#ffffff;
--sinag-text:#19221c;
--sinag-muted:#68736c;
--sinag-accent:#5f7c2f;
--sinag-accent-dark:#4e6726;
--sinag-border:#dde3da;
}

html, body{
height:100%;
}

html{
font-size:16px;
}

body{
background:
radial-gradient(900px 420px at 110% -20%,rgba(188,211,156,.28) 0%,rgba(188,211,156,0) 62%),
radial-gradient(760px 360px at -12% 108%,rgba(183,209,225,.24) 0%,rgba(183,209,225,0) 60%),
var(--sinag-bg);
font-family:'Plus Jakarta Sans', sans-serif;
color:var(--sinag-text);
font-size:1rem;
line-height:1.62;
display:flex;
flex-direction:column;
overflow-x:hidden;
}

.main-content{
flex:1;
}

.container{
max-width:1150px;
}

h1,h2,h3,h4{
font-family:'Plus Jakarta Sans', sans-serif;
font-weight:700;
letter-spacing:.2px;
line-height:1.22;
margin-bottom:.6rem;
}

h1{font-size:clamp(1.7rem, 1.35rem + 1.5vw, 2.45rem);}
h2{font-size:clamp(1.45rem, 1.2rem + 1vw, 2rem);}
h3{font-size:clamp(1.2rem, 1.08rem + .6vw, 1.45rem);}
h4{font-size:clamp(1.05rem, 1rem + .4vw, 1.2rem);}

p, li, label, .form-control, .btn, .accordion-button{
font-size:clamp(.94rem, .9rem + .2vw, 1rem);
}

.hero{
background:var(--sinag-surface);
padding:40px;
border-radius:16px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.card{
border:none;
border-radius:14px;
box-shadow:0 10px 20px rgba(15,25,18,0.08);
transition:transform .18s ease, box-shadow .18s ease;
}

.card:hover{
transform:translateY(-2px);
box-shadow:0 14px 26px rgba(15,25,18,0.12);
}

.card img{
height:200px;
object-fit:cover;
border-top-left-radius:14px;
border-top-right-radius:14px;
}

.progress{
height:14px;
border-radius:999px;
background:#dce4d8;
}

.progress-bar{
font-size:11px;
font-weight:600;
letter-spacing:.2px;
}

.footer{
background:linear-gradient(180deg,#0e1712 0%,#0a120e 100%);
color:#d4dfd7;
padding:26px 0 14px;
margin-top:34px;
}

.footer-grid{
display:grid;
grid-template-columns:1.6fr 1fr 1fr;
gap:20px;
}

.footer-brand{
max-width:340px;
}

.footer-tagline{
color:#9ab3a0;
font-size:.88rem;
margin-bottom:8px;
}

.footer-edu-notice{
background:rgba(255,255,255,.06);
border:1px solid rgba(255,255,255,.10);
border-left:3px solid #94b95c;
border-radius:8px;
padding:7px 9px;
font-size:.77rem;
color:#b5cbba;
line-height:1.34;
}

.footer-edu-notice strong{
color:#d4f0d8;
}

.footer-nav-heading{
font-size:.72rem;
font-weight:700;
text-transform:uppercase;
letter-spacing:.9px;
color:#7a9e84;
margin-bottom:6px;
}

.footer-nav-list{
list-style:none;
padding:0;
margin:0;
}

.footer-nav-list li{
margin-bottom:4px;
}

.footer-nav-list a{
color:#c0d4c5;
text-decoration:none;
font-size:.86rem;
transition:color .15s;
}

.footer-nav-list a:hover{
color:#94b95c;
}

.footer-divider{
border-color:rgba(255,255,255,.10);
margin:14px 0 8px;
}

.footer-bottom{
font-size:.75rem;
color:#6e8a74;
text-align:center;
}

.navbar-brand{
font-size:clamp(1.28rem, 1.04rem + 1vw, 1.6rem);
letter-spacing:.4px;
font-weight:700;
display:inline-flex;
align-items:center;
gap:10px;
padding:0;
line-height:1;
}

.logo-mark{
width:40px;
height:40px;
border-radius:12px;
background:linear-gradient(150deg,#2d4e23 0%,#5f7c2f 60%,#94b95c 100%);
display:inline-flex;
align-items:center;
justify-content:center;
box-shadow:0 10px 20px rgba(95,124,47,.38);
position:relative;
transform:translateZ(0);
animation:logoFloat 3.6s ease-in-out infinite;
}

.logo-mark svg{
width:24px;
height:24px;
display:block;
}

.logo-mark::after{
content:'';
position:absolute;
inset:-5px;
border-radius:15px;
border:1px solid rgba(95,124,47,.28);
}

.logo-text{
font-weight:800;
letter-spacing:.3px;
}

@keyframes logoFloat{
0%,100%{transform:translateY(0);}
50%{transform:translateY(-2px);}
}

.navbar{
border-bottom:1px solid var(--sinag-border);
position:sticky;
top:0;
z-index:1030;
backdrop-filter:saturate(140%) blur(4px);
background-color:rgba(255,255,255,.88) !important;
}

.nav-link{
font-weight:500;
color:var(--sinag-text) !important;
opacity:.88;
border-bottom:2px solid transparent;
margin-right:4px;
}

.nav-link:hover,
.nav-link:focus{
opacity:1;
color:var(--sinag-accent) !important;
border-bottom-color:var(--sinag-accent);
}

.nav-link.active{
opacity:1;
color:var(--sinag-accent) !important;
border-bottom-color:var(--sinag-accent);
}

.btn-primary,
.btn-success{
background:var(--sinag-accent) !important;
border-color:var(--sinag-accent) !important;
font-weight:600;
border-radius:10px;
padding:.55rem 1rem;
min-height:42px;
}

.btn-primary:hover,
.btn-primary:focus,
.btn-success:hover,
.btn-success:focus{
background:var(--sinag-accent-dark) !important;
border-color:var(--sinag-accent-dark) !important;
}

.btn-outline-secondary{
border-color:#93a08f;
color:#556353;
border-radius:10px;
}

.form-control{
border-radius:10px;
border-color:#d7dfd4;
padding:.68rem .8rem;
}

.form-control:focus{
border-color:#95ab78;
box-shadow:0 0 0 .2rem rgba(95,124,47,.18);
}

.alert{
border-radius:12px;
}

@media (max-width: 768px){
.container{
padding-left:14px;
padding-right:14px;
}

.main-content .container.mt-5{
margin-top:1.35rem !important;
}

.navbar-brand{
gap:8px;
}

.logo-mark{
width:34px;
height:34px;
border-radius:10px;
}

.logo-mark svg{
width:20px;
height:20px;
}

.navbar-collapse{
background:#fff;
border:1px solid #e0e7dc;
border-radius:14px;
padding:10px 12px;
margin-top:10px;
box-shadow:0 12px 20px rgba(16,24,19,.08);
}

.navbar-nav .nav-link{
padding:.5rem .4rem;
margin-right:0;
}

.navbar .btn{
margin-top:.55rem;
width:auto;
}

.footer{
padding:20px 0 12px;
margin-top:28px;
}

.footer-grid{
grid-template-columns:1fr;
gap:12px;
}

.footer-brand{
max-width:100%;
}
}

@media (prefers-reduced-motion: reduce){
.logo-mark{
animation:none;
}
}

.btn-outline-secondary:hover,
.btn-outline-secondary:focus{
background:#556353;
border-color:#556353;
color:#fff;
}

/* ── Pagination ── */
.page-link{
color:var(--sinag-accent);
border-color:var(--sinag-border);
font-weight:600;
border-radius:8px !important;
margin:0 2px;
}
.page-link:hover{
background:#eaf4ee;
border-color:#9ec9af;
color:var(--sinag-accent-dark);
}
.page-item.active .page-link{
background:var(--sinag-accent);
border-color:var(--sinag-accent);
color:#fff;
box-shadow:0 4px 10px rgba(95,124,47,.28);
}
.page-item.disabled .page-link{
color:#adbfaa;
border-color:var(--sinag-border);
}
.pagination{
gap:2px;
}

.back-icon-btn{
display:inline-flex;
align-items:center;
justify-content:center;
width:42px;
height:42px;
border-radius:999px;
border:1px solid var(--sinag-border);
background:#fff;
color:var(--sinag-text);
box-shadow:0 4px 10px rgba(15,25,18,.08);
transition:transform .16s ease, box-shadow .16s ease, background .16s ease;
}

.back-icon-btn:hover,
.back-icon-btn:focus{
background:#f5f8f3;
box-shadow:0 8px 16px rgba(15,25,18,.12);
transform:translateY(-1px);
color:var(--sinag-text);
}

.content-with-back.has-back{
display:grid;
grid-template-columns:auto minmax(0,1fr);
gap:14px;
align-items:start;
}

.content-main{
min-width:0;
}

.content-with-back .back-icon-btn{
position:sticky;
top:92px;
}

@media (max-width: 768px){
.content-with-back.has-back{
grid-template-columns:1fr;
}

.content-with-back .back-icon-btn{
position:static;
margin-bottom:10px;
}
}

</style>

</head>

<?php
$rawPath = trim(service('uri')->getPath(), '/');
$path = preg_replace('#^sinag-donation/public/?#', '', $rawPath);
$path = preg_replace('#^index\.php/?#', '', (string) $path);
$path = trim((string) $path, '/');
$isCampaigns = $path === 'campaigns' || str_starts_with($path, 'campaign/') || str_starts_with($path, 'donate/');
$isHowItWorks = $path === 'how-it-works';
$isDashboard = $path === 'dashboard';
$isLoggedIn = (bool) session()->get('user_id');
$isAdminSession = (bool) session()->get('isAdmin');
$accountName = (string) (session()->get('name') ?? 'My Account');
$skeletonTarget = null;

if ($path === '' || $path === 'home') {
  $skeletonTarget = 'skeleton-home-page';
} elseif ($path === 'campaigns') {
  $skeletonTarget = 'skeleton-campaigns-page';
} elseif ($path === 'dashboard') {
  $skeletonTarget = 'skeleton-dashboard-page';
} elseif ($path === 'login' || $path === 'register') {
  $skeletonTarget = 'skeleton-form-page';
} elseif ($path === 'how-it-works') {
  $skeletonTarget = 'skeleton-how-page';
} elseif (preg_match('#(^|/)campaign/\d+($|/)#', $path) === 1) {
  $skeletonTarget = 'skeleton-campaign-detail';
} elseif (preg_match('#(^|/)donate/\d+($|/)#', $path) === 1) {
  $skeletonTarget = 'skeleton-donate-page';
}

$showBackButton = preg_match('#(^|/)campaign/\d+($|/)#', $path) === 1
|| preg_match('#(^|/)donate/\d+($|/)#', $path) === 1;
?>

<body class="<?= $skeletonTarget ? 'skeleton-loading' : '' ?>" data-skeleton-target="<?= esc((string) $skeletonTarget) ?>">

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
<div class="container">

<a class="navbar-brand fw-bold" href="/sinag-donation/public/">
<span class="logo-mark" aria-hidden="true">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3 11.5L12 4L21 11.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 10.5V20H17.5V10.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10 20V14.5H14V20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>
<span class="logo-text">SINAG Donation</span>
</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="nav">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link <?= $isCampaigns ? 'active' : '' ?>" href="/sinag-donation/public/campaigns">
Campaigns
</a>
</li>

<li class="nav-item">
<a class="nav-link <?= $isHowItWorks ? 'active' : '' ?>" href="/sinag-donation/public/how-it-works">
How It Works
</a>
</li>

</ul>

<ul class="navbar-nav">

<?php if($isAdminSession): ?>
<li class="nav-item">
<a class="btn btn-primary ms-2" href="/sinag-donation/public/admin">
Admin Panel
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/sinag-donation/public/logout">
Logout
</a>
</li>
<?php elseif($isLoggedIn): ?>
<li class="nav-item d-flex align-items-center me-2">
<span class="nav-link mb-0" style="opacity:1; border-bottom:0;">
<?= esc($accountName) ?>
</span>
</li>
<li class="nav-item">
<a class="nav-link <?= $isDashboard ? 'active' : '' ?>" href="/sinag-donation/public/dashboard">
Dashboard
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/sinag-donation/public/logout">
Logout
</a>
</li>
<?php else: ?>
<li class="nav-item">
<a class="nav-link" href="/sinag-donation/public/login">
Login
</a>
</li>

<li class="nav-item">
<a class="btn btn-primary ms-2" href="/sinag-donation/public/register">
Register
</a>
</li>
<?php endif; ?>

</ul>

</div>
</div>
</nav>

<div class="main-content">

<div class="container mt-5">

<div class="content-with-back<?= $showBackButton ? ' has-back' : '' ?>">

<?php if($showBackButton): ?>
<button
type="button"
class="back-icon-btn"
aria-label="Go back"
onclick="if(window.history.length > 1){ window.history.back(); } else { window.location.href='/sinag-donation/public/'; }"
>
<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
<path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
<?php endif; ?>

<div class="content-main">

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger shadow-sm border-0">
<?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('msg')): ?>
<div class="alert alert-success shadow-sm border-0">
<?= session()->getFlashdata('msg') ?>
</div>
<?php endif; ?>

<!-- SKELETON LOADERS - One for each page type -->

<div id="page-skeletons">

<!-- Home Page Skeleton -->
<div id="skeleton-home-page" class="skeleton-home-page<?= $skeletonTarget === 'skeleton-home-page' ? ' active' : '' ?>">
  <div class="skeleton-home-hero">
    <div class="skeleton-home-title skeleton"></div>
    <div class="skeleton-home-line skeleton"></div>
    <div class="skeleton-home-line skeleton"></div>
    <div class="skeleton-home-line short skeleton"></div>
  </div>
  <div class="skeleton-home-cards">
    <?php for($i = 0; $i < 3; $i++): ?>
    <div class="skeleton-home-card">
      <div class="skeleton-home-card-image skeleton"></div>
      <div class="skeleton-card-line title skeleton"></div>
      <div class="skeleton-card-line skeleton"></div>
      <div class="skeleton-card-line short skeleton"></div>
    </div>
    <?php endfor; ?>
  </div>
</div>

<!-- How It Works Skeleton -->
<div id="skeleton-how-page" class="skeleton-how-page<?= $skeletonTarget === 'skeleton-how-page' ? ' active' : '' ?>">
  <div class="skeleton-how-banner">
    <div class="skeleton-home-title skeleton"></div>
    <div class="skeleton-home-line skeleton"></div>
    <div class="skeleton-home-line short skeleton"></div>
  </div>
  <?php for($i = 0; $i < 4; $i++): ?>
  <div class="skeleton-how-step skeleton"></div>
  <?php endfor; ?>
  <div class="mt-3">
    <?php for($i = 0; $i < 3; $i++): ?>
    <div class="skeleton-how-faq skeleton"></div>
    <?php endfor; ?>
  </div>
</div>

<!-- Campaigns Page Skeleton -->
<div id="skeleton-campaigns-page" class="skeleton-campaigns-page<?= $skeletonTarget === 'skeleton-campaigns-page' ? ' active' : '' ?>">
  <section class="skeleton-page-header">
    <div class="skeleton-header-content">
      <div class="skeleton-header-text">
        <div class="skeleton-header-title skeleton"></div>
        <div class="skeleton-header-desc skeleton"></div>
        <div class="skeleton-header-desc skeleton"></div>
      </div>
      <div class="skeleton-header-visual skeleton"></div>
    </div>
  </section>
  
  <div class="skeleton-tabs">
    <div class="skeleton-tab skeleton"></div>
    <div class="skeleton-tab skeleton"></div>
  </div>
  
  <div class="skeleton-campaigns-grid">
    <?php for($i = 0; $i < 6; $i++): ?>
    <div class="skeleton-campaign-card">
      <div class="skeleton-card-image skeleton"></div>
      <div class="skeleton-card-content">
        <div class="skeleton-card-title skeleton"></div>
        <div class="skeleton-card-title-line-2 skeleton"></div>
        <div class="skeleton-card-text skeleton"></div>
        <div class="skeleton-card-text skeleton"></div>
        <div class="skeleton-card-text skeleton"></div>
        <div class="skeleton-card-footer">
          <div class="skeleton-card-stat skeleton"></div>
          <div class="skeleton-card-stat skeleton"></div>
        </div>
        <div class="skeleton-card-button skeleton"></div>
      </div>
    </div>
    <?php endfor; ?>
  </div>
</div>

<!-- Dashboard Page Skeleton -->
<div id="skeleton-dashboard-page" class="skeleton-dashboard-page<?= $skeletonTarget === 'skeleton-dashboard-page' ? ' active' : '' ?>">
  <div class="skeleton-stats-grid">
    <?php for($i = 0; $i < 4; $i++): ?>
    <div class="skeleton-stat-card">
      <div class="skeleton-stat-label skeleton"></div>
      <div class="skeleton-stat-value skeleton"></div>
    </div>
    <?php endfor; ?>
  </div>
  
  <div class="skeleton-content-section">
    <div class="skeleton-section-title skeleton"></div>
    <?php for($i = 0; $i < 5; $i++): ?>
    <div class="skeleton-table-row">
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
    </div>
    <?php endfor; ?>
  </div>
</div>

<!-- Form Page Skeleton (Login/Register) -->
<div id="skeleton-form-page" class="skeleton-form-page<?= $skeletonTarget === 'skeleton-form-page' ? ' active' : '' ?>">
  <div class="skeleton-form-container">
    <div class="skeleton-form-title skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-button skeleton"></div>
    <div class="skeleton-form-link skeleton"></div>
  </div>
</div>

<!-- Donate Page Skeleton -->
<div id="skeleton-donate-page" class="skeleton-donate-page<?= $skeletonTarget === 'skeleton-donate-page' ? ' active' : '' ?>">
  <div class="skeleton-donate-header">
    <div class="skeleton-donate-title skeleton"></div>
    <div class="skeleton-donate-desc skeleton"></div>
    <div class="skeleton-donate-desc skeleton"></div>
  </div>
  
  <div class="skeleton-donate-form">
    <div class="skeleton-amount-options">
      <div class="skeleton-amount-btn skeleton"></div>
      <div class="skeleton-amount-btn skeleton"></div>
      <div class="skeleton-amount-btn skeleton"></div>
      <div class="skeleton-amount-btn skeleton"></div>
    </div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-button skeleton"></div>
  </div>
</div>

<!-- Campaign Detail Skeleton -->
<div id="skeleton-campaign-detail" class="skeleton-campaign-detail<?= $skeletonTarget === 'skeleton-campaign-detail' ? ' active' : '' ?>">
  <div class="skeleton-campaign-detail-hero skeleton"></div>
  
  <div class="skeleton-detail-info">
    <div class="skeleton-detail-main">
      <div class="skeleton-detail-title skeleton"></div>
      <div class="skeleton-detail-text skeleton"></div>
      <div class="skeleton-detail-text skeleton"></div>
      <div class="skeleton-detail-text skeleton"></div>
    </div>
    <div class="skeleton-detail-sidebar">
      <div class="skeleton-sidebar-item">
        <div class="skeleton-sidebar-label skeleton"></div>
        <div class="skeleton-sidebar-value skeleton"></div>
      </div>
      <div class="skeleton-sidebar-item">
        <div class="skeleton-sidebar-label skeleton"></div>
        <div class="skeleton-sidebar-value skeleton"></div>
      </div>
      <div class="skeleton-sidebar-item">
        <div class="skeleton-sidebar-label skeleton"></div>
        <div class="skeleton-sidebar-value skeleton"></div>
      </div>
    </div>
  </div>
</div>

</div>

<div id="page-content">
<?= $this->renderSection('content') ?>
</div>

</div>

</div>

</div>

</div>

<footer class="footer">
<div class="container">

<div class="footer-grid">
<div class="footer-brand">
<div class="d-flex align-items-center gap-2 mb-2">
<span class="logo-mark" style="width:32px;height:32px;border-radius:9px;animation:none;">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;">
<path d="M3 11.5L12 4L21 11.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 10.5V20H17.5V10.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10 20V14.5H14V20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>
<span style="font-weight:800;font-size:1.1rem;letter-spacing:.3px;">SINAG Donation</span>
</div>
<p class="footer-tagline">Helping communities through transparent, verified donations.</p>
<p class="footer-edu-notice">
&#9432; This platform is created for <strong>educational purposes only</strong>. No copyright infringement is intended. All campaign content and imagery are used solely for academic demonstration.
</p>
</div>

<div class="footer-nav-col">
<h6 class="footer-nav-heading">Platform</h6>
<ul class="footer-nav-list">
<li><a href="/sinag-donation/public/campaigns">Browse Campaigns</a></li>
<li><a href="/sinag-donation/public/register">Get Started</a></li>
</ul>
</div>

<div class="footer-nav-col">
<h6 class="footer-nav-heading">Support</h6>
<ul class="footer-nav-list">
<li><a href="/sinag-donation/public/how-it-works#faq">FAQ</a></li>
<li><a href="mailto:sinagdonation_help@gmail.com">Contact Support</a></li>
</ul>

</div>
</div>

<hr class="footer-divider">

<div class="footer-bottom">
<span>© 2026 SINAG Donation Platform. For educational purposes only.</span>
</div>

</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="/sinag-donation/public/js/skeleton-loader.js"></script>

</body>

</html>