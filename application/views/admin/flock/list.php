<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-layers bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Daftar Flock</h5>
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
                                            <li class="breadcrumb-item active" aria-current="page">Daftar flock</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<a href="<?= base_url('admin/flock/tambah'); ?>" class="btn btn-secondary"><i class="ik ik-plus"></i> Tambah Flock</a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header"><h3>Data Peternakan</h3></div> -->
									
                                    <div class="card-body">
                                    <style>
                                        /* div.dataTables_filter {
                                            float: left  !important;
                                            margin-left: -400px !important;
                                            margin-top: 50px !important;
                                        } */
                                        div.dataTables_filter > label > input {
                                            border: 1px solid black !important;
                                        }
                                    </style>
                                    <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama </th>
                                                    <th>Lokasi </th>
                                                    <th>Total Populasi</th>
                                                    <th>Satuan</th>
                                                    <th>Total Kandang</th>
                                                    <th>DOC In</th>
                                                    <th>Umur Ayam</th>
                                                    <th>Strain</th>
                                                    <th>Type</th>
                                                    <th></th>
                                                    <!-- <th>Populasi Per kandang</th> -->
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
												
                                                $no = 1;
                                                foreach($flock as $flock) {
													$tanggal = new DateTime($flock->tanggal);
													$today = new DateTime('today');
													$d = $today->diff($tanggal)->d;
                                                ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><?php echo $flock->nama_flock?></td>
                                                    <td><?php echo $flock->kel . ', ' . $flock->prov ?></td>
                                                    <td><?php echo $this->flock_model->jml_ayam($flock->flock_id) ?></td>
                                                    <td>ekor</td>
                                                    <td><?php echo $this->flock_model->jml_kandang($flock->flock_id)->total ?> <a href="<?= base_url('admin/flock/view_kandang/').$flock->id; ?>" title="Detail kandang"><i class="ik ik-eye"></i></a></td>
                                                    <td><?php echo date('F Y', strtotime($flock->tanggal)); ?></td>
                                                    <td><?php echo floor($flock->usia_ayam / 7); ?> Minggu</td>
                                                    <td><?php echo $flock->strain ?></td>
                                                    <td><?php echo $flock->tipe_peternakan ?></td>
                                                    <!-- <td><?php echo $this->flock_model->jml_ayam($flock->flock_id) / $this->flock_model->jml_kandang($flock->flock_id)->total ?></td> -->
                                                    <?php $usia = floor($flock->usia_ayam / 7); ?>
                                                    <?php if($flock->tipe_peternakan == 'Fase Grower' && $usia >= 14)  { ?>
                                                        <td><a href="<?= base_url('admin/flock/pindah/').$flock->id; ?>" class="btn btn-sm btn-warning">Pindah kandang</a></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                    <?php } ?>
                                                    <td>
                                                        <div class="table-actions">
                                                            <a href="<?= base_url('admin/flock/view/').$flock->id; ?>"><i class="ik ik-eye"></i></a>
                                                                <?php if ($flock->flock_terisi == 0){ ?>
                                                                    <a class="text-success" href="<?= base_url('admin/flock/edit/').$flock->id; ?>" title="Edit"><i class="ik ik-edit-2"></i></a>
                                                                    <?php } else {?>
                                                                        
                                                                        <?php } ?>
                                                            <?php if ($flock->flock_terisi == '0' || $this->flock_model->jml_ayam($flock->flock_id) == 0 ){ ?>
                                                            <!-- <a class="text-success" href="<?= base_url('admin/flock/edit/').$flock->id; ?>" title="Edit"><i class="ik ik-edit-2"></i></a> -->
                                                            <a class="text-danger confirm" href="<?= base_url('admin/flock/delete/').$flock->id; ?>" title="Hapus"><i class="ik ik-trash-2"></i></a>
                                                            <?php } else {} ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                 <?php $no++; } //End looping ?>
                                            </tbody>
                                        </table>

<?php
	// $tgl1 = new DateTime("2023-01-13");
    // $now = date('Y-m-d');
	// $tgl2 = new DateTime($now);
	// $d = $tgl2->diff($tgl1)->days;
    // echo $d;
	// echo floor($d / 365) ." tahun";
?>
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


          