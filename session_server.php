<?php
// Oturum kimliği üretimi (burada basit bir rastgele sayı kullanıyoruz)
$session_id = rand(100000, 999999);

// Bu kimliği güvenli bir şekilde istemciye iletiyoruz (örneğin, çerez kullanarak)
setcookie("session_id", $session_id, time() + 3600, "/");

// Oturum verilerini depolama (burada basitçe bir dizi kullanıyoruz)
$session_data = [
    "user_id" => 123,
    "username" => "example_user"
];

// Bu oturum verilerini güvenli bir şekilde depolamalısınız (örneğin, veritabanı kullanarak)

// İstemciye yanıt döndürme
echo json_encode(["session_id" => $session_id]);
?>