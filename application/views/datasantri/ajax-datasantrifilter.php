<div class="card" style="height: 71.8vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
<!--                    <th colspan="2" class="text-center">NAMA</th>-->
					<th>FOTO</th>
                    <th>TETALA</th>
                    <th>ALAMAT</th>
                    <th>DOMISILI</th>
                    <th>DINIYAH</th>
                    <th>FORMAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $no = 1;
                    foreach ($datasantri as $dd) {
                        $fotoc = FCPATH . 'assets/images/apps/fotosantri/';
                        $foto = base_url('assets/images/apps/fotosantri/');
                        $image = $dd->tipe_santri . '/' . $dd->id_santri . '.jpg';

						$ttdc = FCPATH . 'assets/images/apps/ttd/';
						$ttd = base_url('assets/images/apps/ttd/');
						$ttdI = $dd->tipe_santri.'/'.$dd->id_santri.'.png';

						if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
//                            $fotoj = $foto . $dd->tipe_santri . '.jpg';
							$statusFoto = 0;
						} else {
//                            $fotoj = $foto . $image;
							$statusFoto = 1;
						}

						if (file_exists($ttdc . $ttdI) === FALSE || $ttdI == NULL) {
//							$fotoj = $foto . $dd->tipe_santri . '.jpg';
							$statusTtd = 0;
						} else {
//							$fotoj = $foto . $image;
							$statusTtd = 1;
						}

                        $kab = str_replace('Kabupaten', '', $dd->kabupaten_santri);

                ?>
                        <tr style="cursor: pointer;" title="Klik untuk detail" data-id="<?= $dd->id_santri ?>" data-toggle="modal" data-target="#modal-detail" class="detaildata">
                            <td class="align-middle"><?= $no++ ?></td>
<!--                            <td>-->
<!--                                <img style="border-radius: 5px;" alt="Foto --><?php //= $dd->nama_santri ?><!--" width="45px" class="table-avatar" src="--><?php //= $fotoj ?><!--">-->
<!--                            </td>-->
                            <td class="align-middle">
                                <b><?= $dd->nama_santri ?></b>
                                <br>
                                <!-- <small class="text-success"><i class="fa fa-calendar-day"></i> Umur : <?= $dd->umur ?> Tahun</small> -->
                                <small class="text-success"><i class="fa fa-calendar-day"></i> <?= $dd->id_santri ?></small>
                            </td>
							<td class="align-middle">
								<small>
									<span class="text-success <?= $statusFoto ? '' : 'd-none' ?>">- KTS ada</span>
									<span class="text-danger <?= $statusFoto ? 'd-none' : '' ?>">- KTS tidak ada</span>
									<br>
									<span class="text-success <?= $statusTtd ? '' : 'd-none' ?>">- TTD ada</span>
									<span class="text-danger <?= $statusTtd ? 'd-none' : '' ?>">- TTD tidak ada</span>
								</small>
							</td>
                            <td class="align-middle"><?= $dd->tempat_lahir_santri . '<br> ' . @tanggalIndoShort($dd->tanggal_lahir_santri) ?></td>
                            <td class="align-middle"><?= $dd->desa_santri . '<br>' . $kab ?></td>
                            <td class="align-middle"><?= str_replace('Khusus', '', $dd->domisili_santri) . '<br>' . $dd->nomor_kamar_santri ?></td>
                            <td class="align-middle"><?= $dd->kelas_diniyah . '<br>' . $dd->tingkat_diniyah ?></td>
                            <td class="align-middle"><?= $dd->kelas_formal . '<br>' . $dd->tingkat_formal ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center"><td colspan="8"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <b>Total Santri : <?= $total ?> orang<b>
    </div>
</div>
</div>
