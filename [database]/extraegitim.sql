-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 08 Tem 2023, 10:13:40
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `extraegitim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

DROP TABLE IF EXISTS `adresler`;
CREATE TABLE IF NOT EXISTS `adresler` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UyeId` int(11) UNSIGNED NOT NULL,
  `AdSoyad` varchar(111) NOT NULL,
  `Adres` varchar(222) NOT NULL,
  `Ilce` varchar(111) NOT NULL,
  `Sehir` varchar(111) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `adresler`
--

INSERT INTO `adresler` (`id`, `UyeId`, `AdSoyad`, `Adres`, `Ilce`, `Sehir`, `TelefonNumarasi`) VALUES
(1, 1, 'Emre Yaman', 'şükrü paşa mahallesi bahriye üç ok cad', 'Merkez', 'Edirne', '5515976632'),
(4, 1, 'deneme 1 2323323', 'şükrü paşa mahallesi bahriye üç ok cadd', 'Merkez', 'Edirne', '5515976632');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

DROP TABLE IF EXISTS `ayarlar`;
CREATE TABLE IF NOT EXISTS `ayarlar` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SiteAdi` varchar(60) NOT NULL,
  `SiteTitle` varchar(60) NOT NULL,
  `SiteDescription` varchar(255) NOT NULL,
  `SiteKeywords` varchar(255) NOT NULL,
  `SiteCopyrightMetni` varchar(255) NOT NULL,
  `SiteLogosu` varchar(30) NOT NULL,
  `SiteLinki` varchar(255) NOT NULL,
  `SiteEmailAdresi` varchar(50) NOT NULL,
  `SiteEmailSifresi` varchar(50) NOT NULL,
  `SiteEmailHostAdresi` varchar(222) NOT NULL,
  `SosyalLinkFacebook` varchar(255) NOT NULL,
  `SosyalLinkTwitter` varchar(255) NOT NULL,
  `SosyalLinkInstegram` varchar(255) NOT NULL,
  `SosyalLinkYoutube` varchar(255) NOT NULL,
  `SosyalLinkLinkedin` varchar(255) NOT NULL,
  `SosyalLinkPinterest` varchar(255) NOT NULL,
  `DolarKuru` double UNSIGNED NOT NULL,
  `EuroKuru` double UNSIGNED NOT NULL,
  `UcretsizKargoBaraji` double UNSIGNED NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `StoreKey` varchar(100) NOT NULL,
  `ApiKullanicisi` varchar(100) NOT NULL,
  `ApiSifresi` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `SiteAdi`, `SiteTitle`, `SiteDescription`, `SiteKeywords`, `SiteCopyrightMetni`, `SiteLogosu`, `SiteLinki`, `SiteEmailAdresi`, `SiteEmailSifresi`, `SiteEmailHostAdresi`, `SosyalLinkFacebook`, `SosyalLinkTwitter`, `SosyalLinkInstegram`, `SosyalLinkYoutube`, `SosyalLinkLinkedin`, `SosyalLinkPinterest`, `DolarKuru`, `EuroKuru`, `UcretsizKargoBaraji`, `ClientID`, `StoreKey`, `ApiKullanicisi`, `ApiSifresi`) VALUES
(1, 'Dağdan Mağazası', 'Ayakkabı denince Akla biz geliriz', 'Ayaklarınız rahat etsin istiyorsanız  doğru adres biziz', 'Ayaklarınız rahat etsin istiyorsanız  doğru adres biziz', 'Copyright 2023 - Dagdan - Tüm hakları saklıdır.', 'logo.png', 'asdasdasd', 'alyadua@hotmail.com.tr', '12345678', 'alyadua@hotmail.com.tr', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.youtube.com', 'https://www.linkedin.com', 'https://www.pinterest.com', 20, 20, 900, '0000000', '1111111', '3Dkullanicim', '3DSifrem');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bankahesaplarimiz`
--

