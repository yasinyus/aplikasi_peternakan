				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-user bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Produksi Layer</h5>
                                            <span>Input detail produksi layer harian disini</span>
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
                                        <form class="user" method="post" action="<?= base_url('admin/produksi/insert_layer'); ?>">
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Pilih Flock</label>
												<div class="col-sm-9">
													<select name="flock_id" id="flock" class="form-control">
													<option>--Pilih--</option>
													<?php
													foreach ($flock as $flock) {
														echo '<option value="' . $flock->flock_id . '">' . $flock->nama_flock . '</option>';
													}
													?>
													</select>
												</div>
                                            </div>
											<div class="form-group row mb-3">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Pilih Kandang</label>
												<div class="col-sm-9">
													<select name="kandang_id" id="kandang" class="form-control">
													<option value="">Pilih kandang</option>
													</select>
												</div>
                                            </div>
											<hr>
											<b class="mt-3">Data Produksi</b>
											
                                            <div class="form-group row mt-3">
                                                <label class="col-sm-3 col-form-label" for="">Jumlah Utuh</label>
												 <div class="input-group col-sm-4">
                                                    <input type="text" name="jml_utuh_butir" class="form-control" id="" placeholder="Masukkan total butir">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="text" name="jml_utuh_kg" class="form-control" id="" placeholder="Masukkan total KG">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Sortir (Putih, lainnya)</label>
												 <div class="input-group col-sm-4">
                                                    <input type="text" name="sortir_butir" class="form-control" id="" placeholder="Masukkan butir">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="text" name="sortir_kg" class="form-control" id="" placeholder="Masukkan KG">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">BS</label>
												 <div class="input-group col-sm-4">
                                                    <input type="text" name="bs_butir" class="form-control" id="" placeholder="Masukkan butir">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="text" name="bs_kg" class="form-control" id="" placeholder="Masukkan KG">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Cangkang</label>
												 <div class="input-group col-sm-4">
                                                    <input type="text" name="cangkang_butir" class="form-control" id="" placeholder="Masukkan butir">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">butir</span>
													</div>
                                                </div>
												 <div class="input-group col-sm-5">
                                                    <input type="text" name="cangkang_kg" class="form-control" id="" placeholder="Masukkan KG">
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
                                                    <input type="text" name="pakan_kg" class="form-control" id="" placeholder="Masukkan jumlah pakan dalam KG">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
												</div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Minum</label>
												 <div class="input-group col-sm-9">
                                                    <input type="text" name="minum_liter" class="form-control" id="" placeholder="Masukkan jumlah minum dalam liter">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">ml</span>
													</div>
												</div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Bobot Ayam</label>
												 <div class="input-group col-sm-9">
                                                    <input type="text" name="bobot_ayam" class="form-control" id="" placeholder="Masukkan bobot ayam">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">kg</span>
													</div>
                                                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kematian</label>
												<div class="col-sm-9">
                                                    <input type="text" name="kematian" class="form-control" id="" placeholder="Masukkan jumlah ayam mati">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Afkir</label>
												<div class="col-sm-9">
                                                    <input type="text" name="afkir" class="form-control" id="" placeholder="Masukkan jumlah ayam afkir">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Perlakuan (Opsional)</label>
												<div class="col-sm-9">
                                                    <textarea name="perlakuan" class="form-control"></textarea>
                                                </div>
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2" name="submit">Simpan</button>
                                            		<a href="<?= base_url('admin/produksi/layer') ?>" class="btn btn-light">Batal</a>
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
							$("#flock").change(function() {
							var url = "<?php echo site_url('admin/flock/add_ajax_kandang_layer'); ?>/" + $(this).val();
							$('#kandang').load(url);
							return false;
							})
						});
					</script>

