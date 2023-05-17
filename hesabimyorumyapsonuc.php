<?php
if (isset($_SESSION["Kullanici"])){
    if (isset($_GET["UrunId"])){
        $GelenUrunId    =   Guvenlik($_GET["UrunId"]);
    }else{
        $GelenUrunId    =   "";
    }
    if (isset($_POST["Puan"])){
        $GelenPuan  =   Guvenlik($_POST["Puan"]);
    }else{
        $GelenPuan  =   "";
    }
    if (isset($_POST["Yorum"])){
        $GelenYorum     =   Guvenlik($_POST["Yorum"]);
    }else{
        $GelenYorum     =   "";
    }



    if (($GelenUrunId!="") and ($GelenPuan!="") and ($GelenYorum!="")){
        $YorumKayitSorgusu      =   $VeritabaniBaglantisi->prepare("INSERT INTO yorumlar (UrunId, UyeId, Puan, YorumMetni, YorumTarihi, YorumIpAdresi) values (?, ?, ?, ?, ?, ?)");
        $YorumKayitSorgusu->execute([$GelenUrunId, $KullaniciID, $GelenPuan, $GelenYorum, $ZamanDamgasi, $IPAdresi]);
        $YorumKayiKontrol      =   $YorumKayitSorgusu->rowCount();
        if ($YorumKayiKontrol>0) {

            $UrunGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi+1, ToplamYorumPuani=ToplamYorumPuani+? WHERE id = ? LIMIT 1");
            $UrunGuncellemeSorgusu->execute([$GelenPuan, $KullaniciID
            ]);
            $UrunGuncellemeKontrol = $UrunGuncellemeSorgusu->rowCount();
            if ($UrunGuncellemeKontrol > 0) {
                header("Location:index.php?SK=77");
                exit();
            } else {
                header("Location:index.php?SK=78");
                exit();
            }

        }
        header("Location:index.php?SK=77");
            exit();
        }else{
            header("Location:index.php?SK=79");
            exit();
        }

    }

else{
    header("Location:index.php");
    exit();
}

?>