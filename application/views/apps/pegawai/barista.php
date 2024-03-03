<main class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-4 mb-2">
            <div class="card text-light border-0 rounded-3 shadow">
                <div class="card-header bg-white">
                    <div class="card mt-3 rounded-3 border-2 border-white px-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/images/systems/profile-picture.png') ?>" alt="" style="width: 80; height: 80px" class="rounded-circle" />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">@<?= $user['username_pegawai']; ?></p>
                                    <p class="badge rounded-pill text-bg-secondary mb-0"><?= $user['role_pegawai']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <ul class="list-group text-center list-group px-3 py-3">
                        <a href="<?= base_url('barista/report') ?>">
                            <li class="list-group-item border-0 text-bg-primary rounded-3 mb-2">
                                <i class="bi bi-journal-text"></i>
                                <b>Report</b>
                            </li>
                        </a>

                        <a href="" id="logout">
                            <li class="list-group-item border-0 text-bg-danger rounded-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                                <b>Log out</b>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-white text-center">
                    <p class="card-title text-center h5 mt-2"><b>Data Pesanan</b></p>
                </div>
                <div class="card-body">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
                        <div>
                            Klik tombol <span class="badge bg-primary"><b>Konfirmasi</b></span> untuk membuat pesanan, dan klik tombol <span class="badge bg-success"><b>Selesaikan</b></span> jika pesanan siap diantar.
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pemesan</th>
                                    <th>Kode Meja</th>
                                    <th>Daftar Pesanan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot id="dataRecords">
                                
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).on("click", "#logout", function(e) {
        e.preventDefault()

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-lg btn-success fw-bold mx-1',
                cancelButton: 'btn btn-lg btn-danger fw-bold mx-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Yakin Mau Logout?",
            text: "Klik ya untuk mengkonfirmasi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Tidak, batalkan!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed === true) {
                swalWithBootstrapButtons.fire(
                    'Sukses!',
                    'Kamu Berhasil Logout.',
                    'success'
                )

                setTimeout(function() {
                    window.location.href = '<?= base_url('auth/logout') ?>'
                }, 2000)
            }

        })
    })

    function fetchOrders() {
        $.ajax({
            url: "<?php echo base_url('barista/fetch_orders'); ?>",
            method: "GET",
            dataType: "json",
            success: function (data) {
                updateOrdersView(data);
            },
            complete: function() {
                setTimeout(fetchOrders, 5000);
            }
        });
    }

    function updateOrdersView(orders) {
        var html = '';

        if(orders.length > 0) {
            
            $.each(orders, function (index, order) {
                html += '<tr>';
                html += '<td><span class="badge bg-secondary p-2">'+order.pemesan +'\n#'+ order.id_order + '</span></td>';
                html += '<td><span class="badge bg-success p-2">' + order.kd_meja + '</span></td>';
                html += '<td>' + order.nama_menu + '\n<span class="badge bg-dark">x' + order.jumbel + '</span></td>';
                html += '<td>' + order.status_detail + '</td>';
                html += '<td>';
                html += order.status_detail != 'sedang dibuat' ? '<button id="confirmOrder" data-iddetail='+order.detail_id+' class="btn btn-sm btn-primary">Konfirmasi</button>' : '<button id="finishOrder" data-iddetail='+order.detail_id+' class="btn btn-sm btn-success">Selesaikan</button>';
                html += '</td>';
                html += '</tr>';
            });
        } else {
            html += '<tr><td colspan="5" class="text-center">Tidak ada data pesanan saat ini</td></tr>';
        }
        $("#dataRecords").html(html);
    }

    $(document).ready(function () {
        fetchOrders();
    })

    $(document).on('click','#confirmOrder', function(e) {
        e.preventDefault();

        var idDetail = $(this).data('iddetail');

        $.ajax({
            url: '<?= base_url('barista/confirm_order/') ?>' + idDetail,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data.responce === 'success') {
                    toastr["success"](data.message, 'Sukses')
                    fetchOrders();
                    console.log(data.message);
                } else {
                    console.error(data.message);
                }
            }
        })
    })

    $(document).on('click','#finishOrder', function(e) {
        e.preventDefault();

        var idDetail = $(this).data('iddetail');

        $.ajax({
            url: '<?= base_url('barista/finish_order/') ?>' + idDetail,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data.responce === 'success') {
                    toastr["success"](data.message, 'Sukses')
                    fetchOrders();
                    console.log(data.message);
                } else {
                    console.error(data.message);
                }
            }
        })
    })
</script>