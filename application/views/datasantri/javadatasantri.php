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
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('[data-mask]').inputmask();


    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('body').on('keyup', function(e) {
        if (e.keyCode == 113) {
            $('#namafilter').focus().select()
        }
    })

    toastr.options = {
        "positionClass": "toast-top-center"
    }


    async function loadDataAwal() {
        try {
            const result = await $.ajax({
                url: '<?= base_url() ?>datasantri/loaddata',
                method: 'post',
            })

            $('#tampildata').html(result)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

    }

    function loading(kata) {
        const divLoading = `<div class="card" id="loading" style="height: 70vh;">
                                <div class = "text-center" id = "gagal" >
                                    ${kata}
                                </div>
                            </div >`
        $('#tampildata').html(divLoading)
    }

    loading('<img src = "<?= base_url() ?>assets/images/layouts/gif/load.gif" >')


    $(function() {
        loadDataAwal()
    })


    function getDetailSantri(idSantri) {
        $.ajax({
            url: '<?= base_url() ?>datasantri/getdetail',
            method: 'post',
            data: {
                id: idSantri
            },
            dataType: 'json',
            success: function(data) {
                if (data.hasil == 1) {

                    // Tampilkan data
                    $('#idsantriedit').val(data.data.id_santri)
                    $('#idwaliedit').val(data.data.id_walisantri)
                    $('#idsantri').val(data.data.id_santri)
                } else {
                    Swal.fire({
                        position: 'top',
                        icon: 'error',
                        title: 'Data tak ditemukan',
                        showConfirmButton: false,
                        timer: 800
                    })
                }

                // console.log(data)

            }
        })
    }


    async function dataSantriFilter() {
        const [
            nama,
            tipe,
            pendidikan,
            domisili,
            kamar,
            kabupaten,
            status,
            umur,
            periode,
			statusDomisili
        ] = [
            $('#namafilter').val(),
            $('#pilihtipe').val(),
            $('#pilihtingkat').val(),
            $('#pilihdaerah').val(),
            $('#pilihkamar').val(),
            $('#pilihkabupaten').val(),
            $('#pilihstatus').val(),
            $('#pilihumur').val(),
            $('#pilihperiode').val(),
            $('#status-domisili').val(),
        ]

        try {
            const result = await $.ajax({
                url: "<?= base_url() ?>datasantri/getDataSantriFilter",
                method: "post",
                data: {
                    nama,
                    tipe,
                    pendidikan,
                    domisili,
                    kamar,
                    kabupaten,
                    status,
                    umur,
                    periode,
					statusDomisili
                }
            })

            $('#tampildata').html(result)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

    }
    loading('<img src = "<?= base_url() ?>assets/images/layouts/gif/load.gif" >')

    $('#tampildetaildata').on('click', '#editsantri', function() {
        const idSantri = $('#idsantriedit').val()

        $.ajax({
            url: '<?= base_url() ?>datasantri/getDataSantriID',
            method: 'post',
            data: {
                id: idSantri
            },
            dataType: 'json',
            success: data => {
                // console.log(data)
                let tetala = data.tanggal_lahir_santri
                let pecah = tetala.split('-')
                const statusDom = data.status_domisili_santri
                statusDom === 'P2K' && $('#radioPrimary1').prop('checked', true)
                statusDom === 'P2K' && $('.fiturdisable').prop('disabled', false)
                statusDom === 'P2K' && $('#nomorkamarsantri').val(data.nomor_kamar_santri)
                statusDom === 'P2K' && $('#daerahsantri').val(data.domisili_santri)
                statusDom === 'LP2K' && $('#radioPrimary2').prop('checked', true)
                statusDom === 'LP2K' && $('.fiturdisable').prop('disabled', true)


                $('input[name="rencanadomisili"]').on('change', function() {
                    const isi = $(this).val()

                    isi === 'P2K' && $('.fiturdisable').prop('disabled', false)
                    isi === 'P2K' && $('#nomorkamarsantri').val(data.nomor_kamar_santri)
                    isi === 'P2K' && $('#daerahsantri').val(data.domisili_santri)
                    isi === 'LP2K' && $('.fiturdisable').prop('disabled', true)
                    isi === 'LP2K' && $('#nomorkamarsantri').val('')
                    isi === 'LP2K' && $('#daerahsantri').val('')
                })

                $('#id_santri').val(data.id_santri)
                $('#niksantri').val(data.nik_santri)
                $('#kksantri').val(data.kk_santri)
                $('#tempatlahirsantri').val(data.tempat_lahir_santri)
                $('#namasantri').val(data.nama_santri)
                $('#tanggallahirsantri').val(pecah[2])
                $('#bulanlahirsantri').val(pecah[1])
                $('#tahunlahirsantri').val(pecah[0])
                $('#provinsisantri').val(data.provinsi_santri)
                $('#kecamatansantri').val(data.kecamatan_santri)
                $('#dusunsantri').val(data.dusun_santri)
                $('#kabupatensantri').val(data.kabupaten_santri)
                $('#desasantri').val(data.desa_santri)
                $('#rtsantri').val(data.rt_santri)
                $('#rwsantri').val(data.rw_santri)
                $('#kodepossantri').val(data.kode_pos_santri)
                $('#pendidikansantri').val(data.pendidikan_akhir_santri)
                $('#kelasdiniyahsantri').val(data.kelas_diniyah)
                $('#tingkatdiniyahsantri').val(data.tingkat_diniyah)
                $('#ayahsantri').val(data.ayah_santri)
                $('#kelasformalsantri').val(data.kelas_formal)
                $('#tingkatformalsantri').val(data.tingkat_formal)
                $('#ibusantri').val(data.ibu_santri)
            }
        })
    })

    $('#modal-editsantri').on('shown.bs.modal', function() {
        $('#niksantri').focus().select();
    })

    $('#modal-editwali').on('shown.bs.modal', function() {
        $('#nikwali').focus().select();
    })

    $('#modal-editwali').on('hidden.bs.modal', function() {
        $('#tipewali').val(0)
        $('#totalnik').val(0)
        $('#tipeupdate').val(0)
        $('.bukadisable').prop('readOnly', false)
        $('#matenika').hide()
        $('#customCheckbox2').prop('checked', false)
        $('#tombolBukaDetail').hide()
        $('#tombolTutupDetail').hide()
        $('#nikWaliDetail').val('')
    })


    const getAlamat = (element, url, target, targetElement) => {
        element.autocomplete({
            source: url,
            select: (event, ui) => {
                target.val(ui.item.description)
                targetElement.prop('readOnly', false).focus().val('')
            }
        });
    }


    const elementKab = $('#kabupatensantri')
    $(function() {
        const [
            elementPro,
            urlprovinsi,
            targetPro
        ] = [
            $('#provinsisantri'),
            $('#urldataprovinsi').val(),
            $('#idProvinsiSantri')
        ]

        getAlamat(elementPro, urlprovinsi, targetPro, elementKab)

    })

    const elementKec = $('#kecamatansantri')
    elementKab.on('keypress', function() {
        const [
            urlkab,
            idPro,
            targetKab
        ] = [
            $('#urldatakab').val(),
            $('#idProvinsiSantri').val(),
            $('#idKabSantri')
        ]
        const fixUrlKab = `${urlkab}/${idPro}`
        getAlamat(elementKab, fixUrlKab, targetKab, elementKec)
    })

    const elementDesa = $('#desasantri')
    elementKec.on('keypress', function() {
        const [
            urlkec,
            idKab,
            targetKec
        ] = [
            $('#urldatakec').val(),
            $('#idKabSantri').val(),
            $('#idKecSantri')
        ]
        const fixUrlKec = `${urlkec}/${idKab}`
        getAlamat(elementKec, fixUrlKec, targetKec, elementDesa)
    })

    const elementDusun = $('#dusunsantri')
    elementDesa.on('keypress', function() {
        const [
            urldesa,
            idKec,
            targetDesa
        ] = [
            $('#urldatadesa').val(),
            $('#idKecSantri').val(),
            $('#kodepossantri')
        ]
        const fixUrlDesa = `${urldesa}/${idKec}`
        getAlamat(elementDesa, fixUrlDesa, targetDesa, elementDusun)
    })


    $('#tombolsimpaneditsantri').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Akan melakukan update data',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>datasantri/EditDataSantri',
                    method: 'post',
                    data: $('#formeditsantri').serialize(),
                    success: (data) => {
                        $('#modal-editsantri').modal('hide')
                        toastr.success('Satu data berhasil diupdate')

                        dataSantriFilter()

                        detaildatasantri(data)
                    }
                })
            }
        })
    })


    $('#tampildetaildata').on('click', '#editwali', function() {
        const idWali = $('#idsantriedit').val()
        // const idWali = $('#idwaliedit').val()
        $.ajax({
            url: '<?= base_url() ?>datasantri/getDataWaliID',
            method: 'post',
            data: {
                id: idWali
            },
            dataType: 'json',
            success: (data) => {
                // console.log(data);
                $('#idwali').val(data[0].id_walisantri)
                $('#nikwaliedit').val(data[0].nik_walisantri)
                $('#nikwali').val(data[0].nik_walisantri)
                $('#namawali').val(data[0].nama_walisantri)
                $('#nomorhpwali').val(data[0].nomor_hp_walisantri)
                $('#nomorwawali').val(data[0].nomor_wa_walisantri)
                $('#provinsiwali').val(data[0].provinsi_walisantri)
                $('#kecamatanwali').val(data[0].kecamatan_walisantri)
                $('#dusunwali').val(data[0].dusun_walisantri)
                $('#kabupatenwali').val(data[0].kabupaten_walisantri)
                $('#desawali').val(data[0].desa_walisantri)
                $('#rtwali').val(data[0].rt_walisantri)
                $('#rwwali').val(data[0].rw_walisantri)
                $('#kodeposwali').val(data[0].kode_pos_walisantri)
                $('#pendidikanwali').val(data[0].pendidikan_akhir_walisantri)
                $('#pekerjaanwali').val(data[0].pekerjaan_walisantri)
                $('#hubunganwali').val(data[0].hubungan_wali)

                const totalNik = data[1];
                $('#totalnik').val(totalNik)
                if (totalNik > 1) {
                    $('#matenika').show()
                    $('#katotal').text(totalNik)
                    $('#tombolBukaDetail').show()
                    $('#nikWaliDetail').val(data[0].nik_walisantri)
                }
            }
        })
    })


    $('#customCheckbox2').on('click', function() {
        if ($(this).is(':checked')) {
            $('#tipeupdate').val(1)
        } else {
            $('#tipeupdate').val(0)
        }
    })

    const elementKabWali = $('#kabupatenwali')
    $(function() {
        const [
            elementProWali,
            urlprovinsiwali,
            targetProWali
        ] = [
            $('#provinsiwali'),
            $('#urldataprovinsi').val(),
            $('#idProWali')
        ]
        getAlamat(elementProWali, urlprovinsiwali, targetProWali, elementKabWali)
    })


    const elementKecWali = $('#kecamatanwali')
    elementKabWali.on('keypress', function() {
        const [
            urlkabwali,
            idProwali,
            targetKabWali
        ] = [
            $('#urldatakab').val(),
            $('#idProWali').val(),
            $('#idKabWali')
        ]
        const fixUrlKabWali = `${urlkabwali}/${idProwali}`
        getAlamat(elementKabWali, fixUrlKabWali, targetKabWali, elementKecWali)
    })


    const elementDesaWali = $('#desawali')
    elementKecWali.on('keypress', function() {
        const [
            urlkecwali,
            idKabwali,
            targetKecWali
        ] = [
            $('#urldatakec').val(),
            $('#idKabWali').val(),
            $('#idKecWali')
        ]
        const fixUrlKecWali = `${urlkecwali}/${idKabwali}`
        getAlamat(elementKecWali, fixUrlKecWali, targetKecWali, elementDesaWali)
    })


    const elementDusunWali = $('#dusunwali')
    elementDesaWali.on('keypress', function() {
        const [
            urldesawali,
            idKecwali,
            tergetDesaWali
        ] = [
            $('#urldatadesa').val(),
            $('#idKecWali').val(),
            $('#kodeposwali')
        ]
        const fixUrlDesaWali = `${urldesawali}/${idKecwali}`
        getAlamat(elementDesaWali, fixUrlDesaWali, tergetDesaWali, elementDusunWali)
    })


    $('#tombolsimpateditwali').on('click', () => {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Akan melakukan update data',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                if ($('#hubunganwali').val() != '') {
                    $.ajax({
                        url: '<?= base_url() ?>datasantri/EditDataWali',
                        method: 'post',
                        data: $('#formeditwali').serialize(),
                        dataType: 'JSON',
                        success: (data) => {
                            $('#modal-editwali').modal('hide')
                            dataSantriFilter()
                            detaildatasantri(data.satu)
                            const hasilUpdate = data.dua
                            hasilUpdate === 0 && toastr.success('Data santri diperbarui tanpa mengubah data wali karena data NIK Wali sudah ada')
                            hasilUpdate === 1 && toastr.success('Data wali diubah beserta seluruh santri yang berhubungan')
                            hasilUpdate === 2 && toastr.success('Data wali diubah dengan menambah data baru')
                            hasilUpdate === 3 && toastr.success('Data wali berhasil diperbarui')
                            // console.log(data.dua)
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hubungan wali belum dipilih',
                    })
                }
            }
        })
    })


    $('#nikwali').on('focusout', function() {
        const idwali = $(this).val()
        const nikwaliedit = $('#nikwaliedit').val()
        //alert(idwali)
        let [
            tipewali,
            namawali,
            nomorhpwali,
            provinsiwali,
            kecamatanwali,
            dusunwali,
            kabupatenwali,
            desawali,
            rtwali,
            rwwali,
            kodeposwali,
            pendidikanwali,
            pekerjaanwali,
            hubunganwali
        ] = [
            $('#tipewali'),
            $('#namawali'),
            $('#nomorhpwali'),
            $('#provinsiwali'),
            $('#kecamatanwali'),
            $('#dusunwali'),
            $('#kabupatenwali'),
            $('#desawali'),
            $('#rtwali'),
            $('#rwwali'),
            $('#kodeposwali'),
            $('#pendidikanwali'),
            $('#pekerjaanwali'),
            $('#hubunganwali')
        ]


        if (idwali != '' && idwali !== nikwaliedit) {
            $.ajax({
                url: '<?= base_url() ?>santribaru/ceknikwali',
                method: 'post',
                data: {
                    nik: idwali
                },
                dataType: 'json',
                success: data => {
                    let dataHasil = data[0]

                    if (data.hasil == 1) {
                        Swal.fire({
                            title: 'NIK WALI SUDAH ADA',
                            text: 'Klik lanjut untuk isi data otomatis',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Lanjutkan',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                tipewali.val(1)
                                namawali.val(data[0].nama_walisantri).prop('readonly', true)
                                nomorhpwali.val(data[0].nomor_hp_walisantri).prop('readonly',
                                    true)
                                provinsiwali.val(data[0].provinsi_walisantri).prop('readonly',
                                    true)
                                kecamatanwali.val(data[0].kecamatan_walisantri).prop(
                                    'readonly', true)
                                dusunwali.val(data[0].dusun_walisantri).prop('readonly',
                                    true)
                                kabupatenwali.val(data[0].kabupaten_walisantri).prop(
                                    'readonly', true)
                                desawali.val(data[0].desa_walisantri).prop('readonly',
                                    true)
                                rtwali.val(data[0].rt_walisantri).prop('readonly', true)
                                rwwali.val(data[0].rw_walisantri).prop('readonly', true)
                                kodeposwali.val(data[0].kode_pos_walisantri).prop(
                                    'readonly',
                                    true)
                                pendidikanwali.val(data[0].pendidikan_akhir_walisantri)
                                pekerjaanwali.val(data[0].pekerjaan_walisantri)
                                hubunganwali.val(data[0].hubungan_walisantri)
                            }
                        })
                    }
                }
            })
        }
    })

    const showDivDetailWalis = () => {
        const nik = $('#nikWaliDetail').val()
        $.ajax({
            url: '<?= base_url() ?>datasantri/getdetailnikwali',
            method: 'post',
            data: {
                nik
            },
            success: function(data) {
                $('#showdetailsantriwalis').show()
                $('#tampildetailwalis').html(data)
            }
        })
    }

    $('#tombolBukaDetail').on('click', function() {
        $('#tombolBukaDetail').hide()
        showDivDetailWalis()
        $('#tombolTutupDetail').show()

    })

    $('#tombolTutupDetail').on('click', function() {
        $(this).hide()
        $('#tombolBukaDetail').show()
        $('#showdetailsantriwalis').hide()
    })

    $('#tampildata').on('click', '.detaildata', function() {
        const id = $(this).data('id')
        detaildatasantri(id)
        getDetailSantri(id)
    })

    $('#pilihdaerah').on('change', function() {
        const pilih = $(this).val()
        if (pilih != 131) {
            $('#pilihkamar').show()
        } else {
            $('#pilihkamar').hide()
        }
    })

    async function detaildatasantri(id) {
        try {
            const result = await $.ajax({
                url: '<?= base_url() ?>datasantri/detaildatasantri',
                method: 'post',
                data: {
                    id
                },
            })

            $('#tampildetaildata').html(result)
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loadingdetail(kataerror)
        }

    }

    function loadingdetail(kata) {
        const divLoading = `<div class="card" style="height: 70vh;">
                                <div class = "text-center" id = "gagal" >
                                    ${kata}
                                </div>
                            </div >`
        $('#tampildetaildata').html(divLoading)
    }

    loadingdetail('<img src = "<?= base_url() ?>assets/images/layouts/gif/load.gif" >')
</script>
</body>

</html>
