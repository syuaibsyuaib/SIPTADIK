`        <div class="mb-2" style="position: relative;left:20px">
<form class="bd-search position-relative me-autod-inline">
    <span class="algolia-autocomplete" style="position: relative; display: inline-block; direction: ltr;">
        <input type="search" class="form-control ds-input" id="search-input" placeholder="Cari..."
            aria-label="Cari..." autocomplete="off" data-bd-docs-version="5.1" spellcheck="false"
            role="combobox" aria-autocomplete="list" aria-expanded="false"
            aria-owns="algolia-autocomplete-listbox-0" dir="auto"
            style="position: relative; vertical-align: top;">
    </span>
    <select id="rentangRiwayat" class="form-select d-inline" style="width: auto;">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
    </select>
</form>
</div>`

`                            <nav aria-label="Page navigation example">
<ul class="pagination">
    <li class="page-item" id="prevPage">
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>

    <li class="page-item" id="nextPage">
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>
</nav>`
// PAGINATION RIWAYAT
let templateNmrPage = function(no) {
    return template = `<li class="page-item nmrPage"><a class="page-link" href="#">${no}</a></li>`
}

let templateTrans = function(parm) {
    let prev = `<li class="page-item d-none" id="transPagePrev">
                            <a class="page-link" href="#">...</a>
                        </li>`

    let next = `<li class="page-item d-none" id="transPageNext">
                            <a class="page-link" href="#">...</a>
                        </li>`

    if (parm == 'next') {
        return next
    } else if (parm == 'prev') {
        return prev
    }
}
let jumlahPage = Math.ceil($('.trRiwayat').length / $('#rentangRiwayat').val())

// BUAT NOMOR PAGE
for (let i = 0; i < jumlahPage; i++) {
    $('#nextPage').before(templateNmrPage(i + 1))
}

// NOMOR PAGE 1 NYALA 
function page1Active() {
    $('.nmrPage').eq(0).addClass('active');
    $('#prevPage').addClass('disabled')
}
page1Active()


// MUNCULKAN PAGE 1 s/d SESUAI VALUE SELECT/OPTION PAGE
function rangePageAction() {
    for (let i = 0; i < $('#rentangRiwayat').val(); i++) {
        $('.trRiwayat').eq(i).removeClass('d-none')
    }
}
rangePageAction()

/* JIKA JUMLAH NMRPAGE LEBIH DARI 4 MAKA HIDDEN NMRPAGE 5 - SATU PAGE SEBELUM PAGE TERAKHIR
   DAN MUNCULKAN BUTTON [...] */
if ($('.nmrPage').length > 3) {
    $('.nmrPage').eq($('.nmrPage').length - 1).before(templateTrans('next'));
    for (let i = 4; i < $('.nmrPage').length - 1; i++) {
        $('.nmrPage').eq(i).addClass('d-none')
    }
}

// TRIGGER ONCLICK (NEXTPAGE DAN PREVPAGE) UNTUK PINDAHKAN PAGE AKTIF
$('#prevPage').on('click', function(e) {
    let indexActiveNmrPage = parseInt($('.nmrPage').parent().children('.active').children('a').text()) - 1
    $('.nmrPage').eq(indexActiveNmrPage - 1).click()

    // bukaTutupPage(indexActiveNmrPage, 'prev')
    e.preventDefault()
})

$('#nextPage').on('click', function(e) {
    let indexActiveNmrPage = parseInt($('.nmrPage').parent().children('.active').children('a').text()) - 1
    $('.nmrPage').eq(indexActiveNmrPage + 1).click()

    bukaTutupPage(indexActiveNmrPage, 'next')
    e.preventDefault()
})

let x = 0
let y = 1

