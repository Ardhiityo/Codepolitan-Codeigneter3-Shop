<div class="row">
    <div class="col-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="m-0">Pengguna</h6>
                            <a href="/user/create" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <?= form_open($action, ['method' => 'GET']) ?>
                        <div class="input-group">
                            <?= form_input(
                                'keyword',
                                $keyword,
                                [
                                    'class' => 'form-control w-50',
                                    'placeholder' => 'Cari'
                                ]
                            ) ?>
                            <button class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <a href="/user" class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-eraser"></i>
                            </a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $index => $row) : ?>
                            <tr>
                                <td><?= (($current_page * $per_page) - $per_page) + ($index + 1) ?></td>
                                <td>
                                    <img src="<?=$row->image_url ? base_url($row->image_url) : base_url('assets/profile.webp') ?>" alt="avatar" class="rounded" height="50"
                                        width="50">
                                    <?= $row->name ?>
                                </td>
                                <td><?= $row->email ?></td>
                                <td><?= $row->role ?></td>
                                <td><?= $row->is_active ? 'Aktif' : 'Non-Aktif' ?></td>
                                <td class="d-flex gap-3">
                                    <a href="<?= '/user/edit/'.$row->id ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <?= form_open('/user/delete/'.$row->id) ?>
                                    <?= form_hidden('id', $row->id) ?>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-<?= $row->id ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-<?= $row->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are your sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $row->name ?> will be deleted.
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
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>