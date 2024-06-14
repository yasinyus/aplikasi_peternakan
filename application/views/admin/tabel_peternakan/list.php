<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-home bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Daftar Lokasi</h5>
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
                                                <a href="#">Tables</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">List Peternakan</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<?php if($this->session->userdata('tipe_user') == NULL){ ?>
						<a href="<?= base_url('admin/peternakan/tambah'); ?>" class="btn btn-secondary"><i class="ik ik-plus"></i> Tambah Lokasi</a>
						<?php } else {} ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header"><h3>Data Peternakan</h3></div> -->
									
                                    <div class="card-body">
                                        <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Lokasi</th>
                                                    <th>Longitude , Latitude</th>
                                                    <th>Fase</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $no = 1;
                                                foreach($peternakan as $peternakan) {
                                                ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><?php echo $peternakan->nama_peternakan ?></td>
                                                    <td><?php echo $peternakan->kel. ', ' . $peternakan->prov ?></td>
                                                    <td><?php echo $peternakan->longitude.', '.$peternakan->latitude ?></td>
                                                    <td><?php echo $peternakan->tipe_peternakan ?></td>
                                                    <td>
                                                    <div class="table-actions">
                                                    <a class="text-success" href="<?= base_url('admin/peternakan/edit/').$peternakan->id_peternakan; ?>" title="Edit"><i class="ik ik-edit-2"></i></a>
                                                    <?php if($peternakan->terisi == 1){ ?>
                                                    <?php } else { ?>
                                                        
                                                            <!-- <a href="#"><i class="ik ik-eye"></i></a> -->
                                                            
                                                            <a class="text-danger confirm" href="<?= base_url('admin/peternakan/delete/').$peternakan->id_peternakan; ?>" title="Hapus"><i class="ik ik-trash-2"></i></a>
                                                       
                                                    <?php } ?>
                                                    </div>
                                                    </td>
                                                </tr>
                                                 <?php $no++; } //End looping ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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


          