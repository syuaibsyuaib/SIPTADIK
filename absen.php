<?php
$title = "Absen";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
?>

<script src="assets/js/chart.min.js"></script>

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
            <canvas id="chart_report"></canvas>
        </div>

    </div>
</div>

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
    function vidOff(videoElem) {
        try {
            const stream = videoElem.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach(function(track) {
                track.stop();
            });

            videoElem.srcObject = null;
            cancelAnimationFrame(animFrame)
            myCanvas.getContext('2d').clearRect(0, 0, $(myVideo).width(), $(myVideo).height())
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