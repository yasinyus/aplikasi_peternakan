<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-users bg-orange"></i>
                                        <div class="d-inline">
                                            <h5>Manage User</h5>
                                            <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
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
                                            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<a	href="<?= base_url('admin/users/tambah_downline') ?>" class="btn btn-warning">Tambah User</a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h3>List User</h3></div>
									
                                    <div class="card-body">
                                        <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>No Telp</th>
                                                    <th>Tgl Daftar</th>
                                                    <th>Status</th>
                                                    <th>Tipe User</th>
                                                    <th>Peternakan</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $no = 1;
                                                foreach($user as $user) {
                                                ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><?php echo $user->nama ?></td>
                                                    
                                                    <td><?php echo $user->email ?></td>
                                                    <td><?php echo $user->no_telp ?></td>
                                                    <td><?php $time = strtotime($user->tanggal_daftar); echo date('m/d/Y', $time);  ?></td>
                                                    <td>
														<?php if ($user->status == 0) { ?>
														<a class="aktiv btn btn-danger" href="<?= base_url('admin/users/confirm/').$user->id ?>">Belum aktif</a>
														<?php } else { ?> 
														<a class="disaktiv btn btn-success" href="<?= base_url('admin/users/confirm_nonactive/').$user->id ?>">Sudah aktif</a>
														<?php } ?>
													</td>
													 <td><?php if($user->tipe_user == "admin_input"){echo "Admin Input";} else {echo "Super User";} ?></td>
													  <td><?php echo $user->nama_peternakan ?></td> 
                                                    <td>
                                                        <div class="table-actions">
                                                            <a href="<?= base_url('admin/users/view/').$user->id ?>" style="color:green"><i class="ik ik-eye"></i></a>
                                                            <a href="<?= base_url('admin/users/edit/').$user->id ?>" style="color:blue"><i class="ik ik-edit-2"></i></a>
                                                            <a class="hapus" href="<?= base_url('admin/users/delete/').$user->id ?>" style="color:red"><i class="ik ik-trash-2"></i></a>
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
							$('.aktiv').on('click',function (e) {
								e.preventDefault();
								var self = $(this);
								console.log(self.data('title'));
								Swal.fire({
									title: 'Apakah anda yakin?',
									text: "akan mengaktifkan user ini?",
									icon: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									cancelButtonText: 'Batalkan',
									confirmButtonText: 'Ya, saya yakin!'
								}).then((result) => {
									if (result.isConfirmed) {
										Swal.fire(
											'Sudah aktif!',
											'Kamu berhasil mengaktifkan user.',
											'success'
										)
									location.href = self.attr('href');
									}
								})

							})

						</script>

						<script>
							$('.disaktiv').on('click',function (e) {
								e.preventDefault();
								var self = $(this);
								console.log(self.data('title'));
								Swal.fire({
									title: 'Apakah anda yakin?',
                                    text: "akan mononaktivkan user ini?",
									icon: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									cancelButtonText: 'Batalkan',
									confirmButtonText: 'Ya, saya yakin!'
								}).then((result) => {
									if (result.isConfirmed) {
										Swal.fire(
											'Sudah nonaktif!',
											'Kamu berhasil menonaktifkan user.',
											'success'
										)
									location.href = self.attr('href');
									}
								})

							})
						</script>

                        <script>
							$('.hapus').on('click',function (e) {
								e.preventDefault();
								var self = $(this);
								console.log(self.data('title'));
								Swal.fire({
									title: 'Apakah anda yakin?',
									text: "akan menghapus user ini?",
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
											'Data berhasil dihapus',
											'success'
										)
									location.href = self.attr('href');
									}
								})

							})
						</script>


          