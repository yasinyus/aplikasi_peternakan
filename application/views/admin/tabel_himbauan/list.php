<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-bell bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>List Himbauan</h5>
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
                                            <li class="breadcrumb-item active" aria-current="page">List himbauan</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<a href="<?= base_url('admin/himbauan/tambah'); ?>" class="btn btn-secondary"><i class="ik ik-plus"></i> Tambah himbauan</a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header"><h3>Data himbauan</h3></div> -->
									
                                    <div class="card-body">
                                        <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Tipe</th>
                                                    <th>Detail</th>
                                                    <th>Tanggal</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $no = 1;
                                                foreach($himbauan as $himbauan) {
                                                ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><?php echo $himbauan->judul ?></td>
                                                    <td><?php echo $himbauan->tipe ?></td>
                                                    <td><?php echo $himbauan->detail ?></td>
                                                    <td><?php echo $himbauan->created_at ?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <!-- <a href="#"><i class="ik ik-eye"></i></a> -->
                                                            <a class="text-success" href="<?= base_url('admin/himbauan/edit/').$himbauan->id ?>" title="Edit"><i class="ik ik-edit-2"></i></a>
                                                            <a class="text-danger confirm" href="<?= base_url('admin/himbauan/delete/').$himbauan->id; ?>" title="Hapus"><i class="ik ik-trash-2"></i></a>
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


          