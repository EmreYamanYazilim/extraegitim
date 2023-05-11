<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?SK=52" method="post">
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
                        <td valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari" value="<?php echo $IsimSoyisim; ?>" </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="mail" name="EmailAdresi" class="InputAlanlari" value="<?php echo $EmailAdresi; ?>" </td>
                    </tr>
                    <tr height="30">

                    <tr height="30">
                        <td valign="bottom" align="left">Şifre (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="Sifre"  value="EskiSifre" class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">

                    <tr height="30">
                        <td valign="bottom" align="left">Şifre Tekrar (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="SifreTekrar" value="EskiSifre" class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">

                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="TelefonNumarasi" value="<?php echo $TelefonNumarasi; ?>" maxlength="11"
                                                             class="InputAlanlari"></td>
                    </tr>

                    <tr height="30">

                        <td valign="bottom" align="left">Cinsiyet(*)</td>
                    </tr>
                    <tr height="30">
                        <td>
                            <select name="Cinsiyet" id="" class="SelectAlanlari">
                                <option value="Erkek" <?php if ($Cinsiyet=="Erkek"){ ?> selected="selected" <?php } ?>>Erkek</option>
                                <option value="Kadin" <?php if ($Cinsiyet=="Kadin"){?> selected="selected"  <?php } ?>>Kadın</option>
                            </select>
                        </td>
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