DROP TABLE IF EXISTS `bankahesaplarimiz`;
CREATE TABLE IF NOT EXISTS `bankahesaplarimiz` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BankaLogosu` varchar(100) NOT NULL,
  `BankaAdi` varchar(100) NOT NULL,
  `KonumSehri` varchar(100) NOT NULL,
  `KonumUlke` varchar(100) NOT NULL,
  `SubeAdi` varchar(100) NOT NULL,
  `SubeKodu` varchar(100) NOT NULL,
  `ParaBirimi` varchar(100) NOT NULL,
  `HesapSahibi` varchar(255) NOT NULL,
  `HesapNumarasi` varchar(100) NOT NULL,
  `IbanNumarasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bankahesaplarimiz`
--

INSERT INTO `bankahesaplarimiz` (`id`, `BankaLogosu`, `BankaAdi`, `KonumSehri`, `KonumUlke`, `SubeAdi`, `SubeKodu`, `ParaBirimi`, `HesapSahibi`, `HesapNumarasi`, `IbanNumarasi`) VALUES
(4, '88dd26c0bc6046ab74b11498b.png', 'EmreBANK2111', 'EdirneMerkez1', 'TR11', 'EDİRNE221', '22002211111', 'TRY1', 'EMREYAMAN1', '12345678901', 'TR0000000000001234567890221'),
(5, 'Akbank.png', 'AkBank', 'ankara', 'Türkiye', '', 'aşti', 'Türk Lirası', 'Emre YAMAN', '122131321321', '66666666');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bannerlar`
--

DROP TABLE IF EXISTS `bannerlar`;
CREATE TABLE IF NOT EXISTS `bannerlar` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BannerAlani` varchar(111) NOT NULL,
  `BannerAdi` varchar(111) NOT NULL,
  `BannerResmi` varchar(111) NOT NULL,
  `GosterimSayisi` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bannerlar`
--

INSERT INTO `bannerlar` (`id`, `BannerAlani`, `BannerAdi`, `BannerResmi`, `GosterimSayisi`) VALUES
(1, 'Menu Altı', 'Örnek Reklam 1 ', '250x500baner.jpg', 502),
(2, 'Menu Altı', 'Örnek Reklam 2 ', '250x500baner2.jpg', 501),
(3, 'Menu Altı', 'Örnek Reklam 3 ', '250x500baner3.jpg', 502),
(4, 'Ürün Detay', 'Örnek 4', '350x350 reklam alani.jpg', 383),
(5, 'Ürün Detay', 'Örnek 5', '350x350 reklam alani2.jpg', 383),
(6, 'Ana sayfa', 'Ana sayfa 1.banner', 'banner1.jpg', 72),
(7, 'Ana sayfa', 'Ana sayfa 2.banner', 'banner1.jpg', 71);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

DROP TABLE IF EXISTS `favoriler`;
CREATE TABLE IF NOT EXISTS `favoriler` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UrunId` int(10) UNSIGNED NOT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `havalebildirimleri`
--

DROP TABLE IF EXISTS `havalebildirimleri`;
CREATE TABLE IF NOT EXISTS `havalebildirimleri` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BankaId` int(10) UNSIGNED NOT NULL,
  `AdiSoyadi` varchar(111) NOT NULL,
  `EmailAdresi` varchar(222) NOT NULL,
  `TelefonNumarasi` varchar(22) NOT NULL,
  `Aciklama` text NOT NULL,
  `İslemTarihi` int(11) UNSIGNED NOT NULL,
  `Durum` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `havalebildirimleri`
--

