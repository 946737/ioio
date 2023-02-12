<?php defined("BASEPATH") or exit("No direct script access allowed."); ?>
<?php
$start_time = microtime(true);
if (isset($_SESSION['user'])) {
    $check_notifications = $db->query("SELECT * FROM user_notifications WHERE username = '{$_SESSION['user']['username']}' ORDER BY created_at DESC LIMIT 4");
}

$check_A = $db->query("SELECT * FROM setting_website WHERE id = '1'");
$web = $check_A->fetch_assoc();

$tiket = $db->query("SELECT * FROM tiket WHERE is_user = '0' AND user = '{$_SESSION['user']['username']}'");

function level($s)
{
    if ($s === "Admin") {
        return 'Admin <i class="mdi mdi-checkbox-multiple-marked-circle text-success"></i> ';
    } elseif ($s === "Reseller") {
        return 'Reseller
<i class="mdi mdi-checkbox-multiple-marked-circle text-success"></i> ';
    } elseif ($s === "Member") {
        return 'Member';
    } else {
        return 'Lock <i class="mdi mdi-lock text-danger"></i>';
    }
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php include_once 'title_meta.php'; ?>
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="content-right-sidebar">
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item">
                            <a class="nav-link menu-toggle" href="javascript:void(0);">
                                <i class="ficon" data-feather="menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-id"></i><span class="selected-language">Indonesia</span></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-id"></i> Indonesia</a><a class="dropdown-item" href="javascript:void(0);" data-language="us"><i class="flag-icon flag-icon-us"></i> English ( Coming soon )</a></div>
                </li>                  
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a>
                    </li>
                    <?php if (isset($_SESSION['user'])) { ?>
                                                                                               
                    <li class="nav-item dropdown dropdown-cart me-25">
                        <a class="nav-link" href="<?= base_url() ?>ticket/list"><i class="ficon" data-feather="message-square"></i><?php if (mysqli_num_rows($tiket) !== 0) { ?><span class="badge badge-pill badge-glow  badge-success badge-up"><?= mysqli_num_rows($tiket) ?><?php } ?></a>
                    </li>
                    
                    <li class="nav-item dropdown dropdown-cart me-25">
                        <a class="nav-link" href="<?= base_url() ?>pemesanan/new"><i class="ficon" data-feather="shopping-cart"></i></a>
                    </li>                    
                    
                    <li class="nav-item dropdown dropdown-notification mr-25">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                            <i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-glow  badge-danger badge-up"><?= mysqli_num_rows($check_notifications) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 mr-auto">Notifikasi</h4>
                                    <div class="badge badge-pill badge-light-primary">
                                        <?= mysqli_num_rows($check_notifications) ?>
                                        Baru
                                    </div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <?php while ($data_notification = $check_notifications->fetch_assoc()) { ?>
                                <a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content"><i class="fas fa-bell"></i></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading">
                                                <span class="font-weight-bolder"><?= $data_notification['title'] ?></span>
                                                <small class="float-right"><?= time_elapsed_string($data_notification['created_at']) ?></small>
                                            </p>
                                            <small class="notification-text"><?= $data_notification['message'] ?></small>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="<?= base_url('/account/aktifitas_login') ?>">Tampilkan Semua</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name font-weight-bolder limited-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 8ch;"><?= $_SESSION['user']['username'] ?></span>
                                <span class="user-status"><?= level(e($_SESSION['user']['level'])) ?></span>
                            </div>
                            <span class="avatar">
                                <img class="round" src="<?= gravatar($_SESSION['user']['email']) ?>" alt="avatar" height="40" width="40" />
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="<?= base_url('/account/pengaturan_akun') ?>"> <i class="mr-50" data-feather="settings"></i> Pengaturan </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url('/account/logout') ?>"> <i class="mr-50" data-feather="power"></i> Logout </a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto">
                    
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <span class="brand-logo"> </span>
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <h2 class="brand-text text-primary"><?= $web['NamaWeb']; ?></h2>
                        </a>
                    </li>
                    <li class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                            <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="shadow-bottom"></div>

            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">                    
                    <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="navigation-header">
                        <span>DASHBOARD</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item <?= (uri() == '/dashboard') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/dashboard') ?>">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">Home</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/auth/login') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/auth/login') ?>">
                            <i data-feather="log-in"></i>
                            <span class="menu-title text-truncate" data-i18n="SignIn">Login</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/auth/register') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/auth/register') ?>">
                            <i data-feather="user-plus"></i>
                            <span class="menu-title text-truncate" data-i18n="Register">Register</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/halaman/price_list') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/halaman/price_list') ?>">
                            <i data-feather="tag"></i>
                            <span class="menu-title text-truncate" data-i18n="Price List">Price List</span>
                        </a>
                    </li>
                    <?php } else { ?>                    													                                        
                    <?php if ($_SESSION['user']['level'] == 'Reseller' || $_SESSION['user']['level'] == 'Reseller') : ?>
                    <li class="navigation-header">
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item <?= (uri() == 'eseller') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="feather"></i>
                            <span class="menu-title text-truncate" data-i18n="Premium">Premium</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/reseller/transfer_saldo') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>reseller/transfer_saldo">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Transfer Saldo">Transfer Saldo</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/reseller/buat_voucher') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>reseller/buat_voucher">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Buat Voucher">Buat Voucher</span>
                                </a>
                            </li>
                            </ul>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['user']['level'] == 'Admin' || $_SESSION['user']['level'] == 'Admin') : ?>
                    <li class="nav-item <?= (uri() == '/admin') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin') ?>">
                            <i data-feather="award"></i>
                            <span class="menu-title text-truncate" data-i18n="admin">Admin Panel</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item <?= (uri() == '/') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url() ?>">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                        </a>
                    </li>
                   
                    <li class="nav-item <?= (uri() == '/account/hof') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/account/hof') ?>">
                            <i data-feather="award"></i>
                            <span class="menu-title text-truncate" data-i18n="Top Pengguna">Top Pengguna</span>
                        </a>
                    </li>
                    
                    <li class="nav-item <?= (uri() == 'pemesanan') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="shopping-bag"></i>
                            <span class="menu-title text-truncate" data-i18n="Pemesanan">Pemesanan</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/pemesanan/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/new">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Pesanan Baru">Pesanan Baru</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/pemesanan/riwayat') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/riwayat">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Pesanan">Riwayat Pesanan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/pemesanan/riwayat-refill') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/riwayat-refill">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Refill">Riwayat Refill</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= (uri() == 'deposit') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="credit-card"></i>
                            <span class="menu-title text-truncate" data-i18n="Deposit">Deposit</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/deposit/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>deposit/new">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Kelola">Deposit Baru</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/deposit/voucher') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>deposit/voucher">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Voucher">Voucher</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/deposit/riwayat') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>deposit/riwayat">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Deposit">Riwayat Deposit</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= (uri() == 'halaman') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="tag"></i>
                            <span class="menu-title text-truncate" data-i18n="Layanan">Layanan</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/halaman/price_list') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/price_list">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Daftar Layanan">Daftar Layanan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/halaman/monitoring') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/monitoring">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Monitoring">Monitoring</span>
                                </a>
                            </li>
                        </ul>                        
                    </li>
                    
                    <li class="nav-item <?= (uri() == 'ticket') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="message-square"></i>
                            <span class="menu-title text-truncate" data-i18n="Tiket">Tiket</span>
                            <?php if (mysqli_num_rows($tiket) !== 0) { ?>
                            <span class="badge badge-pill badge-success"><?php echo mysqli_num_rows($tiket); ?></span>
                            <?php } ?>                                   
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/ticket/list') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>ticket/list">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Data Ticket">Data Tiket</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/ticket/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>ticket/new">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Buat Ticket">Buat Tiket</span>
                                </a>
                            </li>                            
                        </ul>
                    </li>
                    
                    <li class="nav-item <?= (uri() == 'dokumentasi') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="trello"></i>
                            <span class="menu-title text-truncate" data-i18n="API">Rest API</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/dokumentasi/api_sosialmedia') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>dokumentasi/api_sosialmedia">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Sosial Media">Sosial Media</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/dokumentasi/api_profile') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>dokumentasi/api_profile">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Profile">Profile</span>
                                </a>
                            </li>
                        </ul>                        
                    </li>

                    <li class="nav-item <?= (uri() == 'halaman') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="upload-cloud"></i>
                            <span class="menu-title text-truncate" data-i18n="Log">Log</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/account/mutasi_saldo') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>account/mutasi_saldo">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n=" Mutasi Saldo"> Mutasi Saldo</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/account/aktifitas_login') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>account/aktifitas_login">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Masuk">Riwayat Masuk</span>
                                </a>
                            </li>
                        </ul>                        
                    </li>
                                        
                    <li class="nav-item <?= (uri() == '/account/downline_reff') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/account/downline_reff') ?>">
                            <i data-feather="external-link"></i>
                            <span class="menu-title text-truncate" data-i18n="Refferal">Refferal</span>
                        </a>
                    </li>
                                                            
                    <?php } ?>
                    
                    <li class="nav-item <?= (uri() == '/halaman/download_app') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/halaman/download_app') ?>">
                            <i data-feather="download"></i>
                            <span class="menu-title text-truncate" data-i18n="APK">Download APK</span>
                        </a>
                    </li>
                                        
                    <li class="nav-item <?= (uri() == 'dokumentasi') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="layout"></i>
                            <span class="menu-title text-truncate" data-i18n="sitemap">Sitemap</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/halaman/kontak-kami') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/kontak-kami">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="terms">Bantuan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/halaman/ketentuan_layanan') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/ketentuan_layanan">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="terms">Ketentuan</span>
                                </a>
                            </li>
                        </ul>                        
                    </div>
                </div>

        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <?php if (isset($_SESSION['alert']) && $alert = $_SESSION['alert']) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-<?= $alert[0] ?>" role="alert">
                                <h4 class="alert-heading"><?= $alert[1] ?></h4>
                                <div class="alert-body"><?= $alert[2] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['alert']); } ?>

                    