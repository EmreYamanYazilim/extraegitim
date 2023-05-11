<form action="index.php?SK=15" method="post">
    <table>
        <tr>
            <td>
                <h1>Sık Sorulan Sorular</h1>
            </td>
        </tr>

        <tr>
            <td>
                <b>Aklınıza takılan sorularun cevaplarını bu sayfada cevapladık</b>
            </td>
        </tr>

        <tr>
            <td> <?php
                $SoruSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sorular");
                $SoruSorgusu->execute();
                $SoruSayisi = $SoruSorgusu->rowCount();
                $SoruKayitlari = $SoruSorgusu->fetchAll(PDO::FETCH_ASSOC);


                foreach ($SoruKayitlari as $Kayitlar) {
                    ?>
                    <div>

                        <div id="<?php echo $Kayitlar["id"]; ?>" onclick="$.SoruIcerigiGoster(<?php echo $Kayitlar["id"]; ?>)"><b> <?php echo $Kayitlar["soru"]; ?> </b></div>
                        <div class="SorununCevapAlani" style="display: none;" ><?php echo $Kayitlar["cevap"]; ?></div>

                    </div>

                <?php } ?>
            </td>
        </tr>

    </table>
</form>