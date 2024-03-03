<main class="container">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card px-0 py-0 border-0 rounded-3 shadow-sm">
                <nav class="px-4 pt-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="link-custom" href="<?= base_url("admin") ?>"><b>Beranda</b></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4 mb-3">
            <div class="card border-0 rounded-3 shadow-sm">
                <form action="" id="form">
                    <div class="card-header bg-white">
                        <p class="card-title text-center h5 mt-2"><b>Form Pegawai</b></p>
                    </div>
                    <div class="card-body text-black">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="username_pegawai" autocomplete="off" placeholder="">
                            <label for="floatingInput">Username Pegawai</label>
                        </div>

                        <div class="form-floating mb-2">
                            <select class="form-select bg-body-secondary border-0 rounded-3" id="role_pegawai" aria-label="Floating label select example">
                                <option value="" selected>--- Pilih Jenis Role Pegawai ---</option>
                                <option value="barista">Barista</option>
                                <option value="kitchen">Kitchen</option>
                                <option value="kasir">Kasir</option>
                            </select>
                            <label for="jenis_menu">Jenis Role</label>
                        </div>

                        <div class="input-group mb-2">
                            <div class="form-floating ">
                                <input type="password" class="form-control bg-body-secondary border-0 rounded-start-3 pass" id="password_pegawai" autocomplete="off" placeholder="">
                                <label for="floatingPassword">Kata Sandi</label>
                            </div>
                            <button class="input-group-text btn btn-primary border-0 rounded-end-3" id="togglePasswordButton" onclick="togglePasswordVisibility1()" type="button">
                                &nbsp;
                                <i id="eyeIcon" class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                                &nbsp;
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <button class="btn btn-danger" id="resetFrom" type="reset"><b>Reset</b></button>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-primary" type="submit" id="add"><b>Simpan</b></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-white text-center">
                    <p class="card-title text-center h5 mt-2"><b>Data Pegawai</b></p>
                </div>
                <div class="card-body">

                    <table class="table" id="records">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form action="" id="formUpdate">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_record_id" name="edit_record_id" value="">
                    <input type="hidden" id="current_pass" name="current_pass" value="">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="edit_username" autocomplete="off" placeholder="barang">
                        <label for="floatingInput">Username Pegawai</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select bg-body-secondary border-0 rounded-3" id="edit_role" aria-label="Floating label select example">
                            <option value="" selected>--- Pilih Role Pegawai ---</option>
                            <option value="barista">Barista</option>
                            <option value="kitchen">Kitchen</option>
                            <option value="kasir">Kasir</option>
                        </select>
                        <label for="jenis_menu">Jenis Menu</label>
                    </div>

                    <hr>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
                        <div>
                            Kosongkan jika tidak ingin mengubah password.<br>
                            Jika salah satu kosong maka tidak akan ada perubahan pada password jika disimpan.
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <div class="form-floating ">
                            <input type="password" class="form-control bg-body-secondary border-0 rounded-start-3 pass2" id="edit_old_pass" autocomplete="off" placeholder="">
                            <label for="floatingPassword">Password Lama</label>
                        </div>
                        <button class="input-group-text btn btn-primary border-0 rounded-end-3" id="toggleedit_old_pass" onclick="togglePasswordVisibility2()" type="button">
                            &nbsp;
                            <i id="eyeIcon2" class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                            &nbsp;
                        </button>
                    </div>
                    <div class="input-group mb-2">
                        <div class="form-floating ">
                            <input type="password" class="form-control bg-body-secondary border-0 rounded-start-3 pass3" id="edit_new_pass" autocomplete="off" placeholder="">
                            <label for="floatingPassword">Password Baru</label>
                        </div>
                        <button class="input-group-text btn btn-primary border-0 rounded-end-3" id="toggleedit_new_pass" onclick="togglePasswordVisibility3()" type="button">
                            &nbsp;
                            <i id="eyeIcon3" class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                            &nbsp;
                        </button>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-block" data-bs-dismiss="modal">Batal</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary btn-block" id="update">Simpan</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

</main>
<!-- <main> -->
<script>
    var passInput1 = document.getElementById('password_pegawai');
    var passInput2 = document.getElementById('edit_old_pass');
    var passInput3 = document.getElementById('edit_new_pass');
    var eyeIcon1 = document.getElementById('eyeIcon');
    var eyeIcon2 = document.getElementById('eyeIcon2');
    var eyeIcon3 = document.getElementById('eyeIcon3');

    function togglePasswordVisibility1() {
        if (passInput1.type === 'password') {
            passInput1.type = 'text';
            eyeIcon1.classList.remove("bi-eye-slash-fill");
            eyeIcon1.classList.add("bi-eye-fill");
        } else {
            passInput1.type = 'password';
            eyeIcon1.classList.remove("bi-eye-fill");
            eyeIcon1.classList.add("bi-eye-slash-fill");
        }
    }

    function togglePasswordVisibility2() {
        if (passInput2.type === 'password') {
            passInput2.type = 'text';
            eyeIcon2.classList.remove("bi-eye-slash-fill");
            eyeIcon2.classList.add("bi-eye-fill");
        } else {
            passInput2.type = 'password';
            eyeIcon2.classList.remove("bi-eye-fill");
            eyeIcon2.classList.add("bi-eye-slash-fill");
        }
    }

    function togglePasswordVisibility3() {
        if (passInput3.type === 'password') {
            passInput3.type = 'text';
            eyeIcon3.classList.remove("bi-eye-slash-fill");
            eyeIcon3.classList.add("bi-eye-fill");
        } else {
            passInput3.type = 'password';
            eyeIcon3.classList.remove("bi-eye-fill");
            eyeIcon3.classList.add("bi-eye-slash-fill");
        }
    }
