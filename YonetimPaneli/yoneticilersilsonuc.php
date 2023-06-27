<?php
if (isset($_SESSION["Yonetici"])) {

    if (isset($_GET["ID"])) {
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }

    if ($GelenID != "") {
        //yönetici kendini silemez KullaniciAdi != ? koyarak   bunude executede yakalamak için ayar.php den Yonetici Sessionu içinde olan $YoneticiKullaniciAdi alıyorum
        // silinemeyen süper admin gibi bir ekleme yaparak silme değeri sıfır olanı silmesini gösterek  her adminliğin silinmemesi için önlem aldık
        $YoneticiSilmeSorgusu       =       $VeritabaniBaglantisi->prepare("DELETE FROM yoneticiler WHERE id = ? AND KullaniciAdi != ? AND SilinemeyecekYoneticiDurumu = ? LIMIT 1");
        $YoneticiSilmeSorgusu->execute([$GelenID, $YoneticiKullaniciAdi,0]);
        $YoneticiSilmeSayisi        =       $YoneticiSilmeSorgusu->rowCount();

        if ($YoneticiSilmeSayisi > 0) {
            header("Location:index.php?SKD=0&SKI=80");
            exit();
        }else{
            header("Location:index.php?SKD=0&SKI=81");
            exit();
        }

    }else{
        header("Location:index.php?SKD=0&SKI=81");
        exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}



?>