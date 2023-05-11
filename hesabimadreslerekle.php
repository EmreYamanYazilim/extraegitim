<?php
if (isset($_SESSION["Kullanici"])){
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?SK=71" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:#FF9900"><h3>Bilgileri Değiştir</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;"> Bilgilerinizi girerek değiştirin
                            olun
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"  </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="Adres" class="InputAlanlari"  </td>
                    </tr>
                    <tr height="30">

                    <tr height="30">
                        <td valign="bottom" align="left">İlçe</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="Ilce"   class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">

                    <tr height="30">
                        <td valign="bottom" align="left">Sehir</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="Sehir"   class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">


                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="TelefonNumarasi"  maxlength="11"
                                                             class="InputAlanlari"></td>
                    </tr>






                    <tr height="40">

                        <td align="center"><input type="submit" value="Adresi Ekle" class="YesilButon"></td>
                    </tr>
                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

    </tr>
</table>

<?php
}else{
    header("Location:index.php");
    exit();
}
    ?>