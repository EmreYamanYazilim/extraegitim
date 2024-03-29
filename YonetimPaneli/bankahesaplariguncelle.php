<?php
if(isset($_SESSION["Yonetici"])){
    if (isset($_GET["ID"])){
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }

    $BankaHesaplarSorgusu       =   $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
    $BankaHesaplarSorgusu->execute([$GelenID]);
    $BankaSayisi                =   $BankaHesaplarSorgusu->rowCount();
    $BankaHesaplarKayirlari     =   $BankaHesaplarSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($BankaSayisi>0) {



    ?>
    <form action="index.php?SKD=0&SKI=15&ID=<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["id"])?>" method="POST" enctype="multipart/form-data" >
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;BANKA HESAP AYARLARI</h3></td>
                <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=10" style="color: #FFFFFF; text-decoration: none;">Yeni Banka Hesabı Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td>Banka Logosu</td>
                            <td>:</td>
                            <td><input type="file" name="BankaLogosu"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="BankaAdi" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["BankaAdi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="SubeAdi"  value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["SubeAdi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Banka Şube Kodu</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="SubeKodu" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["SubeKodu"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunduğu Şehir</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="KonumSehri"  value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["KonumSehri"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Bankanın Bulunduğu Ülke</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="KonumUlke"  value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["KonumUlke"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesabın Para Birimi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ParaBirimi" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["ParaBirimi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Sahibi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="HesapSahibi" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["HesapSahibi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Hesap Numarası</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="HesapNumarasi" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["HesapNumarasi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">IBAN</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="IbanNumarasi" value="<?php echo DonusumleriGeriDondur($BankaHesaplarKayirlari["IbanNumarasi"]) ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="Banka Hesabı Kaydet"  class="YesilButon"></td>
                        </tr>
                    </table></td>
            </tr>
        </table>
    </form>
    <?php
    }else{
        header("Location:index.php?SKD=1&SKI=17");
        exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}
?>
