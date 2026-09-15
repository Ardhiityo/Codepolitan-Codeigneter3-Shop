<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Tambah Produk</h6>
            </div>
            <div class="card-body">
                <?= form_open_multipart() ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Produk</label>
                    <?= form_input(
                        'title',
                        $input->title,
                        [
                            'id' => 'title',
                            'onkeyup' => 'createSlug()',
                            'class' => 'form-control'
                        ])
                        ?>
                    <?= form_error('title') ?>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <?= form_textarea(
                        'desc',
                        $input->desc,
                        [
                            'id' => 'desc',
                            'class' => 'form-control',
                        ])
                        ?>
                    <?= form_error('desc') ?>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <?= form_input(
                        'slug',
                        $input->slug,
                        [
                            'id' => 'slug',
                            'class' => 'form-control'
                        ])
                        ?>
                    <?= form_error('slug') ?>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <?= form_input(
                        [
                            'value' => $input->price,
                            'name' => 'price',
                            'type' => 'number',
                            'id' => 'price',
                            'class' => 'form-control',
                        ])
                        ?>
                    <?= form_error('price') ?>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <?= form_dropdown(
                        'category_id',
                        getDropdownList('category', ['id', 'title']),
                        $input->category_id,
                        ['class' => 'form-select']
                    ) ?>
                    <?= form_error('category_id') ?>
                </div>
                <div class="mb-3">
                    <label for="availability" class="form-label">Ada Stok?</label>
                    <br>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <?= form_radio(
                                [
                                    'name' => 'is_available',
                                    'class' => 'form-check-input',
                                    'checked' => $input->is_available == 1 ? true : false,
                                    'value' => '1',
                                    'id' => 'available'
                                ]
                            ) ?>
                            <label class=" form-check-label" for="available">
                                Ada
                            </label>
                        </div>
                        <div class="form-check">
                            <?= form_radio(
                                [
                                    'name' => 'is_available',
                                    'class' => 'form-check-input',
                                    'checked' => $input->is_available == 0 ? true : false,
                                    'value' => '0',
                                    'id' => 'available'
                                ]
                            ) ?>
                            <label class="form-check-label" for="unavailable">
                                Kosong
                            </label>
                        </div>
                    </div>
                    <?= form_error('is_available') ?>
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
                    <?php if ($input->image_url) : ?>
                        <div class="div my-3">
                            <img src="<?= base_url($input->image_url) ?>" height="70" width="70" alt="product" class="rounded">
                        </div>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>