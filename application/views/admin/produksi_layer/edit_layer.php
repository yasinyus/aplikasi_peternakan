				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-plus bg-orange"></i>
                                        <div class="d-inline">
                                            <h5>Update Produksi Layer</h5>
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
                                        <form class="user" method="post" action="<?= base_url('admin/produksi/update_layer_post'); ?>">
                                            
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Nama Peternakan *</label>
												<div class="col-sm-9">
													<select name="peternakan_id" id="peternakan" class="form-control" disabled>
													<option>Pilih Lokasi</option>
                                                    <?php foreach($peternakan as $p){ ?>
                                                        <option value="<?= $p->id_peternakan ?>" <?php if($p->id_peternakan == $produksi_layer->peternakan_id ){echo 'selected';} ?>><?= $p->nama_peternakan ?> -- <?= $p->tipe_peternakan  ?> | <?= $p->lokasi_peternakan ?></option>
                                                    <?php } ?>
													</select>
												</div>
                                            </div>
                                            <input type="hidden" name="id_produksi" value="<?= $produksi_layer->id_produksi ?>">
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Flock *</label>
												<div class="col-sm-9">
													<select name="flock_id" id="flock" class="form-control" disabled>
													<option value="<?= $produksi_layer->flock_id ?>"><?= $produksi_layer->nama_flock ?></option>
													</select>
												</div>
                                            </div>
											<div class="form-group row mb-3">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Kandang *</label>
												<div class="col-sm-9">
													<select name="kandang_id" id="kandang" class="form-control" disabled>
													<option value="<?= $produksi_layer->kandang_id ?>"><?= $produksi_layer->nama_kandang ?></option>
													</select>
												</div>
                                            </div>
											<hr>
											<b class="mt-3">Data Produksi</b>
											<div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Tanggal *</label>
												 <div class="col-sm-9">
                                                
                                                    <input type="date" name="tanggal_prod" class="form-control" value="<?= $produksi_layer->tanggal_prod ?>" id="" placeholder="" readonly>
												</div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Jumlah Utuh *</label>
												 <div class="input-group col-sm-4">
                                                    <input type="number" step="0.1" name="jml_utuh_butir" class="form-control" id="" value="<?= $produksi_layer->jml_utuh_butir ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="number" step="0.1" name="jml_utuh_kg" class="form-control" id="" value="<?= $produksi_layer->jml_utuh_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Sortir (Putih, lainnya) </label>
												 <div class="input-group col-sm-4">
                                                    <input type="number" step="0.1" name="sortir_butir" class="form-control" id="" value="<?= $produksi_layer->sortir_butir ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="number" step="0.1" name="sortir_kg" class="form-control" id="" value="<?= $produksi_layer->sortir_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">BS</label>
												 <div class="input-group col-sm-4">
                                                    <input type="number" step="0.1" name="bs_butir" class="form-control" id="" value="<?= $produksi_layer->sortir_butir ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="number" step="0.1" name="bs_kg" class="form-control" id="" value="<?= $produksi_layer->sortir_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Cangkang</label>
												 <div class="input-group col-sm-4">
                                                    <input type="number" step="0.1" name="cangkang_butir" class="form-control" id="" value="<?= $produksi_layer->cangkang_butir ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="number" step="0.1" name="cangkang_kg" class="form-control" id="" value="<?= $produksi_layer->cangkang_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
											<hr>
											<b class="mt-3">Data Lainnya</b>
											
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Pakan</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="pakan_kg" class="form-control" id="" value="<?= $produksi_layer->pakan_kg ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Minum</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="minum_liter" class="form-control" id="" value="<?= $produksi_layer->minum_liter ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">l</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">bobot_ayam</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.001" name="bobot_ayam" class="form-control" id="" value="<?= $produksi_layer->bobot_ayam ?>">
                                                    <input type="hidden" name="user_id_layer" value="<?= $this->session->userdata('id'); ?>">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kematian</label>
												<div class="col-sm-9">
                                                    <input type="number" step="0.1" name="kematian" class="form-control" id="" value="<?= $produksi_layer->kematian ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Afkir</label>
												<div class="col-sm-9">
                                                    <input type="number" step="0.1" name="afkir" class="form-control" id="" value="<?= $produksi_layer->afkir ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Perlakuan (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="perlakuan" class="form-control"><?= $produksi_layer->perlakuan ?></textarea>
                                                </div>
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                    <button type="submit" class="btn btn-warning mr-2" name="submit">Simpan Update</button>
                                            		<a href="<?= base_url('admin/produksi/layer') ?>" class="btn btn-light"><i class="fa fa-arrow-left"></i> Kembali</a>
                                            		
												</div>
                                            </div>
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
