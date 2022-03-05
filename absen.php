<?php
$title = "Riwayat";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>
<script src="assets/js/chart.min.js"></script>

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
                <form action="">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Ulangi</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-start h-100 ">
    <div class="nav flex-column nav-pills h-100 me-3 bg-dark" style="min-width: 200px;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="btn btn-outline-info py-3 border-0 rounded-0 active" id="frame_jadwal-tab" data-bs-toggle="pill" data-bs-target="#frame_jadwal" type="button" role="tab" aria-controls="frame_jadwal" aria-selected="true">Jadwal</button>
        <button class="btn btn-outline-info py-3 border-0 rounded-0" id="frame_tambah_pegawai-tab" data-bs-toggle="pill" data-bs-target="#frame_tambah_pegawai" type="button" role="tab" aria-controls="frame_tambah_pegawai" aria-selected="false">Pegawai</button>
        <button class="btn btn-outline-info py-3 border-0 rounded-0" id="frame_train_model-tab" data-bs-toggle="pill" data-bs-target="#frame_train_model" type="button" role="tab" aria-controls="frame_train_model" aria-selected="false">Preview</button>
        <button class="btn btn-outline-info border-0 rounded-0" id="frame_report-tab" data-bs-toggle="pill" data-bs-target="#frame_report" type="button" role="tab" aria-controls="frame_report" aria-selected="false">Report</button>
    </div>
    
    <div class="tab-content w-100" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="frame_jadwal" role="tabpanel" aria-labelledby="frame_jadwal-tab">
            <div id="div_tambah_jadwal" class="w-75">
                <form>
                    <table class="table text-light">
                        <thead class="text-center">
                            <th>Aktivasi</th>
                            <th>Nama Jadwal</th>
                            <th>Jam Absen</th>
                            <th>Toleransi</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="" id="check_masuk" checked></td>
                                <td><span name="nama_jadwal_masuk" id="nama_jadwal_masuk">Jadwal Masuk</span></td>
                                <td><input class="form-control" type="time" name="waktu_jadwal_masuk" id="waktu_jadwal_masuk"></td>
                                <td><input class="form-control" type="time" name="toleransi_jadwal_masuk" id="toleransi_jadwal_masuk"></td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="" id="check_pulang" checked></td>
                                <td><span name="nama_jadwal_pulang" id="nama_jadwal_pulang">Jadwal Pulang</span></td>
                                <td><input class="form-control" type="time" name="waktu_jadwal_pulang" id="waktu_jadwal_pulang"></td>
                                <td><input class="form-control" type="time" name="toleransi_jadwal_pulang" id="toleransi_jadwal_pulang"></td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="" id="check_siang"></td>
                                <td><span name="nama_jadwal_siang" id="nama_jadwal_siang">Jadwal Siang</span></td>
                                <td><input class="form-control" type="time" name="waktu_jadwal_siang" id="waktu_jadwal_siang"></td>
                                <td><input class="form-control" type="time" name="toleransi_jadwal_siang" id="toleransi_jadwal_siang"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary ms-5" type="submit">Simpan</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="frame_tambah_pegawai" role="tabpanel" aria-labelledby="frame_tambah_pegawai-tab">
            <div id="div_tambah_pegawai">
                <form>
                    <table class="table text-white table-hover">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Nama Pegawai</th>
                            <th>ID</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div>
                        <button type="button" class="btn btn-primary" id="btn_tambah_pegawai">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
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
        <div class="tab-pane fade" id="frame_report" role="tabpanel" aria-labelledby="frame_report-tab">
            <canvas id="chart_report"></canvas>
        </div>
    </div>
</div>

<script src="/assets/js/main.js"></script>

<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-tab button'))
    triggerTabList.forEach(function(triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function(event) {
            event.preventDefault()
            if ($(event.target).text() == 'Preview') {
                $(video_loading).show()
                pengaturan_scan()
            } else(
                vidOff(myVideo)
            )
        })
    })

    // TAMBAH PEGAWAI

    $(btn_tambah_pegawai).click(e => {
        $('#div_tambah_pegawai tbody').append(() => {
            let banyakChild = $('#div_tambah_pegawai tbody').children().length
            return `<tr>
                        <td scope="col" class="fw-bold"><span>${banyakChild + 1}</span></td>
                        <td><input class="form-control" type="text"></td>
                        <td><input class="form-control" type="text"></td>
                        <td><input class="form-control" type="text"></td>
                        <td class="text-center"><button class="btn btn-success" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
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
            let nama_pegawai = $(e.target).parents('tr').find('input').eq(0).val()
            let id_pegawai = $(e.target).parents('tr').find('input').eq(1).val()
            if (nama_pegawai == "" || id_pegawai == "") {
                $('#modal_info .modal-body').text("Nama Pegawai/ ID Pegawai tidak boleh kosong")
                $(modal_info).modal('show')
                return false
            }

            $('#modal_ambil_foto').modal('show')
            let canvas = $('#modal_ambil_foto canvas')[0]
            canvas.width = $(video_foto).width()
            canvas.height = $(video_foto).height()

            let ctx = canvas.getContext("2d");
            ctx.globalAlpha = 0.2;
            ctx.fillStyle = "red";
            ctx.fillRect(0, 0, $(video_foto).width(), $(video_foto).height());
            ctx.clearRect($(video_foto).width() / 6, $(video_foto).width() / 8, $(video_foto).width() / 1.5, $(video_foto).width() / 1.5);

            $('#modal_ambil_foto h5').text(nama_pegawai + " / " + id_pegawai)
            AmbilFoto.start(video_foto)

            let i = 0
            $(startbutton).on('click', function(ev) {
                let res = AmbilFoto.take(video_foto);
                $('#canvas_foto img')[i++].src = res
                if (i > 2) {
                    i = 0
                }
                ev.preventDefault();
            });

            $('#modal_ambil_foto button').eq(2).click(e => {
                $('#canvas_foto img').each((idx, item) => {
                    AmbilFoto.clear(item)
                    i = 0
                })
            })

        })

        $('#div_tambah_pegawai tbody tr button:nth-child(2)').click(e => {
            $(e.target).parents('tr').remove()
            let td = $('#div_tambah_pegawai tbody td:nth-child(1)')
            // console.log(td.length)
            for (let i = 0; i < td.length; i++) {
                td.eq(i).text(i + 1)
            }
        })



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
    const ctx = document.getElementById('chart_report').getContext('2d');
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