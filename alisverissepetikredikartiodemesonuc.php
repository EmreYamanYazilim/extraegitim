<?php
session_start();
ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once ("Ayarlar/sitesayfalari.php");

$oid			      =	$_POST['oid']; //Sepet Numarası burdan çekiliccek

$SepetinTaksitSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE SepetNumarasi = ? LIMIT 1 ");
$SepetinTaksitSorgusu->execute([$oid]);
$TaksitKaydi          = $SepetinTaksitSorgusu->fetch(PDO::FETCH_ASSOC);

$TaksitSayisi         = $TaksitKaydi["TaksitSecimi"];
if ($TaksitSayisi==1) {
    $TaksitSayisi = "";
}

$hashparams		=	$_POST["HASHPARAMS"];
$hashparamsval	=	$_POST["HASHPARAMSVAL"];
$hashparam		=	$_POST["HASH"];
$storekey		=	DonusumleriGeriDondur($StoreKey);	// Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
$paramsval		=	"";
$index1			=	0;
$index2			=	0;
while($index1<@strlen($hashparams)){
    $index2		=	@strpos($hashparams,":",$index1);
    $vl			=	$_POST[@substr($hashparams,$index1,$index2-$index1)];
    if($vl==null)
        $vl			=	"";
    $paramsval	=	$paramsval.$vl;
    $index1		=	$index2+1;
}
$hashval		=	$paramsval.$storekey;
$hash			=	@base64_encode(@pack('H*',@sha1($hashval)));
if($paramsval!=$hashparamsval || $hashparam!=$hash)
    echo "<h4>Güvenlik Uyarısı! Sayısal İmza Geçerli Değil.</h4>";

$name			=	DonusumleriGeriDondur($ApiKullanicisi);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Adı
$password		=	DonusumleriGeriDondur($ApiSifresi);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Şifresi
$clientid		=	$_POST["clientid"];
$mode			=	"P";	// P Çekim İşlemi Demek, T Test İşlemi Demek (Kesinlikle P Olacak Yoksa Çekimler Kart Sahibine Geri Gider)
$type			=	"Auth";	// Auth: Satış PreAuth: Ön Otorizasyon
$expires		=	$_POST["Ecom_Payment_Card_ExpDate_Month"]."/".$_POST["Ecom_Payment_Card_ExpDate_Year"];
$cv2			=	$_POST['cv2'];
$tutar			=	$_POST["amount"];
$taksit			=	$TaksitSayisi;	// Taksit Yapılacak İse Taksit Sayısı Girilmeli, 0 Kesinlikle Girilmeyecektir. Tek Çekim İçin Boş Bırakılacaktır, Taksit İşlemleri İçin Minimum 2 Girilir. Maksimum Bankanın Size Vereceği Taksit Sayısı Kadardır.
$lip			=	GetHostByName($REMOTE_ADDR);
$email			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail Adresini Gönderebilirsiniz
$mdStatus		=	$_POST['mdStatus'];
$xid			=	$_POST['xid'];
$eci			=	$_POST['eci'];
$cavv			=	$_POST['cavv'];
$md				=	$_POST['md'];

