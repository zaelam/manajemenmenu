        <div class="row  mt-4">
            <div class="col-12 mt-4">
                <a href="#" data-toggle="modal" data-target="#tambah_user" class="btn btn-primary mb-2">Tambah user</a>
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user as $u) { ?>
                            <tr>
                                <th scope="row"><?= $no ?></th>
                                <td><?= $u['email'] ?></td>
                                <td><?= $u['ps_kode'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="<?= base_url('assignmenu/index/') . $u['id_user']; ?>">Assign Menu</a>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('user/delete/') . $u['id_user']; ?>">delete</a>
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
        <div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Tambah User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('register/processRegister'); ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama User</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_user" placeholder="Nama user">
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