$(document).ready(function() {
    $(".container-avatar-edit").hide();
    $(".avatar-edit").click(function() {
        $(".container-avatar-edit").toggle().css("opacity", "1");
    });
    $(".close-avatar-edit").click(function() {
        $(".container-avatar-edit").hide();
    });

    $(document).mousedown(function(e) {
        var containerEditAvatar = $(".container-avatar-edit");
        var btnEditAvatar = $(".avatar-edit");
        var cameraModal = $(".modal-content");

        // Kiểm tra nếu nhấp bên ngoài cả hai thẻ avatar và avatarButton
        if (!containerEditAvatar.is(e.target) && containerEditAvatar.has(e.target).length === 0 &&
            !btnEditAvatar.is(e.target) && btnEditAvatar.has(e.target).length === 0 &&
            !cameraModal.is(':visible')) {
            containerEditAvatar.hide();
        }
    });

    $(".container-profile-edit").hide();
    $(".action__edit").click(function() {
        $(".container-profile-edit").toggle().css("opacity", "1");
    });
    $(".close-profile-edit").click(function() {
        $(".container-profile-edit").hide();
    });

    $(document).mousedown(function(e) {
        var containerEditProfile = $(".container-profile-edit");
        var btnEditProfile = $(".action__edit");

        // Kiểm tra nếu nhấp bên ngoài cả hai thẻ avatar và avatarButton
        if (!containerEditProfile.is(e.target) && containerEditProfile.has(e.target).length === 0 &&
            !btnEditProfile.is(e.target) && btnEditProfile.has(e.target).length === 0) {   
                containerEditProfile.hide();
        }
    });
});
