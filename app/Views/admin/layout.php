<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
overflow-x:hidden;
}

.sidebar{
height:100vh;
background:#343a40;
color:white;
padding-top:20px;
}

.sidebar a{
color:white;
display:block;
padding:10px;
text-decoration:none;
}

.sidebar a:hover{
background:#495057;
}

</style>

</head>

<body>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 sidebar">

<h4 class="text-center">Sinag Admin</h4>

<a href="/sinag-donation/public/admin">Dashboard</a>

<a href="/sinag-donation/public/admin/campaigns">Campaigns</a>

<a href="/sinag-donation/public/admin/donations">Donations</a>

<a href="/sinag-donation/public/logout">Logout</a>

</div>

<div class="col-md-10 p-4">

<?= $this->renderSection('content') ?>

</div>

</div>

</div>

</body>
</html>