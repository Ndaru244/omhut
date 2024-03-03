    <main class="container mb-5">
        <div class="row mt-2">
            <div class="col-1">
                <h3>
                    <a class="text-dark" href="#" onclick="window.history.go(-1); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                </h3>
            </div>
            <div class="col-11">
                <h3 class="text-center"><b>Keranjang Pesanan</b></h3>
            </div>
            <hr class="border border-secondary border-1 opacity-25">
        </div>
        <!-- <h6 class="bg-light p-2 border-top border-bottom">Pesanan Anda</h6> -->
        <div class="card border-0 rounded-3 shadow-sm mb-5">
            <div class="row mt-0">
                <div class="col-lg ">
                    <?php $cart = $this->session->userdata('cart') ?? []; ?>
                    <?= empty($cart) ? '
                    <div class="alert alert-warning" role="alert"> 
                        <b>Keranjang Kosong</b>
                    </div>
                    ':'
                    <div class="alert alert-primary" role="alert"> 
                        Klik pada list menu pesanan jika ingin mengubah jumlah pesanan atau ingin menghapus list.
                    </div>
                    '?>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-top-3">

                    <?php
                    
                    $total = 0;
                    foreach ($cart as $data) :
                        $id = array('id_menu'=> $data['menuId']);
                        $getData = $this->Main_model->getDataByID('menu',$id);
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center btn-open-modal" data-bs-toggle="modal" data-bs-target="#detailCart" data-item-id="<?= $getData->id_menu ?>" data-item-image="<?= $getData->gambar_menu ?>" data-item-name="<?= $getData->nama_menu ?>" data-item-price="<?= $getData->harga_menu ?>" data-item-quantity="<?= $data['jumbel'] ?>">
                        <div class="d-flex align-items-center">
                            <img style="max-width: 100px" src="<?= base_url("assets/images/").$getData->gambar_menu ?>" class="img-fluid rounded" alt="...">
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?= $getData->nama_menu ?></p>
                                <p class="text-muted mb-0">Rp.<?= number_format($getData->harga_menu, 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <span class="badge bg-secondary rounded-pill">&times;&nbsp;<?= $data['jumbel'] ?></span>
                    </li>
                    <?php
                    $total += $getData->harga_menu * $data['jumbel'];
                    endforeach
                    ?>

                    <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="ms-0">
                                <p class="fw-bold mb-0">Total Bayar:&nbsp;</p>
                            </div>
                        </div>
                        <span class="badge bg-white text-dark rounded-pill">Rp.<?= number_format($total, 0, ',', '.') ?></span>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-white">
                <div class="mt-2 d-grid">
                    <?= empty($cart) ? '
                    <a href="'.base_url('main/home').'" class="btn btn-lg btn-primary d-grid"><b>Pilih Menu</b></a>
                    ' : '
                    <button type="button" id="confirm_order" class="btn btn-lg btn-primary d-grid"><b>Konfirmasi Pesanan</b></button>
                    ' ?>
                    
                </div>
            </div>
        </div>

    </main>

    <!-- Modal -->
    <div class="modal fade" id="detailCart" data-bs-backdrop="static" aria-labelledby="detailDrinkLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="updateForm">
                <div class="modal-header">
                    <h5 class="modal-title modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card border-0 rounded-3 shadow-sm mb-3" style="max-width: 100%;">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <div class="card-body border-0 p-0">
                                            <img src="" id="item-image" class="img-fluid rounded-3" alt="">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body">
                                            <h4 class="card-title" id="item-name"></h4>
                                            <p class="card-subtitle small text-body-secondary" id="item-price"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm">
                            <div class="card border-0 rounded-botto-3 shadow-sm mb-2">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="form-floating mb-2">
                                            <input type="number" class="form-control bg-body-secondary border-0 rounded-3" autocomplete="off" name="item-quantity" id="item-quantity" min=1 value="1" required>
                                            <label for="item-quantity">Jumlah Beli</label>
                                        </div>
                                        <input type="hidden" id="item-id" name="menuId">
                                        <small class="text-wrap fw-light text-primary">
                                            Silahkan ubah jumlah beli jika ingin menambahkan atau mengurangi pesanan. dan tekan tombol simpan untuk mengubah data.
                                        </small>
                                        <br>
                                        <small class="text-wrap fw-light text-danger mt-2">
                                            Silahkan klik tombol hapus jika ingin menghapus pesanan.
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col">
                        <a id="del" class="btn btn-danger btn-block"><b>Hapus</b></a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block"><b>Ubah</b></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.btn-open-modal').click(function () {
                var itemId = $(this).data('item-id');
                var itemImage = "<?= base_url('assets/images/') ?>"+$(this).data('item-image');
                var itemName = $(this).data('item-name');
                var itemPrice = Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0, maximumFractionDigits: 0, }).format($(this).data('item-price'))+"/pcs";
                var itemQuantity = $(this).data('item-quantity');

                $('#detailCart .modal-title').text(itemName);
                $('#detailCart #del').data('value', itemId);
                $('#detailCart #item-id').val(itemId);
                $('#detailCart #item-image').attr('src',itemImage);
                $('#detailCart #item-name').text(itemName);
                $('#detailCart #item-price').text(itemPrice);
                $('#detailCart #item-quantity').val(itemQuantity);

                // console.log('Nilai pada elemen dengan ID del:', $('#detailCart #del').data('value'));
            })

            $('#updateForm').submit(function (e) {
                e.preventDefault();
    
                var menuId = $('#item-id').val();
                var jumbel = $('#item-quantity').val();
                // console.log(jumbel)
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('main/update_cart'); ?>',
                    data: {
                        menuId: menuId,
                        jumbel: jumbel
                    },
                    success: function (response) {
                        $('#detailCart').modal('hide');
                        toastr["success"]('list sudah di update', "Berhasil")
                        setTimeout(function() {
                            window.location.href = '<?= base_url('main/keranjang')?>';
                        },100)
                        // console.log(response)
                    },error: function() {
                        console.log("error")
                    }
                })
            })

            $(document).on("click", "#del", function(e) {
                e.preventDefault()
                
                var menuId = $(this).data("value")
                console.log(menuId)
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-lg btn-success fw-bold mx-1',
                    cancelButton: 'btn btn-lg btn-danger fw-bold mx-1'
                },
                buttonsStyling: false
                })
    
                swalWithBootstrapButtons.fire({
                title: "Kamu Yakin?",
                text: "Pesanan akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batalkan!',
                reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url: "<?= base_url('main/remove_from_cart') ?>",
                        type: "POST",
                        data: {
                            menuId : menuId
                        },
                            success: function(data) {
                                if (data === "success") {
                                    setTimeout(function() {
                                        window.location.href = '<?= base_url('main/keranjang')?>';
                                    },100)
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

            $(document).on("click", "#confirm_order", function(e) {
                e.preventDefault()
    
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: 'btn btn-lg btn-success fw-bold mx-1',
                    cancelButton: 'btn btn-lg btn-danger fw-bold mx-1'
                    },
                    buttonsStyling: false
                })
    
                swalWithBootstrapButtons.fire({
                    title: "Konfirmasi pesanan?",
                    text: "Pesanan yang sudah di konfirmasi akan di tampilkan di halaman utama!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Konfirmasi',
                    cancelButtonText: 'Batalkan!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?=base_url('main/confirm_order')?>',
                            type: 'POST',
                            success: function(response) {
                                if(response === 'success') {
                                    swalWithBootstrapButtons.fire(
                                    'Sukses!',
                                    'Konfirmasi pesanan sukes.',
                                    'success',
                                    )
                                    setTimeout(function() {
                                        window.location.href = '<?=base_url('main/home')?>'
                                    },100)
                                } else {
                                    swalWithBootstrapButtons.fire(
                                    'Gagal!',
                                    'Gagal Konfirmasi pesanan.',
                                    'error'
                                    )
                                }
                            },
                            error: function () {
                            }
                        })
                    }
                })
            })
        })
    </script>