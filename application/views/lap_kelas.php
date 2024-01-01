<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif;
            font-size: 10pt;
        }


        .text-center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid;

        }

        th {
            padding: 5px 0px;
        }

        td {
            padding: 4px 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .no-border-right {
            border-right: 0px;
        }

        .no-border-left {
            border-left: 0px;
        }

        h5 {
            margin: 4px;
        }

        h6 {
            margin: 4px 0px 8px 0px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .d-flex {
            display: flex;
            align-items: flex-end;
        }
    </style>
</head>
<?php
$arrTingkat = [
	'I\'dadiyah',
	'Ibtidaiyah',
	'Tsanawiyah',
	'Aliyah'
];
?>
<body>
    <div>
        <section>
            <h5 class="text-center">
                REKAPITULASI KEUANGAN <?= ($tingkat != 0) ? $arrTingkat[$tingkat] : '' ?>
            </h5>
        </section>
        <section class="mb-5">
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>DOMISILI</th>
                        <th>KELAS</th>
						<?php if($tingkat != 0) : ?>
                        <th>TINGKAT</th>
						<?php endif; ?>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if ($data[0]) {
                        foreach ($data[0] as $d) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $d->nama ?></td>
                                <td><?= $d->desa . ', ' . $d->kab ?></td>
                                <td><?= str_replace('Khusus ', '', $d->dom) . ' - ' . $d->kamar ?></td>
                                <td><?= $d->kelas ?></td>
							<?php if($tingkat != 0) : ?>
                                <td><?= $arrTingkat[$d->tingkat] ?></td>
							<?php endif; ?>
                                <td><?= $d->status ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
		Kesimpulan
		<section>
			<table>
				<tr>
					<th>NO</th>
					<th>STATUS</th>
					<th>JUMLAH</th>
				</tr>
				<?php
				if ($data[1]) {
					$noo = 1;
					foreach ($data[1] as $dd) {
						?>
						<tr>
							<td><?= $noo++ ?></td>
							<td><?= $dd->status ?></td>
							<td><?= $dd->jumlah ?></td>
						</tr>
				<?php
					}
				}
				?>
			</table>
		</section>
        <section>
            <?php
            $bendahara = [1 => 'ABD. KHOFI', 'MARIA NUR HARYATI'];
            ?>
            <div class="text-center">
                Kebun baru, <?= $this->baseModel->TampilHijri($this->baseModel->GetHijriSekarang()) ?> <br>
                Bendahara
                <br><br><br><br>
                <b><u><?= $bendahara[$this->session->userdata('tipe_user')] ?></u></b>
            </div>
        </section>
    </div>
</body>

</html>