INSERT INTO `havalebildirimleri` (`id`, `BankaId`, `AdiSoyadi`, `EmailAdresi`, `TelefonNumarasi`, `Aciklama`, `İslemTarihi`, `Durum`) VALUES
(1, 4, 'emre yaman', 'alyadua@hotmail.com', '1231231', 'asdasd', 1683039177, 0),
(3, 5, 'yasin', 'yasin@hotmail.com', '555555555', 'Hadi bakalım yaaaasssinnn', 1683381411, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kargofirmalari`
--

DROP TABLE IF EXISTS `kargofirmalari`;
CREATE TABLE IF NOT EXISTS `kargofirmalari` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `KargoFirmasiLogosu` varchar(33) NOT NULL,
  `KargoFirmasiAdi` varchar(77) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kargofirmalari`
--

INSERT INTO `kargofirmalari` (`id`, `KargoFirmasiLogosu`, `KargoFirmasiAdi`) VALUES
(2, 'Aras.png', 'Aras Kargo'),
(3, 'ptt.png', 'PTT Kargo'),
(4, 'MNGKargo156x30.png', 'MNG Kargo'),
(5, 'sürat.jpeg', 'Sürat Kargo'),
(9, 'df9e9ba3371206ee6510dc5a8.png', 'YURTT ICI');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

DROP TABLE IF EXISTS `menuler`;
CREATE TABLE IF NOT EXISTS `menuler` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UrunTuru` varchar(111) NOT NULL,
  `MenuAdi` varchar(55) NOT NULL,
  `UrunSayisi` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menuler`
--

INSERT INTO `menuler` (`id`, `UrunTuru`, `MenuAdi`, `UrunSayisi`) VALUES
(1, 'Erkek Ayakkabısı', 'Günlük Ayakkabılar', 5),
(2, 'Erkek Ayakkabısı', 'Klasik Ayakkabı', 3),
(4, 'Erkek Ayakkabısı', 'Botlar', 0),
(6, 'Kadın Ayakkabısı', 'spor', 0),
(8, 'Cocuk Ayakkabısı', 'Klasik', 0),
(9, 'Cocuk Ayakkabısı', 'Spor', 0),
(10, 'Cocuk Ayakkabısı', 'günlük', 1),
(11, 'Erkek Ayakkabısı', 'Renkli Ayakkabı', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

DROP TABLE IF EXISTS `sepet`;
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SepetNumarasi` int(10) UNSIGNED DEFAULT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `UrunId` int(10) UNSIGNED NOT NULL,
  `AdresId` int(10) UNSIGNED DEFAULT NULL,
  `VaryantId` int(10) UNSIGNED NOT NULL,
  `KargoId` tinyint(2) DEFAULT NULL,
  `UrunAdedi` tinyint(3) UNSIGNED NOT NULL,
  `OdemeSecimi` varchar(50) DEFAULT NULL,
  `TaksitSecimi` tinyint(2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`id`, `SepetNumarasi`, `UyeId`, `UrunId`, `AdresId`, `VaryantId`, `KargoId`, `UrunAdedi`, `OdemeSecimi`, `TaksitSecimi`) VALUES
(8, 8, 1, 7, 0, 54, 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
CREATE TABLE IF NOT EXISTS `siparisler` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `SiparisNumarasi` int(10) UNSIGNED NOT NULL,
  `UrunId` int(11) UNSIGNED NOT NULL,
  `UrunTuru` varchar(55) NOT NULL,
  `UrunAdi` varchar(255) NOT NULL,
  `UrunFiyati` double UNSIGNED NOT NULL,
  `KdvOrani` int(2) UNSIGNED NOT NULL,
  `UrunAdedi` int(3) UNSIGNED NOT NULL,
  `ToplamUrunFiyati` double UNSIGNED NOT NULL,
  `KargoFirmasiSecimi` varchar(111) NOT NULL,
  `KargoUcreti` double UNSIGNED NOT NULL,
  `UrunResmiBir` varchar(55) NOT NULL,
  `VaryantBasligi` varchar(111) NOT NULL,
  `VaryantSecimi` varchar(111) NOT NULL,
  `AdresAdiSoyadi` varchar(111) NOT NULL,
  `AdresDetay` varchar(255) NOT NULL,
  `AdresTelefon` varchar(11) NOT NULL,
  `OdemeSecimi` varchar(25) NOT NULL,
  `TaksitSecimi` int(2) UNSIGNED NOT NULL,
  `SiparisTarihi` int(11) NOT NULL,
  `SiparisIpAdresi` varchar(22) NOT NULL,
  `OnayDurumu` tinyint(1) UNSIGNED DEFAULT NULL,
  `KargoDurumu` tinyint(1) UNSIGNED DEFAULT NULL,
  `KargoGonderiKodu` varchar(111) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `UyeId`, `SiparisNumarasi`, `UrunId`, `UrunTuru`, `UrunAdi`, `UrunFiyati`, `KdvOrani`, `UrunAdedi`, `ToplamUrunFiyati`, `KargoFirmasiSecimi`, `KargoUcreti`, `UrunResmiBir`, `VaryantBasligi`, `VaryantSecimi`, `AdresAdiSoyadi`, `AdresDetay`, `AdresTelefon`, `OdemeSecimi`, `TaksitSecimi`, `SiparisTarihi`, `SiparisIpAdresi`, `OnayDurumu`, `KargoDurumu`, `KargoGonderiKodu`) VALUES
(2, 1, 7, 1, 'Erkek Ayakkabısı', 'siyah ayakkabı', 150, 18, 1, 150, 'Aras Kargo', 15, '1.jpeg', 'numara', '37', 'Emre Yaman', 'şükrü paşa mahallesi bahriye üç ok cad Edirne Merkez', '5515976632', 'Banka Havalesi', 0, 1688562714, '127.0.0.1', 1, 1, 'asdasd'),
(3, 1, 8, 1, 'Erkek Ayakkabısı', 'siyah ayakkabı', 150, 18, 1, 150, 'Aras Kargo', 15, '1.jpeg', 'numara', '37', 'Emre Yaman', 'şükrü paşa mahallesi bahriye üç ok cad Edirne Merkez', '5515976632', 'Banka Havalesi', 0, 1688562714, '127.0.0.1', 0, 0, NULL),
(4, 1, 9, 1, 'Erkek Ayakkabısı', 'siyah ayakkabı', 150, 18, 1, 150, 'Aras Kargo', 15, '1.jpeg', 'numara', '37', 'Emre Yaman', 'şükrü paşa mahallesi bahriye üç ok cad Edirne Merkez', '5515976632', 'Banka Havalesi', 0, 1688562714, '127.0.0.1', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorular`
--

DROP TABLE IF EXISTS `sorular`;
CREATE TABLE IF NOT EXISTS `sorular` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `soru` text NOT NULL,
  `cevap` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sorular`
--

INSERT INTO `sorular` (`id`, `soru`, `cevap`) VALUES
(1, '1. sorunuzun başlığı guncelleme başarlı', '1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni1. sorunuzun cevap metni\r\ngüncelleme başarılı'),
(2, '2. sorunuzun başlığı', '2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni2. sorunuzun cevap metni'),
(3, '3. sorunuzun başlığı', '3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni3. sorunuzun cevap metni'),
(4, '4. sorunuzun başlığı', '4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni4. sorunuzun cevap metni');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sozlesmelervemetinler`
--

DROP TABLE IF EXISTS `sozlesmelervemetinler`;
CREATE TABLE IF NOT EXISTS `sozlesmelervemetinler` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `HakkimizdaMetni` text NOT NULL,
  `UyelikSozlesmeMetni` text NOT NULL,
  `KullanimKosullariMetni` text NOT NULL,
  `GizlilikSozlesmesiMetni` text NOT NULL,
  `MesafeliSatisSozlesmesiMetni` text NOT NULL,
  `TeslimatMetni` text NOT NULL,
  `IptalIadeDegisimMetni` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sozlesmelervemetinler`
--

INSERT INTO `sozlesmelervemetinler` (`id`, `HakkimizdaMetni`, `UyelikSozlesmeMetni`, `KullanimKosullariMetni`, `GizlilikSozlesmesiMetni`, `MesafeliSatisSozlesmesiMetni`, `TeslimatMetni`, `IptalIadeDegisimMetni`) VALUES
(1, 'Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridir Burası HAkkımızda YEridirasdasd', '165165165165165165', 'KullanimKosullariMetni	KullanimKosullariMetni	KullanimKosullariMetni	KullanimKosullariMetni	KullanimKosullariMetni	KullanimKosullariMetni	KullanimKosullariMetni	11122333asdasd', 'GizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniGizlilikSozlesmesiMetniasdasd', 'MesafeliSatisSozlesmesiMetniMesafeliSatisSozlesmesiMetniMesafeliSatisSozlesmesiMetniMesafeliSatisSozlesmesiMetniMesafeliSatisSozlesmesiMetniMesafeliSatisSozlesmesiMetniMesafeliSatisSozleasdasdsmesiMetniasdasd', 'TeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniTeslimatMetniasdasd', 'IptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniIptalIadeDegisimMetniasdasd');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `MenuId` int(10) UNSIGNED NOT NULL,
  `UrunTuru` varchar(111) NOT NULL,
  `UrunAdi` varchar(244) NOT NULL,
  `UrunFiyati` double UNSIGNED NOT NULL,
  `ParaBirimi` char(3) NOT NULL,
  `KdvOrani` int(2) UNSIGNED NOT NULL,
  `UrunAciklamasi` text NOT NULL,
  `UrunResmiBir` varchar(55) DEFAULT NULL,
  `UrunResmiiki` varchar(55) DEFAULT NULL,
  `UrunResmiUc` varchar(55) DEFAULT NULL,
  `UrunResmiDort` varchar(55) DEFAULT NULL,
  `VaryantBasligi` varchar(111) NOT NULL,
  `KargoUcreti` double UNSIGNED NOT NULL,
  `Durumu` tinyint(1) UNSIGNED NOT NULL,
  `ToplamSatisSayisi` int(11) UNSIGNED DEFAULT NULL,
  `YorumSayisi` tinyint(10) DEFAULT NULL,
  `ToplamYorumPuani` int(10) UNSIGNED DEFAULT NULL,
  `GoruntulenmeSayisi` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `MenuId`, `UrunTuru`, `UrunAdi`, `UrunFiyati`, `ParaBirimi`, `KdvOrani`, `UrunAciklamasi`, `UrunResmiBir`, `UrunResmiiki`, `UrunResmiUc`, `UrunResmiDort`, `VaryantBasligi`, `KargoUcreti`, `Durumu`, `ToplamSatisSayisi`, `YorumSayisi`, `ToplamYorumPuani`, `GoruntulenmeSayisi`) VALUES
(1, 1, 'Erkek Ayakkabısı', 'siyah ayakkabı', 150, 'TRY', 18, '                           Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, alias aliquid, consectetur cumque eaque facere harum hic ipsum perspiciatis ratione recusandae sapiente. Alias commodi exercitationem sapiente vero! Assumenda, exercitationem neque.\n                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, alias aliquid, consectetur cumque eaque facere harum hic ipsum perspiciatis ratione recusandae sapiente. Alias commodi exercitationem sapiente vero! Assumenda, exercitationem neque.\n                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, alias aliquid, consectetur cumque eaque facere harum hic ipsum perspiciatis ratione recusandae sapiente. Alias commodi exercitationem sapiente vero! Assumenda, exercitationem neque.\n                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, alias aliquid, consectetur cumque eaque facere harum hic ipsum perspiciatis ratione recusandae sapiente. Alias commodi exercitationem sapiente vero! Assumenda, exercitationem neque.\n                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, alias aliquid, consectetur cumque eaque facere harum hic ipsum perspiciatis ratione recusandae sapiente. Alias commodi exercitationem sapiente vero! Assumenda, exercitationem neque.\n', '1.jpeg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 9, 111, 559, 165),
(2, 2, 'Kadın Ayakkabısı', 'Urun 2 ', 300, 'TRY', 18, 'Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 ', '1.jpg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 1, 123, 222, 7),
(3, 2, 'Kadın Ayakkabısı', 'Urun3 ', 300, 'USD', 18, 'Urun 3 Urun 3 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 Urun 2 ', '1.jpg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 15, 0, 0, 29),
(4, 1, 'Erkek Ayakkabısı', 'ürün 4 ', 300, 'TRY', 18, 'ürün 4 ürün 4 ürün1ürün 1 ürün1ürün 1 ürün1ürün 1 ürün1ürün1', '1.jpg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 0, 111, 333, 14),
(5, 1, 'Erkek Ayakkabısı', 'ürün 5 ', 300, 'TRY', 18, 'ürün 5 ürün 4 ürün1ürün 1 ürün1ürün 1 ürün1ürün 1 ürün1ürün1', '2.jpeg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 0, 0, 0, 9),
(6, 1, 'Erkek Ayakkabısı', 'ürün 6 ürün 6 ürün 6 ürün 6 ürün 6', 10, 'USD', 18, 'ürün 65 ürün 4 ürün1ürün 1 ürün1ürün 1 ürün1ürün 1 ürün1ürün1', '3.jpeg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 6, 111, 222, 37),
(7, 1, 'Erkek Ayakkabısı', 'ürün 7777777777777', 300, 'TRY', 18, 'ürün 65 ürün 4 ürün1ürün 1 ürün1ürün 1 ürün1ürün 1 ürün1ürün1', '4.jpeg', '', '', '', 'numara', 15, 1, 15, 98, 329, 41),
(8, 10, 'Cocuk Ayakkabısı', 'ürün 8', 15, 'TRY', 18, 'ÜRÜN 8888 ÜRÜN 8888   ÜRÜN 8888   ÜRÜN 8888   ÜRÜN 8888   ÜRÜN 8888   ÜRÜN 8888', 'df42511d6f92fd034a9c47f2a.jpg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 1, 99, 333, 23),
(9, 6, 'Kadın Ayakkabısı', 'Urun9', 300, 'TRY', 18, 'Urun 9999999999999999', '1d37dbf7668e1a023cfd70566.jpg', '', '', '', 'numara', 15, 1, 8, 0, 0, 30),
(10, 6, 'Kadın Ayakkabısı', 'Urun 10', 300, 'TRY', 18, 'Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10 Urun 10  Urun 10 Urun 10', '4a596a044845bbe788bb1f47d.jpg', 'Bos.jpg', 'Bos.jpg', 'Bos.jpg', 'numara', 15, 1, 2, 123, 222, 12),
(11, 10, 'Cocuk Ayakkabısı', 'Deneme', 111, 'TRY', 18, 'sadasd', '32c912d0040e1824beffbe500.jpg', NULL, NULL, NULL, 'numara', 75, 0, NULL, NULL, NULL, NULL),
(12, 10, 'Cocuk Ayakkabısı', 'ekle deneme', 3000, 'TRY', 18, 'asdasd', 'e7b29a830ec6784ec06b666a4.jpg', NULL, NULL, NULL, 'numara', 75, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunvaryantlari`
--

DROP TABLE IF EXISTS `urunvaryantlari`;
CREATE TABLE IF NOT EXISTS `urunvaryantlari` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UrunId` int(11) UNSIGNED NOT NULL,
  `VaryantAdi` varchar(111) NOT NULL,
  `StokAdedi` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunvaryantlari`
--

INSERT INTO `urunvaryantlari` (`id`, `UrunId`, `VaryantAdi`, `StokAdedi`) VALUES
(1, 1, '37', 107),
(2, 1, '38', 109),
(3, 1, '39', 332),
(22, 1, '40', 329),
(25, 2, '37', 222),
(24, 1, '41', 328),
(26, 2, '38', 110),
(27, 2, '39', 333),
(28, 2, '40', 333),
(29, 3, '30', 222),
(30, 3, '37', 218),
(31, 3, '38', 107),
(32, 3, '39', 333),
(33, 3, '40', 333),
(34, 4, '38', 111),
(35, 4, '39', 333),
(36, 4, '40', 111),
(37, 4, '41', 333),
(38, 5, '38', 111),
(39, 5, '39', 333),
(40, 5, '40', 333),
(41, 5, '41', 333),
(42, 6, '42', 111),
(43, 6, '39', 329),
(44, 6, '40', 331),
(45, 6, '41', 331),
(46, 8, '27', 332),
(47, 8, '25', 110),
(48, 8, '28', 331),
(49, 8, '30', 333),
(50, 7, '41', 333),
(53, 7, '40', 333),
(54, 7, '37', 218),
(55, 9, '38', 111),
(57, 9, '40', 333),
(58, 9, '41', 333),
(59, 9, '42', 100),
(60, 10, '1', 11),
(61, 12, '31', 33);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `EmailAdresi` varchar(255) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  `IsimSoyisim` varchar(50) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL,
  `Cinsiyet` varchar(5) NOT NULL,
  `SilinmeDurumu` tinyint(3) UNSIGNED DEFAULT NULL,
  `Durumu` tinyint(1) NOT NULL,
  `KayitTarihi` int(11) NOT NULL,
  `KayitIpAdresi` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailAdresi` (`EmailAdresi`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `EmailAdresi`, `Sifre`, `IsimSoyisim`, `TelefonNumarasi`, `Cinsiyet`, `SilinmeDurumu`, `Durumu`, `KayitTarihi`, `KayitIpAdresi`) VALUES
(1, 'alya@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'emre yaman', '123456789', 'Erkek', 0, 0, 1683394389, '::1'),
(2, 'deneme@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'deneme1', '123', 'Erkek', 0, 0, 1683430852, '::1'),
(3, 'asdaasd@gmail.com', '202cb962ac59075b964b07152d234b70', 'deneme2', '1234', 'Erkek', 0, 0, 1683646280, '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

DROP TABLE IF EXISTS `yoneticiler`;
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `KullaniciAdi` varchar(100) DEFAULT NULL,
  `Sifre` varchar(100) DEFAULT NULL,
  `IsimSoyisim` varchar(100) NOT NULL,
  `EmailAdresi` varchar(100) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL,
  `SilinemeyecekYoneticiDurumu` tinyint(1) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `KullaniciAdi`, `Sifre`, `IsimSoyisim`, `EmailAdresi`, `TelefonNumarasi`, `SilinemeyecekYoneticiDurumu`) VALUES
(1, 'alyadua', 'e10adc3949ba59abbe56e057f20f883e', 'alyaduanaga', 'alya@hotmail.com', '5515976632', 1),
(4, 'mahmut', 'e10adc3949ba59abbe56e057f20f883e', 'mahmut ustaosmanoğlu', 'mahmut@gmail.com', '5555555555', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UrunId` int(10) UNSIGNED NOT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `Puan` tinyint(1) UNSIGNED NOT NULL,
  `YorumMetni` text NOT NULL,
  `YorumTarihi` int(10) NOT NULL,
  `YorumIpAdresi` varchar(22) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `UrunId`, `UyeId`, `Puan`, `YorumMetni`, `YorumTarihi`, `YorumIpAdresi`) VALUES
(1, 1, 1, 5, 'Karım bu ayakkabıyı bana özenerek almış bende çok beğendim ', 1684190393, '::1'),
(2, 1, 1, 5, 'HARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHA \n RİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKAHARİKA', 1684220564, '::1'),
(5, 1, 1, 1, 'asdasd', 1684220707, '::1'),
(6, 3, 1, 5, 'asdasd', 1684220752, '::1'),
(7, 3, 1, 1, '123123', 1684220787, '::1'),
(8, 3, 1, 4, '53535', 1684220939, '::1'),
(9, 3, 1, 4, 'asdasd', 1684221050, '::1'),
(10, 3, 1, 3, 'asdasd', 1684221186, '::1'),
(11, 3, 1, 4, 'aaaaaaaaaaaa', 1684221242, '::1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
