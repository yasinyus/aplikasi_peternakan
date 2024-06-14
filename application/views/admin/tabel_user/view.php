<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-users bg-orange"></i>
                                        <div class="d-inline">
                                            <h5>View User</h5>
                                            <span>View detail user</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#">Tables</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                          <?php 
                // Notifikasi error
                echo validation_errors('<p class="alert alert-warning">','</p>');

                // Form open 
                echo form_open(base_url('admin/users/edit_aksi/'.$user->id));
                ?>

                <div class="auth-credentials">
					<input type="hidden" value="<?= $this->session->userdata('id')?>" name="id_user_downline">
                    <label for="signInEmail" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="signInEmail" aria-describedby="signInEmail" placeholder="Nama lengkap" value="<?= $user->nama ?>">
                    <!-- <label for="signInEmail" class="form-label mt-4">Nama Peternakan</label>
                    <input type="text" name="nama_peternakan" class="form-control" id="signInEmail" aria-describedby="signInEmail" placeholder="Nama Peternakan"> -->
                    <label for="signInEmail" class="form-label mt-4">Email</label>
                    <input type="text" name="email" class="form-control" id="signInEmail" aria-describedby="signInEmail" placeholder="Email" value="<?= $user->email ?>">
                    
                    <label for="signInEmail" class="form-label mt-4">No HP</label>
                    <input type="text" name="no_telp" class="form-control" id="signInEmail" aria-describedby="signInEmail" placeholder="No HP" value="<?= $user->no_telp ?>">
                   
                    <label for="signInEmail" class="form-label mt-4">Tipe User</label>
                    <select name="tipe_user" id="" class="form-control">
                        <option value="">Select User Type</option>
                        <option value="input_admin" <?php if($user->tipe_user == "input_admin") {echo "selected";} ?>>Input Admin</option>
                        <option value="owner" <?php if($user->tipe_user == "owner") {echo "selected";} ?>>Owner</option>
                    </select>
                    
                    <!-- <label for="signInPassword" class="form-label mt-4">Password</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input name="password" type="password" value="" class="input form-control" id="password" placeholder="password" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
                    </div>
                    </div>
                    
                    <label for="signInPassword" class="form-label mt-4">Konfirmasi Password</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input name="konfirmasi_password" type="password" value="" class="input form-control" id="konfirmasi_password" placeholder="password" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide2();">
                        <i class="fas fa-eye" id="show_eye2"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                        </span>
                    </div>
                    </div> -->
                    <!-- <label for="signInPassword" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi_password" class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"> -->
                </div>
                <!-- <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
					<div class="col-sm-9"> -->
                        <!-- <button type="submit" class="btn btn-warning mr-2" name="submit">Simpan</button> -->
                        <a href="<?= base_url('admin/users/list_downline') ?>" class="btn btn-danger mt-5">Kembali</a>
					<!-- </div>
                </div> -->

                <!-- <div class="col auth-submit mt-3">
                    <a type="submit" class="btn bg-orange btn-block btn-lg" style="width=50%">Simpan</a><a href="" class="btn bg-orange btn-block btn-lg">Batal</a>
                </div> -->
            <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function password_show_hide() {
                            var x = document.getElementById("password");
                            var show_eye = document.getElementById("show_eye");
                            var hide_eye = document.getElementById("hide_eye");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                            }
                        </script>

                        <script>
                            function password_show_hide2() {
                            var x = document.getElementById("konfirmasi_password");
                            var show_eye = document.getElementById("show_eye2");
                            var hide_eye = document.getElementById("hide_eye2");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                            }
                        </script>

				


          