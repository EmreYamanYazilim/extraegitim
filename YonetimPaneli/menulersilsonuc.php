<?php
if (isset($_SESSION["Yonetici"])) {
    if (isset($_GET["ID"])) {
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }

    if ($GelenID != "") {
        $MenuSilSorgusu          =       $VeritabaniBaglantisi->prepare("DELETE FROM menuler WHERE id = ? LIMIT 1");
        $MenuSilSorgusu->execute([$GelenID]);
        $MenuSilmeSayisi         =       $MenuSilSorgusu->rowCount();

        if ($MenuSilmeSayisi > 0) {
            // menuleri silerken içindede ürünler var ürünleride sildirmemiz gerekecek
            $UrunlerSorgusu               =       $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE MenuId = ? LIMIT 1");
            $UrunlerSorgusu->execute([$GelenID]);
            $UrunlerSorgusuSayisi         =       $UrunlerSorgusu->rowCount();
            if ($UrunlerSorgusuSayisi > 0) {
                $UrunlerGuncellemeSorgusu       =       $VeritabaniBaglantisi->prepare("UPDATE urunler SET Durumu = ? WHERE MenuId = ?");
                $UrunlerGuncellemeSorgusu->execute([0,$GelenID]);

            }
                header("Location:index.php?SKD=0&SKI=67");
                exit();

        }else{
            header("Location:index.php?SKD=0&SKI=68");
            exit();
        }

    }else{
        header("Location:index.php?SKD=0&SKI=68");
        exit();
    }


}else{
    header("Location:index.php?SKD=1");
    exit();
}






?>