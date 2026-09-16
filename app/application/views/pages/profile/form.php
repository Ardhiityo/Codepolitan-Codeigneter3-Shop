<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0">Formulir Profil</h6>
            </div>
            <div class="card-body">
                <?= form_open_multipart() ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <?= form_input(
                        [
                            'name' => 'email',
                            'value' => $input->email,
                            'id' => 'email',
                            'class' => 'form-control',
                            'type' => 'email'
                        ]
                    ) ?>
                    <?= form_error('email') ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <?= form_input(
                        [
                            'name' => 'password',
                            'value' => '',
                            'id' => 'password',
                            'class' => 'form-control',
                            'type' => 'password'
                        ]
                    ) ?>
                    <?= form_error('password') ?>
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
                            <img src="<?= base_url($input->image_url) ?>" height="70" width="70" alt="product"
                                class="rounded">
                        </div>
                    <?php endif ?>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>