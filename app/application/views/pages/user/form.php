<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Tambah User</h6>
            </div>
            <div class="card-body">
                <?= form_open_multipart() ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <?= form_input([
                        'name' => 'name',
                        'id' => 'name',
                        'class' => 'form-control',
                        'value' => $input->name
                    ]) ?>
                    <?= form_error('name') ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <?= form_input([
                        'name' => 'email',
                        'id' => 'email',
                        'class' => 'form-control',
                        'type' => 'email',
                        'value' => $input->email
                    ]) ?>
                    <?= form_error('email') ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <?= form_password([
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control'
                    ]) ?>
                    <?= form_error('password') ?>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <?= form_dropdown(
                        'role',
                        [
                            'admin' => 'Admin',
                            'member' => 'Member'
                        ],
                        $input->role,
                        [
                            'id' => 'role',
                            'class' => 'form-select',
                        ])
                        ?>
                    <?= form_error('role') ?>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <br>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <?= form_radio(
                                [
                                    'name' => 'is_active',
                                    'class' => 'form-check-input',
                                    'checked' => $input->is_active == 1 ? true : false,
                                    'value' => '1',
                                    'id' => 'active'
                                ]
                            ) ?>
                            <label class=" form-check-label" for="active">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <?= form_radio(
                                [
                                    'name' => 'is_active',
                                    'class' => 'form-check-input',
                                    'checked' => $input->is_active == 0 ? true : false,
                                    'value' => '0',
                                    'id' => 'deactive'
                                ]
                            ) ?>
                            <label class="form-check-label" for="deactive">
                                Non-Aktif
                            </label>
                        </div>
                    </div>
                    <?= form_error('is_active') ?>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    <?= form_upload(
                        'image_url',
                        null,
                        [
                            'id' => 'image_url',
                            'class' => 'form-control',
                        ])
                        ?>
                    <?= form_error('image_url') ?>
                    <?php if (isset($input->image_url) && $input->image_url) : ?>
                        <div class="div my-3">
                            <img src="<?= base_url($input->image_url) ?>" height="70" width="70" alt="avatar"
                                class="rounded">
                        </div>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>