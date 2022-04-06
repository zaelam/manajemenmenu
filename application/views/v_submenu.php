        <div class="row  mt-4">
            <div class="col-12 mt-4">
                <a href="#" data-toggle="modal" data-target="#tambah_sub_menu" class="btn btn-primary mb-2">Tambah sub menu</a>
                <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">menu</th>
                            <th scope="col">sub menu</th>
                            <th scope="col">link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($submenu as $u) { ?>
                            <tr>
                                <th scope="row"><?= $no ?></th>
                                <td><?= $u['menu'] ?></td>
                                <td><?= $u['sub_menu'] ?></td>
                                <td><?= $u['link'] ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_sub_menu<?= $u['id_sub_menu'] ?>" class="btn btn-sm btn-success">edit</a>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('menu/delete/submenu/') . $u['id_sub_menu']; ?>">delete</a>
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
        <div class="modal fade" id="tambah_sub_menu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Tambah Sub Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('menu/addSubMenu'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">pilih menu utama</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="id_menu">
                                    <?php foreach ($menu as $m) { ?>
                                        <option value="<?= $m['id_menu'] ?>"><?= $m['menu'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Menu</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sub_menu" placeholder="menu">
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
        foreach ($submenu as $u) {
        ?>
            <div class="modal fade" id="edit_sub_menu<?= $u['id_sub_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Menu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('menu/editSubMenu/') . $u['id_sub_menu'];; ?>" method="POST">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">pilih menu utama</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="id_menu">
                                        <?php foreach ($menu as $m) { ?>
                                            <option value="<?= $m['id_menu'] ?>" <?= $u['id_menu'] == $m['id_menu'] ? 'selected' : ''; ?>><?= $m['menu'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Menu</label>
                                    <input type="text" class="form-control" value="<?= $u['menu'] ?>" name="menu" placeholder="menu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Menu</label>
                                    <input type="text" class="form-control" value="<?= $u['sub_menu'] ?>" name="sub_menu" placeholder="sub menu">
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