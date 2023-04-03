<?php
session_start();
require '../config.php';

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
    if (isset($_POST['login'])) {
        $post_username = $conn->real_escape_string(trim(filter($_POST['username'])));
        $post_password = $conn->real_escape_string(trim(filter($_POST['password'])));
        
        $check_user = $conn->query("SELECT * FROM users WHERE username = '$post_username'");
        $check_user_rows = mysqli_num_rows($check_user);
        $data_user = mysqli_fetch_assoc($check_user);

        $verif_pass = password_verify($post_password, $data_user['password']);

            if (!$post_username || !$post_password) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Username <br /> - Password.');
            } else if ($check_user_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Pengguna Tidak Tersedia.');
            } else if ($data_user['status'] == "Tidak Aktif") {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Akun Sudah Tidak Aktif.');
            } else {
            $pesannya = "Halo *".$data_user['username']."*, Apakah Anda Melakukan Percobaan Login? Berikut Detailnya:
			        
*Browser:* ".$_SERVER['HTTP_USER_AGENT']."
*Waktu:* $date $time

Jika Anda Lupa Password Silahkan Ganti Password Anda Di https://www.tempestpedia.com/auth/forgot-password";
                    $nomerhp = $data_user['hp'];
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
                if ($check_user_rows == 1){
                    if ($verif_pass == true) {
						$remember = isset($_POST['remember']) ? TRUE : false;
						if($remember == TRUE) {
							$cookie_token = md5($post_username,$email);
							$conn->query("UPDATE users SET cookie_token = '".$cookie_token."' WHERE username= '".$post_username."'");
							setcookie('cookie_token',$cookie_token, time()+60*60*24*7, '/');
						}
                    $conn->query("INSERT INTO log VALUES ('','$post_username', 'Login', '".get_client_ip()."','$date','$time')");
                    $_SESSION['user'] = $data_user;
                    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil Masuk!', 'pesan' => 'Selamat Datang <b>'.$data_user['username'].'</b>, Jangan Lupa Order Ya Kak ^_^');
                    exit(header("Location: ".$config['web']['url']));
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username Atau Password Salah.');
                }
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
                <div class="card card-pages shadow-none">
    
                    <div class="card-body">
                        <h5 class="font-18 text-center">Sign in to continue.</h5>
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
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe"> Remember me</label>
                                                  </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                                </div>
                            </div>
    
                            <div class="form-group row m-t-30 m-b-0">
                                <div class="col-sm-6">
                                    <a href="<?php echo $config['web']['url'] ?>auth/forgot-password" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?php echo $config['web']['url'] ?>auth/register" class="text-muted"><i class="fas fa-user-plus m-r-5"></i>Create account</a>
                                </div>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
<?php
require '../lib/scripts_login.php';
?>
