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

	$('#id').on('keyup', function(e) {
		let id = $(this).val()
		let key = e.which
		if (key != 13) {
			return false
		}

		if (key == 13 && id == '') {
			return false
		}

		checkData(id)
	})

	const checkButton = () => {
	  let id = $('#id').val()
		if (!id) {
			toastr.error('Pastikan ID sudah diisi')
			return false
		}

		checkData(id)
	}

	const checkData = (id) => {
		$.ajax({
			url: '<?= base_url() ?>temuwali/checkdata',
			method: 'POST',
			data: {id},
			dataType: 'JSON',
			success: res => {
				let status = res.status
				if (!status) {
					toastr.error(res.message)
					return false
				}
				$('#id').val('')
				getData(res.message)
			}
		})
	}

	const getData = id => {
		$.ajax({
			url: '<?= base_url() ?>temuwali/getdata',
			method: 'POST',
			data: {id},
			success: res => {
				$('#show-data').html(res)
			}
		})
	}

	const save = (id, status) => {
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
					url: '<?= base_url() ?>temuwali/save',
					method: 'POST',
					data: {id, status},
					dataType: 'JSON',
					success: res => {
						let status = res.status
						if (!status) {
							toastr.error(res.message)
							return false
						}
						$('#id').focus()
						$('#show-data').html('')
						toastr.success(res.message)
					}
				})
			}
		})
	}
</script>
</body>

</html>
