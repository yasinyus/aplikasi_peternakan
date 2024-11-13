<style>
                        table, tr, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                        text-align: center;
                        font-size:10px;
                        }
                        </style>
                        <h3>Laporan Produksi Grower</h3>
                        <table id="data_table" class="" width="100%">
                                            <thead>
                                            
                                            <tr>
                                                <th rowspan="3">Tanggal</th>
                                                <th colspan="2">Profil</th>
                                                <th colspan="2">Deplesi</th>
                                                <th colspan="5">Konsumsi</th>
                                                <th colspan="2">Bobot Ayam</th>
                                                <th colspan="2">Uniformity</th>
                                                <th rowspan="3">Keterangan</th>
                                                <th rowspan="3">Nama Obat</th>
                                                <th rowspan="3">Nama Pakan</th>
                                                <th rowspan="3">Vitamin</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Umur (Week)</th>
                                                <th rowspan="2">Populasi</th>
                                                <th rowspan="2">Kematian</th>
                                                <th rowspan="2">Afkir</th>
                                                <!--<th rowspan="2">Mort%</th>-->
                                                <th colspan="3">Pakan</th>
                                                <th colspan="2">Air Minum</th>
                                                <th>Real</th>
                                                <th>Standard</th>
                                                <th>Real</th>
                                                <th>Standard</th>
                                            </tr>
                                            <tr>
                                                
                                                <th>Total (Kg)</th>
                                                <th>Fl(gram/ekor)</th>
                                                <th>standard(gr/ekor)</th>
                                                <th>Total (L)</th>
                                                <th>mL/ekor</th>
                                                <th>Gram</th>
                                                <th>Gram</th>
                                                <th>%</th>
                                                <th>%</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                // if($this->input->get('peternakan_id') && $this->input->get('flock_id')){
                                                foreach($produksi as $data) {
                                                ?>
                                            <tr>
                                                <td><?= $data['tanggal_prod'];?></td>
                                                <td></td>
                                                <!-- <td><?= floor($data['umur']);?></td> -->
                                                <td><?= $data['jml_total_ayam'];?></td>
                                                <td><?= $data['kematian'];?></td>
                                                <td><?= $data['afkir'];?></td>
                                                <!--<td><?= $data['mort'];?></td>-->
                                                <td><?= $data['pakan_kg'];?></td>
                                                <td><?= $data['pakan_gr_per_ekor'] * 1000;?></td>
                                                <td></td>
                                                <td><?= $data['minum_liter'];?></td>
                                                <td><?= $data['minum_ml_per_ekor'] * 1000;?></td>
                                                <?php if($data['bobot_ayam'] >= 1.400 && $this->input->get('flock_id') != NULL){ ?>
                                                <td><?= $data['bobot_ayam'] / $this->flock_model->jml_kandang($this->input->get('flock_id'))->total;?></td>
                                                <?php } else { ?>
                                                <td><?= $data['bobot_ayam'] ?></td>
                                                <?php } ?>
                                                <td></td>
                                                <td><?= $data['uniformity'];?></td>
                                                <td></td>
                                                <td><?= $data['perlakuan'];?></td>
                                                 <td><?= $data['nama_obat'];?></td>
                                                    <td><?= $data['nama_pakan'];?></td>
                                                    <td><?= $data['vitamin'];?></td>
                                            </tr>
                                            <?php }  ?> 
                                            </tbody>
                                        </table>