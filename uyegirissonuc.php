<?php

if(isset($_POST["EmailAdresi"])){
    $GelenEmailAdresi		=	Guvenlik($_POST["EmailAdresi"]);
}else{
    $GelenEmailAdresi		=	"";
}
if(isset($_POST["Sifre"])){
    $GelenSifre				=	Guvenlik($_POST["Sifre"]);
}else{
    $GelenSifre				=	"";
}

$MD5liSifre					=	md5($GelenSifre);

if(($GelenEmailAdresi!="") and ($GelenSifre!="")){
    $KontrolSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND Sifre = ? ");
    $KontrolSorgusu->execute([$GelenEmailAdresi, $MD5liSifre]);
    $KullaniciSayisi	=	$KontrolSorgusu->rowCount();
    $KullaniciKaydi		=	$KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

    if($KullaniciSayisi>0){
        if($KullaniciKaydi["Durumu"]==0){
            $_SESSION["Kullanici"]	=	$GelenEmailAdresi;

            if($_SESSION["Kullanici"]==$GelenEmailAdresi){
                header("Location:index.php?SK=50");
                exit();
            }else{
                header("Location:index.php?SK=33");
                exit();
            }
        }else{
            header("Location:index.php?SK=33");
            exit();

        }
    }else{
        header("Location:index.php?SK=34");
        exit();
    }
}else{
    header("Location:index.php?SK=35");
    exit();
}
?>