<main class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card px-0 py-0 border-0 rounded-3 shadow-sm">
                <nav class="px-4 pt-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="link-custom" href="<?= base_url('kitchen/') ?>"><b>Kitchen</b></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-lg-12 mt-2">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-white text-center">
                    <p class="card-title text-center h5 mt-2"><b>Laporan Kitchen</b><br> <?= $user['role_pegawai'] ?>: @<?= $user['username_pegawai'] ?></p>
                </div>
                <div class="card-body">
                    <!-- <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
                        <div>
                            Silahkan datangi meja pelanggan untuk mengkonfirmasi pemesanan. Klik <span class="badge bg-primary"><b>Konfirmasi</b></span> jika pelanggan sudah membayar.
                        </div>
                    </div> -->
                    <table class="table" id="records">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Kode Meja</th>
                                <th>Daftar Pesanan</th>
                                <th>Qty</th>
                                <th>Pengantar</th>
                                <th>Tanggal Pesan</th>
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
        $.fn.dataTable.ext.errMode = 'none';
        $('#records').DataTable({
            serverside: false,
            deferRender: true,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            },
            dom: '<"row"<"col-md-12 mb-2 text-center"B><"col-md-6"l><"col-md-6"f>>tr<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: [ 
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
                url: "<?= base_url('kitchen/fetch_report') ?>",
                type: "POST",
                dataType: "json",
                dataSrc: ""
            },
            initComplete: function(settings, json) {
                if (json.posts && json.posts.length > 0) {
                    $('#records').DataTable();
                }
            },
            columns: [
                {
                    render: function(data, type, row) {
                        let pemesanan = '<span class="badge bg-secondary p-2">' + row.pemesan + ' #' + row.id_order + '</span>';
                        return pemesanan
                    },
                },
                {
                    data: "kd_meja",
                },
                {
                    data: 'nama_menu'
                },
                {
                    data: 'jumbel'
                },
                {
                    data: "delivery_person",
                    render: function(data) {
                        return '@'+data
                    }
                },
                {
                    data: "tanggal_pesan",
                    render: function(data, type, row) {
                        // Menggunakan moment.js untuk memformat timestamp| HH:mm
                        return moment(data).format('YYYY/MM/DD');
                    }
                }
            ]
        })
    })
</script>