<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-4">
                                    <div class="page-header-title">
                                        <i class="ik ik-bar-chart-2 bg-warning"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard</h5>
                                            <?= date('Y-m-d', strtotime('-7 days')) ?> ||
                                            <?= date('Y-m-d', strtotime('-14 days')) ?>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
						<?php echo $this->session->flashdata('message'); ?>
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              
              function errorHandler(errorMessage) {
                  //curisosity, check out the error in the console
                  console.log(errorMessage);

                  //simply remove the error, the user never see it
                  google.visualization.errors.removeError(errorMessage.id);
                  document.getElementById("curve_chart_message").innerHTML += "Data belum memenuhi 30 hari terkahir, segera lengkapi agar dashboard dapat muncul";
              }

              // old draw() function
              // function drawChart() {
              //   var data = google.visualization.arrayToDataTable([
                  
              //     <?php
              //     if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
              //       $sql = "select pet.kel AS nama_lokasi, pro.peternakan_id as lokasi from produksi pro
              //       LEFT JOIN peternakan pet ON pet.id_peternakan = pro.peternakan_id
              //       WHERE jenis_produksi = 'layer' AND peternakan_id = '".$this->session->userdata('id_peternakan')."' AND user_id = '".$this->session->userdata('id')."' AND
              //       tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
              //       GROUP BY lokasi";
              //     } else {
              //     $sql = "select pet.kel AS nama_lokasi, pro.peternakan_id as lokasi from produksi pro
              //     LEFT JOIN peternakan pet ON pet.id_peternakan = pro.peternakan_id
              //     WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND
              //     tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
              //     GROUP BY lokasi";
              //     }
              //     $sql2 = "select distinct(tanggal_prod) as tanggal from produksi WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
              //     $lokasi = $this->db->query($sql)->result_array();
              //     $tgl = $this->db->query($sql2)->result_array();
              //     $list = "['Tgl',";
              //     foreach($lokasi as $row){
              //       $list = $list."'".$row['nama_lokasi']."',";
              //     }
              //     $list = $list."]";
              //     echo $list.",";
              //     foreach($tgl as $tgls) {
              //       $lst = "['".$tgls['tanggal']."',";
              //       foreach($lokasi as $lok){
              //         $sql3 = 'select peternakan_id, sum(total_kg_telur) as total_kg_telur from produksi where  tanggal_prod="'.$tgls['tanggal'].'" AND peternakan_id="'.$lok['lokasi'].'" AND jenis_produksi = "layer" AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY peternakan_id';
              //         $prod = $this->db->query($sql3)->result_array();
              //         foreach($prod as $baris){
              //           // echo $baris['total_kg_telur'];
              //           $lst = $lst.$baris['total_kg_telur'].",";
              //         }
                      
              //       }
              //       $lst = $lst."]";
              //         echo $lst.",";
              //     }

              // ?>
              //   ]);

              //   var options = {
              //     title: '',
              //     curveType: 'function',
              //     legend: { position: 'bottom' }
              //   };

              //   var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

              //   //attach the error handler here, before draw()
              //   google.visualization.events.addListener(chart, 'error', errorHandler);    

              //   chart.draw(data, options);
              // }

              function drawChart(selectedPeriod = 7) {
                // Default to last 7 days
                var dateToday = new Date();
                var chartData = [];
                for (var i = selectedPeriod - 1; i >= 0; i--) {
                    var date = new Date();
                    date.setDate(dateToday.getDate() - i);
                    var dateString = date.getFullYear() + '-' + (date.getMonth() + 1).toString().padStart(2, '0') + '-' + date.getDate().toString().padStart(2, '0');
                    chartData.push([dateString, 0]); // Default value is null (for no data)
                }

                var phpData = [<?php
                  if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
                    $sql = "select pro.flock_id as flock_id from produksi pro
                    LEFT JOIN flock f ON f.user_id = pro.user_id
                    WHERE jenis_produksi = 'layer' AND pro.user_id = '".$this->session->userdata('id')."' AND
                    tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                    GROUP BY pro.flock_id";
                  } else {
                  $sql = "select pro.flock_id as flock_id from produksi pro
                  LEFT JOIN flock f ON f.user_id = pro.user_id
                  WHERE jenis_produksi = 'layer' AND pro.user_id = '".$this->session->userdata('id')."' AND
                  tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                  GROUP BY pro.flock_id";
                  }
                  $sql2 = "select distinct(tanggal_prod) as tanggal from produksi WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
                  $lokasi = $this->db->query($sql)->result_array();
                  $tgl = $this->db->query($sql2)->result_array();
                  foreach($tgl as $tgls) {
                    $lst = "['".$tgls['tanggal']."',";
                    foreach($lokasi as $lok){
                      $sql3 = 'select flock_id, sum(total_kg_telur) as total_kg_telur from produksi where  tanggal_prod="'.$tgls['tanggal'].'" AND flock_id="'.$lok['flock_id'].'" AND jenis_produksi = "layer" AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY flock_id';
                      $prod = $this->db->query($sql3)->result_array();
                      foreach($prod as $baris){
                        // echo $baris['total_kg_telur'];
                        $lst = $lst.$baris['total_kg_telur'].",";
                      }
                      
                    }
                    $lst = $lst."]";
                      echo $lst.",";
                  }
                ?>];

                // var phpData = [<?php
                //   if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
                //     $sql = "select pet.kel AS nama_lokasi, pro.peternakan_id as lokasi from produksi pro
                //     LEFT JOIN peternakan pet ON pet.id_peternakan = pro.peternakan_id
                //     WHERE jenis_produksi = 'layer' AND peternakan_id = '".$this->session->userdata('id_peternakan')."' AND user_id = '".$this->session->userdata('id')."' AND
                //     tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                //     GROUP BY lokasi";
                //   } else {
                //   $sql = "select pet.kel AS nama_lokasi, pro.peternakan_id as lokasi from produksi pro
                //   LEFT JOIN peternakan pet ON pet.id_peternakan = pro.peternakan_id
                //   WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND
                //   tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                //   GROUP BY lokasi";
                //   }
                //   $sql2 = "select distinct(tanggal_prod) as tanggal from produksi WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
                //   $lokasi = $this->db->query($sql)->result_array();
                //   $tgl = $this->db->query($sql2)->result_array();
                //   foreach($tgl as $tgls) {
                //     $lst = "['".$tgls['tanggal']."',";
                //     foreach($lokasi as $lok){
                //       $sql3 = 'select peternakan_id, sum(total_kg_telur) as total_kg_telur from produksi where  tanggal_prod="'.$tgls['tanggal'].'" AND peternakan_id="'.$lok['lokasi'].'" AND jenis_produksi = "layer" AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY peternakan_id';
                //       $prod = $this->db->query($sql3)->result_array();
                //       foreach($prod as $baris){
                //         // echo $baris['total_kg_telur'];
                //         $lst = $lst.$baris['total_kg_telur'].",";
                //       }
                      
                //     }
                //     $lst = $lst."]";
                //       echo $lst.",";
                //   }
                // ?>];                

                // Cari jumlah kolom maksimal berdasarkan data phpData
                var maxColumns = phpData.reduce((max, item) => Math.max(max, item.length), 0);

                // Tambahkan kolom tambahan ke chartData sesuai dengan jumlah kolom maksimal
                for (var i = 0; i < chartData.length; i++) {
                  while (chartData[i].length < maxColumns) {
                    chartData[i].push(0); // Isi dengan null jika belum ada nilai
                  }
                }

                // Loop untuk memasukkan data dari phpData ke dalam chartData
                for (var i = 0; i < chartData.length; i++) {
                  for (var j = 0; j < phpData.length; j++) {
                    if (chartData[i][0] === phpData[j][0]) {
                      for (var k = 1; k < phpData[j].length; k++) {
                        chartData[i][k] = phpData[j][k] ? parseFloat(phpData[j][k]) : 0;
                      }
                      break;
                    }
                  }
                }

                // Sesuaikan header data dengan jumlah garis
                var dataHeader = ['Date'];
                for (var i = 1; i < maxColumns; i++) {
                  dataHeader.push('Value ' + i);
                }

                var data = google.visualization.arrayToDataTable([dataHeader, ...chartData]);
                

                var options = {
                  title: '',
                  curveType: 'function',
                  vAxis: {
                    maxValue: (maxColumns > 0) ? maxColumns : 10, // Ensure the minimum value on the Y axis is 0
                    minValue: 0, // Ensure the minimum value on the Y axis is 0
                    viewWindow: {
                        min: 0,
                    }
                  },
                  legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                //attach the error handler here, before draw()
                google.visualization.events.addListener(chart, 'error', errorHandler);    

                chart.draw(data, options);
              }



            </script>


                        <div class="row">
							              <div class="col-md-12">
                              <div class="card">
                                <div class="card-header"><h3>Produksi Telur (Kg) 30 hari terakhir</h3></div>
                                <p class="mt-2 ml-4">Tanggal Terakhir Update <?= date("d/m/Y", strtotime($last_update)); ?></p>
                                <div id="curve_chart_message" style="text-align: center;"></div>
                                <div class="card-body">
                                      <select id="periodSelect">
                                        <option value="7">7 hari</option>
                                        <option value="14">14 hari</option>
                                        <option value="30">30 hari</option>
                                      </select>
                                    <div class="chart-container">
                                      <div id="curve_chart" style="width: 1280px; height: 720px"></div>
                                    </div>
                                    </div>
									
                                </div>
                            </div>
                        </div>

                        <div class="row">
							<div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h3>Populasi</h3></div>
                                    <div class="card-body">
                                    <div class="chart-container">
                                        <div class="pie-chart-container">
                                        <canvas id="pie-chart"></canvas>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                   
							              <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h3>FCR</h3></div>
                                    <div class="card-body">
                                    <div class="chart-container">
                                        <div class="bar-chart-container">
                                        <canvas id="bar-chart"></canvas>
                                        </div>
                                    </div>
                                    </div>
									
                                </div>
                            </div>

                            <div class="col-md-12" style="font-size: 11px;">
                                <div class="card">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="card-header"><h3>Produksi Layer</h3></div>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mt-2 ml-4">Tanggal Hari ini <?= date('m/d/Y') ?></p> <br>
                                      <p class="mt-2 ml-4">Tanggal Terakhir Update <?= date("d/m/Y", strtotime($last_update)); ?></p>
                                    </div>
                                    <div class="col-md-2">
                                    <select id="test" class="form-control" onchange="showDiv(this)">
                                      <option value="0">Harian</option>
                                      <option value="1">7 Hari</option>
                                      <option value="2">30 Hari</option>
                                    </select>
                                    <script type="text/javascript">
                                      function showDiv(select){
                                        if(select.value==1){
                                          document.getElementById('harian').style.display = "none";
                                          document.getElementById('mingguan').style.display = "block";
                                          document.getElementById('bulanan').style.display = "none";
                                        } else if(select.value==2){
                                          document.getElementById('harian').style.display = "none";
                                          document.getElementById('mingguan').style.display = "none";
                                          document.getElementById('bulanan').style.display = "block";
                                        } else {
                                          document.getElementById('harian').style.display = "block";
                                          document.getElementById('mingguan').style.display = "none";
                                          document.getElementById('bulanan').style.display = "none";
                                        }
                                      } 
                                      </script>
                                    </div>
                                  </div>
									
                                    <div class="card-body">
                                      
                                      <style>
                                        .table-1, tr, th, td {
                                          border: 1px solid silver;
                                          border-collapse: collapse;
                                          text-align: center;
                                        }
                                        .noBorder {
                                          border:none !important;
                                        }
                                        </style>

                                        <div id="harian"><div class="row">
                          
                          <div class="col-md-3">
                          <h5 class="text-center">Lokasi</h5>
                                        <table id="" class="" width="100%">
                                            <thead>
                                              <tr class="noBorder">
                                                  <th rowspan="2" colspan="2" style="background-color:silver">Nama Lokasi</th>
                                              </tr>
                                              
                                            </thead>
                                            <tbody>
                                                <?php  foreach($produksi_yesterday as $data) { ?>
                                                <tr>
                                                    <td><?= $data->kel;?>, <?= $data->prov; ?></td>
                                                    </tr>
                                                 <?php   }  ?> 
                                            </tbody>
                                        </table>
                                      </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Butir</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_today as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_yesterday as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Kg</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_today as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_yesterday as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                          <h5 class="text-center">Kematian</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_today as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_yesterday as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                                        <div id="mingguan" style="display:none;">
                                        <div class="row">
                          
                          <div class="col-md-3">
                          <h5 class="text-center">Lokasi</h5>
                                        <table id="" class="" width="100%">
                                            <thead>
                                              <tr class="noBorder">
                                                  <th rowspan="2" colspan="2" style="background-color:silver">Nama Lokasi</th>
                                              </tr>
                                              
                                            </thead>
                                            <tbody>
                                                <?php  foreach($produksi_mingguan1 as $data) { ?>
                                                <tr>
                                                    <td><?= $data->kel;?>, <?= $data->prov; ?></td>
                                                    </tr>
                                                 <?php   }  ?> 
                                            </tbody>
                                        </table>
                                      </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Butir</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Kg</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                          <h5 class="text-center">Kematian</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                                      </div>

                                        <div id="bulanan" style="display:none;">
                                        <div class="row">
                          
                          <div class="col-md-3">
                          <h5 class="text-center">Lokasi</h5>
                                        <table id="" class="" width="100%">
                                            <thead>
                                              <tr class="noBorder">
                                                  <th rowspan="2" colspan="2" style="background-color:silver">Nama Lokasi</th>
                                              </tr>
                                              
                                            </thead>
                                            <tbody>
                                                <?php  foreach($produksi_bulanan1 as $data) { ?>
                                                <tr>
                                                    <td><?= $data->kel;?>, <?= $data->prov; ?></td>
                                                    </tr>
                                                 <?php   }  ?> 
                                            </tbody>
                                        </table>
                                      </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Butir</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_butir_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-3">
                          <h5 class="text-center">Telur Kg</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->total_kg_telur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                          <h5 class="text-center">Kematian</h5>
                            <div class="row">
                              
                            <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Periode saat ini</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                              <div class="col-md-6">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">sebelumnya</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan2 as $data) { ?>
                                        <tr>
                                          <td><?= $data->kematian;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                                      </div>
                        

                        
                        
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!-- javascript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 

   <script>
  $(function(){
      //get the bar chart canvas
      var cData = JSON.parse(`<?php echo $chart_data; ?>`);
      var ctx = $("#pie-chart");
 
      //bar chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: cData.label,
            data: cData.data,
            backgroundColor: [
              "#DC143C",
              "#DEB887",
              "#708238",
              "#F4A460",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
            ],
            borderColor: [
                "#CB252B",
              "#CDA776",
              "#989898",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
        //   text: "Monthly Registered Users Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "pie",
        data: data,
        options: options
      });
 
  });
</script>

   <script>
  $(function(){
      //get the bar chart canvas
      var cData = JSON.parse(`<?php echo $bar_chart; ?>`);
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: "Avg FCR 30 hari terakhir",
            data: cData.data,
            backgroundColor: [
                "#DC143C",
              "#DEB887",
              "#708238",
              "#76cd86",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
              "#CDA776",
              "#989898",
              "#CB252B",
              "#76cd86",
            ],
            borderColor: [
                "#CB252B",
              "#CDA776",
              "#989898",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
        //   text: "Monthly Registered Users Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
      });
 
  });
</script>

<script>
  $(function(){
      //get the bar chart canvas
      var cData = JSON.parse(`<?php echo $line_chart; ?>`);
      var ctx = $("#line-chart");
 
      //bar chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: "Populasi Ayam per Lokasi",
            data: cData.data,
            backgroundColor: [
                "#DC143C",
              "#DEB887",
              "#76cd86",
              "#F4A460",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
            ],
            borderColor: [
                "#CB252B",
              "#CDA776",
              "#989898",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
        //   text: "Monthly Registered Users Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
      });
 
      $('#periodSelect').on('change', function() {
        drawChart(parseInt($(this).val()));
      })
  });

  
</script>

				
						


          