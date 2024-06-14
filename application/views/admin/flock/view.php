				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-layers bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>View Flock</h5>
                                            <span>Detail flock</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Flock</a></li>
                                            <li class="breadcrumb-item"><a href="#">View Flock</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="user" method="post" action="<?= base_url('admin/flock/update'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Nama Flock</label>
												 <div class="col-sm-9">
                                                    <p class="mt-1"><?= $flock->nama_flock ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Kode Kandang</label>
												 <div class="col-sm-9">
                                                 <p class="mt-1"><?= $flock->kode_kandang ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Usia Dalam Hari (Minggu) *</label>
												<div class="col-sm-9">
                                                    <?php 
                                                        $tanggal = new DateTime($flock->tanggal);
                                                        $today = new DateTime('today');
                                                        $d = $today->diff($tanggal)->d;
                                                        $usia = $flock->usia_ayam + $d;
                                                    ?>
                                                    <p class="mt-1"><?=  $usia ?> Hari / <?= floor( $usia / 7) ?> Minggu</p>
                                                </div>
                                            </div>

                                           

                                            <?php if($flock->tipe_peternakan == "Fase Grower") { ?>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Estimasi selesai masa layer</label>
												<div class="col-sm-9">
                                                    <p class="mt-1"><?= date('d/m/Y',strtotime('+630 days',strtotime(str_replace('/', '-', $flock->tanggal)))) . PHP_EOL; ?></p>
                                                </div>
                                            </div>

                                            <?php } ?>


                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Lokasi Peternakan</label>
												<div class="col-sm-9">
                                                    <p class="mt-1"><?= $flock->kel . ', ' . $flock->prov?></p>
												</div>
                                            </div>

											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Strain *</label>
												<div class="col-sm-9">
                                                <p class="mt-1"><?= $flock->strain?></p>
												</div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">DOC In</label>
												<div class="col-sm-9">
                                                <p class="mt-1"><?= date("d/m/Y", strtotime($flock->tanggal) );?></p>
                                                </div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kandang</label>
												<div class="col-sm-9">
                                                    <?php foreach ($kandang as $k) { ?>
                                                        <p class="mt-1"><?=  $k->nama_kandang ?> Jumlah populasi <?=  $k->jumlah_ayam ?></p>
                                            
                                                    <?php } ?>
                                                </div>
												</div>
                                            </div>
                                            <a href="<?= base_url('admin/flock') ?>" class="btn btn-success" style="width:200px"><i class="fa fa-chevron-left"></i> Kembali ke List Flock</a>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    


                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script type="text/javascript">
				// // var x = 0; //Initial field counter is 1
                // $(document).ready(function() {
				  

         

                $(document).ready(function() {
                    var max_fields      = 10; //maximum input boxes allowed
                    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                    var add_button      = $(".add_field_button"); //Add button ID

                    // var x = 1; //initlal text box count
                    var x = $('.number').length
                    $(add_button).click(function(e){ //on add input button click
                        e.preventDefault();
                        if(x < max_fields){ //max input box allowed
                            x++; //text box increment
                            $(wrapper).append('<div class="input-group number"><span class="input-group-text">Kandang '+ (x) +'</span><label></label><input type="hidden" name="nama_kandang[]" value="Kandang '+ (x) +'"><input type="hidden" name="id_kandang[]" value="'+ (x) +'"><input class="form-control" type="text" name="jumlah_ayam[]" value="" placeholder="Jumlah Ayam"/><br><a href="javascript:void(0);" class="remove_field btn btn-danger ml-2">Hapus</a></div>'); //Add field html
                            // $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                        }
                    });

                    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                });
              </script>
