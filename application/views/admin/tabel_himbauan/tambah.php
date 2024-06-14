				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-bell bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Tambah Himbauan</h5>
                                            <span>Tambahkan data Himbauan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Himbauan</a></li>
                                            <li class="breadcrumb-item"><a href="#">Tambah Himbauan</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h3>Tambah data baru</h3></div>
									
                                    <div class="card-body">
                                        <form class="user" method="post" action="<?= base_url('admin/himbauan/insert'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Judul</label>
												 <div class="col-sm-9">
                                                    <input type="text" name="judul" class="form-control" id="" placeholder="Judul Himbauan">
                                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Tipe</label>
												<div class="col-sm-9">
                                                	<select name="tipe" id="" class="form-control">
														<option value="">--Pilih--</option>
														<option value="himbauan">Himbauan</option>
														<option value="notifikasi">Notifikasi</option>
														<option value="promosi">Promosi</option>
													</select>
												</div>
                                            </div>
											 <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Detail</label>
												<div class="col-sm-9">
                                                    <input type="text" name="detail" class="form-control" id="" placeholder="Deskripsi lengkap">
                                                </div>
                                            </div>
											 <!-- <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Tanggal</label>
												<div class="col-sm-9">
                                                    <input type="datetime" name="tanggal" class="form-control" id="" placeholder="Deskripsi tambahan">
                                                </div>
                                            </div> -->
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2" name="submit">Simpan</button>
                                            		<a href="<?= base_url('admin/himbauan') ?>" class="btn btn-light">Batal</a>
												</div>
                                            </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
