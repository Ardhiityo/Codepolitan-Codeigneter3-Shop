<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-9">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="m-0">Detail Order #123</h6>
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
            <?php if ($order->status == 'waiting') : ?>
                <div class="card-footer">
                    <a href="/myorder/confirm" class="btn btn-success">Konfirmasi Pembayaran</a>
                </div>
            <?php endif ?>
        </div>
        <?php if ($order->status != 'waiting') : ?>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Bukti Transfer</h6>
                        </div>
                        <div class="card-body">
                            <p>Dari Rekening: <?= $order_confirm->account_number ?></p>
                            <p>Atas Nama: <?= $order_confirm->account_name ?></p>
                            <p>Nominal: Rp. <?= number_format($order_confirm->nominal, 0, ',', '.') ?>,-</p>
                            <p>Catatan: <?= $order_confirm->note ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="<?= base_url($order_confirm->image_url) ?>" height="200" width="200" alt="proof">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>