<main class="container mt-2">
        <div class="row">
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

                <h3 class="text-center"><b>Menu Makanan</b></h3>
            </div>
            <hr class="border border-secondary border-1 opacity-25">
        </div>

        <div class="row">
                <?= empty($foods) ? '
                <div class="col-lg mb-2">
                <div class="alert alert-danger" role="alert"> 
                    Tidak Ada Data!
                </div>
                </div>
                ' : '' ?>
        <?php
        foreach($foods as $food) :
        ?>
            <div class="col-lg-6" data-item-id="<?= $food->id_menu ?>">
                <div class="card rounded-3 border-0 shadow-sm mb-2" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="card-body border-0 p-0">
                                <img src="<?= base_url('assets/images/').$food->gambar_menu; ?>" class="img-fluid rounded-3" alt="">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h3 class="card-title"><b><?= $food->nama_menu; ?></b></h3>
                                <p class=" card-subtitle text-body-secondary">Rp.<?= number_format($food->harga_menu, 0, ',', '.'); ?></p>
                                <p class="card-text pt-2"><small class="text-body-secondary d-grid gap-2">
                                <?= $food->status_menu!='tersedia' ? '
                                <button type="button" class="btn btn-danger"><b>Kosong</b></button>
                                ' : '
                                <button type="button" data-bs-toggle="modal" data-bs-target="#detailFood" class="btn btn-primary btn-open-modal" data-item-id="'.$food->id_menu.'" data-item-image="'.$food->gambar_menu.'" data-item-name="'.$food->nama_menu.'" data-item-price="'.$food->harga_menu.'"><b>Pesan</b></button>
                                ' ?>
                                </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach
        ?>
        </div>
    </main>
    <br><br>
    
    <!-- Modal -->
    <div class="modal fade" id="detailFood" data-bs-backdrop="static" aria-labelledby="detailDrinkLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered border-0">
            <div class="modal-content">
                <form id="orderForm">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
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
                                            <input type="number" class="form-control bg-body-secondary border-0 rounded-3" autocomplete="off" id="jumbel" min=1 value="1" required>
                                            <label for="jumbel">Jumlah Beli</label>
                                        </div>
                                        <input type="hidden" id="item-id" name="menuId">
                                        <small class="text-wrap fw-light text-primary">
                                            Silahkan isi jumlah yang inigin di pesan.
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-block" data-bs-dismiss="modal"><b>Batal</b></button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block"><b>Pesan</b></button>
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

                $('#detailFood .modal-title').text(itemName);
                $('#detailFood #item-id').val(itemId);
                $('#detailFood #item-image').attr('src',itemImage);
                $('#detailFood #item-name').text(itemName);
                $('#detailFood #item-price').text(itemPrice);
            })
            
            $('#orderForm').submit(function (e) {
                    e.preventDefault();

                    var menuId = $('#item-id').val();
                    var jumbel = $('#jumbel').val();

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('main/add_to_cart'); ?>',
                        data: {
                            menuId: menuId,
                            jumbel: jumbel
                        },
                        success: function (response) {
                            $('#detailFood').modal('hide');
                            toastr["success"]('sudah ditambahkan ke keranjang', "Berhasil")
                            setTimeout(function() {
                                window.location.href = '<?= base_url('main/menu_makanan')?>';
                            },100)
                            // console.log(response)
                        },error: function() {
                            console.log("error")
                        }
                    })
                })
        })
    </script>