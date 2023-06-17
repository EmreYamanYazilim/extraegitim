<?php
if (isset($_SESSION["Yonetici"])) {

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);

    } else {
        $GelenID = "";
    }

    if ($GelenID!="") {
        $BankalarSorugusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz WHERE id  = ?");
        $BankalarSorugusu->execute([$GelenID]);
        $BankaSayisi      = $BankalarSorugusu->rowCount();
        $BankaKaydi       = $BankalarSorugusu->fetch(PDO::FETCH_ASSOC);

        $SilinecekDosyaYolu  =  "../Resimler/".$BankaKaydi["BankaLogosu"];

        $BankaSilmeSorgusu = $VeritabaniBaglantisi->prepare("DELETE FROM bankahesaplarimiz WHERE id = ? LIMIT 1 ");
        $BankaSilmeSorgusu->execute([$GelenID]);
        $BankaSilmeSayisi = $BankaSilmeSorgusu->rowCount();

        if ($BankaSilmeSayisi>0) {
            unlink($SilinecekDosyaYolu);
            header("Location:index.php?SKD=0&SKI=19");
            exit();
        } else {
            header("Location:index.php?SKD=0&SKI=20");
            exit();
        }

    } else {
        header("Location:index.php?SKD=0&SKI=20");
    }
}else{
    header("Location:index.php");
    exit();
}
