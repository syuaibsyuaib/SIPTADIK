<footer class="footer mt-auto py-3 warna-dasar">
    <div class="text-center">
        <small><i><a href="/" class="text-dark">SIPTADIK - Sistem Informasi Tamu</a> | Copyright &copy; 2021 | <a href="www.google.com" class="text-dark">Made with &hearts;</a></i></small>
    </div>
</footer>
<script src="assets/js/main.js"></script>
<script>
    function tanya_simpan(isiPesan, data) {
        data = data || false;

        let myModalWarning = new bootstrap.Modal(document.getElementById('modalWarning'));
        let myModalLoading = new bootstrap.Modal(document.getElementById('modalLoading'))
        let isiModal = document.getElementById('isiModal');

        myModalWarning.show();
        isiModal.innerHTML = isiPesan;

        let tblModalWarning = document.getElementById('tblModalWarning');

        tblModalWarning.addEventListener('click', () => {
            if (data == 'keluar') {
                window.location.assign('masuk.php')
            } else if (data) {
                myModalLoading.show();

                fetch('proses.php', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded', //'multipart/form-data',   //
                        },
                        body: data,
                    })
                    .then(response => response.text())
                    .then(data => {
                        myModalLoading.hide();
                        notif('Data telah disimpan');
                        window.location.reload();   
                    }).catch((error) => {
                        myModalLoading.hide();
                        alert(`Error: ${error}`);
                        window.location.reload();
                    });
            }
        });
    }

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

    // function toBlob(b64) {
    //     const base64Data = b64;
    //     const base64 = await fetch(base64Data);
    //     const blob = await base64Response.blob();
    //     return blob;
    // }
</script>
</body>

</html>