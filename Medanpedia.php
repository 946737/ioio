	'quantity' => 100 // jumlah pesan
));
print_r($order);
print('<br /><br />');

// membuat pesanan custom komentar
$order = $api->order(array(
	'service' => 1, // id layanan 
	'target' => 'linkpost', // target pesanan
	'custom_comments' => "wow keren\r\nkeren banget" // daftar komentar
	'custom_link' => "linkpost" // kustom link
));
print_r($order);
print('<br /><br />');

// cek status pesanan
$status = $api->status('1107'); // 123 = id pesanan
print_r($status);
