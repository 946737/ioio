<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="<?= (website_config('meta_description')) ? website_config('meta_description') : $config['meta']['description'] ?>" />
    <meta name="keywords"
        content="<?= (website_config('meta_keywords')) ? website_config('meta_keywords') : $config['meta']['keywords'] ?>" />
    <meta name="author"
        content="<?= (website_config('meta_author')) ? website_config('meta_author') : $config['meta']['author'] ?>" />
    <title><?= (website_config('bartitle')) ? website_config('bartitle') : $config['bartitle'] ?></title>    
    	<link rel="shortcut icon" type="image/x-icon" href="<?= (website_config('favicon')) ? website_config('favicon') : $config['favicon'] ?>">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link href="<?= base_url('assets/vertical/') ?>js/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/vertical/') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/vertical/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/vertical/') ?>css/app.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/vertical/') ?>libs/jquery/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <style>
        .hide {display:none !Important;}
    </style>
    <style>.select2-selection__rendered{line-height:42px!important}.select2-container .select2-selection--single{height:38px!important}.select2-selection__arrow{height:38px!important}.hidden{display:none!important
    </style>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1328298087513302" crossorigin="anonymous"></script>
</head>

<body data-topbar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?= base_url() ?>" class="logo logo-dark">
                            <span class="logo-sm font-weight-bold text-uppercase">
                            <!--<?= (website_config('title')) ? website_config('title') : $config['title'] ?>-->
                            <img src="<?= base_url('/assets/zm1.png') ?>" width="40px" alt="<?= (website_config('title')) ? website_config('title') : $config['title'] ?>" />
                            </span>
                            <span class="logo-lg font-weight-bold text-uppercase">
                            <!--<?= (website_config('title')) ? website_config('title') : $config['title'] ?>-->
                            <img src="<?= base_url('/assets/zm1.png') ?>" width="40px" alt="<?= (website_config('title')) ? website_config('title') : $config['title'] ?>" />
                            </span>
                        </a>

                        <a href="<?= base_url() ?>" class="logo logo-light">
                            <span class="logo-sm font-weight-bold text-uppercase">
                            <!--<?= (website_config('title')) ? website_config('title') : $config['title'] ?>-->
                            <img src="<?= base_url('/assets/zm1.png') ?>" width="40px" alt="<?= (website_config('title')) ? website_config('title') : $config['title'] ?>" />
                            </span>
                            <span class="logo-lg font-weight-bold text-uppercase">
                            <!--<?= (website_config('title')) ? website_config('title') : $config['title'] ?>-->
                            <img src="<?= base_url('/assets/zm1.png') ?>" width="40px" alt="<?= (website_config('title')) ? website_config('title') : $config['title'] ?>" />
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>
                    </button>

                    <!-- App Search-->
                </div>

                <div class="d-flex">


<?php if (user()) { ?>
    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-settings mdi-24px"></i>
                            <span class="d-none d-sm-inline-block ml-1"><?= user('full_name') ?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            
                            <a class="dropdown-item" href="<?= base_url('user/setting') ?>"><i
                                    class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Pengaturan Akun</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i
                                    class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                        </div>
                    </div>
<?php } ?>

                </div>
            </div>

        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <?php if (user()) { ?>
                            <?php if (user('level') <> 'Member') { ?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <div class="d-inline-block icons-sm mr-1"><i class="fa fa-users"></i></div>
                                        <span>Staff</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="<?= base_url('staff/add_user') ?>">Tambah Pengguna</a></li>
                                        <li><a href="<?= base_url('staff/balance_transfer') ?>">Transfer Saldo</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        <li>
                        <li>
                            <a href="<?= base_url() ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-view-dashboard"></i></div>
                                <span>Dashboard</span>
                            </a>
                        </li>
                       <!-- <li>
                            <a href="<?= base_url('page/hof') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="fa fa-trophy"></i></div>
                                <span>Top Terbaik</span>
                            </a>
                        </li> -->
                     <!--   <li>
                            <a href="<?= base_url('page/monitoring') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="fas fa-desktop"></i></div>
                                <span>Monitoring Layanan</span>
                            </a>
                        </li> ---> 
                        <li>           
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-cart"></i></div>
                                <span>Pemesanan</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= base_url('order/single') ?>">Pesan Baru</a></li>
                                <li><a href="<?= base_url('order/massal') ?>">Pesan Massal</a></li>
                                <li><a href="<?= base_url('order/history') ?>">Riwayat Pemesanan</a></li>
                                <li><a href="<?= base_url('order_refill/history') ?>">Riwayat Refill</a></li>
                                <li><a href="<?= base_url('order/graph') ?>">Grafik</a></li>
                            </ul>
                        </li>
                        <li>           
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-credit-card"></i></div>
                                <span>Deposit</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= base_url('deposit/new') ?>">Deposit Baru</a></li>
                                <li><a href="<?= base_url('deposit/history') ?>">Riwayat</a></li>
                            </ul>
                        </li>
                        <li>           
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-ticket"></i></div>
                                <span>Tiket<?php if ($unread_ticket > 0) { ?><span class="badge badge-warning badge-pill
                            "><?= $unread_ticket ?></span> <?php } ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= base_url('ticket/submit') ?>">Kirim</a></li>
                                <li><a href="<?= base_url('ticket') ?>">Daftar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= base_url('api/documentation') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="fa fa-book"></i></div>
                                <span>Dokumentasi API</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('page/price_list') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-format-list-bulleted-square"></i></div>
                                <span>Daftar Harga</span>
                            </a>
                        </li>
                       <!--  <li>
                            <a href="<?= base_url('page/tutor') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="fas fa-desktop"></i></div>
                                <span>Tutorial</span>
                            </a>
                        </li> -->
                        <li>           
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-file-multiple"></i></div>
                                <span>Log</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= base_url('user/log_login') ?>">Masuk</a></li>
                                <li><a href="<?= base_url('user/log_balance_usage') ?>">Penggunaan Saldo</a></li>
                                <li><a href="<?= base_url('user/setting') ?>">Pengaturan Akun</a></li>
                                <li><a href="<?= base_url('user/refferal') ?>">Refferal</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-file-multiple"></i></div>
                                <span>Sitemap</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                foreach ($page as $key => $value) {
                                    ?>
                                    <li><a href="<?= base_url('page/site/'.$value['slug']) ?>"><?= $value['title'] ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        <li>
                        <?php } else { ?>
                        <li>
                            <a href="<?= base_url() ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-home"></i></div>
                                <span>Halaman Utama</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('auth/login') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-login"></i></div>
                                <span>Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('auth/register') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-account-plus"></i></div>
                                <span>Daftar</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('page/price_list') ?>" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-format-list-bulleted-square"></i></div>
                                <span>Daftar Harga</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-file-multiple"></i></div>
                                <span>Sitemap</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                foreach ($page as $key => $value) {
                                    ?>
                                    <li><a href="<?= base_url('page/site/'.$value['slug']) ?>"><?= $value['title'] ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        <li>
                        <?php }  ?>
                        


                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                <!-- Page-Title -->
                <div class="page-title-box">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title mb-1"><?= (website_config('title')) ? website_config('title') : $config['title'] ?></h4>
                                <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="#"><?= (website_config('title')) ? website_config('title') : $config['title'] ?></a>
                                </li>
                                <?php if($this->uri->segment(1)) : ?>
                                <li class="breadcrumb-item text-uppercase">
                                    <a href="#"><?= $this->uri->segment(1) ?></a>
                                </li>
                                <?php endif; ?>
                                <?php if($this->uri->segment(2)) : ?>
                                <li class="breadcrumb-item text-uppercase active">
                                    <?= str_replace('_', ' ', $this->uri->segment(2)) ?>
                                </li>
                                <?php endif; ?>   
                                </ol>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                    
					<?php $this->load->view('result') ?>
					<?= $content ?>
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end page-content-wrapper -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <?= date('Y') ?> © <?= website_config('title') ?>.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by  <?= website_config('title') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/vertical/') ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/vertical/') ?>libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/vertical/') ?>libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('assets/vertical/') ?>libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url('assets/vertical/') ?>js/select2/select2.min.js"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script src="<?= base_url('assets/vertical/') ?>js/app.js"></script>
    <?php if (user()) { ?>
            <?php if(user('is_read_popup') == '0') { ?>
                     <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center"><i class="mdi mdi-bullhorn fa-fw"></i> Informasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body" style="max-height: 400px; overflow: auto;">
                      <?php if (count($info_popup) == 0) { ?>
                        <div class="alert alert-info text-center">Belum ada informasi yang ditampilkan.</div>
                      <?php } else {
                        foreach ($info_popup as $key => $value) {
                          ?>
                          <div class="card shadow">
                    <div class="card-body">
                        <span class="float-right">
                            <i class="fa fa-calendar fa-fw"></i><?= $this->lib->format_datetime($value['created_at']) ?>
                        </span>
                        <h3>

                            <?= $this->lib->status_info($value['category']) ?>
                        </h3>
                        <div class="card-body mt-2 mb-2">
                            <?= nl2br($value['content']) ?>
                        </div>
                    </div>
                </div>
                          <?php
                        }
                      }
                      ?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
											<button type="button" class="btn btn-primary" onclick="read_popup()"><i class="fa fa-thumbs-up fa-fw"></i> Saya Sudah Membaca</button>
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$('#modal-info').modal('show');
								function read_popup() {
									$.ajax({
										type: "GET",
										url: "<?= base_url('user/read_popup') ?>",
										success: function() {
											$('#modal-info').modal('hide');
										},
										error: function() {
											alert('Terjadi kesalahan, refresh halaman ini.');
										}
									});
								}
							</script>
						<?php } ?>
						<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-dialog-centered modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><i class="fa fa-search fa-fw"></i> Detail Data</h5>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body" id="modal-detail-body">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
</body>

</html>