<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 class="m-0">Konfirmasi Order <?= $content->invoice ?></h6>
                    <?php $this->load->view('layouts/_status', ['status' => $content->status]) ?>
                </div>
                <?= validation_errors()?>
                <div class="card-body">
                    <?= form_open_multipart() ?>
                    <div class="mb-3">
                        <label for="invoice" class="form-label">Transaksi</label>
                        <?= form_hidden('invoice', $content->invoice) ?>
                        <?= form_input([
                            'id' => 'invoice',
                            'name' => 'invoice',
                            'value' => $content->invoice,
                            'disabled' => true,
                            'class' => 'form-control'
                        ]) ?>
                        <?= form_error('invoice') ?>
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Dari Rekening A/N</label>
                        <?= form_input([
                            'id' => 'account_name',
                            'name' => 'account_name',
                            'class' => 'form-control'
                        ]) ?>
                        <?= form_error('account_name') ?>
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Dari Nomor Rekening</label>
                        <?= form_input([
                            'id' => 'account_number',
                            'name' => 'account_number',
                            'class' => 'form-control',
                            'type' => 'number'
                        ]) ?>
                        <?= form_error('account_number') ?>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Sebesar</label>
                        <?= form_input([
                            'id' => 'nominal',
                            'name' => 'nominal',
                            'class' => 'form-control',
                            'type' => 'number'
                        ]) ?>
                        <?= form_error('nominal') ?>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Catatan</label>
                        <?= form_textarea([
                            'id' => 'note',
                            'name' => 'note',
                            'class' => 'form-control'
                        ]) ?>
                        <?= form_error('note') ?>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Bukti Transfer</label>
                        <?= form_upload(
                            'image_url',
                            null,
                            [
                                'id' => 'image_url',
                                'class' => 'form-control',
                            ])
                            ?>
                        <?= form_error('image_url') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                </div>
                <?= form_close() ?>
    </div>
</div>