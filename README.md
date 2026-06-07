# Ambalaj ve Sarf Marketi - B2B E-Ticaret Platformu

Ambalaj ve Sarf Marketi, işletmelerin ve perakende müşterilerinin paketleme ihtiyaçlarını karşılamak üzere geliştirilmiş, toptan satış mantığına uygun dinamik bir e-ticaret platformudur. Proje; sadece ürünlerin listelendiği statik bir site olmanın ötesinde, detaylı sipariş takibi, cüzdan (bakiye) tabanlı ödeme sistemi, anlık döviz kuru entegrasyonu ve gelişmiş bir içerik yönetim sistemi (Admin) barındırır.

Kocaeli Üniversitesi Teknoloji Fakültesi Bilişim Sistemleri Mühendisliği Bölümü **TBL304: Web Programlama Dersi** Projesi kapsamında geliştirilmiştir.

---

## 🌟 Proje Özellikleri

### 👥 Kullanıcı (Müşteri) Modülü
* **Gelişmiş Ana Sayfa:** Dikkat çeken kahraman (hero) alanı, kampanyalı ürün vitrini, kategori filtreleme ve dış API entegrasyonu ile (Fetch API) **anlık USD/EUR döviz kuru** barı.
* **Dinamik Sepet ve Sipariş Akışı:** Kullanıcıların sepet verileri veritabanında güvenli şekilde saklanır. Kredi kartı arayüzü ile sipariş onaylanır. Geçmiş siparişler kronolojik olarak listelenir.
* **Cüzdan Tabanlı Ödeme ve İade:** Siparişi iptal edilen kullanıcıların parası sisteme "Cüzdan Bakiyesi" olarak geri yüklenir. Kullanıcı bir sonraki alışverişinde önce zorunlu olarak cüzdanındaki bu bakiyeyi kullanır, kalan tutarı kartla öder.
* **Sipariş İptal ve Canlı Takip:** Siparişler, yönetici tarafından onaylanana kadar müşteri tarafından iptal edilebilir. Onaylandıktan sonra ise iptal edilemez ve *Bekliyor -> Onaylandı -> Hazırlanıyor -> Kargoya Verildi -> Size Doğru Yola Çıktı -> Teslim Edildi* adımları şeffafça takip edilir. "Teslim Edildi" adımında müşteri "Ürünü Teslim Aldım" butonuna basarak işlemi sonlandırır.
* **Profil ve Hesap Yönetimi:** Kullanıcı ad-soyad, şifre, iletişim ve adres bilgilerini güncelleyebilir. İstediği zaman "Hesabımı Dondur" seçeneği ile üyeliğini pasif hale getirebilir.

### 🛡️ Yönetici (Admin) Paneli
* **Dashboard ve Kontrol Merkezi:** Sistemdeki ürün, sipariş, toplam müşteri sayısı gibi kritik veriler tek bir ekranda raporlanır.
* **Sipariş Yönetimi ve Faturalandırma:** Siparişler adım adım tek tıkla ilerletilebilir. Yöneticiler her sipariş için özel "Fatura Yazdır" ekranından PDF formatında kaydedilebilir şık bir döküm alabilir.
* **Ürün ve Kategori Yönetimi:** Sınırsız sayıda ürün ve kategori eklenebilir. Yöneticiler ürün görselini sunucuya yükleyebilir, ürünleri geçici olarak "Satıştan Kaldır" (Pasif) statüsüne çekebilir.
* **Kullanıcı Yönetimi:** Yöneticiler tüm müşterilerin bilgilerini, bakiye durumlarını görebilir, sorunlu kullanıcıları sistemden silebilir veya askıya alabilir.

---

## 🛠️ Kullanılan Teknolojiler ve Mimari

### Backend (Sunucu Tarafı)
* **Dil:** PHP 8.4 (Yüksek performans ve tip güvenliği)
* **Framework:** Laravel 11.x (MVC - Model-View-Controller Mimarisi)
* **Veritabanı:** PostgreSQL (Güçlü veri tutarlılığı, Foreign Key kısıtlamaları)
* **ORM:** Eloquent ORM (İlişkisel veritabanı sorguları)
* **Güvenlik:** Laravel Auth, Middleware tabanlı rol yetkilendirmesi, CSRF Koruması, Bcrypt şifreleme.

