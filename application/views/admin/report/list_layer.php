<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-file-minus bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Report Fase Layer </h5>
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
                                            <li class="breadcrumb-item active" aria-current="page">Report Layer </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<h5>Filter Report</h5>
                        <form action="<?php base_url('admin/report/fase_layer') ?>" method="get" onsubmit="getHTML();">
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
                                    <label for="">Lokasi</label>
                                    <select name="peternakan_id" id="peternakan" class="form-control" required>
                                    <?php if($this->input->get('pet')){ ?>
                                    <option value=""><?= $this->input->get('pet') ?></option>
                                    <?php } ?>
                                    <option value="">Pilih Lokasi</option>
                                    
													<?php foreach ($peternakan as $peternakan) { ?>
													<?php if(isset($_GET['peternakan_id'])) { ?>
													   <option value="<?= $peternakan->id_peternakan; ?>" <?php if($peternakan->id_peternakan == $_GET['peternakan_id']){ echo 'selected'; } ?> > <?= $peternakan->nama_peternakan; ?></option>
													 <?php } else { ?>
													    <option value="<?= $peternakan->id_peternakan; ?>" > <?= $peternakan->nama_peternakan; ?></option>
													<?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Flock</label>
                                    <select name="flock_id" id="flock" class="form-control" >
                                    <option value="">All</option>
                                    <?php if($this->input->get('flo')){ ?>
                                    <option value=""><?= $this->input->get('flo') ?></option>
                                    <?php } ?>
                                        <!-- <option value="">Pilih Flock</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Kandang</label>
                                    <select name="kandang_id" id="kandang" class="form-control">
                                    <option value="">All</option>
                                    <?php if($this->input->get('kan')){ ?>
                                    <option value=""><?= $this->input->get('kan') ?></option>
                                    <?php } ?>
                                        <!-- <option value="">Pilih Kandang</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Periode</label>
                                    <select name="periode" id="periode" class="form-control">
                                        <option value="">Pilih Periode</option>
                                        <option value="7" <?php if($this->input->get('periode') == 7){ echo "selected";} ?>>7 Hari Terakhir</option>
                                        <option value="14" <?php if($this->input->get('periode') == 14){ echo "selected";} ?>>14 Hari Terakhir</option>
                                        <option value="30" <?php if($this->input->get('periode') == 30){ echo "selected";} ?>>30 Hari Terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tgl Awal</label>
                                    <div id="rentang_waktu_awal"></div>
                                    <?php if($this->input->get('tgl_awal')){ ?>
                                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="<?= $this->input->get('tgl_awal') ?>" >
                                    <?php } else {?>
                                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" >
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tgl Akhir</label>
                                    <div id="rentang_waktu_akhir"></div>
                                    <?php if($this->input->get('tgl_akhir')){ ?>
                                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= $this->input->get('tgl_akhir') ?>" >
                                    <?php } else {?>
                                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" >
                                    <?php  }?>
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
                        
                        <a href="<?= base_url('admin/laporan_pdf/layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger" target="_blank">Download PDF</a>
                                <a href="<?= base_url('admin/report/xls_layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger" target="_blank">Download XLS</a>

                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <?php if($_GET['pet'] == "0") { ?>
                                
                                <?php } else { ?>
                                
                                Filter berdasarkan : <br>
                                Lokasi : <?= $_GET['pet']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Flock : <?= $_GET['flo']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Kandang : <?= $_GET['kan']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 Periode : <?= $_GET['periode']?> Hari Terakhir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Tgl Awal : <?= $_GET['tgl_awal']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Tgl Akhir : <?= $_GET['tgl_akhir']?> &nbsp;&nbsp;
                                
                                <?php } ?>
                            </div>
                        </div>
                        
                        <style>
                        table, tr, th, td {
                        border: 1px solid silver;
                        border-collapse: collapse;
                        text-align: center;
                        margin-top:20px;
                        }
                        </style>
						                <table id="" class="" width="100%">
						                    <!--<table id="data_table" class="" width="100%">-->
                                            <thead>
                                            <tr>
                                                <th>UB1</th>
                                                <!-- <th></th> -->
                                                <th></th>
                                                <th colspan="2">Deplesi</th>
                                                <th colspan="4">Konsumsi</th>
                                                <th colspan="4">Produksi Telur</th>
                                                <th colspan="6">Performa Produksi</th>
                                                
                                            </tr>
                                            <tr>
                                                <th rowspan="3">Tanggal</th>
                                                <!-- <th rowspan="3">Umur</th> -->
                                                <th rowspan="3">Populasi</th>
                                                <th rowspan="3">Mati</th>
                                                <th rowspan="3">Afkir</th>
                                                <!--<th rowspan="3">Mort</th>-->
                                                <th colspan="2">Pakan</th>
                                                <th colspan="2">Air Minum</th>
                                                <th colspan="4">Total</th>
                                                <th rowspan="3">Bobot Telur (Gr/Butir)</th>
                                                <th rowspan="3">Bobot Telur/1000 Ekor (Kg/1000)</th>
                                                <th rowspan="3" colspan="1">%HD</th>
                                                <th rowspan="3">FCR</th>
                                                <!--<th rowspan="3">Egg Mass Cum</th>-->
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Total Kg</th>
                                                <th rowspan="2">gr/Ekor</th>
                                                <th rowspan="2">Total L</th>
                                                <th rowspan="2">ml/Ekor</th>
                                                <th colspan="2">Normal</th>
                                                <th colspan="2">BS</th>
                                            </tr>
                                            <tr>
                                                
                                                <th>Butir</th>
                                                <th>Kg</th>
                                                <th>Butir</th>
                                                <th>Kg</th>
                                                <!--<th>Real</th>-->
                                                <!--<th>Week</th>-->
                                                <!--<th>Target</th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                // if($this->input->get('peternakan_id') && $this->input->get('flock_id')){
                                                foreach($produksi as $data) {
                                                ?>
                                                <tr>
                                                    <td><?= $data['tanggal_prod'];?></td>
                                                    <!-- <td><?= floor($data['umur']);?></td> -->
                                                    <td><?= $data['jml_total_ayam'];?></td>
                                                    <td><?= $data['kematian'];?></td>
                                                    <td><?= $data['afkir'];?></td>
                                                    <!--<td><?= round($data['kematian']/$data['jml_total_ayam']*100/100, 4);?> %</td>-->
                                                    <td><?= $data['pakan_kg'];?></td>
                                                    <td><?= $data['pakan_gr_per_ekor'] * 1000;?></td>
                                                    <td><?= $data['minum_liter'];?></td>
                                                    <td><?= $data['minum_ml_per_ekor'] * 1000;?></td>
                                                    <td><?= $data['total_butir_telur'];?></td>
                                                    <td><?= $data['total_kg_telur'];?></td>
                                                    <td><?= $data['bs_kg'];?></td>
                                                    <td><?= $data['bs_butir'];?></td>
                                                    <td><?= $data['bobot_telur_gr_perbutir'];?></td>
                                                    <td><?= $data['bobot_telur_per_seribu_ekor'];?></td>
                                                    <td><?= $data['hd'];?>%</td>
                                                    <!--<td></td>-->
                                                    <!--<td></td>-->
                                                    <td><?= $data['fcr'];?></td>
                                                    <!--<td><?= $data['egg_mass_comulative'];?></td>-->
                                                </tr>
                                                 <?php }  ?> 
                                            </tbody>
                                        </table>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              		<script>
						$(document).ready(function() {
							$("#peternakan").change(function() {
                                var peternakan = $('#peternakan option:selected').html();
                               
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
     <!--         		<script>-->
					<!--	$(document).ready(function() {-->
					<!--		$("#peternakan").change(function() {-->
     <!--                           const tgl_awal = document.getElementById('tgl_awal');-->
     <!--                           tgl_awal.remove();-->
					<!--		var url = "<?php echo site_url('admin/flock/get_ajax_tgl_awal'); ?>/" + $(this).val();-->
					<!--		$('#rentang_waktu_awal').load(url);-->
					<!--		return false;-->
					<!--		})-->
					<!--	});-->
					<!--</script>-->
     <!--         		<script>-->
					<!--	$(document).ready(function() {-->
					<!--		$("#peternakan").change(function() {-->
     <!--                           const tgl_akhir = document.getElementById('tgl_akhir');-->
     <!--                           tgl_akhir.remove();-->
					<!--		var url = "<?php echo site_url('admin/flock/get_ajax_tgl_akhir'); ?>/" + $(this).val();-->
					<!--		$('#rentang_waktu_akhir').load(url);-->
					<!--		return false;-->
					<!--		})-->
					<!--	});-->
					<!--</script>-->