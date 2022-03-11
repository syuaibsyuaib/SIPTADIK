<?php
$title = "Absen";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>

<script src="assets/js/webcam.min.js"></script>

<!-- modal info -->
<div class="modal fade" id="modal_info" tabindex="-1" aria-labelledby="modal_infoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_infoLabel">Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ambil foto-->
<div class="modal fade" id="modal_ambil_foto" tabindex="-1" role="dialog" aria-labelledby="modal_ambil_foto_title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">nama/id</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-5 text-center">
                        <div style="height: 350px;overflow:hidden">
                            <canvas style="position: absolute;"></canvas>
                            <video id="video_foto" style="height: 350px;" class="border mb-3"></video>
                        </div>
                        <div>
                            <button id="startbutton" type="button" class="btn btn-primary mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z" />
                                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="container">
                            <div class="row mb-3 g-0">
                                <div class="col"><img class="img-thumbnail" src="/img/orangDepan.png"></div>
                                <div class="col"><img class="img-thumbnail" src="/img/orangSamping.png"></div>
                                <div class="col"><img class="img-thumbnail" src="/img/orangSamping2.png"></div>
                            </div>
                            <div class="row g-0" id="canvas_foto">
                                <div class="col"><img class="img-fluid img-thumbnail" src=""></div>
                                <div class="col"><img class="img-fluid img-thumbnail" src=""></div>
                                <div class="col"><img class="img-fluid img-thumbnail" src=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Ulangi</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-start h-100 ">

    <div class="tab-content w-100" id="v-pills-tabContent">

        <!-- JADWAL -->
        <div class="tab-pane fade show active" id="frame_jadwal" role="tabpanel" aria-labelledby="frame_jadwal-tab">
            <div class="container my-4" id="div_tambah_jadwal">

                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

                    <!-- JAM DATANG -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="check_masuk">Jam Datang
                                    </label>
                                </h4>
                            </div>
                            <div class="card-body text-start">
                                <div class="mb-3">
                                    <label for="nama_jadwal_masuk" class="form-label">Nama Jadwal</label>
                                    <input type="text" class="form-control" name="nama_jadwal_masuk" id="nama_jadwal_masuk" placeholder="Nama Jadwal">
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_jadwal_masuk" class="form-label">Jam Absen</label>
                                    <input class="form-control" type="time" name="waktu_jadwal_masuk" id="waktu_jadwal_masuk">
                                </div>
                                <div class="mb-3">
                                    <label for="toleransi_jadwal_masuk" class="form-label">Toleransi</label>
                                    <input class="form-control" type="time" name="toleransi_jadwal_masuk" id="toleransi_jadwal_masuk">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- JAM PULANG -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="check_pulang">Jam Pulang
                                    </label>
                                </h4>
                            </div>
                            <div class="card-body text-start">
                                <div class="mb-3">
                                    <label for="nama_jadwal_pulang" class="form-label">Nama Jadwal</label>
                                    <input class="form-control" type="text" name="nama_jadwal_pulang" id="nama_jadwal_pulang" placeholder="Nama Jadwal">
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_jadwal_pulang" class="form-label">Jam Absen</label>
                                    <input class="form-control" type="time" name="waktu_jadwal_pulang" id="waktu_jadwal_pulang">
                                </div>
                                <div class="mb-3">
                                    <label for="toleransi_jadwal_pulang" class="form-label">Toleransi</label>
                                    <input class="form-control" type="time" name="toleransi_jadwal_pulang" id="toleransi_jadwal_pulang">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- JAM SIANG -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="check_siang">Jam Siang
                                    </label>
                                </h4>
                            </div>
                            <div class="card-body text-start">
                                <div class="mb-3">
                                    <label for="nama_jadwal_pulang" class="form-label">Nama Jadwal</label>
                                    <input class="form-control" type="text" name="nama_jadwal_siang" id="nama_jadwal_siang" placeholder="Nama Jadwal">
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_jadwal_pulang" class="form-label">Jam Absen</label>
                                    <input class="form-control" type="time" name="waktu_jadwal_siang" id="waktu_jadwal_siang">
                                </div>
                                <div class="mb-3">
                                    <label for="toleransi_jadwal_pulang" class="form-label">Toleransi</label>
                                    <input class="form-control" type="time" name="toleransi_jadwal_siang" id="toleransi_jadwal_siang">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- PEGAWAI -->
        <div class="tab-pane fade" id="frame_tambah_pegawai" role="tabpanel" aria-labelledby="frame_tambah_pegawai-tab">
            <div class="container my-4 p-3" style="background: #ffffffab;" id="div_tambah_pegawai">

                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama Pegawai</th>
                            <th>ID</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center"><i>Belum ada data</i></td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <button type="button" class="btn btn-primary" id="btn_tambah_pegawai">Tambah</button>
                    <button type="button" class="btn btn-info" id="btn_simpan_pegawai">Simpan</button>
                </div>

            </div>
        </div>

        <!-- REGISTRASI WAJAH -->
        <div class="tab-pane fade" id="frame_tambah_wajah" role="tabpanel" aria-labelledby="frame_tambah_wajah-tab">
            <div class="container my-4">

                <form method="POST" action="proses.php">
                    <input type="hidden" name="image" class="image-tag">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card" style="width: 490px; border: none; margin: 0 auto;">
                                <div style="height: 390; background: #333;" class="card-img-top" id="kamera_tambah_wajah"></div>
                                <div class="card-body">
                                    <button class="btn btn-secondary btn-lg" type=button value="Ambil Gambar" onClick="ambil_wajah()"><i class="bi bi-camera"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card" style="width: 490px; border: none; margin: 0 auto;">
                                <div style="height: 390; background: #333;" class="card-img-top" id="results"></div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Nama pegawai:</span>
                                        <input type="text" class="form-control" name="nama-pegawai" required>
                                        <button class="btn btn-primary" type="submit" name="tambah-wajah" id="simpan_wajah">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- reset -->

        <script>
            let kameraTambahWajah = document.getElementById('frame_tambah_wajah-tab');
            let simpan_wajah = document.getElementById('simpan_wajah');
            Webcam.set({
                width: 490,
                height: 390,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            kameraTambahWajah.addEventListener('click', function() {
                simpan_wajah.disabled = true;
                Webcam.attach('#kamera_tambah_wajah');
            })

            function ambil_wajah() {
                Webcam.snap(function(data_uri) {
                    simpan_wajah.disabled = false;
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                    Webcam.reset();
                });
            }
        </script>

        <!-- PREVIEW -->
        <div class="tab-pane fade" id="frame_train_model" role="tabpanel" aria-labelledby="frame_train_model-tab">
            <div class="d-flex justify-content-center align-items-center">
                <div class="p-3 border mt-3">
                    <div id="video_loading" class="spinner-grow" style="display:flex; position:absolute; width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <canvas style="position: absolute;" id="myCanvas"></canvas>
                    <video id="myVideo" class=""></video>
                </div>
            </div>
        </div>

        <!-- REPORT -->
        <div class="tab-pane fade" id="frame_report" role="tabpanel" aria-labelledby="frame_report-tab">
            <table class="table text-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>321</td>
                        <td>labaco</td>
                        <td>
                            <button class="btn btn-info" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="/assets/js/main.js"></script>

<?php
include("firestorage.php");
?>

//<script>
    $('#v-pills-tab li').on('click', function(event) {
        event.preventDefault()
        if ($(event.target).text() == 'Preview') {
            $(video_loading).show()
            pengaturan_scan()
        } else(
            vidOff(myVideo)
        )
        if ($(event.target).text() != 'Tambah Wajah') {
            Webcam.reset()
        }
    })

    // ambilDb(db, "absen").then(res => console.log(res))

    // TAMBAH PEGAWAI

    $(btn_tambah_pegawai).click(e => {
        $('#div_tambah_pegawai tbody').append(() => {
            let banyakChild = $('#div_tambah_pegawai tbody').children().length
            return `<tr>
                        <td scope="col" class="fw-bold"><span>${banyakChild + 1}</span></td>
                        <td><input class="form-control" type="text"></td>
                        <td><input class="form-control" type="text"></td>
                        <td><input class="form-control" type="text"></td>
                        <td class="text-center">
                        <button class="btn btn-success" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z" />
                                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                </svg></button>
                            <button type="button" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg></button>
                        </td>
                    </tr>`
        })

        $('#div_tambah_pegawai tbody tr button:nth-child(1)').click(e => {
            let namaPegawai = $(e.target).parents('tr').find('input').eq(0).val()
            let idPegawai = $(e.target).parents('tr').find('input').eq(1).val()
            let alamatPegawai = $(e.target).parents('tr').find('input').eq(2).val()

            if (namaPegawai == "" || idPegawai == "") {
                $('#modal_info .modal-body').text("Nama Pegawai/ ID Pegawai tidak boleh kosong")
                $(modal_info).modal('show')
                return false
            }

            // KIRIM FOTO KE SERVER
            $('#modal_ambil_foto button').eq(3).click(e => {
                let arrFotoPegawai = []
                $('#canvas_foto img').each((idx, elm) => {
                    arrFotoPegawai.push(b64toArr((elm.src).replace("data:image/png;base64,", "")))
                    // console.log()
                })
                // TODO kirim ke proses.php
                // TODO tes kirim ke firebase
                let formKirimPegawai = new URLSearchParams("tambahAbsen=")
                formKirimPegawai.append("id_pegawai", idPegawai)
                formKirimPegawai.append("nama_pegawai", namaPegawai)
                formKirimPegawai.append("alamat_pegawai", alamatPegawai)
                formKirimPegawai.append("foto_pegawai", arrFotoPegawai)

                tanya_simpan("Simpan", "Yakin akan simpan?", formKirimPegawai)
                e.preventDefault()
            })

            $('#modal_ambil_foto').modal('show')
            let canvas = $('#modal_ambil_foto canvas')[0]
            canvas.width = $(video_foto).width()
            canvas.height = $(video_foto).height()

            let ctx = canvas.getContext("2d");
            ctx.globalAlpha = 0.2;
            ctx.fillStyle = "red";
            ctx.fillRect(0, 0, $(video_foto).width(), $(video_foto).height());
            ctx.clearRect($(video_foto).width() / 6, $(video_foto).width() / 8, $(video_foto).width() / 1.5, $(video_foto).width() / 1.5);

            $('#modal_ambil_foto h5').text(namaPegawai + " / " + idPegawai)
            AmbilFoto.start(video_foto)

            // TAKE FOTO
            let i = 0
            $(startbutton).on('click', function(ev) {
                let res = AmbilFoto.take(video_foto);
                $('#canvas_foto img')[i++].src = res
                if (i > 2) {
                    i = 0
                }
                ev.preventDefault();
            });

            // BERSIHKAN IMG FOTO
            $('#modal_ambil_foto button').eq(2).click(e => {
                $('#canvas_foto img').each((idx, item) => {
                    AmbilFoto.clear(item)
                    i = 0
                })
            })



        })

        // HAPUS BARIS PEGAWAI
        $('#div_tambah_pegawai tbody tr button:nth-child(2)').click(e => {
            $(e.target).parents('tr').remove()
            let td = $('#div_tambah_pegawai tbody td:nth-child(1)')
            // console.log(td.length)
            for (let i = 0; i < td.length; i++) {
                td.eq(i).text(i + 1)
            }
        })


        // JIKA MODAL AMBIL FOTO TERTUTUP, BERSIHKAN IMG.SRC
        $('#modal_ambil_foto').on('hide.bs.modal', (e) => {
            $('#canvas_foto img').each((idx, item) => {
                AmbilFoto.clear(item)
            })

            vidOff(video_foto, false)
        })


    })


    // JADWAL
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

    // REPORT



    let animFrame;

    // MATIKAN VIDEO DAN CANVAS
    function vidOff(videoElem, actCanvas) {
        actCanvas = true;
        try {
            const stream = videoElem.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach(function(track) {
                track.stop();
            });

            videoElem.srcObject = null;
            if (actCanvas) {
                cancelAnimationFrame(animFrame)
                myCanvas.getContext('2d').clearRect(0, 0, $(myVideo).width(), $(myVideo).height())
            }
        } catch {
            console.log('video belum jalan')
        }
    }

    // INISIALISASI MODEL
    async function model() {
        await faceapi.nets.ssdMobilenetv1.loadFromUri('/models')
        // await faceapi.nets.ageGenderNet.loadFromUri('/models')
        // await faceapi.nets.faceExpressionNet.loadFromUri('/models')
        await faceapi.nets.faceLandmark68Net.loadFromUri('/models')
        // await faceapi.nets.faceLandmark68TinyNet.loadFromUri('/models')
        await faceapi.nets.faceRecognitionNet.loadFromUri('/models')
        // await faceapi.nets.tinyFaceDetector.loadFromUri('/models')

        return 'model siap'
    }

    // FUNGSI PREVIEW
    function pengaturan_scan(textEl) {
        model().then((res) => {
            let stream = navigator.mediaDevices.getUserMedia({
                video: true
            })

            stream.then(res => {
                console.log(res)
                myVideo.srcObject = res;
                window.localStream = res;
                myVideo.onloadedmetadata = async function(e) {
                    await $('#myVideo')[0].play()
                    console.log('video siap')
                    detek()
                }
            })

            console.log(`%c ${res}`, 'background: #222; color: #bada55')
        })

        async function detek() {
            let wajah = await loadLabeledImages()
            const faceMatcher = new faceapi.FaceMatcher(wajah)

            // UBAH UKURAN CANVAS SAMA DENGAN VIDEO
            const displaySize = {
                width: $(myVideo).width(),
                height: $(myVideo).height()
            }

            faceapi.matchDimensions(myCanvas, displaySize)
            console.log('%c CANVAS SIAP', 'background: #222; color: #bada55')
            $(video_loading).hide()

            // DETEKSI WAJAH
            async function ulangi() {
                const detections = await faceapi.detectSingleFace(myVideo).withFaceLandmarks()
                    .withFaceDescriptor()

                if (detections) {
                    const resizedDetections = faceapi.resizeResults(detections, displaySize)
                    myCanvas.getContext('2d').clearRect(0, 0, displaySize.width, displaySize.height)
                    const results = faceMatcher.findBestMatch(resizedDetections.descriptor)
                    const box = resizedDetections.detection.box
                    const drawBox = new faceapi.draw.DrawBox(box, {
                        label: results.label
                    })

                    console.log(results.label)
                    if (results.label != 'unknown') {
                        drawBox.draw(myCanvas)
                    } else {
                        myCanvas.getContext('2d').clearRect(0, 0, displaySize.width, displaySize.height)
                    }
                }

                requestAnimationFrame(ulangi)
            }
            animFrame = requestAnimationFrame(ulangi)
        }

        // TRAINING WAJAH DARI FOTO
        function loadLabeledImages() {
            //const labels = ['Black Widow', 'Captain America', 'Hawkeye' , 'Jim Rhodes', 'Tony Stark', 'Thor', 'Captain Marvel']
            const labels = ['syuaib', 'irma'] // for WebCam
            return Promise.all(
                labels.map(async (label) => {
                    console.log(label)
                    let descriptions = []
                    for (let i = 0; i < 3; i++) {
                        const img = await faceapi.fetchImage(`/images/${label}/${i}.jpg`)
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
                        if (detections) {
                            console.log(`%c foto wajah ditemukan (training)`, `background: #222; color: #bada55`)
                            descriptions.push(detections.descriptor)
                        }
                    }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                })
            )
        }
    }
</script>


<?php
include("layout/footer.php");
?>