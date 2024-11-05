<?php
require_once('../config/db.php');

// Open database connection
$conn = open_dataBase();

// Initialize variables
$className = '';

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim and sanitize inputs
    $username = trim($conn->real_escape_string($_POST['username']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the password

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($password)) {
        echo "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Check if the username already exists
        if (isExists('username', $username)) {
            $className = 'input--error';
            echo "Tên đăng nhập đã tồn tại!";
        } 
        // Check if the email already exists
        else if (isExists('email', $email)) {
            echo "Email đã được sử dụng. Vui lòng nhập Email khác!";
        } else {
            // Prepare and bind the insert statement
            $sql = "INSERT INTO users (username,fullname, password, email) VALUES (?, ?, ?,?)";
            $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $username, $password, $email);

            if ($stmt->execute()) {
                echo "Đăng ký thành công!";
                header('Location: ../pages/index.php');
                exit();
            } else {
                echo "Đăng ký thất bại: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        }
        $stmt->close();
        }
    }
}
// Close the database connection
$conn->close();
?>