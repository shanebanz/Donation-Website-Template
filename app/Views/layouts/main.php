<!DOCTYPE html>
<html>

<head>

<title>SinagDonation</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/sinag-donation/public/css/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

html, body{
height:100%;
}

body{
background:#f4f6f9;
font-family:'Poppins', sans-serif;
display:flex;
flex-direction:column;
}

.main-content{
flex:1;
}

.hero{
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.card{
border:none;
border-radius:12px;
box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

.card img{
height:200px;
object-fit:cover;
border-top-left-radius:12px;
border-top-right-radius:12px;
}

.progress{
height:18px;
border-radius:10px;
}

.progress-bar{
font-size:12px;
}

.footer{
background:#000;
color:white;
padding:40px 0;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
<div class="container">

<a class="navbar-brand fw-bold" href="/sinag-donation/public/">
SINAG Donation
</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="nav">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link" href="/sinag-donation/public/campaigns">
Campaigns
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
How It Works
</a>
</li>

</ul>

<ul class="navbar-nav">

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

</ul>

</div>
</div>
</nav>

<div class="main-content">

<div class="container mt-5">

<?= $this->renderSection('content') ?>

</div>

</div>

<footer class="footer">
<div class="container text-center">

<p>© 2026 SINAG Donation Platform</p>

<p>
Helping communities through transparent donations.
</p>

</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>