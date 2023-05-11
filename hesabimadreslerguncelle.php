<?php
if (isset($_SESSION["Kullanici"])){
    if (isset($_GET["ID"])){
        $GelenID        = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

        if ($GelenID!=""){

        $AdresSorgusu   =   $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? AND UyeId = ? LIMIT 1");
        $AdresSorgusu->execute([$GelenID, $KullaniciID ]);
        $AdresSayisi    =   $AdresSorgusu->rowCount();
        $KayitBilgisi   =   $AdresSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($AdresSayisi>0){

    ?>

    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="500" valign="top">
                <form action="index.php?SK=63&ID=<?php echo $GelenID;?>" method="post">
                    <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td style="color:#FF9900"><h3>Bilgileri Değiştir</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCCCCC;"> Bilgilerinizi girerek değiştirin.....
                                olun
                            </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">İsim Soyisim (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"  value="<?php echo $KayitBilgisi["AdSoyad"]; ?>" </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">Adresi (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="Adres" class="InputAlanlari" value="<?php echo $KayitBilgisi["Adres"]; ?>"  </td>
                        </tr>
                        <tr height="30">

                        <tr height="30">
                            <td valign="bottom" align="left">İlçe</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="Ilce"   class="InputAlanlari" value="<?php echo $KayitBilgisi["Ilce"] ?>"></td>
                        </tr>
                        <tr height="30">

                        <tr height="30">
                            <td valign="bottom" align="left">Sehir</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="Sehir"   class="InputAlanlari" value="<?php echo $KayitBilgisi["Sehir"] ?>" ></td>
                        </tr>
                        <tr height="30">


                            <td valign="bottom" align="left">Telefon Numarası (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="TelefonNumarasi"  maxlength="11"
                                                                 class="InputAlanlari"   value="<?php echo $KayitBilgisi["TelefonNumarasi"] ?>"></td>
                        </tr>






                        <tr height="40">

                            <td align="center"><input type="submit" value="Bilgilerimi Güncelle" class="YesilButon"></td>
                        </tr>
                    </table>
                </form>
            </td>

            <td width="20">&nbsp;</td>

        </tr>
    </table>

    <?php

        }else{
            header("Localhost:index.php?SK=65");
        }


    }else{
        header("Location:index.php?SK=65");
        exit();
    }

}else{
    header("Location:index.php");
    exit();
}
?>