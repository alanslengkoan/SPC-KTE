<script src="<?= assets_url() ?>admin/jquery.filer/js/jquery.filer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk upload foto
    var untukUploadFoto = function() {
        $("#inplogo").change(function() {
            cekLokasiFoto(this);
        });

        $('#inplogo').filer({
            extensions: ['jpg', 'jpeg', 'png'],
            changeInput: true,
            showThumbs: true,
            addMore: false
        });
    }();

    // untuk ubah logo
    var untukUbahLogo = function() {
        $('#form-logo').submit(function(e) {
            e.preventDefault();
            $('#inplogo').attr('required', 'required');

            if ($('#form-logo').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-logo').attr('disabled', 'disabled');
                        $('#save-logo').html('<i class="fa fa-spinner"></i>&nbsp;Waiting');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        })
                        .then((value) => {
                            location.reload();
                        });
                    }
                })
            }
        });
    }();

    // untuk ubah profil
    var untukUbahProfil = function() {
        $('#form-profil').submit(function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpemail').attr('required', 'required');
            $('#inpalamat').attr('required', 'required');
            $('#inptelepon').attr('required', 'required');

            if ($('#form-profil').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-profil').attr('disabled', 'disabled');
                        $('#save-profil').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        })
                        .then((value) => {
                            location.reload();
                        });
                    }
                })
            }
        });
    }();

    // untuk baca lokasi gambar
    function cekLokasiFoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#lihat-gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>