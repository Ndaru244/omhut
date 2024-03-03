<main class="container">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card px-0 py-0 border-0 rounded-3 shadow-sm">
                <nav class="px-4 pt-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="link-custom" href="<?=base_url("admin")?>"><b>Beranda</b></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Gudang</li>
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
                        <p class="card-title text-center h5 mt-2"><b>Form Item</b></p>
                    </div>
                    <div class="card-body text-black">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="nama_item" autocomplete="off" placeholder="barang">
                            <label for="nama_item">Nama Item</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control bg-body-secondary border-0 rounded-3" id="jumlah_item" autocomplete="off" placeholder="132">
                            <label for="jumlah_item">Jumlah Item</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-select bg-body-secondary border-0 rounded-3" id="status_item" aria-label="status_item">
                                <option value="" selected>--- Pilih Status ---</option>
                                <option value="keluar">KELUAR</option>
                                <option value="masuk">MASUK</option>
                            </select>
                            <label for="status_item">Status Item</label>
                        </div>
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
                    <p class="card-title text-center h5 mt-2"><b>Data Item</b></p>
                </div>
                <div class="card-body">

                    <table class="table" id="records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        moment.locale('id');
        $.fn.dataTable.ext.errMode = 'none'
        $('#records').DataTable({
            serverside: false,
            deferRender: true,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            },
            dom: '<"row"<"col-md-12 mb-2 text-center"B><"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',
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
                url: "<?= base_url('admin/fetch_warehouse') ?>",
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
                {
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'nama_item'},
                {data: 'jumlah_item'},
                {data: 'status_item'},
                {
                    data: 'tanggal',
                    render: function(data, type, row) {
                        return moment(data).format('YYYY/MM/DD HH:mm');
                    }
                }
            ]
        })
    })

    $(document).on("click", "#add", function(e) {
    e.preventDefault()

    var nama_item = $('#nama_item').val()
    var jumlah_item = $('#jumlah_item').val()
    var status_item = $('#status_item').val()

    $.ajax({
      url: "<?= base_url('admin/insert_warehouse') ?>",
      type: "POST",
      dataType: "json",
      data: {
        nama_item: nama_item,
        jumlah_item: jumlah_item,
        status_item: status_item
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
</script>