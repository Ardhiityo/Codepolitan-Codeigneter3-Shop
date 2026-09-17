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
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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