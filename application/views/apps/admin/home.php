<main class="container-fluid">
    <div class="row mt-4">
      <div class="col-lg-4 mb-2">
        <div class="card text-light border-0 rounded-3 shadow">
          <div class="card-header bg-white">
            <div class="card mt-3 rounded-3 border-2 border-white px-3">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <img src="<?= base_url('assets/images/systems/profile-picture.png') ?>" alt="" style="width: 80; height: 80px"
                    class="rounded-circle" />
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
              <!-- <li class="list-group-item border-0 text-bg-primary rounded-3 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg>
                <b>Edit Profil</b>
              </li> -->

              <a href="" id="logout">
                <li class="list-group-item border-0 text-bg-danger rounded-3 mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                    <path fill-rule="evenodd"
                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                  </svg>
                  <b>Log out</b>
                </li>
              </a>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <hr class="border border-tertiary border-1 opacity-25">
        <!-- <div class="card border-0 shadow-sm" style="background-color: #fff;">test</div> -->
        <div class="row">

          <div class="col-6">
            <a class="link-custom" href="<?=base_url('admin/menu')?>">
              <div class="card border-0 shadow-sm mb-2 text-center menus-card">
                <div class="card-body">
                  <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-card-list mb-2" viewBox="0 0 16 16">
                      <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                      <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>
                    <p class="h5"><b>Data Menu</b></p>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a class="link-custom" href="<?=base_url('admin/meja')?>">
              <div class="card border-0 shadow-sm mb-2 text-center menus-card">
                <div class="card-body">
                  <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-square mb-2" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    </svg>
                    <p class="h5"><b>Data Meja</b></p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6">
            <a class="link-custom" href="<?=base_url('admin/report')?>">
              <div class="card border-0 shadow-sm mb-2 text-center menus-card">
                <div class="card-body">
                  <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cash-stack mb-2" viewBox="0 0 16 16">
                      <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                      <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                    </svg>
                    <p class="h5"><b>Report</b></p>
                  </div>
                </div>
              </div>
            </a>
            </div>
          <div class="col-6">
          <a class="link-custom" href="<?=base_url('admin/warehouse')?>">
            <div class="card border-0 shadow-sm mb-2 text-center menus-card">
              <div class="card-body">
                <div class="card-title">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-boxes mb-2" viewBox="0 0 16 16">
                    <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
                  </svg>
                  <p class="h5"><b>Laporan Data Gudang</b></p>
                </div>
              </div>
            </div>
          </a>
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
      }).then((result) =>{
        if (result.isConfirmed === true) {
            swalWithBootstrapButtons.fire(
              'Sukses!',
              'Kamu Berhasil Logout.',
              'success'
            )

          setTimeout(function() {
            window.location.href = '<?=base_url('auth/logout')?>'
          },2000)
        }

      })
    })
  </script>