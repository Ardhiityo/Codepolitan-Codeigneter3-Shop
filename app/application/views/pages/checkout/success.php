<div class="row">
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Berhasil</h6>
            </div>
            <div class="card-body">
                <h5>Nomor Order: <?= $content->invoice ?></h5>
                <p>Terimakasih sudah berbelanja.</p>
                <p>Silahkan lakukan pembayaran untuk bisa kami proses selanjutnya, dengan cara:</p>
                <ol>
                    <li>
                        Lakukan pembayaran pada rekening <strong>BCA 12345</strong> a/n <strong>PT.Shop</strong>
                    </li>
                    <li>Sertakan keterangan dengan nomor order: <strong><?= $content->invoice ?></strong></li>
                    <li>Total pembayaran <strong>Rp. <?= number_format($content->total, 0, ',', '.') ?>,-</strong></li>
                </ol>
                <p>
                    Jika sudah, silahkan kirimkan bukti transfer di halaman konfirmasi atau bisa
                    <a href="/myorder/confirm">klik disini</a>
                </p>
                <a href="/" class="btn btn-primary">
                    <i class="fa-solid fa-circle-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>