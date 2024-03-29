<?php 




$IPAdresi			=	$_SERVER['REMOTE_ADDR'];
$ZamanDamgasi		=	time();
$TarihSaat			=	date("d.m.Y H:i:s", $ZamanDamgasi);

$SiteKokDizini      =   $_SERVER["DOCUMENT_ROOT"];
$ResimKlasoruYolu   =   '/extraegitim/Resimler/';//kendi localhostza göre veya internet üzerindeki alanıza göre değiştircez
$VerotIcinKlasorYolu =   $SiteKokDizini.$ResimKlasoruYolu;


function TarihBul($Deger){
    $Cevir =    date("d.m.Y H:i:s", $Deger);
    $Sonuc = $Cevir;
    return $Sonuc;
}

function UcGunIleriTarihi(){
    global $ZamanDamgasi;
    $BirGun     =   86400;  // bir gün bu kadar  saniyedir
    $Hesapla    =   $ZamanDamgasi+(3*$BirGun);
    $Cevir      =   date("d.m.Y", $Hesapla );
    $Sonuc      =   $Cevir;
    return $Sonuc;
}


function RakamlarHariciTumKArakterleriSil($Deger){
    $Islem  =   preg_replace("/[^0-9]/","",$Deger);  // şapka işareti onların yanındakiler dışındakilerin  manasına gelir o yüzden rakkamlar dışındakileri preg_replace siler
    $Sonuc  =   $Islem;
    return $Sonuc;
}

function TumBosluklariSil($Deger){
    $Islem      =   preg_replace("/\s|&nbsp;/","", $Deger); //  \s boşluk demektir | veya anlamı katar &nbsp; de boşluk demktir
    $Sonuc      =   $Islem;
    return $Sonuc;

}


function DonusumleriGeriDondur($Deger){
    $GeriDondur     =   htmlspecialchars_decode($Deger, ENT_QUOTES);  // htmlspacialchars ile etkisiz yaptıklarımızı decode ekleyerek  tekrardan ekletiyoruz
    $Sonuc          =   $GeriDondur;
    return $Sonuc;
}

function Guvenlik($Deger){
	$BoslukSil		=	trim($Deger);
	$TaglariTemizle	=	strip_tags($BoslukSil);
	$EtkisizYap		=	htmlspecialchars($TaglariTemizle,ENT_QUOTES);
	$sonuc			=	$EtkisizYap;
	return $sonuc;
}


function SayiliIcerikleriFilitrele($Deger){
    $BoslukSil		=	trim($Deger);
    $TaglariTemizle	=	strip_tags($BoslukSil);
    $EtkisizYap		=	htmlspecialchars($TaglariTemizle, ENT_QUOTES);
    $Temizle        =   RakamlarHariciTumKArakterleriSil($EtkisizYap);
    $sonuc			=	$Temizle;
    return $sonuc;
}


function IbanBicimlendir($Deger){
    $BoslukSil          =    trim($Deger);
    $TumbosluklariSil   =   TumBosluklariSil($BoslukSil);// trim gibi boşlukları silidirdik garanti olsun diye yazdık
    $BirinciBlok        =   substr($TumbosluklariSil, 0,4);
    $IkinciBlok         =   substr($TumbosluklariSil,4,4);
    $UcuncuBlok         =   substr($TumbosluklariSil,8,4);
    $DorduncuBlok       =   substr($TumbosluklariSil,12,4);
    $BesinciBlok        =   substr($TumbosluklariSil,16,4);
    $AltinciBlok        =   substr($TumbosluklariSil,20,4);
    $YedinciBlok        =   substr($TumbosluklariSil,24,2);
    $Duzenle            =   $BirinciBlok." ".$IkinciBlok." ".$UcuncuBlok." ".$DorduncuBlok." ".$BesinciBlok." ".$AltinciBlok." ".$YedinciBlok;
    $Sonuc              =   $Duzenle;
    return $Sonuc;

}

function FiyatBicimlendir($Deger) {
    $Bicimlendir = number_format($Deger , "2", ",", ".");
    $Sonuc = $Bicimlendir;
        return $Sonuc;
}


function  ResimAdiOlustur(){
    $Sonuc  =  substr(md5(uniqid(time())),0,25 );  //time ile zaman damgamızı buldum.zamandamgamızı uniqid ile benzersiz değer ürettim sonra md5 içine alarak  kriptolama mantığına soktum.substr ile sıfırdan başla 25 kareakter al dedim benzersiz isim oluşturudm
    return $Sonuc;
}








?>