<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="m-0">Orders</h6>
                        </div>
                    </div>
                    <div class="col-4">
                        <?= form_open(base_url('order'), ['method' => 'GET']) ?>
                        <div class="input-group">
                            <input type="text" class="form-control w-50" name="keyword" value="<?= $keyword ?>" placeholder="Cari">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <a href="/order" class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-eraser"></i>
                            </a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table text-center table-borderless">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $row) : ?>
                            <tr>
                                <td class="text-primary">
                                    <a href="<?= 'order/detail/'.$row->invoice ?>">
                                        <?= $row->invoice ?>
                                    </a>
                                </td>
                                <td><?= date('d/m/Y', strtotime($row->date)) ?></td>
                                <td>Rp. <?= number_format($row->total, 0, ',', '.') ?>,-</td>
                                <td><?php $this->load->view('layouts/_status', ['status' => $row->status]) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>