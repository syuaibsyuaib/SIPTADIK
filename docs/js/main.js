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

		////////////////////// UNTUK PAGE ADMIN /////////////////
		$('#bid').on('change', function(e) {
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

		$('#subbid').on('change', function(e) {
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
		    console.log(response)
		    return response;
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
