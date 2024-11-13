<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-plus bg-orange"></i>
                                        <div class="d-inline">
                                            <h5>Update Produksi Grower</h5>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
                                            <li class="breadcrumb-item"><a href="#">Update Produksi</a></li>
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
                                        <form class="user" method="post" action="<?= base_url('admin/produksi/update_grower_post'); ?>">
                                            
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Nama Lokasi *</label>
												<div class="col-sm-9">
													<select name="peternakan_id" id="peternakan" class="form-control" required>
													<option>Pilih Lokasi</option>
                                                    <?php foreach($peternakan as $p){ ?>
                                                        <option value="<?= $p->id_peternakan ?>" <?php if($p->id_peternakan == $produksi_grower->peternakan_id ){echo 'selected';} ?>><?= $p->nama_peternakan ?> -- <?= $p->tipe_peternakan  ?> | <?= $p->lokasi_peternakan ?></option>
                                                    <?php } ?>
													</select>
												</div>
                                            </div>
                                            <input type="hidden" name="id_produksi" value="<?= $produksi_grower->id_produksi ?>">
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Flock *</label>
												<div class="col-sm-9">
													<select name="flock_id" id="flock" class="form-control">
													<option value="<?= $produksi_grower->flock_id ?>"><?= $produksi_grower->nama_flock ?></option>
													</select>
												</div>
                                            </div>
											<div class="form-group row mb-3">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Kandang *</label>
												<div class="col-sm-9">
													<select name="kandang_id" id="kandang" class="form-control">
													<option value="<?= $produksi_grower->kandang_id ?>"><?= $produksi_grower->nama_kandang ?></option>
													</select>
												</div>
                                            </div>
											<hr>
											
											
											<b class="mt-3">Data Produksi</b>
											<div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Tanggal *</label>
												 <div class="col-sm-9">
                                                
                                                    <input type="date" name="tanggal_prod" class="form-control" value="<?= $produksi_grower->tanggal_prod ?>" id="" placeholder="" required>
												</div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Pakan</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="pakan_kg" class="form-control" id="" value="<?= $produksi_grower->pakan_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Minum</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="minum_liter" class="form-control" id="" value="<?= $produksi_grower->minum_liter ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">l</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">bobot_ayam</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="any" name="bobot_ayam" class="form-control" id="" value="<?= $produksi_grower->bobot_ayam ?>">
                                                    <input type="hidden" name="user_id_layer" value="<?= $this->session->userdata('id'); ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kematian</label>
												<div class="col-sm-9">
                                                    <input type="number"  name="kematian" class="form-control" id="" value="<?= $produksi_grower->kematian ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Afkir</label>
												<div class="col-sm-9">
                                                    <input type="number"  name="afkir" class="form-control" id="" value="<?= $produksi_grower->afkir ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Uniformity</label>
												<div class="col-sm-9">
                                                    <input type="number" step="0.1" name="uniformity" class="form-control" id="" value="<?= $produksi_grower->uniformity ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Perlakuan (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="perlakuan" class="form-control"><?= $produksi_grower->perlakuan ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Nama Obat (Opsional)</label>
												<div class="col-sm-9">
                                                    <input type="text"  name="nama_obat" class="form-control" value="<?= $produksi_grower->nama_obat ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Nama Pakan (Opsional)</label>
												<div class="col-sm-9">
                                                    <input type="text"  name="nama_pakan" class="form-control" value="<?= $produksi_grower->nama_pakan ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Vitamin (Opsional)</label>
												<div class="col-sm-9">
                                                    <input type="text"  name="vitamin" class="form-control" value="<?= $produksi_grower->vitamin ?>">
                                                </div>
                                            </div>

											
											<a href="<?= base_url('admin/produksi/grower') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              		<script>
						$(document).ready(function() {
							$("#peternakan").change(function() {
							var url = "<?php echo site_url('admin/flock/add_ajax_get_flock'); ?>/" + $(this).val();
							$('#flock').load(url);
							return false;
							})
						});
					</script>
              		<script>
						$(document).ready(function() {
							$("#flock").change(function() {
							var url = "<?php echo site_url('admin/flock/add_ajax_kandang_layer'); ?>/" + $(this).val();
							$('#kandang').load(url);
							return false;
							})
						});
					</script>
