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