### Frontend (Kullanıcı Arayüzü)
* **Şablon Motoru:** Laravel Blade (Bileşen ve Layout tabanlı yapı)
* **Stil ve Tasarım:** HTML5, CSS3, SCSS ve Bootstrap mantığına dayanan Custom CSS Grid sistemi (Tümüyle Mobil Uyumlu - Responsive Tasarım).
* **Asenkron İletişim:** JavaScript Fetch API (Döviz kurlarının canlı çekilmesi).

### Geliştirme ve Canlı Ortam (DevOps)
* **Lokal Ortam:** XAMPP / Laragon (Apache, PHP, PostgreSQL)
* **Canlı Ortam (Deployment):** Back4App Containers / Render (Bulut sunucu üzerinde Docker tabanlı otomatik CI/CD GitHub entegrasyonu).

---

## 🗄️ Veritabanı Mimarisi

Sistem, veri bütünlüğünü (data integrity) en üst düzeyde tutmak amacıyla tam ilişkisel veritabanı kurallarına uygun olarak tasarlanmıştır:

* **`users`:** Müşteri ve yöneticilerin kimlik bilgilerini, şifrelerini, cüzdan bakiyelerini (`wallet_balance`) ve rollerini (admin/user) tutar.
* **`categories`:** Ürünlerin ait olduğu sınıflandırmaları tutar.
* **`products`:** Satışa sunulan ambalaj ürünlerinin başlık, stok, fiyat, materyal, ebat ve aktiflik durumunu barındırır.
* **`product_images`:** Ürünlere ait birden fazla sunucu görselini yöneten ilişkisel tablodur (`product_id` ile bağlıdır).
* **`orders`:** Kullanıcıların onaylanmış siparişlerinin genel toplamını, teslimat adresini ve o anki kargo statüsünü (`status`) tutar.
* **`order_items`:** Siparişin detay tablosudur. Satın alınan ürünlerin adetini ve sipariş anındaki *birim fiyatını* kopyalarak saklar. Ürün fiyatı gelecekte değişse bile faturanın tutarlılığı bozulmaz.
* **`carts` & `cart_items`:** Sepet yapısının oturum (session) bağımsız olarak veritabanında tutulmasını sağlar, böylece kullanıcı mobilden ve bilgisayardan girdiğinde aynı sepeti görür.

---

## 📝 Çekirdek Algoritmalar (Sözde Kod / Pseudocode)

### 1. Sipariş İptali ve Cüzdan İadesi Mekanizması
Kullanıcı, admin siparişi onaylamadan önce siparişini iptal ederse, kredi kartına doğrudan iade yerine bakiye sisteme yansıtılır:

```text
ALGORİTMA SiparisIptalVeIade(Kullanici, Siparis)
    // 1. Yetki ve Durum Kontrolü
    EĞER Siparis.user_id EŞİT DEĞİLSE Kullanici.id İSE
        HataVer("Erişim Engellendi!") ve Süreci Sonlandır()
    BİTTİ

    EĞER Siparis.status EŞİT DEĞİLSE 'pending' (Bekliyor) İSE
        HataVer("Onaylanmış veya kargolanmış siparişler iptal edilemez.") ve Süreci Sonlandır()
    BİTTİ

    // 2. Stok Geri Yükleme ve İade
    HER Siparisin İçindeki Urun İÇİN
        Urun.Stok = Urun.Stok + Urun.Adet
        VeritabaniniGuncelle(Urun)
    DÖNGÜ SONU

    Kullanici.cuzdan_bakiyesi = Kullanici.cuzdan_bakiyesi + Siparis.toplam_tutar
    VeritabaniniGuncelle(Kullanici)

    // 3. Siparişi Kapatma
    Siparis.status = 'cancelled' (İptal Edildi)
    VeritabaniniGuncelle(Siparis)

    "Siparişiniz iptal edildi ve tutar bakiyenize eklendi." mesajını göster.
SON ALGORİTMA
```

