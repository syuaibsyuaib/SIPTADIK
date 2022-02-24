$('.pass').on('click', function () {
    $(this).prop({ 'type': 'text' });
    $(this).on('focusout', function () {
        $('.pass').prop({ 'type': 'password' });
    })
});

function notif(isiPesan) {
    let toast = new bootstrap.Toast($('#liveToast'));
    $('#pesanNotif').html(isiPesan);
    toast.show();
}

function b64toArr(base64) {
    var binary_string = window.atob(base64);
    var len = binary_string.length;
    var bytes = new Uint8Array(len);
    for (var i = 0; i < len; i++) {
        bytes[i] = binary_string.charCodeAt(i);
    }
    return new Uint8Array(bytes.buffer);
}

////////////////////// UNTUK PAGE ADMIN /////////////////
$('#subbid option').prop('hidden', true);

$('#bid').on('change', function (e) {
    switch ($('#bid').prop('selectedIndex')) {
        case 0:
            $('#subbid, #jabat').prop('selectedIndex', 0);
            $('#subbid option, #jabat option').prop('hidden', true);
            break;
        case 1:
            $('#subbid option').prop('hidden', false);
            $('#jabat option').prop('hidden', true);
            $('#subbid, #jabat').prop('selectedIndex', 0);
            break;
        default:
            $('#subbid option').prop('hidden', true);
            $('#jabat option').prop('hidden', false);
            $('#subbid, #jabat').prop('selectedIndex', 0);
            break;
    }
})

$('#subbid').on('change', function (e) {
    switch ($('#subbid').prop('selectedIndex')) {
        case 0:
            $('#jabat option').prop('hidden', true);
            $('#jabat option').prop('selectedIndex', 0);
            break;
        default:
            $('#jabat option').prop('hidden', false);
            $('#jabat option').prop('selectedIndex', 0);
            break;
    }
})

function hapusOptions(e) {
    $(`${e} option`).prop('hidden');
    return true;
}


async function kirim(url, data) {
    const response = await fetch(url, {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', //'multipart/form-data',   //
        },
        body: data,
    })
    return response.text();
}

function responProses() {
    return new Promise((res, rej) => {
        let timeout = setTimeout(() => {
            let interval = setInterval(() => {
                if (localStorage.respon) {
                    res(localStorage.respon);
                    clearInterval(interval);
                    clearTimeout(timeout);
                }
            }, 500);
        }, 10000);
    })
}

// TODO fungsi ambil foto pakai camera di admin untuk dikirim ke server PHP 
// lalu simpan di folder images
function ambilGambar() {
    var width = 320;
    var height = 0;

    var streaming = false;

    var video = null;
    var canvas = null;
    var photo = null;
    var startbutton = null;

    function showViewLiveResultButton() {
        if (window.self !== window.top) {
            document.querySelector(".contentarea").remove();
            const button = document.createElement("button");
            button.textContent = "View live result of the example code above";
            document.body.append(button);
            button.addEventListener('click', () => window.open(location.href));
            return true;
        }
        return false;
    }

    function startup() {
        if (showViewLiveResultButton()) { return; }
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        photo = document.getElementById('photo');
        startbutton = document.getElementById('startbutton');

        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
            .then(function (stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.log("An error occurred: " + err);
            });

        video.addEventListener('canplay', function (ev) {
            if (!streaming) {
                height = video.videoHeight / (video.videoWidth / width);

                if (isNaN(height)) {
                    height = width / (4 / 3);
                }

                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        }, false);

        startbutton.addEventListener('click', function (ev) {
            takepicture();
            ev.preventDefault();
        }, false);

        clearphoto();
    }

    function clearphoto() {
        var context = canvas.getContext('2d');
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }

    function takepicture() {
        var context = canvas.getContext('2d');
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);

            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        } else {
            clearphoto();
        }
    }

    window.addEventListener('load', startup, false);
};