<?php
$title = "Riwayat";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>
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
        <div class="container" id="frame_jadwal">
            <div class="row" style="display: block;">
                <div class="col">
                    <div id="div_tambah_jadwal">
                        <div class="row w-50">
                            <div class="col">
                                <p>Nama Jadwal</p>
                                <input class="form-control" type="text" name="nama_jadwal" id="">
                            </div>
                            <div class="col">
                                <p>Jam</p>
                                <input class="form-control" type="time" name="jadwal" id="">
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" id="tambah_jadwal">Tambah jadwal</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none;" id="frame_train_model">
            <iframe src="/teachable machine" class="w-100 h-100" frameborder="0"></iframe>
        </div>
        <div style="display: none;" id="frame_report">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>



<script>
    $('#tambah_jadwal').on('click', (e) => {
        $('#div_tambah_jadwal').append(` <div class="row w-50">
                        <div class="col">
                            <p>Nama Jadwal</p>
                            <input class="form-control" type="text" name="nama_jadwal" id="">
                        </div>
                        <div class="col">
                            <p>Jam</p>
                            <input class="form-control" type="time" name="jadwal" id="">
                        </div>
                        <div class="col">
                        <p style="margin-bottom:40px"></p>
                        <button class="btn btn-danger" style="width:50px">hapus</button>
                        </div>
                    </div>`)
    })

    $('#sidebar_absen a').on('click', (e) => {
        $('#sidebar_absen a').each((idx, elem) => {
            $(elem).removeClass('active')
        })
        $(e.target).addClass('active')

        switch ($(e.target).text()) {
            case 'Pengaturan':
                $('#frame_train_model').show()
                $('#frame_report').hide()
                $('#frame_jadwal').hide()
                break;
            case 'Report':
                $('#frame_train_model').hide()
                $('#frame_report').show()
                $('#frame_jadwal').hide()
                break;
            case 'Jadwal Absen':
                $('#frame_train_model').hide()
                $('#frame_report').hide()
                $('#frame_jadwal').show()
                break;
        }
    })

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<?php
include("layout/footer.php");
?>