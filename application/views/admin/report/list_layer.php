<style>
    .-mt-6 {
        margin-top: -1.5rem
    }

    /* Style utama untuk datepicker */
    #ui-datepicker-div.ui-datepicker {
        background: #fff !important; /* Warna latar belakang putih */
        border: none !important; /* Hilangkan border */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important; /* Tambahkan bayangan */
        padding: 10px 15px !important; /* Padding kalender */
        border-radius: 10px !important; /* Sudut kalender yang halus */
        width: auto !important; /* Lebar menyesuaikan konten */
        margin: 0 auto !important; /* Margin untuk mengatur posisi di tengah */
    }

    /* Style header */
    #ui-datepicker-div .ui-datepicker-header {
        background: #fff !important; /* Header background putih */
        border: none !important; /* Hilangkan border header */
        color: #333 !important; /* Warna teks header */
        font-size: 16px !important; /* Ukuran teks header */
        font-weight: bold !important; /* Teks tebal */
        padding: 10px 0 !important; /* Jarak vertikal header */
        text-align: center !important; /* Posisi teks header di tengah */
    }

    /* Style untuk judul bulan dan tahun */
    #ui-datepicker-div .ui-datepicker-title {
        margin: 0 !important; /* Hilangkan margin */
        display: inline-block !important; /* Menjaga elemen tetap inline */
    }

    /* Style untuk panah navigasi */
    #ui-datepicker-div .ui-datepicker-prev, 
    #ui-datepicker-div .ui-datepicker-next {
        color: #333 !important; /* Warna panah */
        font-size: 18px !important; /* Ukuran panah */
        line-height: 1 !important; /* Line height */
        position: absolute !important; /* Posisi absolut */
        width: 20px !important; /* Lebar ikon panah */
        height: 20px !important; /* Tinggi ikon panah */
        cursor: pointer !important; /* Ubah cursor menjadi pointer */
        margin-top: 13px;
    }

    #ui-datepicker-div .ui-datepicker-prev {
        left: 10px !important; /* Posisi panah kiri */
    }

    #ui-datepicker-div .ui-datepicker-next {
        right: 10px !important; /* Posisi panah kanan */
    }

    /* Style untuk kalender */
    #ui-datepicker-div .ui-datepicker-calendar {
        width: 100% !important; /* Kalender full width */
        border: none !important;
    }

    /* Style untuk header hari (SU, MO, dll.) */
    #ui-datepicker-div .ui-datepicker-calendar th {
        color: #666 !important; /* Warna teks header hari */
        font-weight: 500 !important; /* Tebal */
        text-transform: uppercase !important; /* Ubah teks menjadi huruf besar */
        padding: 10px 0 !important; /* Jarak vertikal */
    }

    /* Style untuk setiap tanggal */
    #ui-datepicker-div .ui-datepicker-calendar td {
        text-align: center !important; /* Teks di tengah */
        border-radius: 50% !important; /* Tanggal berbentuk bulat */
        transition: background 0.3s !important; /* Animasi saat hover */
    }

    /* Warna teks default tanggal */
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-default {
        color: #333 !important; /* Warna teks */
        font-weight: 500 !important; /* Tebal */
        padding: 10px;
        font-size: medium;
        font-weight: 600;
        border-radius: 20%;
    }

    /* Warna saat tanggal dihover */
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-hover {
        background: #007bff !important; /* Warna latar belakang saat hover */
        color: #fff !important; /* Warna teks saat hover */    
    }

    /* Warna untuk tanggal yang dipilih */
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-active {
        background: #007bff !important; /* Warna latar belakang tanggal aktif */
        color: #fff !important; /* Warna teks tanggal aktif */
    }

    /* Menghapus border di sekitar tanggal */
    #ui-datepicker-div .ui-datepicker-calendar td {
        border: none !important; /* Hilangkan border di dalam sel */
        box-shadow: none !important; /* Hilangkan bayangan */
    }

    /* Menghapus border di sekitar hari (SU, MO, dll.) */
    #ui-datepicker-div .ui-datepicker-calendar th {
        border: none !important; /* Hilangkan border di header */
    }

    /* Menghapus border di sekitar bulan/tahun */
    #ui-datepicker-div .ui-datepicker-header {
        border: none !important; /* Hilangkan border di header */
        box-shadow: none !important; /* Hilangkan bayangan di header */
    }

    /* Menghapus garis antar hari */
    #ui-datepicker-div .ui-datepicker-calendar tr {
        border: none !important; /* Hilangkan border pada baris */
    }

    /* Menghapus border untuk tanggal aktif atau hover */
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-default,
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-active,
    #ui-datepicker-div .ui-datepicker-calendar .ui-state-hover {
        border: none !important; /* Hilangkan border pada tanggal aktif/hover */
    }
