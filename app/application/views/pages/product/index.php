<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="m-0">Produk</h6>
                            <a href="/product/create" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <?= form_open($action, ['method' => 'GET']) ?>
                        <div class="input-group">
                            <?= form_input(
                                [
                                    'name' => 'keyword',
                                    'placeholder' => 'Cari',
                                    'class' => 'form-control w-50',
                                    'value' => $keyword
                                ])
                                ?>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <a href="<?= base_url('product') ?>" class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-eraser"></i>
                            </a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $index => $row) : ?>
                            <tr>
                                <td><?= (($per_page * $current_page) - $per_page) + ($index + 1) ?></td>
                                <td>
                                    <img src="<?= base_url($row->image_url) ?>" alt="product" class="rounded" height="50"
                                        width="50">
                                    <?= $row->product_title ?>
                                </td>
                                <td>
                                    <span class="badge text-bg-primary"><?= $row->category_title ?></span>
                                </td>
                                <td>Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                <td><?= $row->is_available ? 'Tersedia' : 'Kosong' ?></td>
                                <td class="d-flex gap-3">
                                    <a href="<?= '/product/edit/'.$row->id ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <?= form_open('/product/delete/'.$row->id) ?>
                                    <?= form_hidden('id', $row->id) ?>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-<?= $row->id ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-<?= $row->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are your sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $row->product_title ?> will be deleted.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>