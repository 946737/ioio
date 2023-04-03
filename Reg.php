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
    if (isset($_POST['daftar'])) {

        if (daftar($_POST) > 0) {
            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Pendaftaran Berhasil!', 'pesan' => 'Pengguna Baru Berhasil Ditambahkan!');
        } else {
            echo mysqli_error($conn);
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
                        <h5 class="font-18 text-center">Register</h5>
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
                    <form class="form-horizontal" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    <label for="hp">Nomor WhatsApp</label>
                                    <input type="number" class="form-control" name="hp" placeholder="Nomor Wa Aktif" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label font-weight-normal" for="customCheck1">I accept <a href="#" class="text-primary">Terms and Conditions</a></label>
                                            </div>
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="daftar">Register</button>
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                    <div class="col-12 m-t-10 text-center">
                                        <a href="<?php echo $config['web']['url'] ?>auth/login" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
<?php
require '../lib/scripts_login.php';
?>
