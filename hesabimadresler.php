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
                            <td style="color:#FF9900"><h3>Hesabım > Adresler</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCCCCC;"> Tüm adreslerinizi burdan görebilrisiniz
                            </td>
                        </tr>
                        <tr height="50">
                            <td colspan="1" style="background: #f8ffa7; color: black; font-weight: bold;" align="left">&nbsp;Adresler</td>
                            <td colspan="4" style="background: #f8ffa7; color: black; font-weight: bold;" align="right"><a href="index.php?SK=70" style="text-decoration: none; color: #000000;">+ Yeni Adres Ekle</a>&nbsp;</td>
                        </tr>
                        <?php
                        $AdreslerSorgusu        =       $VeritabaniBaglantisi->prepare("SELECT * FROM adresler where UyeId = ?");
                        $AdreslerSorgusu->execute([$KullaniciID]);
                        $AdreslerSayisi =   $AdreslerSorgusu->rowCount();
                        $AdreslerKayitlari =   $AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                        if ($AdreslerSayisi>0) {
                            foreach ($AdreslerKayitlari as $Satirlar){
                            ?>
                                <tr height="50" >
                                    <td align="left"><?php echo $Satirlar["AdSoyad"]; ?> - <?php echo $Satirlar["Adres"]; ?> <?php echo $Satirlar["Ilce"]; ?> / <?php echo $Satirlar["Sehir"]; ?> - <?php echo $Satirlar["TelefonNumarasi"]; ?></td>
                                    <td width="25"><img src="Resimler/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></td>
                                    <td width="70"><a href="index.php?SK=62&ID=<?php echo $Satirlar["id"]; ?>" style="text-decoration: none; color: #646464;">Güncelle</a></td>
                                    <td width="25"><img src="Resimler/Sil20x20.png" border="0" style="margin-top: 5px;"></td>
                                    <td width="25"><a href="index.php?SK=67&ID=<?php echo $Satirlar["id"]; ?>" style="text-decoration: none; color: #646464;">Sil</a></td>
                                </tr>



                         <?php }

                        }else{
                            ?>


                            <tr height="30">
                                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;"> Adres Kaydı Bulunmuyor
                                </td>
                            </tr>

                        <?php
                        }
                        ?>









                    </table>

            </td>


        </tr>
    </table>


        <?php

        }else{
            header("Location:index.php");
            exit();

        }

        ?>











