<style>
                        table, tr, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                        text-align: center;
                        font-size:10px;
                        }
                        </style>
                        <h3>Laporan Produksi Layer</h3>
						                <table id="" class="" width="100%">
                                            <thead>
                                            <tr>
                                                <th>UB1</th>
                                                <th></th>
                                                <th></th>
                                                <th colspan="2">Deplesis</th>
                                                <th colspan="4">Konsumsi</th>
                                                <th colspan="4">Produksi Telur</th>
                                                <th colspan="7">Performa Produksi</th>
                                                
                                            </tr>
                                            <tr>
                                                <th rowspan="3">Tanggal</th>
                                                 <th rowspan="3">Usia</th> 
                                                <th rowspan="3">Populasi</th>
                                                <th rowspan="3">Mati</th>
                                                <th rowspan="3">Afkir</th>
                                                <!--<th rowspan="3">Mort</th>-->
                                                <th colspan="2">Pakan</th>
                                                <th colspan="2">Air Minum</th>
                                                <th colspan="4">Total</th>
                                                <th rowspan="3">Bobot Telur (Gr/Butir)</th>
                                                <th rowspan="3">Bobot Telur/1000 Ekor (Kg/1000)</th>
                                                <th rowspan="3" colspan="1">%HD</th>
                                                <th rowspan="3">FCR</th>
                                                <th rowspan="3">Nama Obat</th>
                                                <th rowspan="3">Nama Pakan</th>
                                                <th rowspan="3">Vitamin</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Total Kg</th>
                                                <th rowspan="2">gr/Ekor</th>
                                                <th rowspan="2">Total L</th>
                                                <th rowspan="2">ml/Ekor</th>
                                                <th colspan="2">Normal</th>
                                                <th colspan="2">BS</th>
                                            </tr>
                                            <tr>
                                                
                                                <th>Butir</th>
                                                <th>Kg</th>
                                                <th>Butir</th>
                                                <th>Kg</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                foreach($produksi as $data) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    $umur = $data['usia_ayam'];
                                                    $tgl = $data['tanggal'];
                                                    $date1 = date_create($tgl);
                                                    $date2 = date_create(date("Y-m-d"));
                                                    $diff1 = date_diff($date1,$date2);
                                                    $daysdiff = $diff1->format("%R%a");
                                                    $daysdiff = abs($daysdiff);
                                                    
                                                    $usia = $umur + $daysdiff;
                                                    $u = $usia / 7;
                                                    $age = floor($u);
                                                
                                                
                                                ?>
                                                    <td><?= $data['tanggal_prod'];?></td>
                                                    <td><?= $age;?></td>
                                                    <td><?= $data['jml_total_ayam'];?></td>
                                                    <td><?= $data['kematian'];?></td>
                                                    <td><?= $data['afkir'];?></td>
                                                    <!--<td><?= round($data['kematian']/$data['jml_total_ayam']*100/100, 4);?> %</td>-->
                                                    <td><?= $data['pakan_kg'];?></td>
                                                    <td><?= floor($data['pakan_gr_per_ekor']);?></td>
                                                    <td><?= $data['minum_liter'];?></td>
                                                    <td><?= floor($data['minum_ml_per_ekor']);?></td>
                                                    <td><?= $data['total_butir_telur'];?></td>
                                                    <td><?= $data['total_kg_telur'];?></td>
                                                    <td><?= $data['bs_kg'];?></td>
                                                    <td><?= $data['bs_butir'];?></td>
                                                    <td><?= $data['bobot_telur_gr_perbutir'];?></td>
                                                    <td><?= $data['bobot_telur_per_seribu_ekor'];?></td>
                                                    <td><?= $data['hd'];?> %</td>
                                                    <td><?= $data['fcr'];?></td>
                                                    <td><?= $data['nama_obat'];?></td>
                                                    <td><?= $data['nama_pakan'];?></td>
                                                    <td><?= $data['vitamin'];?></td>
                                                </tr>
                                                 <?php }  ?> 
                                            </tbody>
                                        </table>