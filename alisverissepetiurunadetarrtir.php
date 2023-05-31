<?php
if (isset($_SESSION["Kullanici"])) {
    if ($_GET["ID"]) {
        $GelenID = Guvenlik($_GET["ID"]);

    } else {
        $GelenID = "";
    }

    if ($GelenID != "") {
        $SepetGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi=UrunAdedi+1 WHERE id = ? AND UyeId = ? limit 1 ");
        $SepetGuncellemeSorgusu->execute([$GelenID, $KullaniciID]);
        $SepetSayisi = $SepetGuncellemeSorgusu->rowCount();

        if ($SepetSayisi>0) {
            header("Location:index.php?SK=94");
            exit();

        } else {
            header("Location:index.php?SK=94");
            exit();
        }

    } else {
        header("Location:index.php?SK=94");
        exit();
    }

}else{
    header("Location:index.php");
    exit();
}





?>

