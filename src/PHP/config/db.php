<?php
    define('severname', 'localhost');
    define('username', 'root');
    define('password', '');
    define('dbname', 'user_registration');

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

    function getDataByKey($key,$value,$data) {
        // key là tên trường đã biết tên.
        // value là giá trị của trường đã biết.
        // data là trường muốn lấy dữ liệu.
        $conn = open_dataBase();
        $sql = "SELECT $data FROM users WHERE $key = ?";
        $stm = $conn->prepare($sql);
    
        if ($stm) {
            $stm->bind_param('s', $value);
            $stm->execute();
            $result = $stm->get_result();
            
            // Đảm bảo đóng kết nối
            $stm->close();
            $conn->close();
            
            return $result; // Trả về kết quả
        } else {
            echo 'Lỗi chuẩn bị câu lệnh: ' . $conn->error;
            $conn->close();
            return null;
        }
    }
    
    // Kiểm tra username có tồn tại trong dataBase chưa
    function isExists($key,$value){
        $sql = "SELECT $key FROM users WHERE  $key= ?";
        $conn = open_dataBase();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$value);
        if(!$stmt->execute()){
            die('Query error: '. $stmt->error);
        }
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        $conn->close();
    
        return $exists;
    }

    function getAllDataByKey($key, $value) {
        // $key là tên trường đã biết.
        // $value là giá trị của trường đã biết.
        
        $conn = open_dataBase();
        $sql = "SELECT * FROM users WHERE $key = ?";
        $stm = $conn->prepare($sql);
    
        if ($stm) {
            $stm->bind_param('s', $value);
            $stm->execute();
            $result = $stm->get_result();
            
            // Đảm bảo đóng kết nối sau khi lấy dữ liệu
            $stm->close();
            $conn->close();
            
            return $result; // Trả về tất cả các trường của dòng thỏa mãn điều kiện
        } else {
            echo 'Lỗi chuẩn bị câu lệnh: ' . $conn->error;
            $conn->close();
            return null;
        }
    }
?>