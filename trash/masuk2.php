<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <title>SIPTADIK | Masuk</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{display:flex;align-items:center;padding-top:40px;padding-bottom:40px;background-color:#fff3cd;background-image:url(/img/bg.jpg);background-size:cover}
        .wrapper{width:100%;margin:0 auto;overflow:hidden;border-radius:1rem;background:#3a2875;background:url(/img/lg-bg-5.png);background-size:contain}
        .wp-u{margin:2rem auto}
        .wp-u span,.wp-u img{display:block;margin:0 auto}
        .wp-u span{font-weight:bold;font-size:1.5rem;color:#fff}
        .wp-u img{width:6rem;height:auto}
        .wp-b{background:#fff;padding:2rem;border-radius:1rem}
        .wp-b span{display:block;text-align:left}
        .wp-b .judul{font-weight:bold;font-size:1.25rem;color:#5838c1}
        .wp-b .subjudul{font-size:.9rem;color:#555}
        .wp-b form{margin-top:2rem}
        .form-floating{margin:.5rem auto}
        .wp-b .form-control{border:none;border-bottom:1px solid #333;border-radius:0}
        .wp-b button{background-color:#5440b4;border-color:#3b2893;font-size:1rem;width:50%}
        .wp-b button:hover{background-color:#3b2893;border-color:#2e1c82}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm text-center mx-auto">
                <div class="wrapper shadow">
                    <div class="wp-u">
                        <img class="mb-4" src="img/title.png" alt="" width="57" height="57">
                        <span>SIPTADIK</span>
                    </div>
                    <div class="wp-b">
                        <span class="judul">Selamat Datang</span>
                        <span class="subjudul">Silakan masuk terlebih dahulu</span>
                        <form>
                            <div class="form-floating">
                                <input name="pengguna" type="text" class="form-control" id="inputnama" placeholder="Nama Pengguna" required autofocus>
                                <label for="inputnama">Nama Pengguna</label>
                            </div>
                            <div class="form-floating">
                                <input name="sandi" type="password" class="form-control" id="inputsandi" placeholder="Kata Sandi" required>
                                <label for="inputsandi">Kata Sandi</label>
                            </div>

                            <button class="btn btn-lg btn-primary rounded-pill mt-4" type="submit" name="masuk">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>