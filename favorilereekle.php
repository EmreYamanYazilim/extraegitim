<?php
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    } else {
        $GelenID = "";
    }


    if ($GelenID != "") {

        $FavoriKontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UrunId = ? AND UyeId = ? LIMIT 1");
        $FavoriKontrolSorgusu->execute([$GelenID, $KullaniciID]);
        $FavoriKontrolSayisi = $FavoriKontrolSorgusu->rowCount();

        if ($FavoriKontrolSayisi > 0) {
            header("Location:index.php?SK=90");
            exit();
        } else {
            $FaforiEklemeSorgusu = $VeritabaniBaglantisi->prepare("INSERT INTO favoriler (UrunId, UyeId) values (?, ?)");
            $FaforiEklemeSorgusu->execute([$GelenID, $KullaniciID]);
            $FaforiEklemeSayisi = $FaforiEklemeSorgusu->rowCount();

            if ($FaforiEklemeSayisi > 0) {
                header("Location:index.php?SK=88");
                exit();
            } else {
                header("Location:index.php?SK=89");
                exit();
            }
        }
    }

} else {
    header("Location:index.php");
    exit();
}

?>