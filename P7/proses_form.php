<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

     $nama = htmlspecialchars($_POST['nama']);
     $email = htmlspecialchars($_POST['email']);

     echo "Nama: " . $nama . "<br>";
     echo "Email: " . $email . "<br>";
 } 
?>