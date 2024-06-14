<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-file-minus bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Report Fase Grower </h5>
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
                                                <a href="#">Report</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Report Grower </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<h5>Filter Report</h5>
                        <form action="<?php base_url('admin/report/fase_grower') ?>" method="get" onsubmit="getHTML();">
                        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
												<script>
												function getHTML() {
													var peternakan = $('#peternakan option:selected').html();
													var flock = $('#flock option:selected').html();
													var kandang = $('#kandang option:selected').html();
													document.getElementById("pet").value = peternakan;
													document.getElementById("flo").value = flock;
													document.getElementById("kan").value = kandang;
												}
												</script>
												<input type="hidden" name="pet" id="pet">
												<input type="hidden" name="flo" id="flo">
												<input type="hidden" name="kan" id="kan">
                        <?php // if($this->input->get('peternakan_id') == NULL || $this->input->get('peternakan_id') == "") { ?>
                        <div class="row">
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Peternakan</label>
                                    <select name="peternakan_id" id="peternakan" class="form-control" required>
                                    <option value="">Pilih Peternakan</option>
                                    <option value="all">All</option>
													<?php
													foreach ($peternakan as $peternakan) {
														echo '<option value="' . $peternakan->id_peternakan . '">' . $peternakan->kel . ', '. $peternakan->prov. '</option>';
													}
													?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Flock</label>
                                    <select name="flock_id" id="flock" class="form-control" >
                                        <!-- <option value="">Pilih Flock</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Kandang</label>
                                    <select name="kandang_id" id="kandang" class="form-control">
                                        <!-- <option value="">Pilih Kandang</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tgl Awal</label>
                                    <div id="rentang_waktu_awal"></div>
                                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tgl Akhir</label>
                                    <div id="rentang_waktu_akhir"></div>
                                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="color:white">.</label>
                                    
                                    <button type="submit" class="form-control btn btn-success mr-2" style="color:black; border:3px solid #000"><i class="fa fa-filter"></i> Filter</button>
                                    
                                </div>
                            </div>
                        </div>
                        <?php // } else { ?>
                            <?php // if($this->input->get('kandang_id') == NULL || $this->input->get('kandang_id') == ""){ ?>
                                <!-- <a href="<?= base_url('admin/report/export_layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger">Download Report</a> -->
                            <?php // } else { ?>
                                <!-- <a href="<?= base_url('admin/report/export_layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger">Download Report</a> -->
                        <?php // } ?>
                        <?php // } ?>
                        </form>
                        <a href="<?= base_url('admin/laporan_pdf/grower?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger" target="_blank">Download PDF</a>
                        <a href="<?= base_url('admin/report/xls_grower?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger" target="_blank">Download XLS</a>
                        <style>
                        table, tr, th, td {
                        border: 1px solid silver;
                        border-collapse: collapse;
                        text-align: center;
                        font-size: 9px;
                        }
                        </style>
                        <table id="data_table" class="" width="100%">
                                            <thead>
                                            
                                            <tr>
                                                <th rowspan="3">Tanggal</th>
                                                <th colspan="2">Profil</th>
                                                <th colspan="3">Deplesi</th>
                                                <th colspan="5">Konsumsi</th>
                                                <th colspan="2">Bobot Ayam</th>
                                                <th colspan="2">Uniformity</th>
                                                <th rowspan="3">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Umur (Week)</th>
                                                <th rowspan="2">Populasi</th>
                                                <th rowspan="2">Kematian</th>
                                                <th rowspan="2">Afkir</th>
                                                <th rowspan="2">Mort%</th>
                                                <th colspan="3">Pakan</th>
                                                <th colspan="2">Air Minum</th>
                                                <th>Real</th>
                                                <th>Standard</th>
                                                <th>Real</th>
                                                <th>Standard</th>
                                            </tr>
                                            <tr>
                                                
                                                <th>Total (Kg)</th>
                                                <th>Fl(gram/ekor)</th>
                                                <th>standard(gr/ekor)</th>
                                                <th>Total (L)</th>
                                                <th>mL/ekor</th>
                                                <th>Gram</th>
                                                <th>Gram</th>
                                                <th>%</th>
                                                <th>%</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                // if($this->input->get('peternakan_id') && $this->input->get('flock_id')){
                                                foreach($produksi as $data) {
                                                ?>
                                            <tr>
                                                <td><?= $data['tanggal_prod'];?></td>
                                                <td></td>
                                                <!-- <td><?= floor($data['umur']);?></td> -->
                                                <td><?= $data['jml_total_ayam'];?></td>
                                                <td><?= $data['kematian'];?></td>
                                                <td><?= $data['afkir'];?></td>
                                                <td><?= $data['mort'];?></td>
                                                <td><?= $data['pakan_kg'];?></td>
                                                <td><?= $data['pakan_gr_per_ekor'];?></td>
                                                <td></td>
                                                <td><?= $data['minum_liter'];?></td>
                                                <td><?= $data['minum_ml_per_ekor'];?></td>
                                                <?php if($data['bobot_ayam'] >= 1.400 && $this->input->get('flock_id') != NULL){ ?>
                                                <td><?= $data['bobot_ayam'] / $this->flock_model->jml_kandang($this->input->get('flock_id'))->total;?></td>
                                                <?php } else { ?>
                                                <td><?= $data['bobot_ayam'] ?></td>
                                                <?php } ?>
                                                <td></td>
                                                <td><?= $data['uniformity'];?></td>
                                                <td></td>
                                                <td><?= $data['perlakuan'];?></td>
                                            </tr>
                                            <?php }  ?> 
                                            </tbody>
                                        </table>

                        <!-- <a href="<?= base_url('admin/report/export_grower?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id') ?>" class="btn btn-danger">Download Report</a> -->

            

						<script>
							$('.confirm').on('click',function (e) {
								e.preventDefault();
								var self = $(this);
								console.log(self.data('title'));
								Swal.fire({
									title: 'Apakah anda yakin?',
									text: "akan hapus data?",
									icon: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									cancelButtonText: 'Batalkan',
									confirmButtonText: 'Ya, saya yakin!'
								}).then((result) => {
									if (result.isConfirmed) {
										Swal.fire(
											'Berhasil!',
											'Kamu berhasil menghapus data.',
											'success'
										)
									location.href = self.attr('href');
									}
								})

							})

						</script>

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
							$("#peternakan").change(function() {
							var url = "<?php echo site_url('admin/flock/get_ajax_tgl_awal'); ?>/" + $(this).val();
							$('#rentang_waktu_awal').load(url);
							return false;
							})
						});
					</script>
              		<script>
						$(document).ready(function() {
							$("#peternakan").change(function() {
                                const tgl_awal = document.getElementById('tgl_awal');
                                const tgl_akhir = document.getElementById('tgl_akhir');
                                tgl_awal.remove();
                                tgl_akhir.remove();
							var url = "<?php echo site_url('admin/flock/get_ajax_tgl_akhir'); ?>/" + $(this).val();
							$('#rentang_waktu_akhir').load(url);
							return false;
							})
						});
					</script>
						


          