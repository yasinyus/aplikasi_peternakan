				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-layers bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Tambah Flock</h5>
                                            <span>Maukkan data form dibawah ini</span>
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
                                            <li class="breadcrumb-item"><a href="#">Tambah Flock</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header"><h3>Tambah data baru</h3></div>
									
                                    <div class="card-body">
                                        <form class="user" method="post" action="<?= base_url('admin/flock/insert'); ?>">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Nama Flock *</label>
												 <div class="col-sm-9">
                                                    <input type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" name="nama_flock" class="form-control" id="" placeholder="Nama Flock" required>
													<input type="hidden" name="flock_id" class="form-control" id="" value="<?= $last_id[0]->id+1 ?>">
                                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id'); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="">Kode Kandang *</label>
												 <div class="col-sm-9">
                                                    <input type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" name="kode_kandang" class="form-control" id="" placeholder="Contoh. G0821" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Usia Dalam Hari *</label>
												<div class="col-sm-9">
                                                    <input type="number" name="usia_doc" class="form-control" id="" placeholder="Contoh : 360" required>
                                                </div>
                                            </div>

  
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Lokasi *</label>
												<div class="col-sm-9">
													<select name="peternakan_id" id="provinsi" class="form-control" required="required">
													<option value="">Pilih Lokasi</option>
													<?php
													foreach ($peternakan as $peternakan) {
														echo '<option value="' . $peternakan->id_peternakan . '">' . $peternakan->kel . ', ' . $peternakan->prov . ' - '. $peternakan->tipe_peternakan .  '</option>';
													}
													?>
													</select>
												</div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Strain *</label>
												<div class="col-sm-9">
													<select name="strain" id="" class="form-control" required="required">
													<option value="">Pilih Strain</option>
													<option>ISA</option>
													<option>HY Line</option>
													<option>Loghmann</option>
													<option>Hisex</option>
													<option>Novogen</option>
													<option>Lainnya</option>
													</select>
												</div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">DOC In *</label>
												<div class="col-sm-9">
                                                    <input type="date" name="tanggal" class="form-control" id="" placeholder="" required>
                                                </div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kandang *</label>
												<div class="col-sm-9">
													<a href="javascript:void(0);" class="btn btn-success add_field_button mb-5" type="button" id="button-addon2">Tambah Kandang <span class="fa fa-plus ml-5"></span></a>
													<a href="javascript:void(0);" class="remove_field btn btn-danger ml-2 mb-5">Reset Kandang</a>
                                                    <div class="input_fields_wrap"></div>
												</div>
                                                
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
                                                	<input type="submit" class="btn btn-dark mr-2" name="submit" value="Simpan">
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

                    $('input[type="submit"]').attr('disabled','disabled');

                    // var x = 1; //initlal text box count
                    var x = $('.number').length
                    $(add_button).click(function(e){ //on add input button click
                        e.preventDefault();
                        if(x < max_fields){ //max input box allowed
                            x++; //text box increment
                            $(wrapper).append('<div class="input-group number"><span class="input-group-text">Kandang '+ (x) +'</span><label></label><input type="hidden" name="nama_kandang[]" value="Kandang '+ (x) +'" required><input type="hidden" name="id_kandang[]" value="'+ (x) +'"><input class="form-control" type="number" name="jumlah_ayam[]" value="" placeholder="Jumlah Ayam" required/><br></div>'); //Add field html
                            // $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                        }
                        $(":submit").removeAttr("disabled");
                    });

                    $(".remove_field").on("click", function(event) {
                        $(".number").remove();
                        event.preventDefault();
                        x = 0;
                    });

                    // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    //     $('.number').remove(); x = 0;
                    // })
                });
              </script>


