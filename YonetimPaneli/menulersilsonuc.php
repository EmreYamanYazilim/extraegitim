<?php
if (isset($_SESSION["Yonetici"])) {
    if (isset($_GET["ID"])) {
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }

    if ($GelenID != "") {
        $MenuSilSorgusu     =       $VeritabaniBaglantisi->prepare("DELETE FROM menuler WHERE id = ? LIMIT 1");
        $MenuSilSorgusu->execute([$GelenID]);
        $MenuSayisi         =       $MenuSilSorgusu->rowCount();

        if ($MenuSayisi > 0) {






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