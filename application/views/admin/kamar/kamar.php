
<style>
    .btn-modern {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(59,130,246,0.3);
        transition: all 0.3s ease;
    }
    .btn-modern:hover {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(59,130,246,0.4);
        color: #fff;
    }
    .btn-modern i {
        margin-right: 6px;
    }
</style>


<a href="<?= site_url('admin/chat') ?>" class="chat-btn">
  <i class="bi bi-chat-dots-fill"></i>
</a>

<style>
  .chat-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4f46e5, #3b82f6); /* sesuai btn-modern */
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;   /* proporsional */
    line-height: 1;
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
    z-index: 9999;
    text-decoration: none;
  }

  .chat-btn:hover {
    background: linear-gradient(135deg, #3b82f6, #2563eb); /* hover btn-modern */
    transform: scale(1.1) translateY(-2px);
    box-shadow: 0 6px 14px rgba(59, 130, 246, 0.4);
    color: #fff;
  }

  .chat-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>


<body>
    <script src="<?= base_url('assets/dist/assets/static/js/initTheme.js') ?>"></script>

    <div id="app">
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
                <h3>Data Kamar</h3>
                <p class="text-subtitle text-muted">Tabel data kamar yang dapat diurutkan, dicari, dan dipaginasi secara interaktif.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kamar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Kamar
                </h5>
                <a href="<?= site_url('admin/kamar/tambah_kamar') ?>" 
           class="btn-modern">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. Kamar</th>
                            <th>Harga</th>
                            <th>Fasilitas</th>
                            <th>Lantai</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Graiden</td>
                            <td>vehicula.aliquet@semconsequat.co.uk</td>
                            <td>076 4820 8838</td>
                            <td>Offenburg</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Dale</td>
                            <td>fringilla.euismod.enim@quam.ca</td>
                            <td>0500 527693</td>
                            <td>New Quay</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nathaniel</td>
                            <td>mi.Duis@diam.edu</td>
                            <td>(012165) 76278</td>
                            <td>Grumo Appula</td>
                            <td>
                                <span class="badge bg-danger">Inactive</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Darius</td>
                            <td>velit@nec.com</td>
                            <td>0309 690 7871</td>
                            <td>Ways</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Oleg</td>
                            <td>rhoncus.id@Aliquamauctorvelit.net</td>
                            <td>0500 441046</td>
                            <td>Rossignol</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kermit</td>
                            <td>diam.Sed.diam@anteVivamusnon.org</td>
                            <td>(01653) 27844</td>
                            <td>Patna</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Jermaine</td>
                            <td>sodales@nuncsit.org</td>
                            <td>0800 528324</td>
                            <td>Mold</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Ferdinand</td>
                            <td>gravida.molestie@tinciduntadipiscing.org</td>
                            <td>(016977) 4107</td>
                            <td>Marlborough</td>
                            <td>
                                <span class="badge bg-danger">Inactive</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kuame</td>
                            <td>Quisque.purus@mauris.org</td>
                            <td>(0151) 561 8896</td>
                            <td>Tresigallo</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Deacon</td>
                            <td>Duis.a.mi@sociisnatoquepenatibus.com</td>
                            <td>07740 599321</td>
                            <td>Karapınar</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Channing</td>
                            <td>tempor.bibendum.Donec@ornarelectusante.ca</td>
                            <td>0845 46 49</td>
                            <td>Warrnambool</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Aladdin</td>
                            <td>sem.ut@pellentesqueafacilisis.ca</td>
                            <td>0800 1111</td>
                            <td>Bothey</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Cruz</td>
                            <td>non@quisturpisvitae.ca</td>
                            <td>07624 944915</td>
                            <td>Shikarpur</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Keegan</td>
                            <td>molestie.dapibus@condimentumDonecat.edu</td>
                            <td>0800 200103</td>
                            <td>Assen</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Ray</td>
                            <td>placerat.eget@sagittislobortis.edu</td>
                            <td>(0112) 896 6829</td>
                            <td>Hofors</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Maxwell</td>
                            <td>diam@dapibus.org</td>
                            <td>0334 836 4028</td>
                            <td>Thane</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Carter</td>
                            <td>urna.justo.faucibus@orci.com</td>
                            <td>07079 826350</td>
                            <td>Biez</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Stone</td>
                            <td>velit.Aliquam.nisl@sitametrisus.com</td>
                            <td>0800 1111</td>
                            <td>Olivar</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Berk</td>
                            <td>fringilla.porttitor.vulputate@taciti.edu</td>
                            <td>(0101) 043 2822</td>
                            <td>Sanquhar</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Philip</td>
                            <td>turpis@euenimEtiam.org</td>
                            <td>0500 571108</td>
                            <td>Okara</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kibo</td>
                            <td>feugiat@urnajustofaucibus.co.uk</td>
                            <td>07624 682306</td>
                            <td>La Cisterna</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Bruno</td>
                            <td>elit.Etiam.laoreet@luctuslobortisClass.edu</td>
                            <td>07624 869434</td>
                            <td>Rocca d"Arce</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Leonard</td>
                            <td>blandit.enim.consequat@mollislectuspede.net</td>
                            <td>0800 1111</td>
                            <td>Lobbes</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Hamilton</td>
                            <td>mauris@diam.org</td>
                            <td>0800 256 8788</td>
                            <td>Sanzeno</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Harding</td>
                            <td>Lorem.ipsum.dolor@etnetuset.com</td>
                            <td>0800 1111</td>
                            <td>Obaix</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Emmanuel</td>
                            <td>eget.lacus.Mauris@feugiatSednec.org</td>
                            <td>(016977) 8208</td>
                            <td>Saint-Remy-Geest</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

 