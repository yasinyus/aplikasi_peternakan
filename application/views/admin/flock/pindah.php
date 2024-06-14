				<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-layers bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Pindah ke Layer</h5>
                                            <span>Pindah dari Fase Grower ke Fase Layer</span>
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
                                    Flock : <?= $flock->nama_flock ?> <br>
                                    Populasi : <?php echo $this->flock_model->jml_ayam($flock->flock_id) ?>
                                    <div class="card-body">
                                        <form class="user" method="GET" action="<?= base_url('admin/flock/edit_pindah'); ?>" id="upload-form">
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Lokasi</label>
												<div class="col-sm-9">
													<select name="peternakan_id_tujuan" id="" class="form-control" required>
													<option value="">Pilih Lokasi Tujuan</option>
                                                    <?php foreach($peternakan as $p){ ?>
                                                        <option value="<?= $p->id_peternakan ?>"<?php if($p->id_peternakan == $flock->peternakan_id ){echo 'selected';} ?>><?= $p->kel . ', ' . $p->prov ?></option>
                                                    <?php } ?>
													</select>
												</div>
                                            </div>

											<div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Kandang</label>
												<div class="col-sm-9">
                                               
                                                    <div class="input_fields_wrap">
                                                    <!-- <a href="javascript:void(0);" class="btn btn-success add_field_button mb-5" type="button" id="button-addon2">Tambah Kandang <span class="fa fa-plus ml-5"></span></a> -->
                                                    <!-- <input type="text" id="tampung_jumlah"> -->
                                                    <?php foreach ($kandang as $k) { ?>
                                                    <div class="input-group number" style="padding: 20px; border: 1px solid silver;">
                                                    <input type="hidden"  name="nama_kandang[]" value="<?=  $k->nama_kandang ?>">
                                                    <input type="hidden" name="id_kandang[]" value="<?=  $k->id ?>">
                                                    <input type="hidden" name="flock_id_pindah" class="form-control" id="" value="<?= $last_id[0]->id+1 ?>">
                                                    <input type="hidden" name="flock_id" class="form-control" id="" value="<?= $flock->id ?>">
                                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id'); ?>">
                                                    <input type="hidden" name="nama_flock" value="<?= $flock->nama_flock ?>">
                                                    <input type="hidden" name="kode_kandang" value="<?= $flock->kode_kandang ?>">
                                                    <input type="hidden" name="usia_ayam" value="<?= $flock->usia_ayam ?>">
                                                    <input type="hidden" name="strain" value="<?= $flock->strain ?>">
                                                    <input type="hidden" name="tanggal" value="<?= $flock->tanggal ?>">
                                                    <input type="hidden" name="peternakan_id" value="<?= $flock->peternakan_id ?>">
                                                    

                                                        <div class="row">
                                                            <div class="col-md-6" style="">
                                                                <span>Nama Kandang :</span>
                                                                <span class="input-group-text mb-3" style="width:200px"><?=  $k->nama_kandang ?></span>
                                                                <span>Populasi :</span>
                                                                <input class="form-control mb-3" id="jml_pop_awal<?=  $k->id.$k->jumlah_ayam ?>" style="width:200px !important" type="number" name="jumlah_ayam[]" value="<?=  $k->jumlah_ayam ?>" placeholder="Jumlah Ayam"/>
                                                            </div>
                                                            <div class="col-md-6" >
                                                                <div id="<?=  $k->id.$k->jumlah_ayam ?>" style="padding: 10px; border: 1px solid red;">
                                                                <span>Kandang Tujuan :</span>
                                                                <input  class="form-control mb-3" type="text" name="nama_kandang_tujuan[]" value="<?=  $k->nama_kandang ?>">
                                                                <span>Populasi Tujuan :</span>
                                                                <input onblur="hitungAyam<?=  $k->id.$k->jumlah_ayam ?>()" class="form-control" id="jml_pop_tujuan<?=  $k->id.$k->jumlah_ayam ?>" type="number" name="jumlah_ayam_tujuan[]" value="0" placeholder="Jumlah Populasi" />
                                                                <button onclick="myFunction<?=  $k->id.$k->jumlah_ayam ?>()">Tidak dipindah</button>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-4">
                                                            <span>Dijual</span>
                                                            <input type="number" class="form-control mb-3" width="200px" placeholder="Dijual" value="0">
                                                            </div>
                                                            <div class="col-md-4">
                                                            <span>Mati</span>
                                                            <input type="number" class="form-control" width="200px" placeholder="Mati" value="0">
                                                            </div> -->
                                                            
                                                        </div>
                                                        <script>
                                                            function myFunction<?=  $k->id.$k->jumlah_ayam ?>() {
                                                                const element = document.getElementById("<?=  $k->id.$k->jumlah_ayam ?>");
                                                                element.remove();
                                                            }

                                                            function hitungAyam<?=  $k->id.$k->jumlah_ayam ?>() {
                                                                var jml_pop_awal = document.getElementById("jml_pop_awal<?=  $k->id.$k->jumlah_ayam ?>").value;
                                                                var jml_pop_tujuan = document.getElementById("jml_pop_tujuan<?=  $k->id.$k->jumlah_ayam ?>").value;
                                                                var jml = document.getElementById("jml_pop_awal<?=  $k->id.$k->jumlah_ayam ?>").value = parseInt(jml_pop_awal)-parseInt(jml_pop_tujuan);
                                                               
                                                                
                                                            }
                                                        </script>
                                                       
                                                    </div>

                                                    <?php } ?>
                                                    
                                                    <!-- <div class="input_fields_wrap">
                                                        <button class="add_field_button">Add More Fields</button>
                                                        <div><input type="text" name="mytext[]"></div>
                                                    </div> -->
                                                    
                                                </div>
												</div>
                                            </div>

											
											<div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9"> 
                                                	<input type="submit" class="btn btn-warning mr-2 confirm" name="submit" value="Pindahkan" onclick="return confirm('APAKAH ANDA YAKIN UNTUK MEMINDAHKAN KANDANG TERSEBUT \nDENGAN RINCIAN SEBAGAI BERIKUT \nDipindah : ' + document.getElementById('jml_pop_awal<?=  $k->id.$k->jumlah_ayam ?>').value + '\nMati : ' + '\nDijual : ' + '\nSisa : ')">
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
                            $(wrapper).append('<div class="input-group number"><span class="input-group-text">Kandang '+ (x) +'</span><label></label><input type="hidden" name="nama_kandang[]" value="Kandang '+ (x) +'"><input type="hidden" name="id_kandang[]" value="'+ (x) +'"><input class="form-control" type="text" name="jumlah_ayam[]" value="" placeholder="Jumlah Ayam"/><br><select class="form-control" name="tipe_ayam[]"><option value="">Jenis Ayam</option><option>ISA BROWN</option><option>HY Line</option><option>LOHMANN</option><option>Hisex</option><option>Novogen</option></select><select class="form-control" name="tipe_peternakan[]"><option>Jenis Peternakan</option><option>Fase Layer</option><option>Fase Grower</option></select><a href="javascript:void(0);" class="remove_field btn btn-danger ml-2">Hapus</a></div>'); //Add field html
                            // $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                        }
                    });

                    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                });
              </script>
<!-- 
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

						</script> -->
           
