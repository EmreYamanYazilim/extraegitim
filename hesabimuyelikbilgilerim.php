<?php
if (isset($_SESSION["Kullanici"])){ ?>

    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="3"><hr /></td>
    </tr>
    <tr>
        <td colspan="3"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=50" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=58" style="text-decoration: none; color: black;">Adresler</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=59" style="text-decoration: none; color: black;">Favoriler</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=61" style="text-decoration: none; color: black;">Siparişler</a></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td colspan="3"><hr /></td>
    </tr>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="500" valign="top">
                    <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td style="color:#FF9900"><h3>Üye Bilgileri</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCCCCC;"> Aşağıdan bilgilerinizi görebilir ve güncelleyebilirsiniz
                            </td>
                        </tr>

                        <!--  ayar.php üzerinden  bilgileri çektik-->
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><?php echo $EmailAdresi; ?></td>
                        </tr>


                        <td valign="bottom" align="left">isim soy isim</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><?php echo $IsimSoyisim;  ?> </td>
                        </tr>

                        <td valign="bottom" align="left">telefon numarası</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><?php echo $TelefonNumarasi; ?> </td>
                        </tr>

                        <td valign="bottom" align="left">cinsiyet</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><?php echo $Cinsiyet; ?></td>
                        </tr>

                        <td valign="bottom" align="left">kayıt tarihi</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"> <?php echo TarihBul($KayitTarihi); ?></td>
                        </tr>



                        <tr height="40">

                            <td align="center" ><a href="index.php?SK=51" class="BilgilerimiGuncelleButonu"> Bilgilerimi güncelle</a></td>
                        </tr>

                    </table>

            </td>

            <td width="20">&nbsp;</td>

            <td width="545" valign="top"><table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td  style="color:#FF9900"><h3>Reklam</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">EMREYAMANYAZILIM</td>
                    </tr>
                    <tr height="5">
                        <td height="5" style="font-size: 5px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><img src="Resimler/545x340.png" border="0"></td>
                    </tr>
                </table></td>


        </tr>
    </table>














<?php

}else{
    header("Location:index.php");
    exit();

}

?>