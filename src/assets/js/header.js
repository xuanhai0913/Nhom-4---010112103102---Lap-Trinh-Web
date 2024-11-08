$(document).ready(function () {
    function updateDateTime() {
        let days = ['CN', 'Th 2', 'Th 3', 'Th 4', 'Th 5', 'Th 6', 'Th 7'];
        let months = ['Thg 1', 'Thg 2', 'Thg 3', 'Thg 4', 'Thg 5', 'Thg 6', 'Thg 7', 'Thg 8', 'Thg 9', 'Thg 10', 'Thg 11', 'Thg 12'];

        let now = new Date();
        let dayOfWeek = days[now.getDay()];
        let day = now.getDate();
        let month = months[now.getMonth()];

        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');
        let time = `${hours}:${minutes}`;

        $('#datetime').text(`${time} • ${dayOfWeek}, ${day} ${month}`);
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);
});

$(document).ready(function () {
    $(".profilePopup").hide();
    $(".btn-avatar").click(function () {
        $(this).toggleClass("active");
        $(".profilePopup").toggle().css("opacity", "1");
    });
    $(".profilePopup__closeIcon").click(function () {
        $(".profilePopup").hide();
        $(".btn-avatar").removeClass("active");
    });
    $(document).mousedown(function (e) {
        var avatar = $(".profilePopup");
        var avatarButton = $(".btn-avatar");
        var containerEditAvatar = $(".container-avatar-edit");
        var containerEditProfile = $(".container-profile-edit");

        // Kiểm tra nếu nhấp bên ngoài cả hai thẻ avatar và avatarButton
        if (!avatar.is(e.target) && avatar.has(e.target).length === 0 &&
            !avatarButton.is(e.target) && avatarButton.has(e.target).length === 0 &&
            !containerEditAvatar.is(':visible') &&
            !containerEditProfile.is(':visible')) {

            avatar.hide();
            avatarButton.removeClass("active");
        }
    });
});