if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4"){
    $request	=	"DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>"."<CC5Request>"."<Name>{NAME}</Name>"."<Password>{PASSWORD}</Password>"."<ClientId>{CLIENTID}</ClientId>"."<IPAddress>{IP}</IPAddress>"."<Email>{EMAIL}</Email>"."<Mode>P</Mode>"."<OrderId>{OID}</OrderId>"."<GroupId></GroupId>"."<TransId></TransId>"."<UserId></UserId>"."<Type>{TYPE}</Type>"."<Number>{MD}</Number>"."<Expires></Expires>"."<Cvv2Val></Cvv2Val>"."<Total>{TUTAR}</Total>"."<Currency>949</Currency>"."<Taksit>{TAKSIT}</Taksit>"."<PayerTxnId>{XID}</PayerTxnId>"."<PayerSecurityLevel>{ECI}</PayerSecurityLevel>"."<PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>"."<CardholderPresentCode>13</CardholderPresentCode>"."<BillTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."<Company></Company>"."<TelVoice></TelVoice>"."</BillTo>"."<ShipTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."</ShipTo>"."<Extra></Extra>"."</CC5Request>";
    $request	=	@str_replace("{NAME}",$name,$request);
    $request	=	@str_replace("{PASSWORD}",$password,$request);
    $request	=	@str_replace("{CLIENTID}",$clientid,$request);
    $request	=	@str_replace("{IP}",$lip,$request);
    $request	=	@str_replace("{OID}",$oid,$request);
    $request	=	@str_replace("{TYPE}",$type,$request);
    $request	=	@str_replace("{XID}",$xid,$request);
    $request	=	@str_replace("{ECI}",$eci,$request);
    $request	=	@str_replace("{CAVV}",$cavv,$request);
    $request	=	@str_replace("{MD}",$md,$request);
    $request	=	@str_replace("{TUTAR}",$tutar,$request);
    $request	=	@str_replace("{TAKSIT}",$taksit,$request);

    $url		=	"https://<sunucu_adresi>/<apiserver_path>"; // Bu Adres Banka veya EST Firması Tarafından Verilir
    $ch			=	@curl_init();
    @curl_setopt($ch, CURLOPT_URL,$url);
    @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
    @curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    @curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    $result		=	@curl_exec($ch);
    if(@curl_errno($ch)){
        print @curl_error($ch);
    }else{
        @curl_close($ch);
    }
    $Response		=	"";
    $OrderId		=	"";
    $AuthCode		=	"";
    $ProcReturnCode	=	"";
    $ErrMsg			=	"";
    $HOSTMSG		=	"";
    $HostRefNum		=	"";
    $TransId		=	"";
    $response_tag	=	"Response";
    $posf			=	@strpos($result,("<".$response_tag.">"));
    $posl			=	@strpos($result,("</".$response_tag.">"));
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $Response		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"OrderId";
    $posf			=	@strpos($result,("<".$response_tag.">"));
    $posl			=	@strpos($result,("</".$response_tag.">")) ;
    $posf			=	$posf+@strlen($response_tag)+2;
    $OrderId		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"AuthCode";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $AuthCode		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"ProcReturnCode";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $ProcReturnCode	=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"ErrMsg";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $ErrMsg			=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"HostRefNum";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $HostRefNum		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"TransId";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $$TransId		=	@substr($result,$posf,$posl-$posf);
    if($Response==="Approved"){
        //Başarılı işlem bölümü

        $AlisverisSepetiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE SepetNumarasi = ?  ");
        $AlisverisSepetiSorgusu->execute([$oid]);
        $SepetSayisi            = $AlisverisSepetiSorgusu->rowCount();
        $SepetUrunleri          = $AlisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($SepetSayisi>0) {
            $UrnunToplamFiyati           = 0;
            $UrununToplamKargoFiyati     = 0;

            foreach ($SepetUrunleri as $SepetSatirlari) {
                // sepetle alakalı siparisler tablosu ile alakalı tüm stunları değişkene verdik başka yerdede kullanmak için burada kullanmak için rahatlık olsun diye
                $SepetIdsi = $SepetSatirlari["id"]; // silme işleminde kullanacam
                $SepetSepetNumarasi = $SepetSatirlari["SepetNumarasi"];
                $SepettekiUyeId = $SepetSatirlari["UyeId"];
                $SepettekiUrunId = $SepetSatirlari["UrunId"];
                $SepettekiAdresId = $SepetSatirlari["AdresId"];
                $SepettekiVaryantId = $SepetSatirlari["VaryantId"];
                $SepettekiKargoId = $SepetSatirlari["KargoId"];
                $SepettekiUrunAdedi = $SepetSatirlari["UrunAdedi"];
                $SepettekiOdemeSecimi = $SepetSatirlari["OdemeSecimi"];
                $SepettekiTaksitSecimi = $SepetSatirlari["TaksitSecimi"];

                $UrunBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                $UrunKaydi = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                $UrunTuru = $UrunKaydi["UrunTuru"];
                $UrunAdi = $UrunKaydi["UrunAdi"];
                $UrunFiyati = $UrunKaydi["UrunFiyati"];
                $UrunParaBirimi = $UrunKaydi["ParaBirimi"];
                $UrunKdvOrani = $UrunKaydi["KdvOrani"];
                $VaryantBasligi = $UrunKaydi["VaryantBasligi"];
                $UrunKargoUcreti = $UrunKaydi["KargoUcreti"];
                $UrunResmiBir = $UrunKaydi["UrunResmiBir"];


                $UrunVaryantBilgileriSorgulama = $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                $UrunVaryantBilgileriSorgulama->execute([$SepettekiVaryantId]);
                $VaryantKaydi = $UrunVaryantBilgileriSorgulama->fetch(PDO::FETCH_ASSOC);

                $VaryantAdi = $VaryantKaydi["VaryantAdi"];


                $KargoBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
                $KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
                $KargoKaydi = $KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                $KargonunAdi = $KargoKaydi["KargoFirmasiAdi"];

                $AdresBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
                $AdresBilgileriSorgusu->execute([$SepettekiAdresId]);
                $AdresKaydi = $AdresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                $AdresAdSoyad = $AdresKaydi["AdSoyad"];
                $AdresAdres = $AdresKaydi["Adres"];
                $AdresIlce = $AdresKaydi["Ilce"];
                $AdresSehir = $AdresKaydi["Sehir"];
                $AdresTelefonNumarasi = $AdresKaydi["TelefonNumarasi"];
                $AdresToparla = $AdresAdres . " " . $AdresSehir . " " . $AdresIlce;

                if ($UrunParaBirimi == "USD") {
                    $UrunFiyatiHesapla = $UrunFiyati * $DolarKuru;
                } elseif ($UrunParaBirimi == "EUR") {
                    $UrunFiyatiHesapla = $UrunFiyati * $EuroKuru;
                } else {
                    $UrunFiyatiHesapla = $UrunFiyati;
                }

                $UrnunToplamFiyati       = ($UrunFiyatiHesapla * $SepettekiUrunAdedi);
                $UrununToplamKargoFiyati = ($UrunKargoUcreti * $SepettekiUrunAdedi);


                $SiparisEkle = $VeritabaniBaglantisi->prepare("INSERT INTO siparisler (UyeId, SiparisNumarasi, UrunId, UrunTuru, UrunAdi, UrunFiyati, KdvOrani ,UrunAdedi, ToplamUrunFiyati, KargoFirmasiSecimi, KargoUcreti, UrunResmiBir, VaryantBasligi, VaryantSecimi, AdresAdiSoyadi, AdresDetay, AdresTelefon, OdemeSecimi, TaksitSecimi, SiparisTarihi, SiparisIpAdresi, KargoDurumu) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $SiparisEkle->execute([$SepettekiUyeId, $SepetSepetNumarasi, $SepettekiUrunId, $UrunTuru, $UrunAdi, $UrunFiyatiHesapla, $UrunKdvOrani, $SepettekiUrunAdedi, $UrnunToplamFiyati, $KargonunAdi, $UrununToplamKargoFiyati, $UrunResmiBir, $VaryantBasligi, $VaryantAdi, $AdresAdSoyad, $AdresToparla, $AdresTelefonNumarasi, 'Kredi Kartı', $TaksitSayisi, $ZamanDamgasi, $IPAdresi, 0]);
                $EklemeKontrol = $SiparisEkle->rowCount();


//                 sipariş işleme  ve sepetten silme bölümü
                if($EklemeKontrol>0){
                    $SepettenSilmeSorgusu	=	$VeritabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                    $SepettenSilmeSorgusu->execute([$SepetIdsi, $SepettekiUyeId]);
//                        toplam satış sayısı düzenleme ve stok adedi eksiltme bölümü
                    $UrunSatisiArttirmaSorgusu	=	$VeritabaniBaglantisi->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi + ? WHERE id = ?");
                    $UrunSatisiArttirmaSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);

                    $StokGuncellemeSorgusu	=	$VeritabaniBaglantisi->prepare("UPDATE urunvaryantlari SET StokAdedi=StokAdedi - ? WHERE id = ? LIMIT 1");
                    $StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi, $SepettekiVaryantId]);
                }else{

                }

            }


            // kargo ücretini sildirmek için sorgu
            $KargoFiyatiIcınSiparislerSorgusu = $VeritabaniBaglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ?  AND SiparisNumarasi= ?");
            $KargoFiyatiIcınSiparislerSorgusu->execute([$SepettekiUyeId, $SepetSepetNumarasi]);
            $KargoFiyatiKaydi                 = $KargoFiyatiIcınSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
            $ToplamUcretimiz                  = $KargoFiyatiKaydi["ToplamUcret"];

            if ($ToplamUcretimiz>=$UcretsizKargoBaraji){
                $SiparisGuncelle = $VeritabaniBaglantisi->prepare("UPDATE siparisler SET KargoUcreti = ? WHERE UyeId = ? AND SiparisNumarasi = ?");
                $SiparisGuncelle->execute([0,$SepettekiUyeId ,$SepetSepetNumarasi]);
            }

        }

    }else{
        echo "Ödeme isleminiz sırasında hata oluştu. Hata = ".$ErrMsg;
    }
}else{
    echo "Kredi Kartı Bankası 3D Onayı Vermedi, Lütfen Bilgileriniz Kontrol Edip Tekrar Deneyiniz. Sorununuz Devam Eder İse Lütfen Kartınızın Sahibi Olan Bankanın Müşteri Temsilcileriyle İletişime Geçiniz.";
}




$VeritabaniBaglantisi = null;
ob_end_flush();

?>