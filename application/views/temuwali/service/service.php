<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
			<?php
			$session = $this->session->userdata('zone_temu_wali');
			if (!$session) :
			?>
            <div class="row justify-content-center mt-5">
				<div class="col-8">
					<div class="row justify-content-center">
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/PINK" class="btn btn-outline-danger btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">ZONA PINK</span>
							</a>
						</div>
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/HIJAU" class="btn btn-outline-success btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">ZONA HIJAU</span>
							</a>
						</div>
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/BIRU" class="btn btn-outline-primary btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">ZONA BIRU</span>
							</a>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/KUNING" class="btn btn-outline-warning btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">ZONA KUNING</span>
							</a>
						</div>
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/PUTIH" class="btn btn-outline-dark btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">ZONA PUTIH</span>
							</a>
						</div>
						<div class="col-4">
							<a href="<?= base_url() ?>temuwali/setService/NON" class="btn btn-outline-dark btn-block py-5">
								<i class="fas fa-user fa-3x"></i>
								<span class="d-block mt-3">NON-ZONA</span>
							</a>
						</div>
					</div>
				</div>
            </div>
			<?php
			else:
			?>
				<div class="row justify-content-center mt-4">
					<div class="col-4 text-center">
						<h5>ZONA <?= $session ?></h5>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-4">
						<div class="card mb-0">
							<div class="card-body">
								<input autofocus="" data-inputmask="'mask' : '99999999'" data-mask="" type="text" class="form-control" name="id" id="id" autocomplete="off" inputmode="text">
								<small class="text-info">Masukkan ID Santri lalu ENTER</small>
								<form id="form-deposit" class="mt-2" autocomplete="off">
									<input type="hidden" name="nis" id="nis" value="0">
									<input type="hidden" name="nominal" id="nominal-real" value="0">
								</form>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary btn-block" onclick="checkButton()">
									Cek sekarang
								</button>
							</div>
						</div>
					</div>
					<div class="col-8" id="show-data">
					</div>
				</div>
			<?php
			endif;
			?>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
