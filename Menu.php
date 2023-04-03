<?php
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
    <meta name="theme-color" content="#007bff">
    <link rel="shortcut icon" href="<?php echo $config['web']['url'] ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo $config['web']['url'] ?>plugins/morris/morris.css">
    <link href="<?php echo $config['web']['url'] ?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $config['web']['url'] ?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $config['web']['url'] ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $config['web']['url'] ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo $config['web']['url'] ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>    
    <div id="wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <a href="<?php echo $config['web']['url']; ?>" class="logo">
                    <span class="logo-light">
                            <i class="mdi mdi-cart-outline"></i> <?php echo $data['short_title']; ?>
                        </span>
                    <span class="logo-sm">
                            <i class="mdi mdi-cart-outline"></i>
                        </span>
                </a>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>

<?php
if (isset($_SESSION['user'])) {
?>
                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo $config['web']['url'] ?>assets/images/favicon.ico" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>user/profile"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item" href="<?php echo $config['web']['url'] ?>user/pemakaian-saldo"><i class="mdi mdi-wallet"></i> Pemakaian Saldo</a>
                                <a class="dropdown-item d-block" href="<?php echo $config['web']['url'] ?>user/log"><i class="mdi mdi-history"></i> Log Aktivitas</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?php echo $config['web']['url'] ?>logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
<?php } ?>
                    </li>
                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
            </nav>
        </div>
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
<?php
if (isset($_SESSION['user'])) {
?>    
<?php
if ($data_user['level'] == "Developers") {
?>            
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>admin-dashboard" class="waves-effect">
                                <i class="icon-profile"></i><span> Admin </span>
                            </a>
                        </li>

<?php } ?>
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>" class="waves-effect">
                                <i class="icon-home"></i><span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://chat.whatsapp.com/JE82PIlkjSKCZbCEwQttEx" class="waves-effect">
                                <i class="mdi mdi-whatsapp"></i><span> Group WhatsApp</span>
                            </a>
                        </li>

<?php
if ($data_user['level'] != "Member") {
?> 
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Premium <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
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
                                <i class="mdi mdi-trophy"></i><span> Hall Of Fame</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-shopping-cart"></i> <span> Pemesanan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url'] ?>pemesanan/">Server 1</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>pemesanan/server_s2">Server 2</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>pemesanan/virtual">Virtual</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>riwayat/pemesanan">Riwayat</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-wallet"></i> <span> Deposit <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url'] ?>deposit/">Baru</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>deposit/redeem-voucher">Voucher</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>riwayat/deposit">Riwayat</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-ticket"></i> <span> Ticket <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> <?php if (mysqli_num_rows($CallDBTiket) !== 0) { ?><span class="badge badge-warning"><?php echo mysqli_num_rows($CallDBTiket); ?></span><?php } ?> </span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url'] ?>tiket/index">Baru</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>tiket/list">Tiket</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>monitor" class="waves-effect">
                                <i class="icon-tv-monitor"></i> <span> Monitor</span>
                            </a>
                        </li>
                        <li class="menu-title">Pages</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-map"></i><span> Halaman <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/tos">Ketentuan Layanan</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/faq">Pertanyaan Umum</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/status">Penjelasan Status</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/deposit">Cara Deposit</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/transaksi">Cara Transaksi</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/target">Contoh Target</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>halaman/kontak-kami" class="waves-effect">
                                <i class="mdi mdi-phone"></i> <span> Kontak Admin </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pricetag"></i><span> Daftar Layanan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url'] ?>halaman/layanan">Server 1</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>halaman/layanan_s2">Server 2</a></li>
                            </ul>
                        </li>
                            <li>
                                <a href="<?php echo $config['web']['url'] ?>halaman/api-dokumentasi" class="waves-effect">
                                    <i class="icon-website-2"></i>
                                    <span> Api Dokumentasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>tempest.apk" class="waves-effect">
                                    <i class="icon-download"></i> <span> Download Aplikasi</span>
                                </a>
                            </li>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
<?php
} else {
?>        
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>" class="waves-effect">
                                <i class="icon-home"></i><span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url'] ?>auth/login" class="waves-effect">
                                <i class="mdi mdi-login"></i> <span> Login</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url'] ?>auth/register" class="waves-effect">
                                <i class="icon-profile-add"></i> <span> Register</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url'] ?>auth/forgot-password" class="waves-effect">
                                <i class="mdi mdi-account-key"></i> <span> Forgot Password</span>
                            </a>
                        </li>
                        <li class="menu-title">Pages</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Halaman <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/tos">Ketentuan Layanan</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/faq">Pertanyaan Umum</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/status">Penjelasan Status</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/deposit">Cara Deposit</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/transaksi">Cara Transaksi</a></li>
                                <li><a href="<?php echo $config['web']['url']; ?>halaman/target">Contoh Target</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $config['web']['url']; ?>halaman/kontak-kami" class="waves-effect">
                                <i class="mdi mdi-phone"></i> <span> Kontak Admin </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pricetag"></i> <span> Daftar Layanan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo $config['web']['url'] ?>halaman/layanan">Server 1</a></li>
                                <li><a href="<?php echo $config['web']['url'] ?>halaman/layanan_s2">Server 2</a></li>
                            </ul>
                        </li>
                            <li>
                                <a href="<?php echo $config['web']['url']; ?>tempest.apk" class="waves-effect">
                                    <i class="icon-download"></i> <span> Download Aplikasi</span>
                                </a>
                            </li>
                    </div>
                <div class="clearfix"></div>
            </div>
        </div>                         
<?php } ?> 
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
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