</style>
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
                                        <option value="custom_date" <?php if($this->input->get('periode') == 'custom_date'){ echo "selected";} ?>>Custom Tanggal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="tgl_awal_wrapper" class="form-group d-none">
                                    <label for="">Tgl Awal</label>
                                    <div id="rentang_waktu_awal"></div>
                                    <!-- <?php if($this->input->get('tgl_awal')){ ?>
                                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="<?= $this->input->get('tgl_awal') ?>" >
                                    <?php } else {?>
                                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" >
                                    <?php }?> -->
                                    <input type="text" id="tgl_awal_field" class="form-control" placeholder="Pilih Tanggal" name="tgl_awal_field" autocomplete="off"/>
                                    <input type="text" id="tgl_awal" name="tgl_awal" hidden/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="tgl_akhir_wrapper" class="form-group d-none">
                                    <label for="">Tgl Akhir</label>
                                    <div id="rentang_waktu_akhir"></div>
                                    <!-- <?php if($this->input->get('tgl_akhir')){ ?>
                                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= $this->input->get('tgl_akhir') ?>" >
                                    <?php } else {?>
                                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" >
                                    <?php  }?> -->
                                    <input type="text" id="tgl_akhir_field" class="form-control" placeholder="Pilih Tanggal" name="tgl_akhir_field" autocomplete="off"/>
                                    <input type="text" id="tgl_akhir" name="tgl_akhir" hidden/>
                                    <p id="custom_tgl" class="btn btn-secondary btn-block mt-1">Reset</p>
                                </div>
                            </div>
                            
                            <div class="col-md-2 -mt-6">
                                <div class="form-group">
                                    <label style="color:white">.</label>
                                    
                                    <button type="submit" class="filter-button form-control btn btn-success mr-2 d-none" style="color:black; border:3px solid #000"><i class="fa fa-filter"></i> Filter</button>
                                    
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
                        


                        
                        <div class="row">
                            <div class="col-9">
                                <?php if($_GET['pet'] == "0") { ?>
                                
                                <?php } else { ?>
                                
                                Filter berdasarkan : <br>
                                Lokasi : <?= $_GET['pet']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Flock : <?= $_GET['flo']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Kandang : <?= $_GET['kan']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Periode : <?= isset($_GET['periode']) ? $_GET['periode'] . ' Hari Terakhir' : 'Custom' ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Tgl Awal : <?= $_GET['tgl_awal'] ?? '' ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Tgl Akhir : <?= $_GET['tgl_akhir'] ?? '' ?> &nbsp;&nbsp;
                      
                                <?php } ?>
                            </div>
                            <div class="col-3 left-0">
                                <a href="<?= base_url('admin/laporan_pdf/layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-danger" target="_blank">Download PDF</a>
                                <a href="<?= base_url('admin/report/xls_layer?').'peternakan_id='.$this->input->get('peternakan_id').'&flock_id='.$this->input->get('flock_id').'&kandang_id='.$this->input->get('kandang_id').'&tgl_awal='.$this->input->get('tgl_awal').'&tgl_akhir='.$this->input->get('tgl_akhir') ?>" class="btn btn-success" target="_blank">Download XLS</a> 
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
                                                <!-- <th>UB1</th> -->
                                                <th rowspan="4">Tanggal</th>
                                                <th colspan="2">Usia</th>
                                                <th rowspan="4">Populasi</th>
                                                <th colspan="2">Deplesi</th>
                                                <th colspan="4">Konsumsi Pakan</th>
                                                <th colspan="4">Produksi Telur</th>
                                                <th colspan="6">Performa Produksi</th>
                                                
                                            </tr>
                                            <tr> 
                                                <th rowspan="3">Minggu</th>
                                                <th rowspan="3">Hari</th>
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
                                                    <td><?= $data['jml_total_ayam'];?></td>
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
                                                    <td><?= $data['bs_butir'];?></td>
                                                    <td><?= $data['bs_kg'];?></td>
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
                    <script>
                        $(document).ready(function () {
                            const selectableDates = <?php echo json_encode($tanggal_prod); ?>;
                            const today = new Date();
                            const yesterday = new Date(today);
                            yesterday.setDate(yesterday.getDate() - 1);
                            const formatDate = (date) => $.datepicker.formatDate('yy-mm-dd', date);
                            
                            function setPlaceholders() {
                                $('#tgl_awal_field').attr('placeholder', formatDate(yesterday));
                                $('#tgl_akhir_field').attr('placeholder', formatDate(today));
                            }                            

                            function available(date) {
                                const dateString = $.datepicker.formatDate("yy-mm-dd", date);
                                return [selectableDates.indexOf(dateString) !== -1, ""];
                            }

                            $("#tgl_awal_field").datepicker({
                                dateFormat: "yy-mm-dd",
                                beforeShowDay: available,
                                onSelect: function(selectedDate) {
                                    // ($(this).val() !== '') ? $('#periode').prop('disabled', true) : $('#periode').prop('disabled', false);
                                    const date = $(this).datepicker('getDate');
                                    $("#tgl_akhir_field").datepicker("option", "minDate", date);
                                    // Set datepicker end date to start date's month and next month
                                    $("#tgl_akhir_field").datepicker("option", "defaultDate", date);
                                    $("#tgl_akhir_field").datepicker("option", "maxDate", "+1M +1D");
                                    $('#tgl_awal').val(selectedDate);
                                },
                                onClose: function(selectedDate) {
                                    if (selectedDate) {
                                        $("#tgl_akhir_field").datepicker("option", "minDate", selectedDate);
                                    } else {
                                        $("#tgl_akhir_field").datepicker("option", "minDate", null);
                                    }
                                }
                            });

                            $("#tgl_akhir_field").datepicker({
                                dateFormat: "yy-mm-dd",
                                beforeShowDay: available,
                                onSelect: function(selectedDate) {
                                    // ($(this).val() !== '') ? $('#periode').prop('disabled', true) : $('#periode').prop('disabled', false);
                                    const date = $(this).datepicker('getDate');
                                    $("#tgl_awal_field").datepicker("option", "maxDate", date);
                                    $('#tgl_akhir').val(selectedDate);
                                },
                                onClose: function(selectedDate) {
                                    if (selectedDate) {
                                        $("#tgl_awal_field").datepicker("option", "maxDate", selectedDate);
                                    } else {
                                        $("#tgl_awal_field").datepicker("option", "maxDate", null);
                                    }
                                }
                            });
                            
                            $('#custom_tgl').click(function() {
                                let button = $(this)[0];
                                $('#tgl_awal_wrapper, #tgl_akhir_wrapper').hide();
                                $('#periode').prop('disabled', false);
                                $('#periode option:selected').prop('selected', false);
                                $('.filter-button').hide();
                            })
                            
                            $('#periode').on('change', function() {
                                let element = $('#tgl_awal_wrapper, #tgl_akhir_wrapper');
                                const selectedValue = $(this).val();
                                if (selectedValue == 'custom_date') {
                                    $('.filter-button').hasClass('d-none') ? $('.filter-button').removeClass('d-none') : $('.filter-button').show();
                                    element.hasClass('d-none') ? element.removeClass('d-none') : element.show();
                                    $(this).prop('disabled', true);
                                    $('#tgl_awal_field').attr('disabled', false);
                                    $('#tgl_akhir_field').attr('disabled', false);
                                    $('#tgl_awal_field').attr('value', formatDate(yesterday));
                                    $('#tgl_akhir_field').attr('value', formatDate(today));
                                } else if (selectedValue) {                                   
                                    let startDate, endDate;

                                    if (selectedValue == '7') {
                                        startDate = new Date(today);
                                        startDate.setDate(today.getDate() - 7); // 7 hari terakhir
                                    } else if (selectedValue == '14') {
                                        startDate = new Date(today);
                                        startDate.setDate(today.getDate() - 14); // 14 hari terakhir
                                    } else if (selectedValue == '30') {
                                        startDate = new Date(today);
                                        startDate.setDate(today.getDate() - 30); // 30 hari terakhir
                                    }

                                    // Format date to match datepicker format
                                    const formattedStartDate = formatDate(startDate);
                                    const formattedEndDate = formatDate(today);

                                    // Set datepicker values and disable them
                                    $('#tgl_awal').val(formattedStartDate);
                                    $('#tgl_akhir').val(formattedEndDate);
                                    $('#tgl_awal_field').val(formattedStartDate).prop('disabled', true);
                                    $('#tgl_akhir_field').val(formattedEndDate).prop('disabled', true);
                                    element.hasClass('d-none') ? element.removeClass('d-none') : element.show();

                                    $('.filter-button').hasClass('d-none') ? $('.filter-button').removeClass('d-none') : $('.filter-button').show();
                                } else {
                                    $('.filter-button').hide();
                                    element.hide();
                                }
                            })

                            setPlaceholders();
                        })
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