function bukaTutupPage(index, arahPage) {
    // membuat kelompok array untuk trigger muncul/sembunyi tiap 3 page
    let newArr = []
    for (let i = 0; i < $('.nmrPage').length; i++) {
        newArr.push(parseInt($('.nmrPage a').eq(i).text()))
    }

    let arrBaru = [];
    for (let i = 0; i < newArr.length; i = i + 3) { //0, 2, 4
        arr = newArr.slice(i, i + 3)
        arrBaru.push(arr);
    }

    // [[1,2,3],[4,5,6],[7,8,9],[10,11,12],[13]]
    ////////////
    if (arahPage == 'next') {
        if (x > arrBaru.length - 1) {
            x = 1
        }
        console.log(arrBaru[x][2])
        console.log(index)

        if (index == arrBaru[x][2]) { // jika nmrpage ==  
            for (let i = 0; i < arrBaru[0].length; i++) {
                $('.nmrPage').eq(index + i + 1).removeClass('d-none') ///// tampilkan 3 nomor dikanan
            }

            for (let i = 0; i < arrBaru[0].length; i++) {
                $('.nmrPage').eq(index - i).addClass('d-none') ///// sembunyikan 3 nomor dikiri
            }
            x++;
        }

    } else if (arahPage == 'prev') {
        if (y > arrBaru.length) {
            y = 1;
        }

        if (index + 1 == arrBaru[y][0]) { // jika nmrpage yang aktif sama dengan nomor 2 
            for (let i = 0; i < arrBaru[0].length; i++) {
                $('.nmrPage').eq(index + i + 1).addClass('d-none') ///// sembunyikan 3 nomor dikanan
            }

            for (let i = 0; i < arrBaru[0].length; i++) {
                $('.nmrPage').eq(index - i).removeClass('d-none') ///// tempilkan 3 nomor dikiri
            }
            y++;
        }
    }

    ///////// tampilkan [...]
    // if (index + 1 > arrBaru[0][3]) {
    //     if ($('.nmrPage').parent().has('#transPagePrev').length == 0) {
    //         $('.nmrPage').eq(0).after($('#transPagePrev'));
    //     }
    // } else {
    //     if ($('.nmrPage').parent().has('#transPagePrev').length != 0) {
    //         $('#transPagePrev').remove();
    //     }
    // }

    // if (index + 1 >= arrBaru[arrBaru.length - 1][0]) {
    //     $('#transPageNext').remove();
    // } else {
    //     if (arrBaru.length > 1) {
    //         $('.nmrPage').eq($('.nmrPage').length - 1).before($('#transPageNext'));
    //     }
    // }

}


// TRIGGER ONCLICK (BUTTON NOMOR PAGE) UNTUK MUNCULKAN ROW RIWAYAT SESUAI NOMOR PAGE DAN VALUE SELECT/OPTION PAGE
function aktifkanNmrPage() {
    $('.nmrPage').on('click', function(e) {
        let index = $('.nmrPage').index(this)
        if (index != 0) { // jika yang aktif nmrpage 1
            $('#prevPage').removeClass('disabled') // maka disable tombol prev
        } else {
            $('#prevPage').addClass('disabled')
        }

        if (index + 1 == $('.nmrPage').length) { // jika yang diklik nmrpage terakhir
            $('#nextPage').addClass('disabled') // maka disable tombol next
        } else {
            $('#nextPage').removeClass('disabled')
        }

        $('.nmrPage').removeClass('active') // hapus semua class active
        $('.nmrPage').eq(index).addClass('active') // tambahkan class active pada nmrpage yg diklik

        let awalIndex = (index + 1) * $('#rentangRiwayat').val() - $('#rentangRiwayat').val();
        let akhirIndex = (index + 1) * $('#rentangRiwayat').val();

        for (let i = 0; i < $('.trRiwayat').length; i++) {
            $('.trRiwayat').eq(i).addClass('d-none') //sembunyikan semua row riwayat
        }

        for (let i = awalIndex; i < akhirIndex; i++) {
            $('.trRiwayat').eq(i).toggleClass('d-none') //tampilkan row riwayat mulai dari nomor page sampai sebanyak select input
        }
    })
}
aktifkanNmrPage()

/* TRIGGER ONCHANGE (SELECT/OPTION PAGE) UNTUK ATUR ULANG JUMLAH NOMOR PAGE 
     DAN JUMLAH ROW YANG MUNCUL SESUAI VALUE SELECT/OPTION PAGE */
$('#rentangRiwayat').on('change', function(e) {
    $('#prevPage').addClass('disabled')
        // atur ulang nomor page
    for (let i = 0; i < jumlahPage; i++) {
        $('.nmrPage').remove()
    }

    for (let i = 0; i < Math.ceil($('.trRiwayat').length / $('#rentangRiwayat').val()); i++) {
        $('#nextPage').before(templateNmrPage(i + 1))
    }
    $('.nmrPage').eq(0).addClass('active');
    for (let i = 0; i < $('.trRiwayat').length; i++) {
        $('.trRiwayat').eq(i).addClass('d-none')
    }
    for (let i = 0; i < $('#rentangRiwayat').val(); i++) {
        $('.trRiwayat').eq(i).toggleClass('d-none')
    }
    aktifkanNmrPage()
})