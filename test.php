<?php

session_start();

$user = $_SESSION['user'] ?? "";
$pass = $_SESSION['pass'] ?? "";
$role = $_SESSION['role'] ?? "";
$temp = $_SESSION['temp'] ?? "";

echo "$user $pass $role $temp";

?>

<script>
    var ss = SpreadsheetApp.openById("18CpS90MtWU47d2AF7wQx6gkjflenTzk0TSO2uokjH0k");
    var sheet = ss.getSheets()[0];

    function doPost(e) {
        var data = JSON.parse(e.postData.contents);
        var pengguna = data.pengguna;
        var sandi = data.sandi;
        var login = cekLogin(pengguna, sandi);
        var jsn = {};
        if (login != "") {
            jsn["role"] = login;
            return ContentService.createTextOutput(JSON.stringify(jsn));
        } else {
            return ContentService.createTextOutput(false);
        }
    }

    /////////////////////////////////////////////
    function cekLogin(username, pass) {
        var rangeUser = sheet.getRange("A:A");
        var rangeAll = sheet.getRange("B:C");
        // var rangeRole = sheet.getRange("C:C");

        var textFinder = rangeUser.createTextFinder(username);

        var firstOccurrence = textFinder.findNext();
        var barisPengguna = firstOccurrence.getRow();

        var getPass = rangeAll.getCell(barisPengguna, 1).getValue();
        var getRole = rangeAll.getCell(barisPengguna, 2).getValue();

        //  return getPass
        if (getPass == pass) {
            return getRole;
        } else {
            return false;
        }
    }
    //////////////////////////////////////////

    function tulis() {

    }

    function tes() {
        var logi = cekLogin("hadi", 123)
        Logger.log(logi != "")
    }
</script>