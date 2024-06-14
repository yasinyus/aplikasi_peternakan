				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-user bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Tambah Lokasi</h5>
                                            <span>Tambahkan lokasi peternakan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Peternakan</a></li>
                                            <li class="breadcrumb-item"><a href="#">Tambah Peternakan</a></li>
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
                                        <form class="user" method="post" action="<?= base_url('admin/peternakan/insert'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Nama *</label>
												 <div class="col-sm-9">
                                                    <input type="text" name="nama_peternakan" class="form-control" id="" placeholder="Nama" required>
                                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Lokasi *</label>
												<div class="col-sm-9">
                                                    <input type="text" name="lokasi_peternakan" class="form-control" id="alamat" placeholder="Jl / No rumah / RT.RW" required>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
												<script>
												function getHTML() {
													var provinsi = $('#provinsi option:selected').html();
													var kecamatan = $('#kecamatan option:selected').html();
													var kabupaten = $('#kabupaten option:selected').html();
													var desa = $('#desa option:selected').html();
													var alamat = document.getElementById("alamat").value;
													// alert(provinsi + kecamatan + kabupaten + desa);
													document.getElementById("full_address").value = alamat + ", " + "Kel " + desa + ", " + kecamatan + ", " + kabupaten + ", " + provinsi;
													document.getElementById("nam_prov").value = provinsi;
													document.getElementById("nam_kab").value = kabupaten;
													document.getElementById("nam_kec").value = kecamatan;
													document.getElementById("nam_kel").value = desa;
												}
												$(document).ready(function() {

													$("#provinsi").change(function() {
													var url = "<?php echo site_url('admin/peternakan/add_ajax_kab'); ?>/" + $(this).val();
													$('#kabupaten').load(url);
													return false;
													})

													$("#kabupaten").change(function() {
													var url = "<?php echo site_url('admin/peternakan/add_ajax_kec'); ?>/" + $(this).val();
													$('#kecamatan').load(url);
													return false;
													})

													$("#kecamatan").change(function() {
													var url = "<?php echo site_url('admin/peternakan/add_ajax_des'); ?>/" + $(this).val();
													$('#desa').load(url);
													return false;
													})

												});
												</script>
												<input type="hidden" name="full_address" id="full_address">
												<input type="hidden" name="nam_prov" id="nam_prov">
												<input type="hidden" name="nam_kab" id="nam_kab">
												<input type="hidden" name="nam_kec" id="nam_kec">
												<input type="hidden" name="nam_kel" id="nam_kel">
												<label for="" class="col-sm-3 col-form-label"></label>
												 <div class="col-sm-9">
													<select name="prov" id="provinsi" class="form-control" required>
													<option value="">Pilih Provinsi</option>
													<?php
													foreach ($provinsi as $prov) {
														echo '<option value="' . $prov->id . '">' . $prov->nama . '</option>';
													}
													?>
													</select>
												</div>
												<label for="" class="col-sm-3 col-form-label"></label>
												<div class="col-md-9 mt-3">
													<select name="kab" id="kabupaten" class="form-control" required>
													<option value="">Pilih Kabupaten/Kota</option>
													</select>
												</div>
												<label for="" class="col-sm-3 col-form-label"></label>
												<div class="col-md-9 mt-3">
													<select name="kec" id="kecamatan" class="form-control">
													<option value="">Pilih Kecamatan</option>
													</select>
												</div>
												<label for="" class="col-sm-3 col-form-label"></label>
												<div class="col-md-9 mt-3">
													<select name="desa" id="desa" class="form-control" onchange="getHTML();" required>
													<option value="">Pilih Kelurahan/Desa</option>
													</select>
												</div>
                                                
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Longitude</label>
												<div class="col-sm-9">
                                                    <input type="text" name="longitude" class="form-control" id="" placeholder="Longitude">
                                                </div>
                                            </div>
											
											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Latitude</label>
												<div class="col-sm-9">
                                                    <input type="text" name="latitude" class="form-control" id="" placeholder="Latitude">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Fase *</label>
												<div class="col-sm-9">
                                                	<select name="tipe_peternakan" id="" class="form-control" required>
														<option value="">Pilih fase peternakan</option>
														<option value="Fase Layer">Fase Layer</option>
														<option value="Fase Grower">Fase Grower</option>
													</select>
												</div>
                                            </div>
											 <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Deskripsi</label>
												<div class="col-sm-9">
                                                    <input type="text" name="deskripsi" class="form-control" id="" placeholder="Deskripsi tambahan">
                                                </div>
                                                
                                            </div>
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<button type="submit" class="btn btn-warning mr-2" name="submit">Simpan</button>
                                            		<a href="<?= base_url('admin/peternakan') ?>" class="btn btn-light">Batal</a>
												</div>
                                            </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
