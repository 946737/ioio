<div class="row">
<?php
if (website_config('order_info') <> '') {
?>
	<div class="col-lg-12">
		<div class="alert alert-warning"><i class="fa fa-info-circle fa-fw"></i> Baca <b>Informasi</b> yang terletak dikanan (PC/Tablet) / dibawah (Smartphone) form sebelum melakukan Submit.</div>
	</div>
<?php
}
?>
	<div class="<?= (website_config('order_info') <> '') ? 'col-lg-8' : 'col-lg-12' ?>">
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-shopping-cart fa-fw"></i> Pesan Baru</h4><div class="text-right"><span class="badge badge-info p-2 ">Saldo Anda : <?= number_format(user('balance'),0,',','.') ?></span></div>
<form method="post">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Kategori *</label>
		<select class="form-control select2" id="category">
			<option value="">Pilih...</option>
<?php
foreach ($service_category as $key => $value) {
?>
<option value="<?= $value['id'] ?>" <?= ($this->session->userdata('service_category') == $value['id']) ? 'selected' : '' ; ?>><?= $value['name'] ?></option>
<?php
}
?>
		</select>
	</div>
	<div class="form-group">
		<label>Layanan * <span class="badge badge-success hide" style="color:#fff" id="txt_refill"><i class="fas fa-check-circle"></i> Refill Button</span></label>
		<select class="form-control select2" name="service" id="service">
			<option value="">Pilih kategori dahulu...</option>
			<?php if ($this->session->userdata('service_id')) { ?>
			<option value="<?= $this->session->userdata('service_id') ?>" selected>
				<?= $this->session->userdata('service_name') ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Harga/K <span class="badge badge-danger hide" id="txt_custom_price"><i class="fas fa-dollar-sign"></i> Harga Khusus</span></label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<span class="form-control" id="price"><?= ($this->session->userdata('service_price')) ? $this->session->userdata('service_price') : '0' ; ?></span>
			</div>
		</div>
		<div class="form-group col-md-4">
			<label>Min. Pesan</label>
			<span class="form-control" id="min"><?= ($this->session->userdata('service_order_min')) ? $this->session->userdata('service_order_min') : '0' ; ?></span>
		</div>
		<div class="form-group col-md-4">
			<label>Maks. Pesan</label>
			<span class="form-control" id="max"><?= ($this->session->userdata('service_order_max')) ? $this->session->userdata('service_order_max') : '0' ; ?></span>
		</div>
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" id="description" style="height: 100px" readonly><?= ($this->session->userdata('service_description')) ? nl2br($this->session->userdata('service_description')) : 'Deskripsi layanan.' ; ?></textarea>
	</div>
	<div class="form-group">
		<label>Target *</label>
		<input type="text" class="form-control" name="target" value="<?= set_value('target') ?>">
	</div>
	<div class="form-group hide" id="input_custom_comments">
		<label>Komentar *</label>
		<textarea class="form-control" name="custom_comments" rows="5" id="custom_comments"><?= set_value('custom_comments') ?></textarea>
	</div>
	<div class="form-group hide" id="input_custom_link">
		<label>Link Post *</label>
		<input type="text" class="form-control" name="custom_link" value="<?= set_value('custom_link') ?>">
	</div>	
	<div class="form-row">
		<div class="form-group col-md-6">
			<label>Jumlah Pesan *</label>
			<input type="number" class="form-control" name="quantity" id="quantity">
		</div>
		<div class="form-group col-md-6">
			<label>Total Harga</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<span class="form-control" id="total-price">0</span>
			</div>
		</div>
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
		</div></div>
	</div>
<?php
if (website_config('order_info') <> '') {
?>
	<div class="col-lg-4">
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-info-circle fa-fw"></i> Informasi</h4>
			<p>
				<?= nl2br(website_config('order_info')) ?>
			</p>
		</div></div>
	</div>
<?php
}
?>
</div>

<script type="text/javascript">
$(document).keypress(function(event) {
	if (event.which == '13' && !$(event.target).is('textarea')) {
		event.preventDefault();
	}
});
$(function() {
    $('#btn-umum').on('click', function() {
        reset();
        $('#category').val('0').trigger('change.select2');
        $('#categoryfav').val('0').trigger('change.select2');
        $('#service').html('<option value="0">Pilih kategori dahulu...</option>');
    });
    $('#btn-fav').on('click', function() {
        reset();
        $('#category').val('0').trigger('change.select2');
        $('#categoryfav').val('0').trigger('change.select2');
        $('#service').html('<option value="0">Pilih kategori dahulu...</option>');
    });
	$('#category').on('change', function() {
		reset();
		var category = $('#category').val();
		$.ajax({
			type: "GET",
			url: "<?= base_url('ajax/service_list/') ?>" + category + "?<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>",
			dataType: "json",
			success: function(data) {
				$('#service').html(data.msg);
			}, error: function() {
				alert('Terjadi kesalahan, silakan refresh halaman ini.');
			}
		});
	});
	$('#categoryfav').on('change', function() {
		reset();
		var category = $('#categoryfav').val();
		$.ajax({
			type: "GET",
			url: "<?= base_url('ajax/service_list_favorit/') ?>" + category + "?<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>",
			dataType: "json",
			success: function(data) {
				$('#service').html(data.msg);
			}, error: function() {
				alert('Terjadi kesalahan, silakan refresh halaman ini.');
			}
		});
	});
	$('#service').on('change', function() {
		var service = $('#service').val();
		$.ajax({
			type: "GET",
			url: "<?= base_url('ajax/service_detail/') ?>" + service + "?<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>",
			dataType: "json",
			success: function(data) {
				if (data.msg.type == 'custom_comments') {
					$('#quantity').prop('readonly', true);
					$('#input_custom_comments').removeClass('hide');
				} else {
					$('#quantity').prop('readonly', false);
					$('#input_custom_comments').addClass('hide');
				}
				if (data.msg.type == 'custom_link') {
					$('#input_custom_link').removeClass('hide');
				} else {
					$('#input_custom_link').addClass('hide');
				}
				if (data.msg.is_custom_price == '1') {
					$('#txt_custom_price').removeClass('hide');
				} else {
					$('#txt_custom_price').addClass('hide');
				}
				if (data.msg.is_refill == '1') {
					$('#txt_refill').removeClass('hide');
				} else {
					$('#txt_refill').addClass('hide');
				}
				$('#price').html(data.msg.price);
				$('#min').html(data.msg.min);
				$('#max').html(data.msg.max);
				//var newline = String.fromCharCode(13, 10);
				//var dess = data.msg.description;
				//dess.replace('\r\n', newline);
			//	input.replaceAll('\\n', newline);
				$('#description').val(data.msg.description);
			}, error: function() {
				alert('Terjadi kesalahan, silakan refresh halaman ini.');
			}
		});
	});
	$('#custom_comments').on('keyup', function() {
		var service = $('#service').val();
		var quantity = $('#custom_comments').val().split("\n").length;
		$('#quantity').val(quantity);
		total_price(service, quantity);
	});
	$('#quantity').on('keyup', function() {
		var service = $('#service').val();
		var quantity = $('#quantity').val();
		total_price(service, quantity);
	});
	function reset() {
		$('#price').html('0');
		$('#min').html('0');
		$('#max').html('0');
		$('#quantity').val('');
		$('#total-price').html('0');
		$('#description').html('Deskripsi layanan.');
		$('#input_custom_comments').addClass('hide');
		$('#input_custom_link').addClass('hide');
		$('#txt_custom_price').addClass('hide');
	}
	function total_price(service, quantity) {
		$.ajax({
			type: "GET",
			url: "<?= base_url('ajax/service_price/') ?>" + service + "?<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>&quantity=" + quantity,
			dataType: "json",
			success: function(data) {
				$('#total-price').html(data.msg);
			}, error: function() {
				$('#total-price').html('0');
			}
		});
	}
});

$('form').submit(function(){
    $(this).children('button[type=submit]').prop('disabled', true);
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>