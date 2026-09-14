<main class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                    <?= form_open('login', ['method' => 'post']) ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <?= form_input(
                            'email',
                            set_value('email'),
                            [
                                'id' => 'email',
                                'class' => 'form-control',
                                'type' => 'email'
                            ])
                            ?>
                        <?= form_error('email') ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <?= form_password(
                            'password',
                            set_value('password'),
                            [
                                'id' => 'password',
                                'class' => 'form-control'
                            ])
                            ?>
                        <?= form_error('password') ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>