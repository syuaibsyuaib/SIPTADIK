	////// BIDANG OPTIONS //////=======================================================================
	let bidang = document.getElementById('bidang');
	let subbidang = document.getElementById('subbidang');
	let jabatan = document.getElementById('jabatan');

	for (let i = 3; i < jabatan.options.length; i++) {
	    jabatan.options[i].classList.toggle('d-none');
	}

	function togel(parm) {
	    if (parm == 'kadisHilang') {
	        jabatan.options[1].classList.add('d-none');
	        jabatan.options[2].classList.add('d-none');
	        for (let i = 3; i < jabatan.options.length; i++) {
	            jabatan.options[i].classList.remove('d-none');
	        }
	    } else {
	        jabatan.options[1].classList.remove('d-none');
	        jabatan.options[2].classList.remove('d-none');
	        for (let i = 3; i < jabatan.options.length; i++) {
	            jabatan.options[i].classList.add('d-none');
	        }
	    }
	}


	bidang.addEventListener('change', function(isi) {
	    let value = isi.target.options[bidang.selectedIndex].value;
	    subbidang.disabled = true;
	    subbidang.options.selectedIndex = 0;
	    // jabatan.disabled = true;
	    jabatan.options.selectedIndex = 0;
	    if (value == 'b1') {
	        subbidang.disabled = false;
	        jabatan.options.selectedIndex = 0;
	        jabatan.disabled = true;
	    } else if (subbidang.selectedIndex == 0) {
	        jabatan.disabled = false;
	    }

	    if (value != "") {
	        togel('kadisHilang');
	    } else {
	        togel('muncul ko kadis');
	    }
	});

	subbidang.addEventListener('change', function(isi) {
	    let value = isi.target.options[subbidang.selectedIndex].value;
	    jabatan.options.selectedIndex = 0;
	    if (value != "" && subbidang.options.selectedIndex != 0) {
	        jabatan.disabled = false;
	    } else {
	        jabatan.options.selectedIndex = 0;
	        jabatan.disabled = true;
	    }
	})

	$('.pass').click(function() {
	    $('.pass').prop({ 'type': 'text' });
	    $('.pass').focusout(() => {
	        $('.pass').prop({ 'type': 'password' });
	    })
	});

	function notif(isiPesan) {
	    let toast = new bootstrap.Toast($('#liveToast'));
	    $('#pesanNotif').html(isiPesan);
	    toast.show();
	}

	function _base64ToArrayBuffer(base64) {
	    var binary_string = window.atob(base64);
	    var len = binary_string.length;
	    var bytes = new Uint8Array(len);
	    for (var i = 0; i < len; i++) {
	        bytes[i] = binary_string.charCodeAt(i);
	    }
	    return new Uint8Array(bytes.buffer);
	}
	
	
	$('#bid').on('change', function(e) {
		switch ($('#bid').prop('selectedIndex')) {
			case 0:
				$('#subbid, #jabat').prop('selectedIndex', 0);
				$('#subbid, #jabat').prop('disabled', true);
				break;
			case 1:
				$('#subbid').prop('disabled', false);
				$('#jabat').prop('disabled', true);
				$('#subbid, #jabat').prop('selectedIndex', 0);
				break;
			default:
				$('#subbid').prop('disabled', true);
				$('#jabat').prop('disabled', false);
				$('#subbid, #jabat').prop('selectedIndex', 0);
				break;
		}
	})

	$('#subbid').on('change', function(e) {
		switch ($('#subbid').prop('selectedIndex')) {
			case 0:
				$('#jabat').prop('disabled', true);
				$('#jabat').prop('selectedIndex', 0);
				break;
			default:
				$('#jabat').prop('disabled', false);
				$('#jabat').prop('selectedIndex', 0);
				break;
		}
	})