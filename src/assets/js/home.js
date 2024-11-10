var slideIndex = 0;
var slides = [{
    image: "../../assets/images/static/home/info1.png",
    text: "Nhận đường liên kết bạn có thể chia sẻ"
},
{
    image: "../../assets/images/static/home/info2.png",
    text: "Tham gia cuộc họp với một cú nhấp chuột"
},
{
    image: "../../assets/images/static/home/info3.png",
    text: "Bảo mật và an toàn cho mọi cuộc họp"
}
];

function showSlide(index) {
    var carouselImage = document.getElementById("thumbnail__image");
    var carouselText = document.getElementById("carousel__text");
    var dots = document.getElementsByClassName("carousel__dot");

    // Thiết lập chỉ mục slide
    if (index >= slides.length) {
        slideIndex = 0;
    } else if (index < 0) {
        slideIndex = slides.length - 1;
    } else {
        slideIndex = index;
    }

    // Thêm lớp cho hiệu ứng chuyển động mượt
    carouselImage.classList.remove("thumbnail__image--active");
    carouselText.classList.remove("carousel__text--active");

    setTimeout(function () {
        carouselImage.src = slides[slideIndex].image;
        carouselText.innerText = slides[slideIndex].text;

        carouselImage.classList.add("thumbnail__image--active");
        carouselText.classList.add("carousel__text--active");
    }, 100);

    // Cập nhật chấm chỉ mục
    for (var i = 0; i < dots.length; i++) {
        dots[i].classList.remove("carousel__dot--active");
    }
    dots[slideIndex].classList.add("carousel__dot--active");
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


// Hàm tạo phòng mới
function createRoom() {
    const accessToken = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSy4wLmtLbkliWjBxZGZSbGd4T0pzODBrNEFiWjNkYTh4Rk0tMTczMDcyOTE3MiIsImlzcyI6IlNLLjAua0tuSWJaMHFkZlJsZ3hPSnM4MGs0QWJaM2RhOHhGTSIsImV4cCI6MTczMzMyMTE3MiwicmVzdF9hcGkiOnRydWV9.YPTdcHM0uzC7y3gBNzxS3nzI_pywC4jIrPn78wMwENc';
    const roomName = $('#roomNameInput').val();
    const uniqueName = $('#uniqueNameInput').val();
    console.log("Creating room with:", roomName, uniqueName);


    $.ajax({
        url: 'https://api.stringee.com/v1/room2/create',
        type: 'POST',
        headers: { 'X-STRINGEE-AUTH': accessToken, 'Content-Type': 'application/json' },
        data: JSON.stringify({ name: roomName, uniqueName: uniqueName }),
        success: function (response) {
            console.log("API Response:", response);
            if (response.r === 0) {
                // Room created successfully, take the room ID from the response
                const roomId = response.data.roomId;

                // Update the UI with the Room ID
                $('#roomIdDisplay').text('Room ID: ' + roomId);

                // Redirect the user to the room page with the generated room ID
                window.location.href = `room.php?id=${roomId}`;
            } else {
                alert('Error creating room: ' + response.message);
            }
        },
        error: function (error) {
            console.error('Error creating room:', error);
        }
    });
}


// Hàm tham gia phòng có sẵn
function joinWithId() {
    const roomId = document.getElementById("roomCode").value;

    // Kiểm tra xem mã phòng có tồn tại không
    if (!roomId) {
        alert("Vui lòng nhập mã phòng!");
        return;
    }

    // Chuyển hướng người dùng đến trang phòng với mã phòng
    window.location.href = `room/${roomId}`;
}

// Hàm dán mã phòng từ clipboard
function pasteRoomCode() {
    navigator.clipboard.readText()
        .then((text) => {
            document.getElementById("roomCode").value = text;
        })
        .catch((err) => {
            console.error("Không thể dán mã phòng: ", err);
        });
}

// Gắn sự kiện cho các nút
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("createRoomButton").addEventListener("click", createRoom);
});
document.getElementById("joinRoomButton").addEventListener("click", joinWithId);


