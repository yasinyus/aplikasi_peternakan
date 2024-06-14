				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-bell bg-orange"></i>
                                        <div class="d-inline">
                                            <h5>Edit Himbauan</h5>
                                            <span>Edit data himbauan</span>
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
                                            <li class="breadcrumb-item"><a href="#">Edit Himbauan</a></li>
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
                                        <form class="user" method="post" action="<?= base_url('admin/himbauan/update'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Judul</label>
												 <div class="col-sm-9">
													 <input type="hidden" name="id" value="<?= $himbauan->id ?>">
													 <input type="hidden" name="id_user" value="<?= $himbauan->id_user ?>">
                                                    <input type="text" name="judul" class="form-control" id="" placeholder="Judul" value="<?= $himbauan->judul ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Tipe</label>
												<div class="col-sm-9">
                                                	<select name="tipe" id="" class="form-control">
													<option value="">--Pilih--</option>
													<option value="himbauan" <?php if($himbauan->tipe == "himbauan"){echo "selected";} ?>>Himbauan</option>
													<option value="notifikasi" <?php if($himbauan->tipe == "notifikasi"){echo "selected";} ?>>Notifikasi</option>
													<option value="promosi" <?php if($himbauan->tipe == "promosi"){echo "selected";} ?>>Promosi</option>
													</select>
												</div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Detail</label>
												<div class="col-sm-9">
                                                    <input type="text" name="detail" class="form-control" id="" placeholder="Deskripsi lengkap" value="<?= $himbauan->detail ?>">
                                                </div>
                                            </div>
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
