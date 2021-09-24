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
                    })
                    .catch((error) => {
                        myModalLoading.hide();
                        alert(`Error: ${error}`);
                    });
            }
        };
    };

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

    function responProses(){
        return new Promise((res, rej)=>{
            let timeout = setTimeout(()=>{
                let interval = setInterval(() => {
                    if(localStorage.respon){
                        res(localStorage.respon);
                        clearInterval(interval);
                        clearTimeout(timeout);
                    }
                }, 500);
            }, 10000);
        })
    }
</script>
</body>

</html>