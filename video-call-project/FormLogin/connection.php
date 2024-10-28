<?php
    define('severname', 'localhost');
    define('username', 'root');
    define('password', '');
    define('dbname', 'test');

    // Ham ket noi voi dataBase
    function open_dataBase (){
        $conn = new mysqli(severname, username, password, dbname);
        // Kiem tra ket noi
        if($conn->connect_errno){
            die('Connect error: '.$conn->connect_error);
        }
        return $conn;
    }

    function empty_content_register($username,$email,$password){
        if (empty($username) || empty($email) || empty($password)) {
            echo "Vui lòng điền đầy đủ thông tin đăng ký!";
            exit;
        }
    }

    function empty_content_login($username, $password) {
        if (empty($username) || empty($password)) {
            echo "Vui lòng điền đầy đủ thông tin đăng nhập!";
            exit;
        }
    }
    
    // Kiểm tra username có tồn tại trong dataBase chưa
    function is_username_exists($username){
        $sql = 'SELECT username FROM users WHERE username = ?';
        $conn = open_dataBase();

        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$username);

        if(!$stm->execute()){
            die('Query error: '. $stm->error);
        }
        $result = $stm->get_result();
        $exists = $result->num_rows > 0;
        $stm->close();
        $conn->close();
    
        return $exists;
    }

    // Kiểm tra email có tồn tại có dataBase hay không.
    function is_email_exists($email) {
        $sql = 'SELECT email FROM users WHERE email = ?';
        $conn = open_dataBase();
    
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
    
        if (!$stm->execute()) {
            die('Query error: ' . $stm->error);
        }
    
        $result = $stm->get_result();
        $exists = $result->num_rows > 0;
        $stm->close();
        $conn->close();
    
        return $exists;
    }
?>