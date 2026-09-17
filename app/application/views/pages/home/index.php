<div class="row">
    <div class="col-9">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <span>Kategori : <strong><?= $category ? $category : 'Semua Kategori' ?></strong></span>
                        <div>
                            <span class="d-flex gap-2">
                                Urutkan Harga
                                <?= form_open(base_url(), ['method' => 'GET']) ?>
                                <?= form_hidden('price', 'asc') ?>
                                <button class="badge text-bg-primary">Termurah</button>
                                <?= form_close() ?>

                                <?= form_open(base_url(), ['method' => 'GET']) ?>
                                <?= form_hidden('price', 'desc') ?>
                                <button class="badge text-bg-primary">Termahal</button>
                                <?= form_close() ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <?php foreach ($content as $index => $row) : ?>
                        <div class="col-6 mb-3">
                            <div class="card">
                                <img src="<?= base_url($row->image_url) ?>" height="400" alt="product">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>
                                            <?= $row->product_title ?>
                                        </strong>
                                    </h5>
                                    <p class="card-text">
                                        <?= $row->desc ?>
                                    </p>
                                    <p class="card-text">
                                        <strong>
                                            Rp.<?= number_format($row->price, 0, '.', '.') ?>-
                                        </strong>
                                    </p>
                                    <p>
                                        <a href="<?= base_url('?category='.$row->category_slug) ?>"
                                            class="badge text-bg-primary">
                                            <i class="fa-solid fa-tag"></i>
                                            <?= $row->category_title ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <?= form_open(base_url('cart/add'), ['method' => 'POST']) ?>
                                    <div class="input-group">
                                        <?= form_hidden('product_id', $row->id) ?>
                                        <?= form_input([
                                            'name' => 'quantity',
                                            'class' => 'form-control',
                                            'type' => 'number'
                                        ]) ?>
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <div class="card-header">
                <h6>Pencarian</h6>
            </div>
            <div class="card-body">
                <?= form_open(base_url(), ['method' => 'GET']) ?>
                <div class="input-group">
                    <?= form_input([
                        'class' => 'form-control',
                        'name' => 'keyword'
                    ]) ?>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h6>Kategori</h6>
            </div>
            <ul class="list-group list-group-flush">
                <a class="list-group-item" href="<?= base_url() ?>">Semua kategori</a>
                <?php foreach (getCategories() as $key => $row) : ?>
                    <a class="list-group-item" href="<?= base_url('?category='.$row->slug) ?>">
                        <?= $row->title ?>
                    </a>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>