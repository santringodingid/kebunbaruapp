<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/autoNumeric.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>
<script>
    $(function() {
        // loadfooter()
        loadall()
    })

    const loadfooter = () => {
        let bulan = $('#resultbulan').val()
        $.ajax({
            url: '<?= base_url() ?>recapitulation/loadfooter',
            data: {
                bulan
            },
            method: 'post',
            success: function(data) {
                $('#showfooter').html(data)
            }
        })
    }

    const loadall = () => {
        let bulan = $('#resultbulan').val()
        $.ajax({
            url: '<?= base_url() ?>recapitulation/loadall',
            data: {
                bulan
            },
            method: 'post',
            success: function(data) {
                $('#showall').html(data)
            }
        })
    }

    $('#changeBulan').on('change', function() {
        $('#resultbulan').val($(this).val())
        // loadfooter()
        loadall()

        $.ajax({
            url: '<?= base_url() ?>recapitulation/setdate',
            method: 'POST',
            data: {
                bulan: $(this).val()
            },
            success: function() {
                console.log('Disimpan');
            }
        })
    })
</script>
</body>

</html>