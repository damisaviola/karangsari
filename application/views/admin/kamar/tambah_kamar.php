<body>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Tambah Kamar</h3>
        <p class="text-subtitle text-muted">
          Silakan lengkapi form di bawah ini untuk menambahkan data kamar baru.
        </p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav
          aria-label="breadcrumb"
          class="breadcrumb-header float-start float-lg-end"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kamar') ?>">Kamar</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Tambah Kamar</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tambah Kamar</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form" data-parsley-validate>
              <div class="row">
                <div class="col-12">
                  <div class="form-group mandatory">
                    <label for="no-kamar" class="form-label">No. Kamar</label>
                    <input
                      type="text"
                      id="no-kamar"
                      class="form-control"
                      placeholder="Masukkan nomor kamar"
                      name="no_kamar"
                      data-parsley-required="true"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="tipe-kamar" class="form-label">Tipe Kamar</label>
                    <input
                      type="text"
                      id="tipe-kamar"
                      class="form-control"
                      placeholder="Contoh: Deluxe, Standard"
                      name="tipe_kamar"
                      data-parsley-required="true"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="tipe-kamar" class="form-label">Status</label>
                    <input
                      type="text"
                      id="tipe-kamar"
                      class="form-control"
                      placeholder="Contoh: Deluxe, Standard"
                      name="tipe_kamar"
                      data-parsley-required="true"
                    />
                  </div>
                </div>


                 <div class="col-12">
                  <div class="form-group">
                    <label for="tipe-kamar" class="form-label">Lantai</label>
                    <input
                      type="text"
                      id="tipe-kamar"
                      class="form-control"
                      placeholder="Contoh: Deluxe, Standard"
                      name="tipe_kamar"
                      data-parsley-required="true"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="tipe-kamar" class="form-label">Luas</label>
                    <input
                      type="text"
                      id="tipe-kamar"
                      class="form-control"
                      placeholder="Contoh: Deluxe, Standard"
                      name="tipe_kamar"
                      data-parsley-required="true"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="harga" class="form-label">Harga per Malam</label>
                    <input
                      type="number"
                      id="harga"
                      class="form-control"
                      placeholder="Masukkan harga"
                      name="harga"
                      data-parsley-required="true"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="fasilitas" class="form-label">Fasilitas</label>
                    <textarea
                      id="fasilitas"
                      class="form-control"
                      placeholder="Masukkan fasilitas kamar"
                      name="fasilitas"
                      rows="3"
                      data-parsley-required="true"
                    ></textarea>
                  </div>
                </div>
                
                  <div class="col-12">
                    <div class="form-group">
                      <label for="gambar" class="form-label">Upload Gambar</label>
                      <input 
                        type="file" 
                        id="gambar" 
                        class="image-preview-filepond form-control" data-max-file-size="2MB" 
                        name="gambar"
                        data-parsley-required="true"
                      >
                      <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                    </div>
                  </div>

                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary me-1 mb-1">
                    Simpan
                  </button>
                  <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                    Reset
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- // Basic multiple Column Form section end -->
</div>

          