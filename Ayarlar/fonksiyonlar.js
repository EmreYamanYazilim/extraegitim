$(document).ready(function () {
    $.SoruIcerigiGoster = function (ElamanIDsi) {
        var SoruIDsi = ElamanIDsi;
        var IslenecekAlan = "#" + ElamanIDsi;

        $(".SorununCevapAlani").slideUp(); /* başına nokta koyunca clas, dies koyunca id  slideup açılan bir alanı yavaşça yukarı kaldırma */
        $(IslenecekAlan).parent().find(".SorununCevapAlani").slideToggle();

    }

    $.UrunDetayResmiDegistir = function (Klasor, ResimDegeri){
        var ResimIcıDosyaYolu = "Resimler/UrunResimleri/" + Klasor + "/" + ResimDegeri;
        $("#BuyukResim").attr("src", ResimIcıDosyaYolu);
    }


});