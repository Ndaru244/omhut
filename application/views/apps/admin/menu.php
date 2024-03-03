<main class="container">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card px-0 py-0 border-0 rounded-3 shadow-sm">
                <nav class="px-4 pt-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="link-custom" href="<?=base_url("admin")?>"><b>Beranda</b></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Menu</li>
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
                        <p class="card-title text-center h5 mt-2"><b>Form Menu</b></p>
                    </div>
                    <div class="card-body text-black">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="nama_menu" autocomplete="off" placeholder="barang">
                            <label for="floatingInput">Nama Menu</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control bg-body-secondary border-0 rounded-3" id="harga_menu" autocomplete="off" placeholder="132">
                            <label for="floatingPassword">Harga</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-select bg-body-secondary border-0 rounded-3" id="jenis_menu" aria-label="Floating label select example">
                                <option value="" selected>--- Pilih Jenis Menu ---</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                            <label for="jenis_menu">Jenis Menu</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control bg-body-secondary border-0 rounded-3 py-3" id="gambar_menu" accept="image/*">
                            <!-- <label for="floatingInput">Nama Menu</label> -->
                        </div>
                        <div class="img-fluid text-center" id="img-preview">
                            <img id="preview-image" src="#" class="rounded-3" alt="Preview Image" style="width: 100%;"">
                        </div>

                        <script>
                            $(document).ready(()=>{
                                $('#gambar_menu').change(function(){
                                    const file = this.files[0];
                                    if (file){
                                        let reader = new FileReader();
                                        reader.onload = function(event){
                                            $('#preview-image').attr('src', event.target.result);
                                        }
                                        reader.readAsDataURL(file);
                                    } else {
                                        $('#preview-image').attr('src', '');
                                    }
                                })
                                $('#resetFrom').on('click', function() {
                                    $('#preview-image').attr('src', '');
                                })

                            })
                        </script>

                    </div>
                    <div class="card-footer bg-white">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <button class="btn btn-danger" id="resetFrom" type="reset"><b>Reset</b></button>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-primary" id="add"><b>Simpan</b></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-white text-center">
                    <p class="card-title text-center h5 mt-2"><b>Data Menu</b></p>
                </div>
                <div class="card-body">

                    <table class="table" id="records">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th >Tools</th>
                            </tr>
                        </thead>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <input type="hidden" id="edit_record_id" name="edit_record_id" value="">
            <div class="img-fluid text-center mb-2">
                <img id="edit_images" src="#" class="rounded-3" alt="Preview Image" style="width: 50%;"">
            </div>
            <hr>
            <div class="form-floating mb-2">
                <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="edit_nama" autocomplete="off" placeholder="barang">
                <label for="floatingInput">Nama Menu</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" class="form-control bg-body-secondary border-0 rounded-3" id="edit_harga" autocomplete="off" placeholder="132">
                <label for="floatingPassword">Harga</label>
            </div>
            <div class="form-floating mb-2">
                <select class="form-select bg-body-secondary border-0 rounded-3" id="edit_jenis" aria-label="Floating label select example">
                    <option value="" selected>--- Pilih Jenis Menu ---</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>
                <label for="jenis_menu">Jenis Menu</label>
            </div>
            <div class="form-floating mb-2">
                <select class="form-select bg-body-secondary border-0 rounded-3" id="edit_status" aria-label="Floating label select example">
                    <option value="" selected>--- Pilih Status Menu ---</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="kosong">Tidak Tersedia</option>
                </select>
                <label for="jenis_menu">Status Menu</label>
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
      </div>
    </div>

</main>

<!-- <main> -->
<script>
    /* Get Data */ 
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none'
        $('#records').DataTable({
            serverside: false,
            deferRender: true,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            },
            // dom: '<"row"<"col-md-12 mb-2 text-center"B><"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',
            dom: '<"row"<"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: [ 
                // {
                //     extend: 'pageLength', // Menambahkan tombol Show entries
                //     className: 'btn btn-sm btn-dark',
                // },
                {
                    extend: 'excel', // Tombol Excel
                    className: 'btn btn-sm btn-secondary',
                },
                {
                    extend: 'pdf', // Tombol PDF
                    className: 'btn btn-sm btn-secondary',
                },
                {
                    extend: 'print', // Tombol Print
                    className: 'btn btn-sm btn-secondary',
                }, 
            ],
            ajax: {
                url: "<?= base_url('admin/fetch_menu') ?>",
                type: "post",
                dataType: "json",
                dataSrc: "posts"
            },

            initComplete: function(settings, json) {
                if (json.posts && json.posts.length > 0) {
                    $('#records').DataTable();
                }
            },

            "columns": [
                // {
                //     "searchable": false,
                //     "render": function(data, type, row, meta) {
                //         return meta.row + meta.settings._iDisplayStart + 1;
                // }},
                {
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        var a = `<img class="img-fluid rounded-2" alt="${row.gambar_menu}" src="<?=base_url('assets/images/')?>${row.gambar_menu}" alt="qr" width="80px">`
                        return a
                    }
                },

                {
                    data: "nama_menu"
                },
                {
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        var a = Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0, maximumFractionDigits: 0, }).format(`${row.harga_menu}`)
                        return a
                }},
                {
                    data: "jenis_menu"
                },
                {
                    data: "status_menu"
                },
                {
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        var a = `<a href="" value="${row.id_menu}" id="del" class="btn btn-danger">Hapus</a>&nbsp;<a href="#" value="${row.id_menu}" id="edit" class="btn btn-primary">Edit</a>`
                        return a
                }},
            ],
        });
    });

      /* Add Data */ 
    $(document).on("click", "#add", function(e) {
        e.preventDefault()

        var nama_menu = $('#nama_menu').val()
        var harga_menu = $('#harga_menu').val()
        var jenis_menu = $('#jenis_menu').val()
        var gambar_menu = $('#gambar_menu')[0].files[0];
        var status_menu = "tersedia"

        var formData = new FormData();

        formData.append("nama_menu", nama_menu);
        formData.append("harga_menu", harga_menu);
        formData.append("jenis_menu", jenis_menu);
        formData.append("gambar_menu", gambar_menu);
        formData.append("status_menu", status_menu);

        $.ajax({
            url: "<?= base_url('admin/insert_menu') ?>",
            processData: false,
            contentType: false,
            type: "POST",
            dataType: "json",
            data: formData,
            success:function(data) {
                if (data.responce == "success") {
                    $('#preview-image').attr('src', '')
                    $('#form')[0].reset()
                    $("#records").DataTable().ajax.reload(null, false)
                    toastr["success"](data.message,"Sukses")
                } else {
                    toastr["error"](data.message,"Peringatan!")
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
          url: "<?= base_url('admin/delete_menu') ?>",
          type: "post",
          dataType: "json",
          data: {
            del_id : del_id
          },
          success: function(data) {
            if (data.responce === "success") {
              $("#records").DataTable().ajax.reload(null,false)
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
  $(document).on("click", "#edit", function(e){
    e.preventDefault()
    var edit_id = $(this).attr("value")

    $.ajax({
      url: "<?= base_url('admin/edit_menu') ?>",
      type: "post",
      dataType: "json",
      data: {
        edit_id: edit_id
      },
      success: function(data){
        if (data.responce == "success") {
          $('#ModalEdit').modal("show")
          $("#edit_record_id").val(data.post.id_menu)
          $("#edit_images").attr('src', "<?=base_url('assets/images/')?>"+data.post.gambar_menu)
          $("#edit_nama").val(data.post.nama_menu)
          $("#edit_harga").val(data.post.harga_menu)
          $("#edit_jenis").val(data.post.jenis_menu)
          $("#edit_status").val(data.post.status_menu)
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
    var edit_nama = $("#edit_nama").val()
    var edit_harga = $("#edit_harga").val()
    var edit_jenis = $("#edit_jenis").val()
    var edit_status = $("#edit_status").val()

    $.ajax({
        url: "<?= base_url('admin/update_menu') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            edit_record_id: edit_record_id,
            edit_nama: edit_nama,
            edit_harga: edit_harga,
            edit_jenis: edit_jenis,
            edit_status: edit_status
        },
        success: function(data) {
            if (data.responce == "success") {
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