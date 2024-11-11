<?php
// index.php

// Bắt đầu session nếu cần
session_start();

// Lấy giá trị 'page' từ URL, mặc định là 'home' nếu không có giá trị nào được truyền vào
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Định tuyến dựa trên giá trị của $page
switch ($page) {
    case 'home':
        include 'pages/home.php';
        break;
    case 'about':
        include 'pages/about.php';
        break;
    case 'contact':
        include 'pages/contact.php';
        break;
    case 'logout':
        include 'logout.php';
        break;
    default:
        include 'pages/404.php'; // Trang lỗi 404 nếu không tìm thấy trang
        break;
}
