<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
	$('[data-mask]').inputmask();

	toastr.options = {
		"positionClass": "toast-top-center",
		"timeOut": "500"
	}

	$('#customFile').change(function() {
		var file = $('#customFile')[0].files[0].name;
		$('#labelFoto').text(file);
		$('#cekFoto').val(1)
	});

	$('#tombolSimpan').on('click', () => {
		const cekFoto = $('#cekFoto').val()
		if (cekFoto == 0) {
			munculAlert('Foto belum dipilih')
		} else {
			Swal.fire({
				title: 'Anda Yakin?',
				text: 'Pastikan foto sudah dipilih',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Lanjut',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					var formData = new FormData($('#formupload')[0]);
					$.ajax({
						url: '<?= base_url() ?>temuwali/uploadstore',
						method: 'post',
						data: formData,
						processData: false,
						contentType: false,
						cache: false,
						async: false,
						dataType: 'json',
						success: function(data) {
							if (data >= 1) {
								toastr.success('Data berhasil ditambah')
								$('#labelFoto').text('Pilih Foto Wali');
								$('#cekFoto').val(0)
							} else {
								toastr.error('Gagal. Kesalahan server')
							}

						}
					})
				}
			})
		}

	})

</script>
</body>

</html>
