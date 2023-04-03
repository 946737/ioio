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
    
    $acakin_password = acak(6).acak_nomor(6);
    $hash_pass = password_hash($acakin_password, PASSWORD_DEFAULT);
    
    if (!$PostUsername) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Username');
    } else if ($cek_username->num_rows == 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username <strong>'.$username.' </strong> Tidak Di Temukan'); 
    } else {
		    	    $pesannya = "Halo *".$user['username']."*, Anda Berhasil Melakukan Reset Password, Berikut Detailnya:
			        
*Password Baru:* $acakin_password 
*Browser:* ".$_SERVER['HTTP_USER_AGENT']."
*Waktu:* $date $time

*Silahkan Ganti Atau Simpan Password Anda!*

Jangan Lupa Save Nomor Saya [NOTIF TEMPEST] Agar Bisa Klik Link Yang Saya Berikan! Terimakasih.";
                    $nomerhp = $user['hp'];
                    $postdata = "api_key=mQ0fUkB7DxX8nO6RthGINqfUiYpDEfpd&device_key=1vgbst&destination=$nomerhp&message=$pesannya";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://wapisender.id/api/v1/send-message");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $chresult = curl_exec($ch);
            //var_dump($chresult);
            curl_close($ch);
            $json_result = json_decode($chresult, true);
    if ($conn->query("UPDATE users SET password = '$hash_pass', random_kode = '$acakin_password' WHERE username = '".$user['username']."'") == true) {
            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Reset Password Berhasil!', 'pesan' => 'Silahkan Cek Whatsapp Anda Untuk Mengetahui Password Baru Anda.');
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
                    <div class="text-center"><a href="forgot-tomail">KLIK DISINI UNTUK RESET KE EMAIL.</a></div>
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
                                    <label for="hp">Nomor Whatsapp</label>
                                    <input id="hp" type="number" class="form-control" name="hp" tabindex="1" required autofocus>
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
