<?php
session_start();
require("../config.php");
if(isset($_COOKIE['cookie_token'])) {
	$data = $conn->query("SELECT * FROM users WHERE cookie_token = '".$_COOKIE['cookie_token']."'");
	if(mysqli_num_rows($data) > 0) {
	    $hasil = mysqli_fetch_assoc($data);
		$_SESSION['user'] = $hasil;
	}
}

if (isset($_SESSION['user'])) {
    header("Location: ".$config['web']['url']);
} else {
    if ($_POST) {
    $PostUsername = $conn->real_escape_string(filter(trim($_POST['username'])));

    $cek_username = $conn->query("SELECT * FROM users WHERE username = '$PostUsername'");
    $user = $cek_username->fetch_assoc();
    
    if (!$PostUsername) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Username');
    } else if ($cek_username->num_rows == 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username <strong>'.$username.' </strong> Tidak Di Temukan'); 
    } else {
    $acakin_password = acak(9);
    $hash_pass = password_hash($acakin_password, PASSWORD_DEFAULT);
    $tujuan = $user['email'];
    $pesannya = "Berikut Data Akun Tempest-Pedia Yang Anda Reset <br /> <br /> Username: <b>".$user['username']."</b><br /> Password Baru: <b>$acakin_password</b> <br /> Link Login: ".'<a href="https://tempestpedia.com/auth/login" class="btn-loading">'." Klik Disini";
    $subjek = "Reset Password";
    $header = "From:admin@tempest-pedia.com\r\n";
    $header .= "Cc:admin@tempest-pedia.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $send = mail ($tujuan, $subjek, $pesannya, $header);
    if ($conn->query("UPDATE users SET password = '$hash_pass', random_kode = '$acakin_password' WHERE username = '".$user['username']."'") == true) {
            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Reset Password Berhasil!', 'pesan' => 'Silahkan Cek Email Anda Untuk Mengetahui Password Baru Anda.');
        } else {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal');    
            }
        }
    }
}
require '../lib/header_login.php';
?>  
<div class="accountbg"></div>
        <div class="home-btn d-none d-sm-block">
                <a href="<?php echo $config['web']['url'] ?>" class="text-white"><i class="fas fa-home h2"></i></a>
            </div>
        <div class="wrapper-page">
            <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><a href="forgot-password">KLIK DISINI UNTUK RESET KE WHATSAPP.</a></div>
                </div>
                <div class="card card-pages shadow-none">
                    <div class="card-body">
                        <h5 class="font-18 text-center">Reset Password</h5>
    
<?php
if (isset($_SESSION['hasil'])) {
?>
<div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Respon : </strong><?php echo $_SESSION['hasil']['judul'] ?><br /> <strong>Pesan : </strong> <?php echo $_SESSION['hasil']['pesan'] ?>
</div>
<?php
unset($_SESSION['hasil']);
}
?>
                    <form method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-12">
                                    <button type="submit" name="reset" class="btn btn-primary btn-lg btn-block" tabindex="4">Forgot Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php
require '../lib/scripts_login.php';
?>
