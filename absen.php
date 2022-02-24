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
                        <table>
                            <thead>
                                <th>Aktivasi</th>
                                <th>Nama Jadwal</th>
                                <th>Jam</th>
                                <th>Toleransi</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                    <td><input class="form-control" type="text" name="nama_jadwal" id=""></td>
                                    <td><input class="form-control" type="text" name="nama_jadwal" id=""></td>
                                    <td><input class="form-control" type="text" name="nama_jadwal" id=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" id="tambah_jadwal">Tambah jadwal</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none;" id="frame_train_model" class="h-100">
            <canvas style="position: absolute;" id="myCanvas"></canvas>
            <video id="myVideo"></video>
        </div>
        <div style="display: none;" id="frame_report">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>



<script>
    $('#sidebar_absen a').on('click', function(e) {
        $('#sidebar_absen a').each((idx, elem) => {
            $(elem).removeClass('active')
        })
        $(e.target).addClass('active')

        if ($(e.target).text() === 'Pengaturan') {
            $('#frame_train_model').show()
            $('#frame_report').hide()
            $('#frame_jadwal').hide()
            pengaturan_scan($(e.target).text())
            return
        } else if ($(e.target).text() === 'Report') {
            vidOff(myVideo)
            $('#frame_train_model').hide()
            $('#frame_report').show()
            $('#frame_jadwal').hide()
            return
        } else if ($(e.target).text() === 'Jadwal Absen') {
            vidOff(myVideo)
            $('#frame_train_model').hide()
            $('#frame_report').hide()
            $('#frame_jadwal').show()
            return
        }
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


    let animFrame;

    function vidOff(videoElem) {
        try{
            const stream = videoElem.srcObject;
            const tracks = stream.getTracks();
    
            tracks.forEach(function(track) {
                track.stop();
            });
    
            videoElem.srcObject = null;
            cancelAnimationFrame(animFrame)
            myCanvas.getContext('2d').clearRect(0, 0, $(myVideo).width(), $(myVideo).height())
        }catch{
            console.log('video belum jalan')
        }
    }

    // PENGATURAN PEGAWAI
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
                    if (textEl == 'Pengaturan') {
                        await $('#myVideo')[0].play()
                        console.log('video siap')
                        detek()
                    } else {
                        return
                    }
                }
            })

            console.log(`%c ${res}`, 'background: #222; color: #bada55')
        })

        async function detek() {
            // TRAINING FOTO
            let wajah = await loadLabeledImages()
            const faceMatcher = new faceapi.FaceMatcher(wajah)

            // UBAH UKURAN CANVAS SAMA DENGAN VIDEO
            const displaySize = {
                width: $(myVideo).width(),
                height: $(myVideo).height()
            }

            faceapi.matchDimensions(myCanvas, displaySize)
            console.log('%c CANVAS SIAP', 'background: #222; color: #bada55')

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
                    if(results.label != 'unknown'){
                        drawBox.draw(myCanvas)
                    }else{
                        myCanvas.getContext('2d').clearRect(0, 0, displaySize.width, displaySize.height)
                    }
                }

                requestAnimationFrame(ulangi)
            }
            animFrame = requestAnimationFrame(ulangi)
        }


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