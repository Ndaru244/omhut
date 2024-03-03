    <main class="container">
        <div class="d-flex align-items-center justify-content-center" style="height: 70vh;">
            <div class="card border-0 rounded-4 shadow">
                <div class="card-body">
                    <h5 class="card-title text-center"><b>Form Pemesanan</b></h5>
                    <p class="text-muted text-center small">Silahkan isi form ini sebelum memesan.</p>
                    
                    <hr class="border border-secondary-subtle rounded-5 border-2 opacity-25">

                    <div class="form-floating ">
                        <input type="text" class="form-control bg-body-secondary border-0 rounded-3" name="nama_pelanggan" id="nama_pelanggan" autocomplete="off" placeholder="Masukan Nama Anda">
                        <label for="nama_pelanggan">Masukan Nama Anda</label>
                    </div>

                    <div class="input-group mt-2">
                        <div class="form-floating">
                            <input type="text" class="form-control bg-body-secondary border-0 rounded-start-3" name="kd_meja" id="kd_meja" autocomplete="off" placeholder="Meja" readonly style="cursor: not-allowed! important;">
                            <label for="kd_meja">Pilih Meja</label>
                        </div>
                        <button id="btn-scan" class="input-group-text btn btn-primary border-0 rounded-end-3" data-bs-toggle="modal" data-bs-target="#modal-scan">
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                                <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                                <path d="M12 9h2V8h-2v1Z" />
                            </svg>
                            &nbsp;
                        </button>
                    </div>
                    <div class="d-grid">
                        <button id="login" class="btn btn-lg btn-primary d-grid rounded-3 mt-4"><b>Lanjutkan</b></button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal-scan" tabindex="-1" aria-labelledby="btn-scanLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" id="-">
                <div class="modal-header">
                    <h1 class="modal-title mx-auto fs-5" id="btn-scanLabel"><b>Scan QR Meja</b></h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="img-fluid rounded" id="preview" width="100%" height="100px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col">
                        <button type="button" id="cencel-scan" class="btn btn-lg btn-danger btn-block" data-bs-dismiss="modal"><b>Batal</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
    
    function onScanSuccess(decodedText, decodedResult) {
      // handle the scanned code as you like, for example:
        <?php
        $json = [];
        for ($i = 0; $i < count($kodes); $i++) {
            $data = $kodes[$i]->kd_meja;
            $json[] = array('kd_meja' => $data);
        }
        
        $datas = json_encode($json);
        echo "var dataNames = $datas;";
        ?>
        var matchFound = false
        
        for (var i = 0; i < dataNames.length; i++) {
            if (decodedText === dataNames[i].kd_meja) {
                console.log(dataNames[i].kd_meja);
                matchFound = true;
                break;
            }
        }
        if (matchFound) {
            document.getElementById('kd_meja').value = decodedText;
            $('#modal-scan').modal('hide')
            html5QrcodeScanner.clear();
        } else {
            toastr["error"]("Kode QR bukan merupakan kode meja Om Hut Parkopi.", "Peringatan")
            $('#modal-scan').modal('hide')
            html5QrcodeScanner.clear();
        }
    }

    function onScanFailure(error) {
      // handle scan failure, usually better to ignore and keep scanning.
      // for example:info
      // console.warn(`Code scan error = ${error}`);
    //   var infoDiv = document.getElementById("info");
    //   infoDiv.textContent = "Tidak ada QR yang tedeteksi.";
    }

    let config = {
      fps: 10,
      qrbox: {width: 250, height: 250},
      rememberLastUsedCamera: true,
      formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
      showTorchButtonIfSupported: true,
      // Only support camera scan type.
      supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
    };
    let html5QrcodeScanner = new Html5QrcodeScanner(
    "preview", config,
    /* verbose= */ false);

    $(document).on('click','#btn-scan', function(e){
      e.preventDefault()

      html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    })

    $(document).on("click", "#cencel-scan", function (e){
        e.preventDefault()
        
        html5QrcodeScanner.clear();
      })
  </script>

  <script>
        $(document).ready(function() {
            $(document).on("click", "#login", function(e) {
                e.preventDefault();

                var nama_pelanggan = $('#nama_pelanggan').val()
                var kd_meja = $('#kd_meja').val()
                $.ajax({
                    url: '<?= base_url('main/auth_meja') ?>',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        nama_pelanggan: nama_pelanggan,
                        kd_meja: kd_meja
                    },
                    success: function(data) {
                        if (data.responce === 'success') {
                            toastr["success"]('selamat datang', "Berhasil")
                            setTimeout(function() {
                                window.location.href = '<?= base_url('main/home')?>';
                            },500)
                        } else {
                            toastr["error"](data.message, "Gagal")
                            // console.log(data)
                        }
                    }
                });
            })
        })
    </script>