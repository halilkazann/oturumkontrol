
<?php
// Sunucudan dönen oturum kimliğini alıyoruz
$session_id = $_COOKIE["session_id"] ?? null;

if ($session_id) {
    // Sunucuya oturum kimliği ile istek gönderme
    $url = "http://localhost/oturumkontrol/session_server.php"; // Sunucu URL'sini buraya ekleyin
    $response = file_get_contents($url);

    // Sunucudan dönen veriyi alıyoruz
    $session_data = json_decode($response, true);

    if ($session_data && isset($session_data["session_id"])) {
        // Oturum verilerini alıyoruz (veritabanından veya başka bir yerden)
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];

        // Kullanıcı bilgilerini kullanma
        echo "User ID: $user_id, Username: $username";
    } else {
        echo "Invalid session data received.";
    }
} else {
    
    echo "No session ID found.";
    echo "No session ID found.";
}
?>