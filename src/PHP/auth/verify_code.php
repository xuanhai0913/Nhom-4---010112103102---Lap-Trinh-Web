<?php
// verify_code.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'] ?? '';
    if(isset($email)){
        
    }
}
?>