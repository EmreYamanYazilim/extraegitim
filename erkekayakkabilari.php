<?php
if (isset($_GET["MenuID"])){
    $GelenMenuId    =   $_GET["MenuID"];
}else{
    $GelenMenuId    =   "";  // döngüdeki menuler içindeki idleri yakalayabilmek için yaptım
}

?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100">
        <td width="250" align="left" valign="top">
            <table width="250" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellspacing="0" cellpadding="0">

                <tr height="50">
                    <td bgcolor="#F1F1F1"><b>&nbsp;MENULER</b></td>
                </tr>
                <tr><td><a href="index.php?SK=84" style="text-decoration: none; <?php  if ($GelenMenuId=="") {?> color: darkred; font-weight: bold; <?php }else{ ?>  color: #646464; font-weight: bold; <?php }?>">
                            Tüm Ürünler(xxx)
                        </a></td></tr>
                <?php
                $MenulerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE  UrunTuru = 'Erkek Ayakkabısı' ORDER BY MenuAdi ASC");
                $MenulerSorgusu->execute();
                $MenuKayitSayisi = $MenulerSorgusu->rowCount();
                $MenuKayitlari = $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);


                foreach ($MenuKayitlari as $Menu) {
                    ?>


                    <tr>
                        <td><a href="index.php?SK=84&MenuID=<?php echo $Menu["id"] ?>"
                               style="text-decoration: none;  <?php if($GelenMenuId==$Menu["id"]){ ?> color: darkred; font-weight: bold; <?php }else{ ?> color: #646464; font-weight: bold; <?php } ?>  "> <?php echo DonusumleriGeriDondur($Menu["MenuAdi"]) ?>
                                (<?php echo $Menu["UrunSayisi"] ?>)
                            </a></td>
                    </tr>


                <?php } ?>

                </table>


                </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><table width="250" align="center" border="0" cellspacing="0" cellpadding="0">

                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;Reklamlar</b></td>
                            </tr>

                            <?php
                            $BannerSorgusu      =       $VeritabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE BannerAlani = 'Menu Altı' ORDER BY GosterimSayisi ASC LIMIT 1 ");
                            $BannerSorgusu->execute();
                            $BannerSayisi       =       $BannerSorgusu->rowCount();
                            $BannerKaydi        =       $BannerSorgusu->fetch(PDO::FETCH_ASSOC);

                            
                                ?>


                                <tr height="250">
                                    <td><img src="Resimler/<?php echo $BannerKaydi["BannerResmi"]; ?>" alt=""></td>
                                </tr>
                            <?php
                            $BannerGuncelle     =       $VeritabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id = ? LIMIT 1");
                            $BannerGuncelle->execute([$BannerKaydi["id"]]);

                            ?>




                        </table></td>
                </tr>

            </table>
        </td>
        <td width="11" align="left">&nbsp;</td>
        <td width="795" align="left" valign="top"> Ürünler</td>
    </tr>


</table>