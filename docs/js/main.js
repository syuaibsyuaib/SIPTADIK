$('.pass').on('click', function() {
    $(this).prop({ 'type': 'text' });
    $(this).on('focusout', function() {
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

async function kirim(data) {
    const url = "https://script.google.com/macros/s/AKfycbx6QxaoEdDJf8e9zItLDwD6Oq6er4L8cnknO2ET2E-mBxK2QqM/exec";
    modalLoading()
    const response = await fetch(url, {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', //'multipart/form-data',   //
        },
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

async function modalLoading() {
    let scriptLoading = `<div class="modal" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_loading_label" aria-hidden="true" style="z-index: 1057;">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content" style="background: none; border: none;">
						<div class="modal-body" id="modal_loading_label">
							<div class="d-flex justify-content-center">
								<div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>`;

    await $(`body`).prepend(scriptLoading);

    var myInput = document.getElementById('myInput')
    myModal = new bootstrap.Modal(document.getElementById('myModal'))
    myModal.show()
        // myModal.addEventListener('shown.bs.modal', function() {
        //     myInput.focus()
        // })
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
                    <div id="isiModal">${isiText}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="tblModalWarning">Ya</button>
                </div>
            </div>
        </div>
    </div>`
    $('body').prepend(templateModalWarning);
    let modalWarning = new bootstrap.Modal(document.getElementById('modalWarning'));
    let tblWarning = document.getElementById('tblModalWarning');
    modalWarning.show();
    $('.modal-backdrop:eq(1)').attr('style', 'z-index:1056')

    tblWarning.onclick = function(e) {
        fx()
    }
}