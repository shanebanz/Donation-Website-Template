<!DOCTYPE html>
<html>

<head>

<title>SinagDonation</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
font-family:Segoe UI;
}

.navbar{
background:#ff6b35;
}

.navbar-brand{
color:white;
font-weight:bold;
font-size:22px;
}

.navbar a{
color:white;
margin-left:20px;
text-decoration:none;
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

.btn-primary{
background:#ff6b35;
border:none;
}

.btn-success{
background:#2ecc71;
border:none;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg px-4">

<a class="navbar-brand" href="/sinag-donation/public">
SinagDonation
</a>

<div class="ms-auto">

<a href="/sinag-donation/public">Home</a>

<a href="/sinag-donation/public/dashboard">Dashboard</a>

<a href="/sinag-donation/public/logout">Logout</a>

</div>

</nav>

<div class="container mt-5">

<?= $this->renderSection('content') ?>

</div>

</body>

</html>