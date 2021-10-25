<?php
!isset($_SESSION['user']) ? header("Location: /") : "";
?>
<footer class="footer mt-auto py-3 warna-dasar">
    <div class="text-center">
        <small><i><a href="/" class="text-dark"><?= JUDUL ?> - <?= TAGLINE ?></a> | Copyright &copy; 2021 | <a href="<?= DEVLINK ?>" class="text-dark">Made with &hearts;</a></i></small>
    </div>
</footer>
<script src="assets/js/main.js"></script>
<script>
    function tanya_simpan(judulPesan, isiPesan, data, rowHidden) {
        rowHidden = rowHidden || false;
        data = data || false;
        let loc = window.location.pathname
        let myModalWarning = new bootstrap.Modal(document.getElementById('modalWarning'));
        let myModalLoading = new bootstrap.Modal(document.getElementById('modalLoading'));
        let isiModal = document.getElementById('isiModal');
        let judulModal = document.getElementById('judulModal');
        let tblModalWarning = document.getElementById('tblModalWarning');
        myModalWarning.show();
        $('.modal-backdrop:eq(1)').attr('style', 'z-index:1056')
        isiModal.innerHTML = isiPesan;
        judulModal.innerHTML = judulPesan;
        console.log(data)

        tblModalWarning.onclick = function(e) {
            if (data == 'keluar') {
                window.location.assign('masuk.php?logout=<?= $_SESSION['role'] ?>');
            } else {
                localStorage.clear();
                if(rowHidden){
                    $(rowHidden + ':hidden').remove()
                }

                myModalLoading.show();
                $('.modal-backdrop:eq(2)').attr('style', 'z-index:1056');
                let resp = kirim('proses.php', data);
                resp.then((res) => {
                        myModalLoading.hide();
                        notif("Data tersimpan")
                        localStorage.setItem('respon', res);
                        window.location.reload();
                    })
                    .catch((error) => {
                        myModalLoading.hide();
                        alert(`Error: ${error}`);
                    });
            }
        };
    };

    function warning(judulText, isiText, fx) {
        let modalWarning = new bootstrap.Modal(document.getElementById('modalWarning'));
        let isiPesan = document.getElementById('isiModal');
        let judulPesan = document.getElementById('judulModal');
        let tblWarning = document.getElementById('tblModalWarning');
        modalWarning.show();
        $('.modal-backdrop:eq(1)').attr('style', 'z-index:1056')
        isiPesan.innerText = isiText;
        judulPesan.innerText = judulText;
        tblWarning.onclick = function(e){
            fx()
        } 
    }
</script>
</body>

</html>