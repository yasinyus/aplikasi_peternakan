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

              function generateColors(numCategories) {
                let colors = [];
                let baseColor = [30, 255, 255]; // RGB untuk biru (#1E90FF)
                let step = 50; // Selisih gradasi warna

                for (let i = 0; i < numCategories; i++) {
                  // Mengurangi intensitas biru secara bertahap
                  let newColor = `rgb(${baseColor[0]}, ${baseColor[1] - (i * step)}, ${baseColor[2]})`;
                  colors.push(newColor);
                }
                return colors;
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

                // var phpData = [<?php
                //   if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
                //     $sql = "select pro.flock_id as flock_id from produksi pro
                //     LEFT JOIN flock f ON f.user_id = pro.user_id
                //     WHERE jenis_produksi = 'layer' AND pro.user_id = '".$this->session->userdata('id')."' AND
                //     tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                //     GROUP BY pro.flock_id";
                //   } else {
                //   $sql = "select pro.flock_id as flock_id from produksi pro
                //   LEFT JOIN flock f ON f.user_id = pro.user_id
                //   WHERE jenis_produksi = 'layer' AND pro.user_id = '".$this->session->userdata('id')."' AND
                //   tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                //   GROUP BY pro.flock_id";
                //   }
                //   $sql2 = "select distinct(tanggal_prod) as tanggal from produksi WHERE jenis_produksi = 'layer' AND user_id = '".$this->session->userdata('id')."' AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
                //   $lokasi = $this->db->query($sql)->result_array();
                //   $tgl = $this->db->query($sql2)->result_array();
                //   foreach($tgl as $tgls) {
                //     $lst = "['".$tgls['tanggal']."',";
                //     foreach($lokasi as $lok){
                //       $sql3 = 'select flock_id, sum(total_kg_telur) as total_kg_telur from produksi where  tanggal_prod="'.$tgls['tanggal'].'" AND flock_id="'.$lok['flock_id'].'" AND jenis_produksi = "layer" AND tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY flock_id';
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

                var phpData = [<?php
                  if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
                    $sql = "SELECT tanggal_prod, SUM(total_kg_telur) AS total_kg_telur, flock_id 
                            FROM produksi 
                            WHERE jenis_produksi = 'layer' 
                            AND user_id = ".$this->session->userdata('id')."
                            AND tanggal_prod IN ( 
                                SELECT DISTINCT(tanggal_prod) AS tanggal_prod 
                                FROM produksi 
                                WHERE tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() 
                            )
                            GROUP BY flock_id, tanggal_prod
                            ORDER BY flock_id;
                            ";
                  } else {
                  $sql = "SELECT tanggal_prod, SUM(total_kg_telur) AS total_kg_telur, flock_id 
                            FROM produksi 
                            WHERE jenis_produksi = 'layer' 
                            AND user_id = ".$this->session->userdata('id')."
                            AND tanggal_prod IN ( 
                                SELECT DISTINCT(tanggal_prod) AS tanggal_prod 
                                FROM produksi 
                                WHERE tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() 
                            )
                            GROUP BY flock_id, tanggal_prod
                            ORDER BY flock_id;";
                  }
                  $result = $this->db->query($sql)->result_array();
                  
                  // Ambil ID unik dan buat mapping index
                  $unique_ids = [];
                  foreach ($result as $item) {
                      if (!in_array($item['flock_id'], $unique_ids)) {
                          $unique_ids[] = $item['flock_id'];
                      }
                  }

                  // Buat mapping untuk index
                  $ids = [];
                  foreach ($unique_ids as $index => $id) {
                      $ids[] = ['id' => $id, 'index' => $index + 1]; // Index dimulai dari 1
                  }

                  // Buat array untuk menyimpan hasil
                  $data = [];
                  $id_index_mapping = [];

                  // Inisialisasi array untuk menyimpan data
                  foreach ($ids as $id_data) {
                      $id_index_mapping[$id_data['id']] = $id_data['index'];
                  }

                  // Iterasi melalui $result
                  foreach ($result as $item) {
                      $tanggal = $item['tanggal_prod'];
                      $total_kg = (float)$item['total_kg_telur'];
                      $id = $item['flock_id'];

                      // Jika tanggal belum ada di $data, buat entry baru
                      if (!isset($data[$tanggal])) {
                          // Inisialisasi dengan tanggal dan nilai 0 untuk index yang ada
                          $data[$tanggal] = array_merge([$tanggal], array_fill(0, count($unique_ids), 0));
                      }

                      // Set nilai total_kg sesuai dengan index yang ditentukan
                      $index = $id_index_mapping[$id] ?? null; // Dapatkan index dari mapping
                      if ($index !== null) {
                          $data[$tanggal][$index] = $total_kg; // Set nilai
                      }
                  }

                  // Mengubah associative array menjadi indexed array
                  $data = array_values($data);

                  echo json_encode($data);

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
                var maxColumns = phpData[0].reduce((max, item) => Math.max(max, item.length), 0);

                // Tambahkan kolom tambahan ke chartData sesuai dengan jumlah kolom maksimal
                for (var i = 0; i < chartData.length; i++) {
                  while (chartData[i].length < maxColumns) {
                    chartData[i].push(0); // Isi dengan null jika belum ada nilai
                  }
                }

                // Loop untuk memasukkan data dari phpData ke dalam chartData
                for (var i = 0; i < chartData.length; i++) {
                  for (var j = 0; j < phpData[0].length; j++) {
                    if (chartData[i][0] === phpData[0][j][0]) {
                      for (var k = 1; k < phpData[0][j].length; k++) {
                        chartData[i][k] = phpData[0][j][k] ? parseFloat(phpData[0][j][k]) : 0;
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
                
                
                var colors = generateColors(dataHeader.length - 1);

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
                  legend: { position: 'bottom' },
                  colors: colors
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
                                <div class="card-header"><h3>Produksi Telur (Kg)</h3></div>
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
                                      <option value="1">7 Hari</option>
                                      <option value="2">30 Hari</option>
                                    </select>
                                    <script type="text/javascript">
                                      function showDiv(select){
                                        if(select.value==1){
                                          document.getElementById('mingguan').style.display = "block";
                                          document.getElementById('bulanan').style.display = "none";
                                        } else {
                                          document.getElementById('mingguan').style.display = "none";
                                          document.getElementById('bulanan').style.display = "block";
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

                                        <!-- <div id="harian"><div class="row">
                          
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
                      </div> -->
                                        <div id="mingguan">
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

                        <div class="col-md-12" style="font-size: 11px;">
                                <div class="card">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="card-header"><h3>Grower</h3></div>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mt-2 ml-4">Tanggal Hari ini <?= date('m/d/Y') ?></p> <br>
                                      <p class="mt-2 ml-4">Tanggal Terakhir Update <?= date("d/m/Y", strtotime($last_update_grower)); ?></p>
                                    </div>
                                    <div class="col-md-2">
                                    <select id="test" class="form-control" onchange="showDivGrower(this)">
                                      <option value="1">7 Hari</option>
                                      <option value="2">30 Hari</option>
                                    </select>
                                    <script type="text/javascript">
                                      function showDivGrower(select){
                                        if(select.value==1){
                                          document.getElementById('mingguan-grower').style.display = "block";
                                          document.getElementById('bulanan-grower').style.display = "none";
                                        } else {
                                          document.getElementById('mingguan-grower').style.display = "none";
                                          document.getElementById('bulanan-grower').style.display = "block";
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
                                        <div id="mingguan-grower">
                                        <div class="row">
                          
                          <div class="col-md-2">
                          <h5 class="text-center">Lokasi</h5>
                                        <table id="" class="" width="100%">
                                            <thead>
                                              <tr class="noBorder">
                                                  <th rowspan="2" colspan="2" style="background-color:silver">Nama Lokasi</th>
                                              </tr>
                                              
                                            </thead>
                                            <tbody>
                                                <?php  foreach($produksi_mingguan_grower1 as $data) { ?>
                                                <tr>
                                                    <td><?= $data->kel;?>, <?= $data->prov; ?></td>
                                                    </tr>
                                                 <?php   }  ?> 
                                            </tbody>
                                        </table>
                                      </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Usia</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Minggu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->umur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Jumlah Populasi</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Jumlah Populasi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->jml_total_ayam;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Pakan Per Kilo</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Kg</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= ($data->pakan_gr_per_ekor * 1000);?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                          <h5 class="text-center">Bobot</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">gr/ekor</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->bobot_telur_gr_perbutir;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                          <h5 class="text-center">Uniformity</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Uniformity</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_mingguan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->uniformity;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                                      </div>

                                        <div id="bulanan-grower" style="display:none;">
                                        <div class="row">
                          
                          <div class="col-md-2">
                          <h5 class="text-center">Lokasi</h5>
                                        <table id="" class="" width="100%">
                                            <thead>
                                              <tr class="noBorder">
                                                  <th rowspan="2" colspan="2" style="background-color:silver">Nama Lokasi</th>
                                              </tr>
                                              
                                            </thead>
                                            <tbody>
                                                <?php  foreach($produksi_bulanan_grower1 as $data) { ?>
                                                <tr>
                                                    <td><?= $data->kel;?>, <?= $data->prov; ?></td>
                                                    </tr>
                                                 <?php   }  ?> 
                                            </tbody>
                                        </table>
                                      </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Usia</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Minggu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->umur;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Jumlah Populasi</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Jumlah Populasi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->jml_total_ayam;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                      <div class="col-md-2">
                          <h5 class="text-center">Pakan Per Kilo</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Kg</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= ($data->pakan_gr_per_ekor * 1000);?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                          <h5 class="text-center">Bobot</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">gr/ekor</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->bobot_telur_gr_perbutir;?></td>
                                        </tr>
                                        <?php }  ?> 
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                          <h5 class="text-center">Uniformity</h5>
                            <div class="row">
                              
                            <div class="col-md-12">
                                <table id="" class="" width="100%">
                                    <thead>
                                      <tr>
                                        <th style="background-color:silver">Uniformity</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($produksi_bulanan_grower1 as $data) { ?>
                                        <tr>
                                          <td><?= $data->uniformity;?></td>
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
      });
  });

  
</script>

				
						


          