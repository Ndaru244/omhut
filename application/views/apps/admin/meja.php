  <main class="container">
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card px-0 py-0 border-0 rounded-3 shadow-sm">
          <nav class="px-4 pt-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="link-custom" href="<?= base_url('admin/') ?>"><b>Branda</b></a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Meja</li>
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
                <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="kode_meja" autocomplete="off" placeholder="Kode">
                <label for="kode_meja">Kode Meja</label>
              </div>
              <p class="text-muted text-center small">
                Kode bisa berupa kombinasi angka dan huruf<br>
                Contoh: <b class="text-primary">F2M4</b>
              </p>

            </div>
            <div class="card-footer bg-white">
              <div class="row">
                <div class="col-6 d-grid">
                  <button class="btn btn-danger" type="reset"><b>Reset</b></button>
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
        <div class="card border-0 rounded-3 shadow-sm" >
          <div class="card-header bg-white text-center">
            <p class="card-title text-center h5 mt-2"><b>Data Menu</b></p>
          </div>
          <div class="card-body">
            <div class="alert alert-info d-flex align-items-center" role="alert">
              <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
              <div>
                Klik pada gambar qr untuk mendownload.
              </div>
            </div>
            <table class="table" id="records">
              <thead>
                <tr>
                  <th style="width: 5%;">#</th>
                  <th style="width: 15%;">Kode</th>
                  <th>QR</th>
                  <th style="width: 5%;">Tools</th>
                </tr>
              </thead>
            </table>
            
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
      dom: '<"row"<"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',
      ajax: {
        url: '<?= base_url('/admin/fetch_meja') ?>',
        type: 'POST',
        dataType: 'json',
        dataSrc: 'posts'
      },

      initComplete: function(settings, json) {
          if (json.posts && json.posts.length > 0) {
              // Initialize DataTables if data is available
              $('#records').DataTable();
          }
      },

      "columns": [
        {
          "searchable": false,
          "render": function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }},

        {
          data: "kd_meja"
        },

        {
          "searchable": false,
          "render": function(data, type, row, meta) {
            var a = `<a href="<?= base_url('admin/download_qr/')?>${row.qr_meja}" target='_blank'><img src="<?=base_url('assets/qr/')?>${row.qr_meja}" alt="qr" width="150px"></a>`
            return a
        }},

        {
          "searchable": false,
          "render": function(data, type, row, meta) {
            var a = `<a href="" value="${row.kd_meja}" id="del" class="btn btn-danger">Hapus</a>`
            return a
        }},
      ]
    });
  });

  /* Add Data */ 
  $(document).on("click", "#add", function(e) {
    e.preventDefault()

    var kd_meja = $('#kode_meja').val().toUpperCase()
    var qr_meja = "QR_"+kd_meja+".png"

    $.ajax({
      url: "<?= base_url('admin/insert_meja') ?>",
      type: "POST",
      dataType: "json",
      data: {
        kd_meja: kd_meja,
        qr_meja: qr_meja
      },
      success: function(data) {
        if (data.responce == "success") {
          $("#records").DataTable().ajax.reload(null, false)
          toastr["success"](data.message,"Sukses")
        } else {
          toastr["error"](data.message,"Peringatan!")
          console.log('error')
        }
      }
    })
    $('#form')[0].reset()
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
          url: "<?= base_url('admin/delete_meja') ?>",
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
</script>