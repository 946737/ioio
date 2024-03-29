<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

$post_id = $db->real_escape_string(e(base64_decode($_GET['id'])));
$cek_tiket = $db->query("SELECT * FROM tiket WHERE id = '{$post_id}' AND user = '{$session}'");
$data_tiket = $cek_tiket->fetch_assoc();

if (!isset($post_id)) {
    exit(header("Location: " . base_url('/ticket/list')));
} 

mysqli_query($db, "UPDATE tiket SET is_user = '1' WHERE id = '".$post_id."'");

function status($s) {
    if ($s === "Waiting") {
        return '<span class="badge bg-label-warning">Waiting</span>';
    } else if ($s === "Responded") {
        return '<span class="badge bg-label-success">Responded</span>';
    } else if ($s === "Closed") {
        return '<span class="badge bg-label-danger">Closed</span>';
    } 
}

if (mysqli_num_rows($cek_tiket) == 0) {
    $_SESSION['alert'] = ['danger', 'Failed!', 'Ticket Not Found.'];                
    exit(header("Location: " . base_url('/ticket/list')));
} else {
    
    if (isset($_POST['balas'])) {
        $pesan = $db->real_escape_string(trim(filter($_POST['pesan'])));
        if ($data_tiket['status'] == "Closed") {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Ticket Closed.'];
            exit(header("Location: " . base_url('/ticket/list')));               
        } elseif (!$pesan) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Mohon isi semua input.'];
        } elseif (strlen($pesan) > 500) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Maksimal pesan 500 Karakter.'];
        } else {
            $date = date('Y-m-d H:i:s');
            
            $tiketDB = $db->query("INSERT INTO pesan_tiket VALUES ('', '{$post_id}', 'Member', '{$session}', '{$pesan}',  '{$date}','{$date}')");
            $tiketDB = $db->query("UPDATE tiket SET tanggal_at = '{$date}', is_admin = '0', is_user = '1', status = 'Waiting' WHERE id = '{$post_id}'");
            if ($tiketDB == true) {
                $_SESSION['alert'] = ['success', 'Success!', 'Ticket successfully send.'];
                exit(header("Location: " . base_url('/ticket/replay?id='.base64_encode($post_id))));                
            } else {                
                $_SESSION['alert'] = ['danger', 'Failed!', 'Ticket Failed send.'];
                exit(header("Location: " . base_url('/ticket/replay?id='.base64_encode($post_id))));                 
            }
        }
    }
}
include_once '../layouts/header.php'; ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-5">
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body border-bottom">
                <h5 class="card-title">Detail #<?= $data_tiket['id']; ?></h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>
                                <span class="fw-bold">Tipe</span><br />
                                <?= $data_tiket['tipe']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold">Pesan</span><br />
                                <?= $data_tiket['pesan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold">Status</span><br />
                                <?= status($data_tiket['status']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold">Pembaruan Terakhir</span><br />
                                <?= format_date('id',$data_tiket['tanggal_at']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title"><i class="far fa-comments me-1"></i>Balas Tiket</h4>
                <div class="card-body" style="max-height: 400px; overflow: auto;">
                    <div class="row">
                        <?php
                    $check_data = mysqli_query($db, "SELECT * FROM pesan_tiket WHERE id_tiket = '{$post_id}' AND user = '{$session}'");
                    while($query = mysqli_fetch_assoc($check_data)) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-<?= ($query['pengirim'] == 'Admin') ? 'success' : 'info' ?>" role="alert">
                                <div class="alert-body">
                                    <h5 class="text-info mb-1">
                                        <strong>
                                            <?= ($query['pengirim'] == 'Admin') ? 'Admin' : $query['user'] ?>
                                        </strong>
                                        <br />
                                        <span class="text-secondary mb-1 float-end">
                                            <small><?= format_date('id',$query['tanggal']); ?></small>
                                        </span>
                                    </h5>
                                    <p class="text-secondary mb-1">
                                        <strong>
                                            <em><?= $query['pesan']; ?></em>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                ​ ​
                <form method="POST">
                    ​<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" /> ​
                    <div class="mb-1">
                        ​<label class="form-label">Pesan <span class="text-danger">*</span></label> ​<textarea class="form-control" name="pesan" rows="4"></textarea> ​
                    </div>
                    ​
                    <div class="mb-0">
                        ​<button type="submit" name="balas" class="btn btn-relief-primary float-end"><i class="fas fa-reply me-1"></i>Kirim</button> ​
                        <button type="reset" class="btn btn-relief-danger float-end me-1"><i class="fas fa-sync me-1"></i>Ulangi</button> ​
                    </div>                    ​
                </form>                ​
            </div>            ​
        </div>        ​
    </div>
<?php include_once '../layouts/footer.php'; ?>