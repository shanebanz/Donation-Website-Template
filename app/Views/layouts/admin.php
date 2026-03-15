<!DOCTYPE html>
<html>
<head>

<title>Admin Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
body{
font-family:'Plus Jakarta Sans',sans-serif;
}
</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid">

<a class="navbar-brand" href="/sinag-donation/public/admin">
Admin Panel
</a>

<div>

<a class="btn btn-light btn-sm" href="/sinag-donation/public/admin/campaigns">
Campaigns
</a>

<a class="btn btn-light btn-sm" href="/sinag-donation/public/admin/donations">
Donations
</a>

<a class="btn btn-danger btn-sm" href="/sinag-donation/public/logout">
Logout
</a>

</div>

</div>
</nav>

<div class="container mt-4">

<?= $this->renderSection('content') ?>

</div>

</body>

</html>