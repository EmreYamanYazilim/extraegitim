<?php

if (isset($_POST["KargoTakipNosu"])){

    $GelenKargoTakipNosu = SayiliIcerikleriFilitrele(Guvenlik($_POST["KargoTakipNosu"]));

} else {
    $GelenKargoTakipNosu ="";
}


if ($GelenKargoTakipNosu!=""){
    header("Location:https://kargotakip.org/kargo-takip-no-sorgulama-sonucu/?firma=trendyol&takipno=" .$GelenKargoTakipNosu);
    exit();
}else{
    header("Location:index.php?SK=14");
    exit();
}











?>