<?php
if(isset($_SESSION["Yonetici"])){
    if (isset($_GET["ID"])) {
        $GelenID        =       Guvenlik($_GET["ID"]);
    }else{
        $GelenID        =       "";
    }

    $YoneticiGuncellemeSorgusu      =       $VeritabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
    $YoneticiGuncellemeSorgusu->execute([$GelenID]);
    $YoneticiGuncellemeSsayisi      =       $YoneticiGuncellemeSorgusu->rowCount();
    $YoneticiGuncellemeSorgusu      =       $YoneticiGuncellemeSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($YoneticiGuncellemeSorgusu>0) {



    ?>
    <form action="index.php?SKD=0&SKI=76&ID=<?php echo $YoneticiGuncellemeSorgusu["id"] ?>" method="post" >
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;YÖNETİCİLER</h3></td>
                <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=70" style="color: #FFFFFF; text-decoration: none;">Yeni Yönetici Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td width="230">Kullanıcı Adı</td>
                            <td width="20">:</td>
                            <td width="500"><b><?php echo DonusumleriGeriDondur($YoneticiGuncellemeSorgusu["KullaniciAdi"]); ?></b></td>
                        </tr>
                        <tr height="40">
                            <td colspan="3">
                                <b>şifreyi güncellemek istemiyorsanız lütfen boş bırakınız...</b>
                            </td>
                        </tr>
                        <tr height="40">
                            <td width="230">Şifre</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="Sifre"  class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">İsim Soyisim</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="IsimSoyisim" value="<?php echo $YoneticiGuncellemeSorgusu["IsimSoyisim"] ?>" class="InputAlanlari"></td>
                        </tr>

                        <tr height="40">
                            <td width="230">E-Mail Adresi</td>
                            <td width="20">:</td>
                            <td width="500"><input type="email" name="EmailAdresi"  value="<?php echo $YoneticiGuncellemeSorgusu["EmailAdresi"] ?>" class="InputAlanlari"></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Telefon Numarası</td>
                            <td width="20" valign="top">:</td>
                            <td width="500"><input type="text" name="TelefonNumarasi" value="<?php echo $YoneticiGuncellemeSorgusu["TelefonNumarasi"] ?>" class="InputAlanlari" maxlength="11"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="Yönetici Kaydet" class="YesilButon"></td>
                        </tr>
                    </table></td>
            </tr>
        </table>
    </form>
    <?php

    }else{
        header("Location:index.php?SKD=0&SKI=78");
        exit();
    }
}else{
    header("Location:index.php?SKD=1");
    exit();
}
?>