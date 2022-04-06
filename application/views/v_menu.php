        <div class="row  mt-4">
            <div class="col-12 mt-4">
                <a href="#" data-toggle="modal" data-target="#tambah_menu" class="btn btn-primary mb-2">Tambah menu</a>
                <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">menu</th>
                            <th scope="col">link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($menu as $u) { ?>
                            <tr>
                                <th scope="row"><?= $no ?></th>
                                <td><?= $u['menu'] ?></td>
                                <td><?= $u['link'] ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_menu<?= $u['id_menu'] ?>" class="btn btn-sm btn-success">edit</a>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('menu/delete/menu/') . $u['id_menu']; ?>">delete</a>
                                </td>
                            </tr>
                        <?php
                            $no += 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <!--begin::Main-->

        <!--  Modal content for the above example -->
        <div class="modal fade" id="tambah_menu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Tambah Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('menu/addMenu'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Menu</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="menu" placeholder="menu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link" placeholder="link">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php
        foreach ($menu as $u) {
        ?>
            <div class="modal fade" id="edit_menu<?= $u['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Menu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('menu/editMenu/') . $u['id_menu'];; ?>" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Menu</label>
                                    <input type="text" class="form-control" value="<?= $u['menu'] ?>" name="menu" placeholder="menu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link</label>
                                    <input type="text" class="form-control" value="<?= $u['link'] ?>" name="link" placeholder="link">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php } ?>

        </body>
        <!--end::Body-->

        </html>