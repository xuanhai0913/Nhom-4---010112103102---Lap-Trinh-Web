<?php
include_once '../config/db.php';

$conn = open_dataBase();
$successMessage = ""; // Biến lưu thông báo thành công

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ form
    $issue = trim($_POST['issue']);
    $description = trim($_POST['description']);
    $username = $_SESSION['username']; // Lấy username từ session

    // Kiểm tra nếu có lỗi trong dữ liệu
    if (empty($issue) || $issue === "chose" || empty($description)) {
        echo "Vui lòng điền đầy đủ thông tin và chọn loại phản hồi!";
        exit;
    }

    // Prepared statement để tránh SQL Injection
    $stmt = $conn->prepare("INSERT INTO feedbacks (issue, description, username) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $issue, $description, $username);

    if ($stmt->execute()) {
        $successMessage = "Cảm ơn bạn đã gửi phản hồi! Chúng tôi sẽ xem xét trong thời gian sớm nhất.";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>

<head>
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/feedback.css">
    <script src="../../assets/js/includes/jquery-3.7.1.min.js"></script>
</head>
<section class="feedback">
    <div class="feedback-header">
        <h3>Gửi ý kiến phản hồi cho V2meet</h3>
        <div id="close-feedback" class="feedback__closeIcon"><i class="fas fa-times"></i></div>
    </div>
    <div class="feedback-content">
        <?php if ($successMessage != ""): ?>
            <div class="feedback-success-message">
                <h2><?php echo $successMessage; ?></h2>
                <button id="close-success">Đóng</button>
            </div>
        <?php else: ?>
            <form method="post" id="feedback-form">
                <div class="form-group">
                    <label for="issue">Loại ý kiến phản hồi của bạn là gì?</label>
                    <select id="issue" name="issue" required>
                        <option value="chose">Chọn một lựa chọn</option>
                        <option value="report">Báo lỗi</option>
                        <option value="suggest">Góp ý</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả về phản hồi của bạn</label>
                    <textarea id="description" name="description" rows="4" placeholder="Hãy cho chúng tôi biết bạn muốn phản hồi hay góp ý về điều gì" required></textarea>
                </div>
                <div class="form-group">
                    <p>Ảnh chụp màn hình sẽ giúp chúng tôi hiểu rõ hơn về vấn đề này.</p>
                    <input type="file" id="screenshot" name="screenshot" accept="image/*">
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="email">
                        Chúng tôi có thể gửi email cho bạn để hỏi thêm thông tin hoặc cập nhật thông tin cho bạn
                    </label>
                </div>
                <button type="submit" id="submit-btn">Gửi</button>
            </form>
        <?php endif; ?>
    </div>
</section>
<script src="../../assets/js/feedback/feedback.js"></script>
