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

// KIRIM KE PROSES.PHP
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

//FUNGSI AMBIL FOTO
let AmbilFoto = {
    start: function (video) {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
            .then(function (stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.log("An error occurred: " + err);
            });
    },
    take: function (video) {
        let cvs = document.createElement('canvas')
        cvs.width = $(video).width()
        cvs.height = $(video).height()
        let ctx = cvs.getContext('2d');
        ctx.drawImage(video, cvs.width/3, cvs.width/5, cvs.width, cvs.width, 0, 0, cvs.width, cvs.width);
        return cvs.toDataURL('image/png');
    },
    clear: function(el){
        el.src = ""
    }
}


