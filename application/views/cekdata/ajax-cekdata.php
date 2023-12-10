<div class="card" style="height: 74.0vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th style="width: 10%;">ID P2K</th>
                    <th>NAMA</th>
                    <th>KABUPATEN</th>
                    <th>STATUS</th>
                    <th colspan="2">DOMISILI</th>
<!--                    <th colspan="2">DINIYAH</th>-->
<!--                    <th colspan="2">FORMAL</th>-->
					<th>ZONA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $nods = 1;
                    foreach ($datasantri as $ds) {
                        $fotoc = FCPATH . 'assets/images/apps/fotosantri/';
                        $foto = base_url('assets/images/apps/fotosantri/');
                        $image = $ds->tipe_santri . '/' . $ds->id_santri . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = $foto . $ds->tipe_santri . '.jpg';
                        } else {
                            $fotoj = $foto . $image;
                        }
                        $kab = str_replace(['Kabupaten', 'Kota'], '', $ds->kabupaten_santri);
                ?>
                        <tr style="cursor:pointer">
                            <td class="align-middle"><?= $nods++; ?></td>
                            <td class="align-middle">
<!--                                <img style="border-radius: 5px;" alt="Foto --><?php //= $ds->nama_santri ?><!--" width="45px" class="table-avatar" src="--><?php //= $fotoj ?><!--">-->
								<span style="cursor: pointer" title="Salin ID ke clipboard" onclick="copyToClipboard('<?= $ds->id_santri ?>')">
									<span class="text-success"><?= $ds->id_santri ?></span>
									<i class="fas fa-copy ml-1 text-success"></i>
								</span>
							</td>
                            <td class="align-middle">
                                <?= $ds->nama_santri ?>
                            </td>
                            <td class="align-middle"><?= $ds->desa_santri . ' ' . $kab; ?></td>
                            <td class="align-middle"><?= $ds->status_domisili_santri ?></td>
                            <td class="align-middle"><?= $ds->domisili_santri; ?></td>
                            <td class="align-middle"><?= $ds->nomor_kamar_santri; ?></td>
<!--                            <td class="align-middle">--><?php //= $ds->kelas_diniyah; ?><!--</td>-->
<!--                            <td class="align-middle">--><?php //= $ds->tingkat_diniyah; ?><!--</td>-->
<!--                            <td class="align-middle">--><?php //= $ds->kelas_formal; ?><!--</td>-->
<!--                            <td class="align-middle">--><?php //= $ds->tingkat_formal; ?><!--</td>-->
							<td class="align-middle"><?= $this->km->getZoneTemu($ds->id_santri); ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center text-danger"><td colspan="11">Tidak ada data untuk ditampilkan</td></tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
</div>
</div>
