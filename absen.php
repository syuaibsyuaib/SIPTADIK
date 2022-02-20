<?php
$title = "Riwayat";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>
<script src="assets/js/faceapi.js"></script>
<script src="assets/js/chart.min.js"></script>

<div class="row h-100">
    <div class="col-2 p-0">
        <div class="d-flex flex-column p-3 text-white bg-dark h-100" id="sidebar_absen">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white active">Jadwal Absen</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Pengaturan</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Report</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col p-0">
        <div style="display: none;"  id="frame_train_model">
            <iframe src="/teachable machine" class="w-100 h-100" frameborder="0"></iframe>
        </div>
    </div>
</div>



<script>

    $('#sidebar_absen a').on('click', (e) => {
        $('#sidebar_absen a').each((idx, elem) => {
            $(elem).removeClass('active')
        })
        $(e.target).addClass('active')

        switch ($(e.target).text()) {
            case 'Pengaturan':
                $('#frame_train_model').show()
                break;

            default:
                break;
        }
    })
</script>


<?php
include("layout/footer.php");
?>