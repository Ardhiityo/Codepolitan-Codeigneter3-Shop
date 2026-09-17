<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h6>Order List</h6>
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
                        <?php foreach ($content as $key => $row) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('myorder/'.$row->invoice) ?>">
                                        <?= $row->invoice ?>
                                    </a>
                                </td>
                                <td><?= date('d/m/Y', strtotime($row->date)) ?></td>
                                <td>Rp. <?= number_format($row->total, 0, ',', '.') ?>,-</td>
                                <td>
                                    <?php $this->load->view('layouts/_status', ['status' => $row->status]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>