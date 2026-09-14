<div class="row">
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Register</h5>
            </div>
            <div class="card-body">
                <?= form_open('register', ['method' => 'post']) ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <?= form_input(
                        'name',
                        set_value('name'),
                        [
                            'id' => 'name',
                            'autofocus' => 'true',
                            'class' => 'form-control'
                        ]
                    ) ?>
                    <?= form_error('name') ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <?= form_input(
                        'email',
                        set_value('email'),
                        [
                            'id' => 'email',
                            'class' => 'form-control',
                            'type' => 'email'
                        ]
                    ) ?>
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
                        ]
                    ) ?>
                    <?= form_error('password') ?>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <?= form_password(
                        'password_confirmation',
                        set_value('password_confirmation'),
                        [
                            'id' => 'password_confirmation',
                            'class' => 'form-control'
                        ]
                    ) ?>
                    <?= form_error('password_confirmation') ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>