<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$currentPage = $currentPage ?? 1;
$totalPages  = $totalPages  ?? 1;
?>

<style>
.users-card{
border:1px solid #e2e9e3;
border-radius:14px;
background:#fff;
box-shadow:0 10px 20px rgba(15,20,18,.06);
padding:16px;
}

.users-note{
background:#f5f9f4;
border:1px solid #dce7d6;
border-left:4px solid #3aa35f;
border-radius:10px;
padding:10px 12px;
font-size:.92rem;
color:#4f5e55;
margin-bottom:14px;
}

.status-pill{
display:inline-block;
padding:4px 8px;
border-radius:999px;
font-size:.76rem;
font-weight:700;
text-transform:uppercase;
letter-spacing:.35px;
}

.status-active{background:#e8f5ec;color:#1f6d3e;}
.status-disabled{background:#fbe9e9;color:#8e3636;}
.status-verified{background:#e8f0fe;color:#355d9b;}
.status-unverified{background:#fff4dd;color:#8d6b1f;}
.role-user{background:#edf1f5;color:#3a4d42;}
.role-admin{background:#1c2a22;color:#94e8b4;}

.table-sm td,
.table-sm th{padding:.55rem .45rem;}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
<h2 class="mb-0">User Management</h2>
</div>

<div class="users-card">
<div class="users-note">
Only non-sensitive account data is displayed here. Email addresses are masked to protect privacy.
</div>

<div class="table-responsive">
<table class="table table-sm align-middle mb-0">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email (Masked)</th>
<th>Role</th>
<th>Verification</th>
<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php if(empty($users)): ?>
<tr>
<td colspan="7" class="text-muted">No users found.</td>
</tr>
<?php endif; ?>

<?php foreach($users as $user): ?>
<tr>
<td><?= (int) $user['id'] ?></td>
<td><?= esc($user['name']) ?></td>
<td><?= esc($user['masked_email']) ?></td>
<td>
<?php $role = $user['role'] ?? 'user'; ?>
<?php if($role === 'admin'): ?>
<span class="status-pill role-admin">Admin</span>
<?php else: ?>
<span class="status-pill role-user">User</span>
<?php endif; ?>
</td>
<td>
<?php if((int) ($user['is_verified'] ?? 0) === 1): ?>
<span class="status-pill status-verified">Verified</span>
<?php else: ?>
<span class="status-pill status-unverified">Unverified</span>
<?php endif; ?>
</td>
<td>
<?php if((int) ($user['is_active'] ?? 1) === 1): ?>
<span class="status-pill status-active">Active</span>
<?php else: ?>
<span class="status-pill status-disabled">Disabled</span>
<?php endif; ?>
</td>
<td>
<?php if(($user['role'] ?? '') === 'admin'): ?>
<span class="text-muted">Protected</span>
<?php else: ?>
<?php if((int) ($user['is_active'] ?? 1) === 1): ?>
<a href="/sinag-donation/public/admin/users/disable/<?= (int) $user['id'] ?>" class="btn btn-warning btn-sm">Disable</a>
<?php else: ?>
<a href="/sinag-donation/public/admin/users/enable/<?= (int) $user['id'] ?>" class="btn btn-success btn-sm">Enable</a>
<?php endif; ?>
<a href="/sinag-donation/public/admin/users/delete/<?= (int) $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user account? This cannot be undone.');">Delete</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<?php if($totalPages > 1): ?>
<nav aria-label="User pages" class="mt-3">
<ul class="pagination">
<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/users?page=<?= $currentPage - 1 ?>">&#8592; Prev</a>
</li>
<?php for($p = 1; $p <= $totalPages; $p++): ?>
<li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/users?page=<?= $p ?>"><?= $p ?></a>
</li>
<?php endfor; ?>
<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
<a class="page-link" href="/sinag-donation/public/admin/users?page=<?= $currentPage + 1 ?>">Next &#8594;</a>
</li>
</ul>
</nav>
<?php endif; ?>

<?= $this->endSection() ?>