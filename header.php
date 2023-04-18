<?php
require 'session_login.php';
require 'database.php';
require 'csrf_token.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
HAYO NGAPAIN LIAT LIAT NIH ? MAU NGECOPY KAH? BELI DONG SCRIPTNYA CUMA 2JT (MAU SEWA PANELNYA JUGA BISA)
Pembuat : Marshep Ollo [Mrsh Code]
Release Date : 28 Juni 2021
Update At : 14 Mei 2022
© Dilarang Keras Mengedit/Menghapus Semuanya ©
Ganti Copyright Ga Sesusah Bikin Script.
Hargai Kami Dengan Jangan Mengganti Copyright.
UU: Nomor 28 Tahun 2014 Tentang Hak Cipta
FREE UPDATE JIKA BELI LANGSUNG DI MRSHCODE, SELAIN DI MRSHCODE TIDAK ADA UPDATE TERIMAKASIH!!!
-->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $data['title']; ?></title>
        <meta content="<?php echo $data['deskripsi_web']; ?>" name="description"/>
        <meta content="MrshCode" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo $config['web']['url'] ?>assets/images/favicon.ico">
        <!-- DataTables -->
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/plugins/select2/css/select2.min.css">
        <!-- Responsive datatable examples -->
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
      <!-- Start Script JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <!-- End Script JS -->
        <!-- Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/plugins/morris/morris.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="<?php echo $config['web']['url'] ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $config['web']['url'] ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $config['web']['url'] ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
    <body class="fixed-left">
        <div id="wrapper">
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>
                <div class="left-side-logo d-block d-lg-none">
                    <div class="text-center">
                        <a href="<?php echo $config['web']['url']; ?>" class="logo text-blue"><?php echo $data['short_title']; ?></a>
                    </div>
                </div>
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Dashboard</li>
<?php
if (isset($_SESSION['user'])) {
?>    
<?php
if ($data_user['level'] == "Developers") {
?>            
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>admin-dashboard" class="waves-effect">
                                    <i class="dripicons-user"></i>
                                    <span> Admin</span>
                                </a>
                            </li>
<?php } ?>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>" class="waves-effect">
                                    <i class="dripicons-home"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>user/upgrade-level" class="waves-effect">
                                    <i class="mdi mdi-account-convert m-r-5 text-muted"></i>
                                    <span> Upgrade Level</span>
                                </a>
                            </li>
<?php
if ($data_user['level'] != "Member") {
?> 
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i> <span> Premium </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>staff/tambah-pengguna">Tambah Pengguna</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>staff/transfer-saldo">Transfer Saldo</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>staff/kode-voucher">Buat Voucher</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>riwayat/transfer-saldo">Riwayat Transfer</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>riwayat/kode-voucher">Riwayat Voucher</a></li>
                                </ul>
                            </li>
<?php } ?>                  
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>hof" class="waves-effect">
                                    <i class="dripicons-trophy"></i>
                                    <span> Hall Of Fame</span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-cart"></i><span> Pemesanan </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>pemesanan/">Pemesanan Baru</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>riwayat/pemesanan">Riwayat</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-wallet"></i><span> Deposit </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>deposit/">Baru</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>deposit/redeem-voucher">Voucher</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>riwayat/deposit">Riwayat</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-ticket"></i><span> Tiket </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>tiket/index">Baru</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>tiket/list"><span> Tiket </span> <?php if (mysqli_num_rows($CallDBTiket) !== 0) { ?><span class="badge badge-primary"><?php echo mysqli_num_rows($CallDBTiket); ?></span><?php } ?> </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>monitor" class="waves-effect">
                                    <i class="dripicons-monitor"></i>
                                    <span> Monitor</span>
                                </a>
                            </li>
                            <li class="menu-title">Halaman</li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>halaman/kontak-kami" class="waves-effect">
                                    <i class="dripicons-phone"></i>
                                    <span> Kontak Admin </span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-pamphlet"></i><span> Halaman </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/tos">Ketentuan Layanan</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/faq">Pertanyaan Umum</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/status">Penjelasan Status</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/nondrop">Penjelasan Nondrop</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/deposit">Cara Deposit</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/transaksi">Cara Transaksi</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/untung">Cara Meraih Untung</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/target">Contoh Target</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/panel">Sewa Panel</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>halaman/layanan" class="waves-effect">
                                    <i class="dripicons-tag"></i>
                                    <span> Price List</span></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>halaman/api-dokumentasi" class="waves-effect">
                                    <i class="dripicons-code"></i>
                                    <span> Api Dokumentasi</span>
                                </a>
                            </li>
                        <li>
                    </div>
                <div class="clearfix"></div>
            </div>
        </div>
                                                        
<?php
} else {
?>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>" class="waves-effect">
                                    <i class="dripicons-home"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>auth/login" class="waves-effect">
                                    <i class="dripicons-enter"></i>
                                    <span> Login</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>auth/register" class="waves-effect">
                                    <i class="mdi mdi-account-multiple-plus"></i>
                                    <span> Register</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>auth/forgot-password" class="waves-effect">
                                    <i class="mdi mdi-account-key"></i>
                                    <span> Forgot Password</span>
                                </a>
                            </li>
                            <li class="menu-title">Halaman</li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>halaman/kontak-kami" class="waves-effect">
                                    <i class="dripicons-phone"></i>
                                    <span> Kontak Admin </span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-pamphlet"></i><span> Halaman </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/tos">Ketentuan Layanan</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/faq">Pertanyaan Umum</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/status">Penjelasan Status</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/nondrop">Penjelasan Nondrop</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/deposit">Cara Deposit</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/transaksi">Cara Transaksi</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/untung">Cara Meraih Untung</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/target">Contoh Target</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/panel">Sewa Panel</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-tag"></i><span> Daftar Layanan </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/layanan">Server 1</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>halaman/layanan_s2">Server 2</a></li>
                                </ul>
                            </li>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
                             
<?php } ?>                  
            <div class="content-page">
                <div class="content">
                    <div class="topbar">
                        <div class="topbar-left	d-none d-lg-block">
                            <div class="text-center">
                                <a href="<?php echo $config['web']['url']; ?>" class="logo text-white"><?php echo $data['short_title']; ?></a>
                            </div>
                        </div>
                        <nav class="navbar-custom">
<?php
if (isset($_SESSION['user'])) {
?>
                            <ul class="list-inline float-right mb-0">
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="<?php echo $config['web']['url'] ?>assets/images/avatar-1.png" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                        <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>user/profile"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>user/pemakaian-saldo"><i class="mdi mdi-cash-multiple m-r-5 text-muted"></i> Mutasi Saldo</a>
                                        <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>user/log"><i class="mdi mdi-history m-r-5 text-muted"></i> Log Aktivitas</a>
                                        <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>
<?php } ?>
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div><div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="page-title text-capitalize"><?php echo $data['short_title']; ?></h5>
                                </div>
                            </div>
                            <!-- end row -->
<?php
if (isset($_SESSION['hasil'])) {
?>
<div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> alert-dismissible fade show" role="alert">
             <div class="alert-body">
              <strong>Respon : </strong><?php echo $_SESSION['hasil']['judul'] ?><br /> <strong>Pesan : </strong> <?php echo $_SESSION['hasil']['pesan'] ?>
                </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                  </button>
                 </div>
<?php
unset($_SESSION['hasil']);
}
?> 