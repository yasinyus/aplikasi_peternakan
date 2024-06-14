				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-layers bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Edit Flock</h5>
                                            <span>Edit flock dibawahini</span>
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
                                            <li class="breadcrumb-item"><a href="#">Edit Peternakan</a></li>
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
                                        <form class="user" method="post" action="<?= base_url('admin/flock/insert_edit'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Nama Flock</label>
												 <div class="col-sm-9">
                                                    <input type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" name="nama_flock" class="form-control" id="" placeholder="Masukkan Nama Flock" value="<?= $flock->nama_flock ?>">
													<input type="hidden" name="flock_id" class="form-control" id="" value="<?= $flock->id ?>">
                                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Kode Kandang</label>
												 <div class="col-sm-9">
                                                    <input type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" name="kode_kandang" class="form-control"  value="<?= $flock->kode_kandang ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Usia Dalam Hari</label>
												<div class="col-sm-9">
                                                    <input type="number" name="usia_ayam" class="form-control" id="" placeholder="Dalam satuan hari" value="<?= $flock->usia_ayam ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Nama Peternakan</label>
												<div class="col-sm-9">
													<select name="peternakan_id" id="" class="form-control" readonly>
													<option>Pilih Lokasi</option>
                                                    <?php foreach($peternakan as $p){ ?>
                                                        <option value="<?= $p->id_peternakan ?>" <?php if($p->id_peternakan == $flock->peternakan_id ){echo 'selected';} ?>><?= $p->kel ?>, <?= $p->prov  ?> - <?= $p->tipe_peternakan ?></option>
                                                    <?php } ?>
													</select>
												</div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Strain *</label>
												<div class="col-sm-9">
                                                        <select class="form-control" name="strain" readonly>
                                                            <option value="">Jenis Ayam</option>
                                                            <option <?php if($flock->strain == 'ISA'){echo 'selected';} ?>>ISA</option>
                                                            <option <?php if($flock->strain == 'HY Line'){echo 'selected';} ?>>HY Line</option>
                                                            <option <?php if($flock->strain == 'Loghmann'){echo 'selected';} ?>>Loghmann</option>
                                                            <option <?php if($flock->strain == 'Hisex'){echo 'selected';} ?>>Hisex</option>
                                                            <option <?php if($flock->strain == 'Novogen'){echo 'selected';} ?>>Novogen</option>
                                                            <option <?php if($flock->strain == 'Lainnya'){echo 'selected';} ?>>Lainnya</option>
                                                        </select>
												</div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">DOC In *</label>
												<div class="col-sm-9">
                                                    <input type="date" name="tanggal" class="form-control" id="" value="<?= $flock->tanggal ?>" readonly>
                                                </div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kandang *</label>
												<div class="col-sm-9">
                                               
                                                    <div class="input_fields_wrap">
                                                    <!-- <a href="javascript:void(0);" class="btn btn-success add_field_button mb-5" type="button" id="button-addon2">Tambah Kandang <span class="fa fa-plus ml-5"></span></a> -->
                                                    
                                                    <?php foreach ($kandang as $k) { ?>
                                                    <div class="input-group number">
                                                        <span class="input-group-text"><?=  $k->nama_kandang ?></span>
                                                        <input type="hidden" name="nama_kandang[]" value="<?=  $k->nama_kandang ?>">
                                                        <input type="hidden" name="id_kandang[]" value="<?=  $k->id ?>">
                                                        <input class="form-control" type="text" name="jumlah_ayam[]" value="<?=  $k->jumlah_ayam ?>" placeholder="Jumlah Ayam" readonly/><br>
                                                     
                                                    </div>

                                                    <?php } ?>
                                                </div>

                                                <!-- <div class="input_fields_wrap">
                                                    <button class="add_field_button">Add More Fields</button>
                                                    <div><input type="text" name="mytext[]"></div>
                                                </div> -->
												</div>
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<input type="submit" class="btn btn-warning mr-2" name="submit" value="Simpan">
                                            		<a href="<?= base_url('admin/flock') ?>" class="btn btn-light">Batal</a>
												</div>
                                            </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script type="text/javascript">
				  

         

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
                            $(wrapper).append('<div class="input-group number"><span class="input-group-text">Kandang '+ (x) +'</span><label></label><input type="hidden" name="nama_kandang[]" value="Kandang '+ (x) +'"><input type="hidden" name="id_kandang[]" value="'+ (x) +'"><input class="form-control" type="number" name="jumlah_ayam[]" value="" placeholder="Jumlah Ayam"/ ><br><a href="javascript:void(0);" class="remove_field btn btn-danger ml-2">Hapus</a></div>'); //Add field html
                            // $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                        }
                    });

                    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                });
              </script>