### 2. Cüzdan Bakiyesi ile Akıllı Ödeme Sistemi
Kullanıcı ödeme yaparken önce cüzdanı kontrol edilir:

```text
ALGORİTMA OdemeIslemi(Kullanici, SepetToplami)
    KalanOdeme = SepetToplami
    
    EĞER Kullanici.cuzdan_bakiyesi > 0 İSE
        EĞER Kullanici.cuzdan_bakiyesi >= SepetToplami İSE
            Kullanici.cuzdan_bakiyesi = Kullanici.cuzdan_bakiyesi - SepetToplami
            KalanOdeme = 0
        DEĞİLSE
            KalanOdeme = SepetToplami - Kullanici.cuzdan_bakiyesi
            Kullanici.cuzdan_bakiyesi = 0
        BİTTİ
    BİTTİ

    EĞER KalanOdeme > 0 İSE
        KrediKartiSistemindenCek(KalanOdeme)
    BİTTİ

    SiparisOlustur()
    Kullanici.cuzdan_bakiyesi Kaydet()
    SepetiTemizle()
SON ALGORİTMA
```

---

## 🖥️ Web Sitesi Sayfaları

### 1. Kullanıcı (Müşteri) Arayüzü
* **Ana Sayfa:** Özel tanıtım yazıları, kampanyalı "Öne Çıkan Ürünler" vitrini ve üst tarafta Fetch API ile çalışan canlı döviz kuru widget'ı.
* **Ürün Detay Sayfası:** İlgili ambalaj malzemesinin ebat, stok, materyal özellikleri ve yüksek kaliteli görseli ile birlikte "Sepete Ekle" modülü.
* **Profil Sayfası:** Kullanıcının temel ayarlarını, aktif bakiye durumunu ve adres bilgisini güncellediği merkez kontrol alanı. Ayrıca hesap dondurma işlemi buradan yapılır.
* **Sepet ve Ödeme (Checkout):** Ürünlerin listelendiği, fiyat hesaplamalarının anlık yapıldığı ve ödemenin tamamlanıp siparişe dönüştürüldüğü sayfa.
* **Siparişlerim:** Kullanıcının sipariş tarihçesini ve kargo aşamalarını renkli durum barlariyla (Bekliyor, Kargoda vb.) takip ettiği yer.

### 2. Yönetici (Admin) Paneli
*(Tüm admin sayfaları Middleware ile korunmakta olup, normal kullanıcıların erişimi tamamen engellenmiştir.)*
* **Dashboard (Panel Ana Sayfası):** Sistemdeki sipariş hacmi, müşteri sayısı gibi genel analitik verilerin bulunduğu ana ekran.
* **Ürün Yönetimi:** Yeni ürünlerin eklendiği, stok fiyat ve görsellerin güncellendiği CRUD merkezi.
* **Sipariş Yönetimi:** Siparişleri listeleme, fatura yazdırma ve durumlarını "Siparişi Onayla", "Kargoya Ver" gibi tek tık butonlarla ilerletme ekranı.
* **Kullanıcı Yönetimi:** Platforma üye olan tüm kişilerin listelendiği, banlama ve yetkilendirme yetkilerinin sunulduğu sayfa.

---

## ⚡ Canlı Gösterim ve Kurulum

**GitHub Deposu:** [Sitenin Kaynak Kodları](https://github.com/farukomerg/ambalaj-satis)

### Kurulum Adımları
1. Projeyi klonlayın: `git clone https://github.com/farukomerg/ambalaj-satis.git`
2. Bağımlılıkları kurun: `composer install`
3. `.env` dosyanızı oluşturup PostgreSQL bilgilerinizi girin.
4. Terminalden çalıştırın:
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan serve
   ```
*(Admin giriş bilgileri - E-posta: `admin@ambalaj.test`, Şifre: `admin123`)*

*Not: Paylaşımlı hosting gibi terminal erişimi olmayan canlı sunucularda `domain.com/kurulum-tamamla` rotasına giderek veritabanı kurma işlemini otomatik (tek tıkla) gerçekleştirebilirsiniz.*
