        <div class="row  mt-4">
            <div class="col-12 mt-4">
                <a href="#" data-toggle="modal" data-target="#assign_menu" class="btn btn-primary mb-2 float-right">Assign menu</a>
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
                        foreach ($relasi_menu as $u) { ?>
                            <tr>
                                <th scope="row"><?= $no ?></th>
                                <td><?= $u['menu'] ?></td>
                                <td><?= $u['link'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('assignmenu/delete/') . $id_user . '/' . $u['id_relasi_menu']; ?>">delete</a>
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
        <div class="modal fade" id="assign_menu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Assign Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('assignmenu/addMenu'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Menu</label>
                                <select class="form-control" name="id_menu">
                                    <?php foreach ($menu as $m) { ?>
                                        <option value="<?= $m['id_menu'] ?>"><?= $m['menu'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" hidden name="id_user" value="<?= $id_user ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        </body>
        <!--end::Body-->

        </html>