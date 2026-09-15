<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="m-0">Produk</h6>
                            <button class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control w-50" placeholder="Cari">
                            <button class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-eraser"></i>
                            </button>
                        </div>
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
                                    <img src="https://placehold.co/50x50" alt="avatar" class="rounded h-70">
                                    <?= $row->product_title ?>
                                </td>
                                <td>
                                    <span class="badge text-bg-primary"><?= $row->category_title ?></span>
                                </td>
                                <td>Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                <td><?= $row->is_available ? 'Tersedia' : 'Kosong' ?></td>
                                <td class="d-flex gap-3">
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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