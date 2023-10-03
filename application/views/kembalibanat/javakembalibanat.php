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
<script src="<?= base_url('assets/') ?>/plugins/autoNumeric.js"></script>
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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
        tampilAwal()
    })

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "1000"
    }

    $('body').on('keyup', function(e) {
        if (e.keyCode == 113) {
            $('#idSantri').focus().select()
        }
    })

    const tampilAwal = () => {
        $.ajax({
            url: '<?= base_url() ?>comeback/getdata',
            method: 'post',
            success: function(data) {
                $('#tampilData').html(data)
            }
        })
    }

    $('#setliburanlagi').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan pergi ke pengaturan liburan`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '<?= base_url() ?>aturliburan'
            }
        })
    })

    const saveData = id => {
        const kembali = $('#kembali').val()
        $.ajax({
            url: '<?= base_url() ?>comeback/save',
            method: 'post',
            data: {
                id,
                kembali
            },
            dataType: 'json',
            success: function(data) {
                const hasil = data.hasil
                if (hasil == 1) {
                    toastr.error('Gagal! ID Santri tidak boleh kosong')
                } else if (hasil == 2) {
                    toastr.error('Gagal! Jenis liburan belum diatur')
                } else if (hasil == 3) {
                    toastr.error('Gagal! Zona Check In belum diatur')
                } else if (hasil == 4) {
                    toastr.error('Gagal! ID Tidak ditemukan')
                } else if (hasil == 5) {
                    toastr.error('Gagal! Santri sudah tidak aktif')
                } else if (hasil == 6) {
                    toastr.error('Gagal! Akses dicegah')
                } else if (hasil == 8) {
                    toastr.error('Gagal! Santri sudah melakukan check in')
                } else {
                    toastr.success('Satu data berhasil ditambahkan')
                    tampilData(id)
                    tampilAwal()
                }

                if (hasil != 0) {
                    $('#tampil').html('')
                }
                $('#idSantri').val('').focus()

                //console.log(hasil)
            }
        })
    }

    tampilData = id => {
        $.ajax({
            url: '<?= base_url() ?>comeback/getid',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#tampil').html(data)
            }
        })
    }

    $('#idSantri').on('keyup', function(e) {
        const id = $(this).val()

        if (e.keyCode === 13) {
            if (id != '') {
                if (id.length < 8) {
                    toastr.error('ID Tidak valid')
                } else {
                    saveData(id)
                }
            } else {
                toastr.error('Bidang inputan tidak boleh kosong')
            }
            $('#tampil').html('')
        }
    })

    $('#tampil').on('click', '#batalSurat', function() {
        const id = $(this).data('id')
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan membatalkan proses`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>comeback/batal',
                    method: 'post',
                    data: {
                        id
                    },
                    success: function(data) {
                        toastr.warning('Satu data berhasil dibatalkan')
                        $('#tampil').html('')
                        $('#idSantri').focus().val()
                        tampilAwal()
                    }
                })
            }
        })
    })

    $('#modal-lg').on('shown.bs.modal', function() {
        $('#idsantriijin').focus().select();
    })

    $('#modal-lg').on('hidden.bs.modal', function() {
        $('#idsantriijin').val('');
        $('#divalasan').hide()
        $('#alasan').val('')
        $('#tampilhasilijin').hide()
        $('#tampilhasilijin').html('')
        $('#simpanijin').hide()
    })


    $('#idsantriijin').on('keyup', function(e) {
        const id = $(this).val()
        const zone = $('#zone').val()
        const liburan = $('#liburan').val()

        if (id != '' && e.keyCode == 13) {
            $.ajax({
                url: '<?= base_url() ?>comeback/cekmodal',
                method: 'post',
                data: {
                    id
                },
                dataType: 'json',
                success: function(data) {
                    const hasil = data.hasil
                    if (hasil == 0) {
                        dataModal(id)
                        $('#divalasan').show()
                        $('#alasan').focus()
                        $('#simpanijin').show()
                    } else {
                        toastr.error(hasil)
                        $('#idsantriijin').val('');
                        $('#divalasan').hide()
                        $('#alasan').val('')
                        $('#tampilhasilijin').hide()
                        $('#tampilhasilijin').html('')
                    }
                }
            })
        }
    })

    const dataModal = id => {
        $.ajax({
            url: '<?= base_url() ?>comeback/getmodal',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#tampilhasilijin').fadeIn()
                $('#tampilhasilijin').html(data)
            }
        })
    }

    $('#simpanijin').on('click', function() {
        const id = $('#idsantriijin').val()
        const alasan = $('#alasan').val()

        if (alasan == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Alasan masih kosong'
            })
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: `Akan membatalkan proses`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>comeback/saveijin',
                        method: 'post',
                        data: {
                            id,
                            alasan
                        },
                        success: function(data) {
                            $('#modal-lg').modal('hide')
                            tampilData(id)
                            tampilAwal()
                        }
                    })
                }
            })
        }
    })

    $('#batalijin').on('click', function() {
        const id = $('#idsantriijin').val()
        if (id != '') {
            Swal.fire({
                title: 'Anda Yakin?',
                text: `Akan membatalkan proses`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#modal-lg').modal('hide')
                } else {
                    $('#idsantriijin').focus().val('')
                }
            })
        } else {
            $('#modal-lg').modal('hide')
        }
    })


    $('#tampilData').on('click', '.checked', function() {
        $('#filter-type').val(1)
        $('#title-detail').text('Daftar Santri Kembali banat')
        showmodalfilter()
    })

    $('#tampilData').on('click', '.not-checked', function() {
        $('#filter-type').val(0)
        $('#title-detail').text('Daftar Santri Belum Kembali banat')
        showmodalfilter()
    })

    const showmodalfilter = () => {
        const type = $('#filter-type').val()
        const domicile = $('#domicile').val()

        $.ajax({
            url: '<?= base_url() ?>comeback/showfilter',
            method: 'post',
            data: {
                type,
                domicile
            },
            success: function(data) {
                $('#tampilSudah').html(data)
                $('#modal-detail').modal('show')
            }
        })
    }


    $('#tampilData').on('change', '#pilihdaerah', function() {
        const tipe = $('#valtipe').val()
        const daerah = $(this).val()

        showmodalfilter(tipe, daerah)
    })

    $('#simpanTanggal').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Pastikan semua bidang inputan sudah terisi`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formTangal').submit()
            }
        })
    })
</script>
</body>

</html>
