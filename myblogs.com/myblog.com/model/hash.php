<?php
$password = "12345"; // Password yang akan di-hash

// Membuat hash
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password Asli: ".$password."<br>";
echo "Hash: ".$hash;
?>