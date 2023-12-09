<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-end">
				<div class="col-2">
					<select id="changeZone" class="form-control form-control-sm" onchange="loadData()">
						<option value="">Pilih Zona</option>
						<option value="PINK">PINK</option>
						<option value="BIRU">BIRU</option>
						<option value="HIJAU">HIJAU</option>
						<option value="KUNING">KUNING</option>
						<option value="PUTIH">PUTIH</option>
					</select>
				</div>
				<div class="col-2">
					<select id="changeForm" class="form-control form-control-sm" onchange="loadData()">
						<option value="">Pilih Form</option>
						<option value="0">A</option>
						<option value="15">B</option>
						<option value="30">C</option>
						<option value="45">D</option>
						<option value="60">E</option>
						<option value="75">F</option>
						<option value="90">G</option>
						<option value="105">H</option>
						<option value="130">I</option>
					</select>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-12" id="show-data"></div>
			</div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>


<div class="modal fade" id="modal-edit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h6 class="modal-title">Form Edit No HP</h6>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form autocomplete="off" id="form-edit">
							<input type="hidden" name="id" id="id-walisantri" value="">
							<input type="text" class="form-control" data-inputmask="'mask' : '999 999 999 999'" data-mask="" id="phone" name="phone">
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer py-1 justify-content-between">
				<button class="btn btn-danger btn-sm" onclick="tutup()">Batal</button>
				<button class="btn btn-primary btn-sm" onclick="update()">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
