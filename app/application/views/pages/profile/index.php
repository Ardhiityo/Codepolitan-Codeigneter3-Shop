<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= $content->image_url ?>" height="200" width="200" class="rounded" alt="avatar">
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <p>Nama : <?= $content->name ?></p>
                <p>Email: <?= $content->email ?></p>
                <a href="/profile/edit" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>