<div class="card" style="height: 74.0vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th style="width: 10%;">ID P2K</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th colspan="2">DOMISILI</th>
					<th>WALI</th>
					<th>NO. HP</th>
					<th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $nods = 1;
                    foreach ($datasantri as $ds) {
                        $fotoc = FCPATH . 'assets/images/apps/ktws/';
                        $foto = base_url('assets/images/apps/ktws/');
                        $image = $ds->id_santri . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = $foto . '1.jpg';
                        } else {
                            $fotoj = $foto . $image;
                        }
                        $kab = str_replace(['Kabupaten', 'Kota'], '', $ds->kabupaten_santri);
                ?>
                        <tr>
                            <td class="align-middle"><?= $nods++; ?></td>
                            <td class="align-middle">
								<?= $ds->id_santri ?>
							</td>
                            <td class="align-middle">
                                <?= $ds->nama_santri ?>
                            </td>
                            <td class="align-middle"><?= $ds->desa_santri . ' ' . $kab; ?></td>
                            <td class="align-middle"><?= $ds->domisili_santri; ?></td>
                            <td class="align-middle"><?= $ds->nomor_kamar_santri ?></td>
							<td class="align-middle"><?= $ds->nama_walisantri ?></td>
							<td class="align-middle"><?= $ds->nomor_hp_walisantri ?></td>
							<td class="align-middle">
								<a href="<?= base_url() ?>temuwali/getPrint/<?= $ds->id_walisantri ?>/<?= $ds->id_santri ?>" class="btn btn-sm btn-default">
									<i class="fas fa-print"></i>
								</a>
								<button class="btn btn-sm btn-warning" onclick="edit(<?= $ds->id_walisantri ?>)">
									<i class="fas fa-pen"></i>
								</button>
							</td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center text-danger"><td colspan="7">Tidak ada data untuk ditampilkan</td></tr>';
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
