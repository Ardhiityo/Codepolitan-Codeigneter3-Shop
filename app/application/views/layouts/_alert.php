<?php
$success = $this->session->flashdata('success');
$warning = $this->session->flashdata('warning');
$error = $this->session->flashdata('error');

$status = $success ? 'Success' : ($warning ? 'Warning' : 'Error');
$message = $success ? $success : ($warning ? $warning : $error);
$class = $success ? 'success' : ($warning ? 'warning' : 'danger');
?>

<?php if ($message) : ?>
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="alert alert-<?= $class ?> alert-dismissible fade show" role="alert">
                <strong><?= ucfirst($status) ?>!</strong> <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif ?>