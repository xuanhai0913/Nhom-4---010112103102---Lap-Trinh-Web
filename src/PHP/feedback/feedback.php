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
        <div id="feedback-message"></div>
    </div>
</section>
<script src="../../assets/js/feedBack/feedBack.js"></script>