</script>
<script>
    /* Get Data  */
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none'
        $('#records').DataTable({
            serverside: false,
            deferRender: true,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            },

            dom: '<"row"<"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',

            ajax: {
                url: "<?= base_url('admin/fetch_pegawai') ?>",
                type: "post",
                dataType: "json",
                dataSrc: "posts"
            },

            initComplete: function(settings, json) {
                if (json.posts && json.posts.length > 0) {
                    $('#records').DataTable();
                }
            },

            "columns": [{
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    data: "username_pegawai"
                },
                {
                    data: "role_pegawai"
                },
                {
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        var a = `<a href="" value="${row.id_pegawai}" id="del" class="btn btn-danger">Hapus</a>&nbsp;<a href="#" value="${row.id_pegawai}" id="edit" class="btn btn-primary">Edit</a>`
                        return a
                    }
                },
            ],
        });
    });

    /* Add Data  */
    $(document).on("click", "#add", function(e) {
        e.preventDefault()

        var username_pegawai = $('#username_pegawai').val().toLowerCase()
        var password_pegawai = $('#password_pegawai').val()
        var role_pegawai = $('#role_pegawai').val()

        var allowedCharacters = /^[a-zA-Z0-9\-.]+$/

        $.ajax({
            url: "<?= base_url('admin/insert_pegawai') ?>",
            type: "POST",
            dataType: "json",
            data: {
                username_pegawai: username_pegawai,
                password_pegawai: password_pegawai,
                role_pegawai: role_pegawai
            },
            success: function(data) {
                if (data.responce == "success") {
                    $('#form')[0].reset()
                    $("#records").DataTable().ajax.reload(null, false)
                    toastr["success"](data.message, "Sukses")
                } else {
                    toastr["error"](data.message, "Peringatan!")
                }
            }
        })
    })

    /* Delete Data */
    $(document).on("click", "#del", function(e) {
        e.preventDefault()

        var del_id = $(this).attr("value")

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-lg btn-success fw-bold mx-1',
                cancelButton: 'btn btn-lg btn-danger fw-bold mx-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Kamu Yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak, batalkan!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('admin/delete_pegawai') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        del_id: del_id
                    },
                    success: function(data) {
                        if (data.responce === "success") {
                            $("#records").DataTable().ajax.reload(null, false)
                            swalWithBootstrapButtons.fire(
                                'Terhapus!',
                                'Data berhasil terhapus.',
                                'success'
                            )
                        } else {
                            console.log(data)
                            swalWithBootstrapButtons.fire(
                                'Batal',
                                'Data tidak jadi dihapus :)',
                                'error'
                            )
                        }
                    }
                })
            }
        })
    })

    /* Edit Record Data */
    $(document).on("click", "#edit", function(e) {
        e.preventDefault()
        var edit_id = $(this).attr("value")

        $.ajax({
            url: "<?= base_url('admin/edit_pegawai') ?>",
            type: "post",
            dataType: "json",
            data: {
                edit_id: edit_id
            },
            success: function(data) {
                if (data.responce == "success") {
                    $('#ModalEdit').modal("show")
                    $("#edit_record_id").val(data.post.id_pegawai)
                    $("#edit_username").val(data.post.username_pegawai)
                    $("#edit_role").val(data.post.role_pegawai)
                    $("#current_pass").val(data.post.password_pegawai)
                } else {
                    toastr["error"](data.message)
                }
            }
        })
    })

    /* Edit Process Data */
    $(document).on("click", "#update", function(e) {
        e.preventDefault()

        var edit_record_id = $("#edit_record_id").val()
        var current_pass = $("#current_pass").val()
        var edit_username = $("#edit_username").val().toLowerCase()
        var edit_role = $("#edit_role").val()
        var edit_old_pass = $("#edit_old_pass").val()
        var edit_new_pass = $("#edit_new_pass").val()

        $.ajax({
            url: "<?= base_url('admin/update_pegawai') ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                edit_record_id: edit_record_id,
                current_pass: current_pass,
                edit_username: edit_username,
                edit_role: edit_role,
                edit_old_pass: edit_old_pass,
                edit_new_pass: edit_new_pass
            },
            success: function(data) {
                if (data.responce == "success") {
                    $('#formUpdate')[0].reset()
                    $("#records").DataTable().ajax.reload(null, false)
                    $('#ModalEdit').modal('hide')
                    toastr["success"](data.message)
                } else {
                    toastr["error"](data.message)
                }
            }
        })
    })
</script>