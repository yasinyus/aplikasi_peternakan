<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-plus-circle bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>List produksi Ayam Fase Grower</h5>
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
                                            <li class="breadcrumb-item active" aria-current="page">List produksi </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<a href="<?= base_url('admin/produksi/tambah_grower'); ?>" class="btn btn-secondary"><i class="ik ik-plus"></i> Input Data Produksi</a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header"><h3>Data Peternakan</h3></div> -->
									
                                    <div class="card-body">
                                        <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Lokasi</th>
                                                    <th>Flock</th>
                                                    <th>Kandang</th>
                                                    <th>Jumlah Pakan</th>
                                                    <th>Jumlah Minum</th>
                                                    <th>Bobot Ayam</th>
                                                    <th>Kematian</th>
                                                    <th>Afkir</th>
                                                    <th>Uniformity</th>
                                                    <th>Perlakuan</th>
                                                    <th  class="nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $no = 1;
                                                foreach($produksi as $data) {
                                                ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($data->tanggal_prod)) ?></td>
                                                    <td><?php echo $data->kel . ', ' . $data->prov ?></td>
                                                    <td><?php echo $data->nama_flock ?></td>
                                                    <td><?php echo $data->nama_kandang ?></td>
                                                    <td><?php echo $data->pakan_kg ?> kg</td>
                                                    <td><?php echo $data->minum_liter ?> l</td>
                                                    <td><?php echo $data->bobot_ayam ?> kg</td>
                                                    <td><?php echo $data->kematian ?></td>
                                                    <td><?php echo $data->afkir ?></td>
                                                    <td><?php echo $data->uniformity ?></td>
                                                    <td><?php echo $data->perlakuan ?></td>
                                                    <?php if($this->session->userdata('jenis_akun') == 'user') { ?>
                                                        <td>
                                                        <div class="table-actions">
                                                            <a class="text-success" href="<?= base_url('admin/produksi/lihat_produksi_grower/').$data->id_produksi; ?>" title="Lihat"><i class="ik ik-eye"></i></a>
                                                            <a class="text-primary" href="<?= base_url('admin/produksi/update_grower/').$data->id_produksi; ?>" title="Edit"><i class="ik ik-edit-2"></i></a>
                                                            <!-- <a class="text-danger confirm" href="<?= base_url('admin/produksi/delete_grower/').$data->id_produksi; ?>" title="Hapus"><i class="ik ik-trash-2"></i></a> -->
                                                        </div>
                                                    </td>
                                                    <?php } else {} ?>
                                                    
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
						


          