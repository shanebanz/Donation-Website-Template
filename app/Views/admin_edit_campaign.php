<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit Campaign</h2>

<form method="post" enctype="multipart/form-data" action="/sinag-donation/public/admin/campaign/update/<?= $campaign->id ?>">

<div class="mb-3">
<label>Title</label>
<input type="text" name="title" class="form-control" value="<?= $campaign->title ?>">
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"><?= $campaign->description ?></textarea>
</div>

<div class="mb-3">
<label>Goal Amount</label>
<input type="number" name="goal_amount" class="form-control" value="<?= $campaign->goal_amount ?>">
</div>

<div class="mb-3">
<label>Deadline</label>
<input type="date" name="deadline" class="form-control" value="<?= $campaign->deadline ?>">
</div>

<div class="mb-3">
<label>Current Image</label><br>

<?php if($campaign->image): ?>
<img src="/sinag-donation/public/uploads/<?= $campaign->image ?>" width="200">
<?php endif; ?>

</div>

<div class="mb-3">
<label>Change Image</label>
<input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">
Update Campaign
</button>

</form>

<?= $this->endSection() ?>