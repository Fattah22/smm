```php
<?php
// Mengizinkan akses dari antarmuka web
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// ==========================================
// KONFIGURASI AMAN (API Key disimpan di sini)
// ==========================================
$api_url = "https://peakerr.com/api/v2";
$api_key = "71cbca8935a28e59a8915f8d23c408ed";

// Menerima perintah dari frontend web (contoh: action 'services' atau 'add')
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Menyiapkan paket data yang akan dikirim ke pusat (Peakerr)
$post_data = array(
    'key' => $api_key,
    'action' => $action
);

// Khusus untuk pesanan baru, ambil data tambahannya
if ($action === 'add') {
    $post_data['service'] = isset($_POST['service']) ? $_POST['service'] : '';
    $post_data['link'] = isset($_POST['link']) ? $_POST['link'] : '';
    $post_data['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : '';
}

// Menjalankan tembakan API ke server Peakerr menggunakan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Opsional, mencegah error SSL di beberapa hosting

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Meneruskan hasil dari Peakerr kembali ke tampilan Layar (HTML) Anda
http_response_code($httpcode);
echo $response;
?>


```
