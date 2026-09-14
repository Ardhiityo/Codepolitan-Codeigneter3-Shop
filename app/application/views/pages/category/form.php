<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Tambah Kategori</h6>
            </div>
            <div class="card-body">
                <?= form_open() ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Kategori</label>
                    <?= form_input(
                        'title',
                        $input->title,
                        [
                            'id' => 'title',
                            'class' => 'form-control',
                            'onkeyup' => 'createSlug()'
                        ]
                    ) ?>
                    <?= form_error('title') ?>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <?= form_input(
                        'slug',
                        $input->slug,
                        [
                            'id' => 'slug',
                            'class' => 'form-control',
                            'onkeyup' => 'createSlug()'
                        ]
                    ) ?>
                    <?= form_error('slug') ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>