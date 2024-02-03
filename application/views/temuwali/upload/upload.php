<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-4">
					<form id="formupload" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" name="cekFoto" id="cekFoto" value="0">
							<div class="custom-file">
								<input type="file" class="custom-file-input filepond my-pond" name="filepond" id="customFile">
								<label class="custom-file-label" for="customFile" id="labelFoto">Pilih Foto Wali</label>
							</div>
						</div>
					</form>
				</div>
				<div class="col-1">
					<button class="btn btn-primary btn-block" id="tombolSimpan">
						Upload
					</button>
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
