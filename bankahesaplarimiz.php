<table width="1065" height="210" align="center" bgcolor="#F9F9F9" border="0" cellpadding="0"
       cellspacing="0">
    <tr bgcolor="#0088CC">
        <td align="center" style="color: darkred"><h2>Banka Hesaplarımız</h2></td>
    </tr>

    <tr>
        <td align="left"> Dödemelerinizi burdan yapabilirsiniz</td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td align="left">
            <table width="1065" align="center" border="0" cellspacing="0" cellpadding="0" style=" margin-bottom: 20px">
                <tr>

                    <?php
                    $BankaSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz  ");
                    $BankaSorgusu->execute();
                    $BankaSayisi = $BankaSorgusu->rowCount();
                    $BankaKayitlari = $BankaSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $DonguSayisi        =   1;
                    $SutunAdetSayisi    =   3;

                    foreach ($BankaKayitlari as $Kayit) {

                    ?>


                    <td width="340" bgcolor="#CCCCCC">
                        <table align="center" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3">
                                    <img src="Resimler/<?php echo DonusumleriGeriDondur($Kayit["BankaLogosu"]) ?>" alt="">
                                </td>
                            </tr>

                            <tr>
                                <td>Banka Adı</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["BankaAdi"]) ?></td>
                            </tr>
                            <tr>
                                <td>Konum</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["KonumSehri"]) ?></td>

                            </tr>
                            <tr>
                                <td>Şube</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["KonumUlke"]) ?></td>
                            </tr>
                            <tr>
                                <td>Birim</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["ParaBirimi"]) ?></td>
                            </tr>
                            <tr>
                                <td>Hesap Adı</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["HesapSahibi"]) ?></td>
                            </tr>
                            <tr>
                                <td>Hesap No</td>
                                <td>:</td>
                                <td><?php echo DonusumleriGeriDondur($Kayit["HesapNumarasi"]) ?></td>
                            </tr>
                            <tr>
                                <td>IBAN No</td>
                                <td>:</td>
                                <td><?php echo IbanBicimlendir(DonusumleriGeriDondur($Kayit["IbanNumarasi"])) ?> </td>

                            </tr>


                        </table>
                        <br>

                    </td>

                    <td width="20">&nbsp;</td>

                        <?php
                        if ($DonguSayisi<$SutunAdetSayisi) {?>
                            <td width="20">&nbsp;</td>
                        <?php
                        }
                        ?>
                    <?php
                        $DonguSayisi++;
                        if ($DonguSayisi>$SutunAdetSayisi){
                            echo "</tr><tr>";
                            $DonguSayisi=1;
                        }

                    } ?>
                </tr>


            </table>
        </td>
    </tr>
</table>