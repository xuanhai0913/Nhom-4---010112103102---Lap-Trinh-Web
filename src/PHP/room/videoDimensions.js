function getVideoWH() {
    var videoDimensions = $('#videoDimensions').val();
    console.log('videoDimensions: ' + videoDimensions);
    if (videoDimensions == '720p') {
        videoDimensions = {
            width: {
                min: "1280",
                max: "1280"
            },
            height: {
                min: "720",
                max: "720"
            }
        };
    } else if (videoDimensions == '480p') {
        videoDimensions = {
            width: {
                min: "854",
                max: "854"
            },
            height: {
                min: "480",
                max: "480"
            }
        };
    } else if (videoDimensions == '360p') {
        videoDimensions = {
            width: {
                min: "640",
                max: "640"
            },
            height: {
                min: "360",
                max: "360"
            }
        };
    } else if (videoDimensions == '240p') {
        videoDimensions = {
            width: {
                min: "426",
                max: "426"
            },
            height: {
                min: "240",
                max: "240"
            }
        };
    } else if (videoDimensions == 'max') {//27-inch (3840 × 2160)
        videoDimensions = {
            width: {
//                            min: "426",
                ideal: "3840",
//                            max: "3840"
            },
            height: {
//                            min: "240",
                ideal: "2160",
//                            max: "2160"
            }
        };
        /*
         videoDimensions = {
         width: {
         ideal: "4096"
         },
         height: {
         ideal: "2160"
         },
         facingMode: "user" | facingMode: "environment"
         };
         
         */
    } else {
        videoDimensions = {
            width: {
                min: "160",
                max: "160"
            },
            height: {
                min: "120",
                max: "120"
            }
        };

        //160x120
    }
    return videoDimensions;
}