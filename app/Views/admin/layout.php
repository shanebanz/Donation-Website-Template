<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/sinag-donation/public/css/skeleton-loader.css">

<style>

:root{
--sinag-black:#0f1412;
--sinag-green:#3aa35f;
--sinag-green-dark:#2f874e;
--sinag-surface:#f4f6f9;
}

body{
font-family:'Plus Jakarta Sans',sans-serif;
background:var(--sinag-surface);
min-height:100vh;
}

.admin-nav{
background:linear-gradient(90deg,#090d0b 0%,#121915 60%,#1c2a22 100%);
box-shadow:0 8px 24px rgba(0,0,0,0.2);
}

.admin-brand{
font-weight:700;
letter-spacing:.4px;
}

.admin-link{
color:#d6e5dc;
font-weight:500;
border-bottom:2px solid transparent;
transition:all .2s ease;
}

.admin-link:hover,
.admin-link:focus{
color:#fff;
border-bottom-color:var(--sinag-green);
}

.btn-admin{
background:var(--sinag-green);
border-color:var(--sinag-green);
color:#fff;
font-weight:600;
}

.btn-admin:hover,
.btn-admin:focus{
background:var(--sinag-green-dark);
border-color:var(--sinag-green-dark);
color:#fff;
}

.admin-shell{
padding:28px 0 36px;
}

.admin-content{
background:#fff;
border-radius:16px;
padding:26px;
box-shadow:0 12px 26px rgba(15,20,18,.08);
}

/* ── Themed buttons ── */
.btn{
font-family:'Plus Jakarta Sans',sans-serif;
font-weight:600;
border-radius:9px;
letter-spacing:.1px;
transition:background .16s,border-color .16s,box-shadow .16s,transform .1s;
}

.btn:active{transform:scale(.97);}

/* Primary → sinag green */
.btn-primary{
background:#3aa35f !important;
border-color:#3aa35f !important;
color:#fff !important;
}
.btn-primary:hover,.btn-primary:focus{
background:#2f874e !important;
border-color:#2f874e !important;
box-shadow:0 4px 10px rgba(58,163,95,.28) !important;
}

/* Success → deeper teal-green */
.btn-success{
background:#1d8348 !important;
border-color:#1d8348 !important;
color:#fff !important;
}
.btn-success:hover,.btn-success:focus{
background:#176a3b !important;
border-color:#176a3b !important;
box-shadow:0 4px 10px rgba(29,131,72,.28) !important;
}

/* Warning → warm olive (matches site accent) */
.btn-warning{
background:#7a6a1e !important;
border-color:#7a6a1e !important;
color:#fff !important;
}
.btn-warning:hover,.btn-warning:focus{
background:#625616 !important;
border-color:#625616 !important;
box-shadow:0 4px 10px rgba(122,106,30,.28) !important;
}

/* Danger → muted deep red */
.btn-danger{
background:#9b2c2c !important;
border-color:#9b2c2c !important;
color:#fff !important;
}
.btn-danger:hover,.btn-danger:focus{
background:#7f2020 !important;
border-color:#7f2020 !important;
box-shadow:0 4px 10px rgba(155,44,44,.28) !important;
}

/* Outline secondary */
.btn-outline-secondary{
border-color:#6e8a74 !important;
color:#3d5942 !important;
}
.btn-outline-secondary:hover,.btn-outline-secondary:focus{
background:#6e8a74 !important;
border-color:#6e8a74 !important;
color:#fff !important;
}

/* sm size */
.btn-sm{
padding:.32rem .72rem;
font-size:.83rem;
border-radius:7px;
}

/* ── Pagination ── */
.page-link{
color:#3aa35f;
border-color:#dde6da;
font-weight:600;
}
.page-link:hover{
background:#eaf4ee;
border-color:#9ec9af;
color:#2f874e;
}
.page-item.active .page-link{
background:#3aa35f;
border-color:#3aa35f;
color:#fff;
}
.page-item.disabled .page-link{
color:#a0b5a5;
border-color:#dde6da;
}

.back-icon-btn{
display:inline-flex;
align-items:center;
justify-content:center;
width:40px;
height:40px;
border-radius:999px;
border:1px solid #d8e2da;
background:#fff;
color:#1d2b23;
box-shadow:0 4px 10px rgba(15,20,18,.08);
transition:transform .16s ease, box-shadow .16s ease, background .16s ease;
}

.back-icon-btn:hover,
.back-icon-btn:focus{
background:#eef4ef;
box-shadow:0 8px 14px rgba(15,20,18,.12);
transform:translateY(-1px);
color:#1d2b23;
}

.admin-content-with-back.has-back{
display:grid;
grid-template-columns:auto minmax(0,1fr);
gap:14px;
align-items:start;
}

.admin-content-main{
min-width:0;
}

.admin-content-with-back .back-icon-btn{
position:sticky;
top:88px;
}

@media (max-width: 768px){
.admin-content-with-back.has-back{
grid-template-columns:1fr;
}

.admin-content-with-back .back-icon-btn{
position:static;
margin-bottom:10px;
}
}

</style>

</head>

<?php
$adminRawPath = trim(service('uri')->getPath(), '/');
$adminPath = preg_replace('#^sinag-donation/public/?#', '', $adminRawPath);
$adminPath = preg_replace('#^index\.php/?#', '', (string) $adminPath);
$adminPath = trim((string) $adminPath, '/');

$adminSkeletonTarget = null;
if ($adminPath === 'admin') {
  $adminSkeletonTarget = 'skeleton-admin-dashboard-page';
} elseif (str_starts_with($adminPath, 'admin/campaign/create') || str_starts_with($adminPath, 'admin/campaign/edit')) {
  $adminSkeletonTarget = 'skeleton-admin-form-page';
} elseif (str_starts_with($adminPath, 'admin/')) {
  $adminSkeletonTarget = 'skeleton-admin-table-page';
}

$showBackButton = $adminPath !== 'admin';
?>

<body class="<?= $adminSkeletonTarget ? 'skeleton-loading' : '' ?>" data-skeleton-target="<?= esc((string) $adminSkeletonTarget) ?>">

<nav class="navbar navbar-expand-lg admin-nav navbar-dark">
<div class="container">

<a class="navbar-brand admin-brand" href="/sinag-donation/public/admin">
SINAG Admin
</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#adminNav" type="button" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="adminNav">

<ul class="navbar-nav me-auto ms-lg-3">
<li class="nav-item">
<a class="nav-link admin-link" href="/sinag-donation/public/admin">Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link admin-link" href="/sinag-donation/public/admin/campaigns">Campaigns</a>
</li>
<li class="nav-item">
<a class="nav-link admin-link" href="/sinag-donation/public/admin/donations">Donations</a>
</li>
<li class="nav-item">
<a class="nav-link admin-link" href="/sinag-donation/public/admin/users">Users</a>
</li>
</ul>

<a href="/sinag-donation/public/logout" class="btn btn-admin btn-sm px-3 mt-3 mt-lg-0">
Logout
</a>

</div>
</div>
</nav>

<div class="admin-shell">
<div class="container">
<div class="admin-content">

<div class="admin-content-with-back<?= $showBackButton ? ' has-back' : '' ?>">

<?php if($showBackButton): ?>
<button
type="button"
class="back-icon-btn"
aria-label="Go back"
onclick="if(window.history.length > 1){ window.history.back(); } else { window.location.href='/sinag-donation/public/admin'; }"
>
<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
<path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
<?php endif; ?>

<div class="admin-content-main">

<!-- Admin Skeleton Loader -->
<div id="page-skeletons">
<div id="skeleton-admin-dashboard-page" class="skeleton-admin-page<?= $adminSkeletonTarget === 'skeleton-admin-dashboard-page' ? ' active' : '' ?>">
  <div class="skeleton-admin-head skeleton"></div>
  <div class="skeleton-admin-grid">
    <div class="skeleton-admin-kpi skeleton"></div>
    <div class="skeleton-admin-kpi skeleton"></div>
    <div class="skeleton-admin-kpi skeleton"></div>
    <div class="skeleton-admin-kpi skeleton"></div>
  </div>
  <div class="skeleton-admin-block">
    <?php for($i = 0; $i < 4; $i++): ?>
    <div class="skeleton-table-row">
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
    </div>
    <?php endfor; ?>
  </div>
</div>

<div id="skeleton-admin-table-page" class="skeleton-admin-page<?= $adminSkeletonTarget === 'skeleton-admin-table-page' ? ' active' : '' ?>">
  <div class="skeleton-admin-block">
    <div class="skeleton-admin-table-head">
      <div class="skeleton-admin-head-cell skeleton"></div>
      <div class="skeleton-admin-head-cell skeleton"></div>
      <div class="skeleton-admin-head-cell skeleton"></div>
      <div class="skeleton-admin-head-cell skeleton"></div>
    </div>
    <?php for($i = 0; $i < 8; $i++): ?>
    <div class="skeleton-table-row">
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
      <div class="skeleton-table-cell skeleton"></div>
    </div>
    <?php endfor; ?>
  </div>
</div>

<div id="skeleton-admin-form-page" class="skeleton-admin-page<?= $adminSkeletonTarget === 'skeleton-admin-form-page' ? ' active' : '' ?>">
  <div class="skeleton-admin-block">
    <div class="skeleton-admin-form-title skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-input skeleton"></div>
    <div class="skeleton-form-button skeleton"></div>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/sinag-donation/public/js/skeleton-loader.js"></script>

</body>
</html>