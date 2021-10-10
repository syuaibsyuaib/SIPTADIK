<?php
!isset($_SESSION['user']) ? header("Location: /") : "";
?>
<footer class="footer mt-auto py-3 warna-dasar">
    <div class="text-center">
        <small><i><a href="/" class="text-dark"><?= JUDUL ?> - <?= TAGLINE ?></a> | Copyright &copy; 2021 | <a href="<?= DEVLINK ?>" class="text-dark">Made with &hearts;</a></i></small>
    </div>
</footer>
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script>
    function tanya_simpan(judulPesan, isiPesan, data) {
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
                myModalLoading.show();
                $('.modal-backdrop:eq(2)').attr('style', 'z-index:1056');
                let resp = kirim('proses.php', data);
                resp.then((res) => {
                        myModalLoading.hide();
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
</script>
</body>

</html>