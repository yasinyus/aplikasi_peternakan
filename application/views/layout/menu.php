<div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index.html">
                           
                            <span class="text">Finns App</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">
                            <nav id="main-menu-navigation" class="navigation-main">
                                <div class="nav-lavel">Navigation</div>
                                <div class="nav-item <?php if ($this->uri->segment(2) == 'dashboard'){echo "active";}?>">
                                    <a href="<?= base_url('admin/dashboard'); ?>"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>
                                <div class="nav-item <?php if ($this->uri->segment(2) == 'produksi'){echo "active";}?> has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-plus-circle"></i><span>Produksi</span></a>
                                    <div class="submenu-content">
                                        <a href="<?= base_url('admin/produksi/layer'); ?>" class="menu-item">Fase Layer</a>
                                        <a href="<?= base_url('admin/produksi/grower'); ?>" class="menu-item">Fase Grower</a>
                                    </div>
                                </div>
								<?php if($this->session->userdata('tipe_user') == 'super_user' || $this->session->userdata('tipe_user') == NULL){ ?>
								    <div class="nav-item <?php if ($this->uri->segment(2) == 'peternakan'){echo "active";}?>">
                                        <a href="<?= base_url('admin/peternakan'); ?>"><i class="ik ik-home"></i><span>Lokasi</span></a>
                                    </div>
                                    <div class="nav-item <?php if ($this->uri->segment(2) == 'flock'){echo "active";}?>">
                                        <a href="<?= base_url('admin/flock'); ?>"><i class="ik ik-layers"></i><span>Flock</span></a>
                                    </div>
                                     
                                   
								<?php } else{} ?>
                                
                                
                                <!-- <div class="nav-item <?php if ($this->uri->segment(2) == 'himbauan'){echo "active";}?>">
                                    <a href="<?= base_url('admin/himbauan'); ?>"><i class="ik ik-bell"></i><span>Himbauan</span></a>
                                </div> -->
								
                                <div class="nav-item <?php if ($this->uri->segment(2) == 'report'){echo "active";}?> has-sub">
                                    <a href="#"><i class="ik ik-file-minus"></i><span>Report</span></a>
                                    <div class="submenu-content">
                                        <a href="<?= base_url('admin/report/fase_layer?pet=0'); ?>" class="menu-item">Report Fase Layer</a>
                                        <a href="<?= base_url('admin/report/fase_grower?pet=0'); ?>" class="menu-item">Report Fase Grower</a>
                                    </div>
                                </div>

								<?php if($this->session->userdata('jenis_akun') == 'user_downline') { ?>
                               
								<?php } elseif($this->session->userdata('jenis_akun') == 'admin') { ?>
									<div class="nav-item">
										<a href="<?= base_url('admin/users'); ?>"><i class="ik ik-users"></i><span>Manage User</span></a>
									</div>
									<?php } elseif($this->session->userdata('jenis_akun') == 'user') {?>
										<div class="nav-item">
											<a href="<?= base_url('admin/users/list_downline'); ?>"><i class="ik ik-users"></i><span>Users</span></a>
										</div>
								<?php } ?>

								
                               
                            </nav>
                        </div>
                    </div>
                </div>
