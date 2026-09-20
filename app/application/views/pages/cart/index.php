<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6>Cart</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless  text-center align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $key => $row) : ?>
                            <tr>
                                <td>
                                    <img src="<?= $row->image_url ?>" width="50" height="50" alt="product" class="rounded">
                                    <?= $row->title ?>
                                </td>
                                <td>Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                <td>
                                    <?= form_open(base_url('cart/update'), ['method' => 'POST']) ?>
                                    <div class="input-group">
                                        <?= form_hidden('product_id', $row->product_id) ?>
                                        <?= form_input([
                                            'type' => 'number',
                                            'name' => 'quantity',
                                            'class' => 'form-control text-center',
                                            'value' => $row->quantity
                                        ]) ?>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa-solid fa-check"></i></button>
                                    </div>
                                    <?= form_close() ?>
                                </td>
                                <td>Rp. <?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
                                <td>
                                    <?= form_open(base_url('cart/delete'), ['method' => 'POST']) ?>
                                    <?= form_hidden('product_id', $row->product_id) ?>
                                       <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-<?= $row->product_id ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-<?= $row->product_id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are your sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $row->title ?> will be deleted.
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
                <div class="d-flex justify-content-end">
                    <h6><strong>Total: Rp.
                            <?= number_format(array_sum(array_column($content, 'subtotal')), 0, ',', '.') ?>,-</strong>
                    </h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="/" class="btn btn-warning">
                    <i class="fa-solid fa-circle-left"></i>
                    Kembali Belanja
                </a>
                <a href="/checkout" class="btn btn-success">
                    Pembayaran
                    <i class="fa-solid fa-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>