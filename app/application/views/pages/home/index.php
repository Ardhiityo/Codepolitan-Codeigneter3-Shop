<div class="row">
    <div class="col-9">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <span>Kategori : <strong>Semua Kategori</strong></span>
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
                                        <span class="badge text-bg-primary">
                                            <i class="fa-solid fa-tag"></i>
                                            <?= $row->category_title ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <input type="number" class="form-control">
                                        <button class="btn btn-primary">Add to Cart</button>
                                    </div>
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
                <div class="input-group">
                    <input type="text" class="form-control">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h6>Kategori</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Semua kategori</li>
                <li class="list-group-item">Kategori 1</li>
                <li class="list-group-item">Kategori 2</li>
            </ul>
        </div>
    </div>
</div>