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

	const loadData = () => {
		let zone = $('#changeZone').val()
		let form = $('#changeForm').val()

		$.ajax({
			url: '<?= base_url() ?>temuwali/loadData',
			method: 'POST',
			data: {
				zone,
				form
			},
			success: res => {
				$('#show-data').html(res)
			}
		})
	}

	const edit = id => {
		$('#id-walisantri').val(id)
		$('#modal-edit').modal('show')
	}

	const tutup = () => {
	  	$('#id-walisantri').val('')
		$('#phone').val('')
		$('#modal-edit').modal('hide')
	}

	const update = () => {
		Swal.fire({
			title: 'Anda Yakin?',
			text: `Pastikan data sudah dicek dengan sekasama`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Lanjut',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url() ?>temuwali/update',
					method: 'POST',
					data: $('#form-edit').serialize(),
					dataType: 'JSON',
					success: res => {
						let status = res.status
						if (!status) {
							toastr.error(res.message)
							return false
						}
						$('#phone').val('')
						$('#modal-edit').modal('hide')
						toastr.success(res.message)
						loadData()
					}
				})
			}
		})
	}

</script>
</body>

</html>
