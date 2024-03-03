    <main class="container mb-5">
        <div class="row mt-4">
            <div class="col-lg ">
                <div class="alert alert-primary" role="alert"> 
                    Untuk mengganti meja silahkan klik kotak yang berwarna hijau di bawah ini
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <button class="d-flex btn btn-success">Meja : F0M1</button> -->
            
            <div class="col-lg-2 mt-2">
                <div class="card bg-success text-white border-0 shadow" id="ganti_meja">
                    <div class="card-body text-center">
                        <div class="card-title">
                            <h5><b>Meja</b>: <?= $this->session->userdata('kd_meja') ?></h5>
                            <h5 class="mt-2"><b>Pemesan</b>: <?= $this->session->userdata('nama_pelanggan') ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $kd_meja = $this->session->userdata('kd_meja');
            $orders = $this->Main_model->getOrders($kd_meja);
            $is_user_order = '';
            $isUserOrderShown = false;
            foreach ($orders as $data) {
                $is_user_order = $data->pemesan != $this->session->userdata('nama_pelanggan');
                if ($data->status_order != 'selesai' && $data->status_order != 'dibatalkan') {
                    if ($is_user_order) {
                        $isUserOrderShown = true;
                        // echo "Menampilkan menu pesanan";
                    }
                }
            }
            if ($isUserOrderShown) {
                // echo "menampilkan ";
            } else {
                // echo "Pesanan pengguna tidak ditemukan atau tidak sesuai.";
            ?>
            <div class="col-lg-10 mt-2">
                <a href="<?= base_url('main/keranjang') ?>">
                    <div class="card bg-primary text-white border-0 shadow">
                        <div class="card-body text-center">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                                </svg>
                                <h3 class="mt-2"><b>
                                <?php
                                $cart = $this->session->userdata('cart') ?? [];
                                if (!empty($cart)) {
                                    $cartCount = count($cart);
                                    echo $cartCount;
                                }else { echo "0";}
                                
                                // echo empty($cart) ? '' : $cartCount;
                                
                                ?>
                                </b></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            
        </div>

        <?php
        if ($isUserOrderShown) {
            // echo "menampilkan ";
        } else {
        ?>
        <hr class="border border-secondary-subtle rounded-5 border-2 opacity-25 my-4 mx-3">
        <div class="row mt-2">

            <div class="col-6">
                <a href="<?= base_url('main/menu_makanan') ?>">
                    <div class="card content-card-custom border-0 shadow">
                        <div class="overlay rounded card-img-top">
                            <img src="<?= base_url('assets/images/systems/Makanan.png') ?>" class="rounded content-images card-img-top" alt="...">
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6">
                <a href="<?= base_url('main/menu_minuman') ?>">
                    <div class="card content-card-custom border-0 shadow">
                        <div class="overlay rounded card-img-top">
                            <img src="<?= base_url('assets/images/systems/Minuman.png') ?>" class="rounded content-images card-img-top" alt="...">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php
        }
        ?>
        

        <hr class="border border-secondary-subtle rounded-5 border-2 opacity-25 my-4 mx-3">
        
        <div class="row">
            <div class="col-lg" id="order-view"></div>
        </div>
    </main>

    <script>
    $(document).on("click", "#ganti_meja", function(e) {
      e.preventDefault()

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-lg btn-success fw-bold mx-1',
          cancelButton: 'btn btn-lg btn-danger fw-bold mx-1'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: "Yakin Mau Ganti Meja?",
        text: "Klik ya untuk mengkonfirmasi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Ganti',
        cancelButtonText: 'Tidak, batalkan!',
        reverseButtons: true
      }).then((result) =>{
        if (result.isConfirmed === true) {
            swalWithBootstrapButtons.fire(
              'Sukses!',
              'Silahkan Pilih Meja Baru.',
              'success'
            )

          setTimeout(function() {
            window.location.href = '<?=base_url('main/ganti_meja')?>'
          },2000)
        }

      })
    })

    function fetchOrders() {
        $.ajax({
            url: '<?= base_url('main/fetch_orders') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                updateView(data);
            },
            complete: function() {
                setTimeout(fetchOrders, 5000);
            }
        })
    }
    
    function updateView(data) {
        var orders = data.orders;
        var total = data.total;
        
        // Deklarasikan variabel isUserOrderShown di luar loop
        var isUserOrderShown = false;

        var html = '';
        if(orders.length > 0) {
            $.each(orders, function(index, order) {
                var statusClass = order.status_order === 'sudah bayar' ? 'bg-success' : 'bg-danger';

                if (order.is_user_order && !isUserOrderShown) {
                    html += '<div class="alert alert-warning" role="alert">';
                    html += '<b>Meja Sudah Terisi, Segera Ganti Meja</b>';
                    html += '</div>';
                    isUserOrderShown = true;
                } else if (!order.is_user_order) {
                    html += '<div class="card border-light shadow-sm mb-3">';
                    html += '<div class="card-body">';
                    html += '<span class="card-title"><b>Kode pesanan : </b><small class="badge bg-secondary">#'+ order.id_order +'</small></span><br>';
                    html += '<span class="card-text"><b>Status pesanan : </b><small class="badge '+statusClass+'">'+ order.status_order +'</small></span><br>';
                    html += '<span class="card-text"><b>Pemesan : </b><small class="badge bg-secondary">'+ order.pemesan +'</small></span></div>';
                    html += '<table class="table table-sm">';
                    html += '<tr><th>Pesanan</th><th>Qty</th><th>Harga</th><th>Status</th></tr>';
                    
                    $.each(order.order_items, function(index, detail) {
                        var changeColorIfunpaid = detail.status_detail === 'menunggu pembayaran' ? 'text-danger' : 'text-primary';
    
                        html += '<tr>';
                        html += '<td><small>' + detail.nama_menu + '</small></td>';
                        html += '<td><small>' + detail.jumbel + '</small></td>';
                        html += '<td><small>' + Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(`${detail.harga_menu}`).replace(/,00$/, '') + '/pcs</small></td>';
                        html += '<td><small class="'+changeColorIfunpaid+'"><b>' + detail.status_detail + '</b></small></td>';
                        html += '</tr>';
                    });
                    html += '</table>';
                    html += '<span class="badge bg-dark mx-2 py-2">Total: ' + Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(`${order.order_total}`).replace(/,00$/, '') + '</span>';
    
                    var allDetailsCompleted = order.order_items.every(function(detail) {
                        return detail.status_detail === 'selesai';
                    });
    
                    if (allDetailsCompleted) {
                        html += '<div class="alert alert-primary mx-3 mt-3" role="alert">';
                        html += '<small><b>Harap klik tombol \"Selesaikan\" jka status pesanan \"selesai\" semua</b></small>';
                        html += '</div><button id="finishOrder" data-idorder='+order.id_order+' class="btn btn btn-primary mx-2 mb-2"><b>Selesaikan</b></button>';
                    };
                    html += '</div>';
                };

            });
        } else {
            html+= '<div class="alert alert-info d-flex align-items-center" role="alert"><i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i><div>Pesanan yang sudah anda konfirmasi di keranjang akan ditampilkan di sini.</div></div>'
        }

        $('#order-view').html(html);
    }

    $(document).ready(function() {
        fetchOrders();
    });

    $(document).on('click','#finishOrder', function(e) {
        e.preventDefault();

        var idOrder = $(this).data('idorder');

        $.ajax({
            url: '<?= base_url('main/finish_orders/') ?>' + idOrder,
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