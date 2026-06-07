# Ambalaj ve Sarf Marketi (B2B E-Ticaret Sistemi)

Kocaeli Üniversitesi Teknoloji Fakültesi Bilişim Sistemleri Mühendisliği Bölümü **TBL304: Web Programlama Dersi** Projesi kapsamında geliştirilmiş, İçerik Yönetim Sistemine (CMS) sahip web tabanlı alışveriş sitesidir.

## Proje Hakkında
Bu proje, toptan ve perakende ambalaj ve sarf malzemeleri satışı yapan bir işletme için tasarlanmış MVC tabanlı bir e-ticaret otomasyonudur. **Laravel 11** framework'ü kullanılarak sıfırdan geliştirilmiştir. Projede hem müşteriler için modern bir alışveriş arayüzü hem de yöneticiler için kapsamlı bir yönetim paneli (Admin Panel) bulunmaktadır.

Uygulama tamamen mobil uyumlu (Responsive) olarak tasarlanmış olup, dış bir **Döviz Kuru API'si** (REST API) ile entegre çalışarak anlık kur takibi yapmaktadır.

---

## 🚀 Proje İsterlerinin Karşılanma Durumu

Proje yönergesinde istenen **tüm özellikler eksiksiz (%100) olarak** sisteme entegre edilmiştir:

### 👥 Kullanıcı (User) İşlemleri
- [x] **Kayıt ve Oturum Açma:** Kullanıcılar sisteme üye olabilir ve güvenli bir şekilde giriş yapabilir.
- [x] **Profil Yönetimi:** E-posta, şifre, ad-soyad, telefon ve adres bilgileri güncellenebilir.
- [x] **Hesap Dondurma:** Kullanıcılar istedikleri zaman hesaplarını (üyeliklerini) pasif duruma getirebilir.
- [x] **Ürün Görüntüleme:** Ürünler, kategoriler ve detay sayfaları incelenebilir.
- [x] **Sepet İşlemleri:** Sepete ürün ekleme, çıkarma ve toplam tutar hesaplama.
- [x] **Ödeme ve Sipariş:** Kredi kartı arayüzü ile ödeme yapma ve sipariş oluşturma.
- [x] **Cüzdan (Bakiye) Sistemi:** İptal edilen siparişlerin ücretleri kredi kartına değil, site içi kullanıcı cüzdanına (bakiyeye) aktarılır. Kullanıcı bir sonraki alışverişinde ilk olarak bu bakiyeyi kullanmak zorundadır.
- [x] **Sipariş İptali:** Sipariş henüz admin tarafından onaylanmadıysa kullanıcı tarafından iptal edilebilir.
- [x] **Sipariş Takibi:** Sipariş onaylandıktan sonra sırasıyla şu aşamalar kullanıcı panelinden canlı takip edilir: *Ürünleriniz tedarik ediliyor -> Kutulanıyor -> Kargoya veriliyor -> Size doğru yola çıktı -> Teslim edilmiştir.*
- [x] **Teslimat Onayı:** Sipariş "Size teslim edilmiştir" aşamasına gelince aktif olan **"Ürünlerimi Teslim Aldım"** butonuna basılarak süreç tamamlanır.

### 🛡️ Yönetici (Admin) İşlemleri
- [x] **Kullanıcı Yönetimi:** Sistemdeki tüm kullanıcıları görüntüleme, bilgilerini güncelleme, hesapları dondurma ve silme işlemleri.
- [x] **Ürün Yönetimi:** Ürün ekleme, silme, güncelleme (fiyat, stok vb.).
- [x] **Görsel Yönetimi:** Ürünlere ait fotoğrafların yüklenmesi ve yönetimi.
- [x] **Satış Durumu:** Ürünleri satışa sunma veya satıştan kaldırma (Aktif/Pasif).
- [x] **Sipariş ve Fatura:** Gelen siparişleri görüntüleme, onaylama, faturalandırma (Yazdırılabilir PDF/HTML formatında) ve kargoya hazır hale getirme.
- [x] **Sipariş Süreci Yönetimi:** İlgili siparişin durumunu butonlar yardımıyla "İleri" diyerek aşama aşama ilerletme.

### ⚙️ Teknik ve Genel İsterler
- [x] **Framework:** Laravel (MVC Mimari) kullanıldı.
- [x] **Tasarım:** Modern, dinamik ve **Responsive (Mobil uyumlu)** arayüz geliştirildi.
- [x] **Veritabanı:** PostgreSQL kullanılarak tam CRUD (Ekle/Sil/Güncelle/Listele) işlemleri uygulandı. Relasyonel veritabanı tasarımı yapıldı.
- [x] **Minimum Veri:** Veritabanında (Seeder ile otomatik kurulan) 1 Admin, 5 Kullanıcı ve 20 Adet Ürün hazır bulunmaktadır.
- [x] **Canlı Yayın:** Proje GitHub üzerinden bulut sunucuya aktarılarak internete (canlı ortama) açılmıştır.
- [x] **Harici Web API Entegrasyonu:** Toptan ticaret mantığına uygun olarak, dış bir REST API üzerinden **Canlı Döviz Kurları (USD, EUR vb.)** anlık olarak (iframe kullanılmadan `fetch` ile) çekilip sisteme entegre edilmiştir.

---

## 🛠️ Kullanılan Teknolojiler

- **Backend:** PHP 8.4, Laravel 11
- **Frontend:** HTML5, Vanilla CSS3 (Custom Responsive Design System), JavaScript (ES6+)
- **Veritabanı:** PostgreSQL
- **Sunucu ve Dağıtım:** Docker, Apache, Back4App (Bulut Sunucu)

---

## 💻 Kurulum (Local Ortam)

Projeyi kendi bilgisayarınızda çalıştırmak için aşağıdaki adımları izleyebilirsiniz:

1. Projeyi bilgisayarınıza klonlayın veya zip olarak indirin.
2. Terminal üzerinden proje dizinine girin ve gerekli kütüphaneleri indirin:
   ```bash
   composer install
   npm install
   ```
3. `.env.example` dosyasının kopyasını oluşturup `.env` olarak adlandırın ve veritabanı bilgilerinizi girin.
4. Uygulama anahtarını (APP_KEY) oluşturun:
   ```bash
   php artisan key:generate
   ```
5. Veritabanı tablolarını ve zorunlu test verilerini (1 Admin, 5 User, 20 Ürün) yükleyin:
   ```bash
   php artisan migrate:fresh --seed
   ```
6. Resimlerin düzgün görüntülenmesi için storage linkini oluşturun:
   ```bash
   php artisan storage:link
   ```
7. Yerel sunucuyu başlatın:
   ```bash
   php artisan serve
   ```

*Not: Uygulama **Admin** girişi için varsayılan e-posta: `admin@ambalaj.test` şifre: `admin123` şeklindedir.*

---

## ☁️ Bulut Sunucu Otomatik Kurulum Rota Özelliği
Paylaşımlı hosting veya SSH terminal erişimi olmayan platformlar için geliştirilmiş özel rota sayesinde projenin URL adresinin sonuna `/kurulum-tamamla` ekleyerek (Örn: `siteadi.com/kurulum-tamamla`) veritabanı migrasyon ve seed işlemlerini tek tıkla yapabilirsiniz.
