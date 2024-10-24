				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-plus-circle bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Produksi Grower</h5>
                                            <span>Input detail produksi grower harian disini</span>
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
                                            <li class="breadcrumb-item"><a href="#">Produksi Grower</a></li>
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
                                        <form class="user" method="post" action="<?= base_url('admin/produksi/insert_grower'); ?>">
                                        <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Pilih Lokasi *</label>
												<div class="col-sm-9">
                                                    <select name="peternakan_id" id="peternakan" class="form-control" required>
                                                    <option>Pilih Lokasi</option>
                                                    <?php if($this->input->get('id_pt')){ ?>
                                                        <option value="<?= $this->input->get('id_pt')?>" selected><?= $get_peternakan ?></option>
                                                    <?php } else {} ?>
                                                                    <?php
                                                                    foreach ($peternakan as $peternakan) {
                                                                        echo '<option value="' . $peternakan->id_peternakan . '">' . $peternakan->kel . ', ' . $peternakan->prov . '</option>';
                                                                    }
                                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Pilih Flock *</label>
												<div class="col-sm-9">
													<select name="flock_id" id="flock" class="form-control" >
													<option>Pilih Flock</option>
                                                    <?php if($this->input->get('id_fl')){ ?>
                                                        <option value="<?= $this->input->get('id_fl')?>" selected><?= $get_flock ?></option>
                                                    <?php } else {} ?>
													</select>
												</div>
                                            </div>
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Pilih Kandang *</label>
												<div class="col-sm-9">
													<select name="kandang_id" id="kandang" class="form-control" >
													<option value="">Pilih Kandang</option>
                                                    <?php if($this->input->get('id_kd')){ ?>
                                                        <option value="<?= $this->input->get('id_kd')?>" selected><?= $get_kandang ?></option>
                                                    <?php } else {} ?>
													</select>
												</div>
                                            </div>
											<hr>
											<b class="mt-3">Data Produksi Ayam Grower</b>
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Tanggal *</label>
												 <div class="col-sm-9">
                                                 <?php
                                                    $timezone = "Asia/Colombo";
                                                    date_default_timezone_set($timezone);
                                                    $today = date("Y-m-d");
                                                ?>
                                                    <input type="date" name="tanggal_prod" class="form-control" id="" placeholder="" value="<?php echo $today; ?>" max="<?php echo date("Y-m-d"); ?>">
                                                    <div class="col-sm-9" id="tgl_last"></div>
                                                    <?php if($this->input->get('tgl_last')){ ?>
                                                        <span> Tanggal Input Terakhir <?= date('d/m/Y', strtotime($this->input->get('tgl_last')))?></span>
                                                    <?php } else {} ?>
                                                    <?php if($this->session->flashdata('error_tgl')){ ?>
                                                    <span class="text-danger"><?php echo $this->session->flashdata('error_tgl'); ?></span>
                                                    <?php } ?>
												</div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Pakan *</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="pakan_kg" class="form-control" id="" placeholder="50.20" required>
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Minum</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="minum_liter" class="form-control" id="" placeholder="50.20">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">l</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Bobot Ayam</label>
												 <div class="input-group col-sm-9">
                                                    <input type="number" step="0.001" name="bobot_ayam" class="form-control" id="" placeholder="2.50">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kematian *</label>
												<div class="col-sm-9">
                                                    <input type="number"  name="kematian" class="form-control" id="" placeholder="2" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Afkir</label>
												<div class="col-sm-9">
                                                    <input type="number"  name="afkir" class="form-control" id="" placeholder="2">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Uniformity</label>
												<div class="input-group col-sm-9">
                                                    <input type="number" step="0.1" name="uniformity" class="form-control" id="" placeholder="10">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">%</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Perlakuan (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="perlakuan" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Nama Pakan (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="nama_pakan" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Obat / Vitamin (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="vitamin" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Vaksin (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="vaksin" class="form-control"></textarea>
                                                </div>
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2" name="submit">Simpan</button>
                                            		<a href="<?= base_url('admin/produksi/grower') ?>" class="btn btn-light">Batal</a>
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
							var url = "<?php echo site_url('admin/flock/add_ajax_kandang_grower'); ?>/" + $(this).val();
							$('#kandang').load(url);
							return false;
							})
						});
					</script>
                    <script>
						$(document).ready(function() {
							$("#kandang").change(function() {
							var url = "<?php echo site_url('admin/flock/get_ajax_tgl_last_produksi'); ?>/" + $(this).val();
							$('#tgl_last').load(url);
							return false;
							})
						});
					</script>

