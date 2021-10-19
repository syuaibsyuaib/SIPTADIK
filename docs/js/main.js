$('.pass').on('click', function() {
    $(this).prop({ 'type': 'text' });
    $(this).on('focusout', function() {
        $('.pass').prop({ 'type': 'password' });
    })
});

function notif(isiPesan) {
    let templateToast = `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header bg-success text-light">
                                    <strong class="me-auto">SIPTADIK</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    <div>${isiPesan}</div>
                                </div>
                            </div>
                        </div>`
    $('body').prepend(templateToast);
    let toast = new bootstrap.Toast($('#liveToast'));
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


async function kirim(data) {
    const url = "https://script.google.com/macros/s/AKfycbx6QxaoEdDJf8e9zItLDwD6Oq6er4L8cnknO2ET2E-mBxK2QqM/exec";
    const response = await fetch(url, {
        method: 'POST', // or 'PUT'
        body: JSON.stringify(data),
    })
    return response.json();
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



function modalLoading(elem) {
    $('.modal-backdrop:eq(1)').prop('style', 'z-index:1058')
    elem.show()
}

function warning(judulText, isiText, fx) {
    const templateModalWarning = `
    <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true" style="z-index: 1057;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="judulModal">${judulText}</h5>
                </div>
                <div class="modal-body">
                    <div>${isiText}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" id="tblModalWarning">Ya</button>
                </div>
            </div>
        </div>
    </div>`

    if (!$('#modalWarning')[0]) {
        $('body').prepend(templateModalWarning);
    }

    let modalWarning = new bootstrap.Modal(document.getElementById('modalWarning'));
    let tblWarning = document.getElementById('tblModalWarning');
    modalWarning.show();
    $('.modal-backdrop:eq(1)').attr('style', 'z-index:1056')

    tblWarning.onclick = function(e) {
        fx(modalWarning)
    }
}