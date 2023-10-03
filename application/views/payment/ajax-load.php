<div class="col-12">
    <div class="card" style="height: 71.5vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th class="text-center">NAMA</th>
                        <th>ADMINISTRASI</th>
                        <th>INVOICE</th>
                        <th>PEMBAYARAN</th>
                        <th>DETAIL</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datax) {
                        $no = 1;
                        foreach ($datax as $dd) {
                            $kab = str_replace(['Kabupaten', 'Kota '], '', $dd->kabupaten_santri);

                            $status = $dd->status;
                            if ($status == 'LUNAS') {
                                $kata = 'Lunas';
                                $class = 'success';
                            } else {
                                $kata = 'Belum Lunas';
                                $class = 'danger';
                            }

                            $nominal = $dd->nominal;
                            $detail = $this->pm->getpaymentdetail($dd->id);
							$plus = $nominal - $detail;
                            if ($nominal == $detail) {
                                $katalagi = 'Valid';
                                $classlagi = 'success';
								$minus = '';
                            } else {
                                $katalagi = 'Tidak Valid';
                                $classlagi = 'danger';
								$minus = number_format($plus, 0, ',', '.');
                            }

                    ?>
                            <tr>
                                <td class="align-middle"><?= $no++ ?></td>
                                <td class="align-middle">
                                    <b><?= $dd->nama_santri ?></b>
                                    <br>
                                    <small> <?= $dd->desa_santri . ', ' . $kab ?></small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?= $dd->status_domisili_santri . ', ' . str_replace('Khusus', '', $dd->domisili_santri) . ' - ' . $dd->nomor_kamar_santri ?> <br>
                                        <?= $dd->kelas_diniyah . ' - ' . $dd->tingkat_diniyah ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <span class="<?= ($dd->merchant == 'EMAAL') ? 'text-success' : 'text-danger' ?> "><?= $dd->merchant ?></span> : <?= $dd->id ?> <br>
                                        <?= TampilHijri($dd->hijriah) ?> <br>
                                    </small>

                                </td>
                                <td class="align-middle">
                                    <small>
                                        Nominal : Rp. <?= number_format($nominal, 0, ',', '.') ?> <br>
                                    </small>
                                    <span class="badge badge-<?= $class ?>"><?= $kata ?></span>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        Nominal : Rp. <?= number_format($detail, 0, ',', '.') ?>
                                    </small>
                                    <br>
                                    <span class="badge badge-<?= $classlagi ?>"><?= $katalagi ?></span>
									<span class="text-danger text-xs ml-2">
										<small><?= $minus ?></small>
									</span>
                                </td>
								<td class="align-middle text-center">
									<button type="button" onclick="syncPayment(<?= $dd->id ?>, <?= $plus ?>)" class="btn btn-default btn-sm <?= ($nominal == $detail) ? 'd-none' : '' ?>"><i class="fas fa-sync"></i> </button>
									<button title="Klik untuk detail" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="loaddetail(<?= $dd->id ?>)">
										<i class="fas fa-list-ul"></i>
									</button>
								</td>
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
        <div class="card-footer justify-content-between">
            <b>Total Santri : <?= @$total ?> orang</b>
            <b class="float-right">Total Pemasukan : Rp. <?= number_format(@$grand->nominal, 0, ',', '.') ?><b>
        </div>
    </div>
</div>
