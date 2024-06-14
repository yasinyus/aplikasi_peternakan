				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-user bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Profil Akun</h5>
                                            <span>Detail profil akun anda</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Profil Saya</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="row">
                        <?php if($this->session->userdata('jenis_akun') == 'user') { ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h3>Update Profil</h3></div>
									
                                    <div class="card-body">
                                        <form class="user" method="post" action="<?= base_url('admin/profil'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Nama</label>
												 <div class="col-sm-9">
                                                    <input type="text" name="nama" class="form-control" id="" placeholder="Nama" value="<?php echo $user->nama ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Nama Peternakan</label>
												<div class="col-sm-9">
                                                    <input type="text" name="nama_peternakan" class="form-control" id="" placeholder="Nama Peternakan" value="<?php echo $user->nama_peternakan ?>">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Email</label>
												<div class="col-sm-9">
													<input type="email" name="email" class="form-control" id="" placeholder="Email" value="<?php echo $user->email ?>">
												</div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">No Telp</label>
												<div class="col-sm-9">
                                                	<input type="text" name="no_telp" class="form-control" id="" placeholder="No Telp" value="<?php echo $user->no_telp ?>">
												</div>
                                            </div>
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2">Simpan</button>
                                            		<button class="btn btn-light">Batal</button>
												</div>
                                            </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
                            <?php } else {} ?>

                            <div class="col-md-6">
                                <div class="card" style="min-height: 350px;">
                                    <div class="card-header"><h3>Update Password</h3></div>
                                    <div class="card-body">
                                        <?php echo form_open_multipart(base_url('admin/profil/password')) ?>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Password Baru</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control" id="" value="<?php echo set_value('password') ?>" placeholder="Masukkan password baru">
													<?= form_error('password', '<p class="text-danger pl-3">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="passconfirm" class="form-control" id="" value="<?php echo set_value('password') ?>" placeholder="Ulangi password baru">
													<?= form_error('passconfirm', '<p class="text-danger pl-3">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2">Simpan</button>
                                            		<button class="btn btn-light">Batal</button>
												</div>
                                            </div>
                                            
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
