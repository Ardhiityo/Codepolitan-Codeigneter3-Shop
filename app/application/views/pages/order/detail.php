<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="m-0">Detail Order <?= $order->invoice ?></h6>
                <?php $this->load->view('layouts/_status', ['status' => $order->status]) ?>
            </div>
            <div class="card-body">
                <p>Nama : <?= $order->name ?></p>
                <p>Telepon: <?= $order->phone ?></p>
                <p>Alamat: <?= $order->address ?></p>
                <table class="table table-borderless  text-center align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_detail as $row) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url($row->image_url) ?>" height="50" width="50" alt="product"
                                        class="rounded">
                                    <?= $row->title ?>
                                </td>
                                <td>Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                <td><?= $row->quantity ?></td>
                                <td>Rp. <?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h6><strong>Total: Rp. <?= number_format($order->total, 0, ',', '.') ?>,-</strong></h6>
                </div>
            </div>
            <div class="card-footer">
                <?= form_open() ?>
                <div class="input-group">
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option <?= $order->status === 'waiting' ? 'selected' : '' ?> value="waiting">
                            Menunggu Pembayaran
                        </option>
                        <option <?= $order->status === 'paid' ? 'selected' : '' ?> value="paid">
                            Dibayar
                        </option>
                        <option <?= $order->status === 'delivery' ? 'selected' : '' ?> value="delivery" value="delivery">
                            Dikirim
                        </option>
                        <option <?= $order->status === 'delivery' ? 'selected' : '' ?> value="cancel" value="cancel">
                            Cancel
                        </option>
                    </select>
                    <?= form_error('status') ?>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
        <?php if (isset($order_confirm)) : ?>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Bukti Transfer</h6>
                        </div>
                        <div class="card-body">
                            <p>Dari Rekening: <?= $order_confirm->account_number ?></p>
                            <p>Atas Nama: <?= $order_confirm->account_name ?></p>
                            <p>Nominal: Rp. <?= $order_confirm->nominal ?>,-</p>
                            <p>Catatan: <?= $order_confirm->note ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="<?= base_url($order_confirm->image_url) ?>" height="200" width="200" class="rounded"
                                alt="proof">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>