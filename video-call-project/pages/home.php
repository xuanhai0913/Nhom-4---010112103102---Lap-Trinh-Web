<html>

<head>
    <title>
        Video Conference
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link href="../css/base.css" rel="stylesheet" />
    <link href="../css/home.css" rel="stylesheet" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div style="display: flex;">
        <div class="sidebar">
            <div class="menu-item active">
                <i class="fas fa-video">
                </i>
                <span>
                    Cuộc họp
                </span>
            </div>
            <div class="menu-item">
                <i class="fas fa-phone">
                </i>
                <span>
                    Cuộc gọi
                </span>
            </div>
        </div>
        <div class="main">
            <h1>
                Hội nghị truyền hình an toàn cho mọi người
            </h1>
            <p>
                Kết nối, cộng tác và ăn mừng ở mọi nơi với Google Meet
            </p>
            <div class="buttons">
                <button class="primary">
                    Cuộc họp mới
                </button>
                <button>
                    Nhập mã hoặc biệt hiệu
                </button>
                <button disabled="">
                    Tham gia
                </button>
            </div>
            <div class="carousel">
                <i class="fas fa-chevron-left nav left" onclick="prevSlide()">
                </i>
                <img alt="Illustration of two people having a video conference" height="200" id="carousel-image" src="https://storage.googleapis.com/a1aa/image/tqmb77zF9J42Hl5eJQ3qEfZF6r3N5ZLxOKzmekVjE7k0ZbVnA.jpg" width="200" />
                <i class="fas fa-chevron-right nav right" onclick="nextSlide()">
                </i>
                <p id="carousel-text">
                    Nhận đường liên kết bạn có thể chia sẻ
                </p>
                <p>
                    Nhấp vào
                    <strong>
                        Cuộc họp mới
                    </strong>
                    để nhận đường liên kết mà bạn có thể gửi cho những người mình muốn họp cùng
                </p>
                <div class="dots">
                    <span class="active" onclick="currentSlide(0)">
                    </span>
                    <span onclick="currentSlide(1)">
                    </span>
                    <span onclick="currentSlide(2)">
                    </span>
                </div>
            </div>
            <div class="footer">
                <a href="#">
                    Tìm hiểu thêm về Google Meet
                </a>
            </div>
        </div>
    </div>
    <script>
        var slideIndex = 0;
        var slides = [{
                image: "https://storage.googleapis.com/a1aa/image/tqmb77zF9J42Hl5eJQ3qEfZF6r3N5ZLxOKzmekVjE7k0ZbVnA.jpg",
                text: "Nhận đường liên kết bạn có thể chia sẻ"
            },
            {
                image: "https://storage.googleapis.com/a1aa/image/2.jpg",
                text: "Tham gia cuộc họp với một cú nhấp chuột"
            },
            {
                image: "https://storage.googleapis.com/a1aa/image/3.jpg",
                text: "Bảo mật và an toàn cho mọi cuộc họp"
            }
        ];

        function showSlide(index) {
            var carouselImage = document.getElementById("carousel-image");
            var carouselText = document.getElementById("carousel-text");
            var dots = document.getElementsByClassName("dots")[0].getElementsByTagName("span");

            if (index >= slides.length) {
                slideIndex = 0;
            } else if (index < 0) {
                slideIndex = slides.length - 1;
            } else {
                slideIndex = index;
            }

            carouselImage.src = slides[slideIndex].image;
            carouselText.innerText = slides[slideIndex].text;

            for (var i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }
            dots[slideIndex].classList.add("active");
        }

        function nextSlide() {
            showSlide(slideIndex + 1);
        }

        function prevSlide() {
            showSlide(slideIndex - 1);
        }

        function currentSlide(index) {
            showSlide(index);
        }

        showSlide(slideIndex);
    </script>
</body>

</html>