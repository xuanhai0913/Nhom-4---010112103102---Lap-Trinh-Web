<!DOCTYPE html>
<html lang="en">

<head>
    <title>V2meet - Kết nối trái tim, xóa tan khoảng cách</title>
    <link href="../../assets/css/base.css" rel="stylesheet" />
    <link href="../../assets/css/home.css" rel="stylesheet" />

    <script src="../../assets/js/includes/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.20.0/dist/axios.min.js"></script>
    <script src="https://cdn.stringee.com/sdk/web/2.2.1/stringee-web-sdk.min.js"></script>
    <script src="../../assets/js/test/api.js"></script>
</head>

<body>
    <?php include '../templates/header.php'; ?>
    <div class="container">
        <div class="home-container">
            <div class="content">
                <h1>V2meet – Kết nối trái tim, xóa tan khoảng cách</h1>
                <p>Kết nối, cộng tác và ăn mừng mọi khoảnh khắc – chỉ với một cú chạm, khoảng cách sẽ không còn là rào cản!</p>

                <div class="function">
                <iframe src="https://44b899cf-acfa-477b-8627-7aaaae443e39-00-r73g3m76lahb.pike.replit.dev/" width="100%" height="100%" frameborder="0">
        Trình duyệt của bạn không hỗ trợ iframe.
    </iframe>
                    <!-- <button class="function__create-room is-primary" v-if="!room" @click="createRoom" id="createRoomButton">
                        <i class="fa-solid fa-plus"></i>
                        Cuộc họp mới
                    </button>
                    <div class="function__join-room">
                        <input class="join-room__input" type="text" id="roomCode" placeholder="Nhập mã phòng đã có">
                        <i class="fa-regular fa-paste join-room__paste" onclick="pasteRoomCode()"></i>
                        <button class="join-room__button is-info" v-if="!room" @click="joinWithId" id="joinRoomButton">
                            Tham gia
                            <div class="join-room__button-icon">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </button>
                    </div> -->
                </div>
            </div>
            <div class="carousel">
                <div class="carousel__thumbnails">
                    <i class="fas fa-chevron-left thumbnail__prev" onclick="prevSlide()"></i>
                    <img alt="info" id="thumbnail__image" class="thumbnail__image" src="../../assets/images/static/home/info1.png" />
                    <i class="fas fa-chevron-right thumbnail__next" onclick="nextSlide()"></i>
                </div>
                <p id="carousel__text" class="carousel__text">
                    Nhận đường liên kết bạn có thể chia sẻ
                </p>
                <p class="carousel__description">Nhấp vào <strong>Cuộc họp mới</strong> để nhận đường liên kết mà bạn có thể gửi cho những người mình muốn họp cùng</p>
                <div class="carousel__dots">
                    <span class="carousel__dot carousel__dot--active" onclick="currentSlide(0)"></span>
                    <span class="carousel__dot" onclick="currentSlide(1)"></span>
                    <span class="carousel__dot" onclick="currentSlide(2)"></span>
                </div>
            </div>
        </div>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>

<script src="../../assets/js/home/home.js"></script>
<script src="../../assets/js/room/api.js"></script>
<script src="../../assets/js/room/script.js"></script>
</html>