<?php
//************************************************
//* Pembuat : Marshep Ollo [Mrsh Code]
//* Release Date : 28 Juni 2021
//* Website : Https://marshepollo.net
//* © Dilarang Keras Mengedit/Menghapus Semuanya ©
//* Ganti Copyright Ga Sesusah Bikin Script.
//* Hargai Kami Dengan Jangan Mengganti Copyright.
//* UU: Nomor 28 Tahun 2014 Tentang Hak Cipta
//************************************************
require 'session_login.php';
require 'database.php';
require 'csrf_token.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $data['title']; ?></title>
        <meta content="<?php echo $data['deskripsi_web']; ?>" name="description" />
        <meta content="MrshCode" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo $config['web']['url'] ?>assets/images/favicon.ico">
        <!-- DataTables -->
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo $config['web']['url'] ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>admin-dashboard" class="waves-effect">
                                    <i class="dripicons-home"></i>
                                    <span> Halaman Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>admin-dashboard/pengguna" class="waves-effect">
                                    <i class="dripicons-user"></i>
                                    <span> Daftar Pengguna</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>admin-dashboard/data_upgrade" class="waves-effect">
                                    <i class="mdi mdi-account-convert m-r-5 text-muted"></i>
                                    <span> Upgrade Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>admin-dashboard/tiket" class="waves-effect">
                                    <i class="dripicons-ticket"></i>
                                    <span>Daftar Tiket</span> <?php if (mysqli_num_rows($AllTiketUsers) !== 0) { ?><span class="badge badge-danger"><?php echo mysqli_num_rows($AllTiketUsers); ?></span><?php } ?></a></li>
                                </a>
                            </li>
                            <li class="menu-title">Menu</li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-cart"></i> <span> Menu Pemesanan </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/sosial-media">Riwayat</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/layanan-sosmed">Layanan</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/kategori-layanan">Kategori</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-wallet"></i><span> Menu Deposit </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/deposit_sosmed">Riwayat</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/metode-deposit">Metode</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/kode-voucher">Kode Voucher</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>zakycrons/auto_gopay">Mutasi Gopay</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-card"></i> <span> Daftar Ewallet </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/setting_gopay">Go-Pay</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-code"></i> <span> Menu Pusat </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/action-provider">Cek Status DLL</a></li>
                                    <li><a href="<?php echo $config['web']['url'] ?>admin-dashboard/provider_sosmed">Provider Sosmed</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">Aktifitas & Pengaturan</li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-pamphlet"></i><span> Aktifitas </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/aktifitas-pengguna">Aktivitas Pengguna</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/penggunaan-saldo">Penggunaan Saldo</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/transfer-saldo">Riwayat Transfer</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-gear"></i><span> Pengaturan </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/berita">Pengaturan Berita</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/pengaturan-website">Pengaturan Web</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/harga-pendaftaran">Harga Pendaftaran</a></li>
                                    <li><a href="<?php echo $config['web']['url']; ?>admin-dashboard/halaman-lain">Pengaturan Halaman</a></li></ul>
                                </ul>
                            </li>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
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
                    </div>
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="page-title text-center">Balik Kehalaman Member? <a href="<?php echo $config['web']['url'] ?>"> Disini.</a></h3>
                                </div>
                            </div>
                        </div>
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
