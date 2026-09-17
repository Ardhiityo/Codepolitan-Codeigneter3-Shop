<div class="row">
    <div class="col-9">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Alamat Pengiriman</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name">
                                <div id="name" class="form-text">We'll never share your email with anyone
                                    else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="phone">
                                <div id="phone" class="form-text">We'll never share your email with anyone
                                    else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="10"
                                    cols="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <div class="card-header">
                <h6>Cart</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $row) : ?>
                            <td><?= $row->title ?></td>
                            <td><?= $row->quantity ?></td>
                            <td>Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</td>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Subtotal</td>
                            <td>
                                Rp. <?= number_format(array_sum(array_column($content, 'subtotal')), 0, ',', '.') ?>,-
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>
                                Rp. <?= number_format(array_sum(array_column($content, 'subtotal')), 0, ',', '.') ?>,-
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>