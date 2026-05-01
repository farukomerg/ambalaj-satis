<<<<<<< HEAD
# Ambalaj Satis Web Sitesi

Laravel MVC ile gelistirilen, admin paneli ve kullanici alisveris akisina sahip ambalaj urunleri satis uygulamasi.

## Calistirma

Proje Herd ile linklendi:

```powershell
http://ambalaj-satis.test
```

Terminalden gerekli temel komutlar:

```powershell
cd C:\Users\MSI\Desktop\Ambalaj_web_sitesi\ambalaj-satis
& "C:\Users\MSI\.config\herd\bin\php84\php.exe" artisan migrate --seed
& "C:\Users\MSI\.config\herd\bin\php84\php.exe" artisan test
```

PostgreSQL veritabani:

```text
DB_DATABASE=ambalaj_db
DB_USERNAME=postgres
```

## Demo Girisleri

Admin:

```text
admin@ambalaj.test
admin123
```

Kullanici:

```text
user1@ambalaj.test
user123
```

## Karsilanan Isterler

- Admin ve User rolleri eklendi.
- Kullanici kayit, giris, cikis, profil guncelleme ve uyelik pasiflestirme eklendi.
- Admin panelinde urun ekleme, guncelleme, silme, stok, fiyat ve gorsel yukleme akisi eklendi.
- Urun listeleme, urun detay, kategori ve arama filtreleri eklendi.
- Sepete urun ekleme, sepet guncelleme ve sepetten silme eklendi.
- Simule kredi karti odeme ekrani ve siparis olusturma eklendi.
- Kullanici bakiyesi ve iptal edilen siparisin bakiyeye iadesi eklendi.
- Admin siparis onaylama ve siparis hazirlik surecini ilerletme eklendi.
- Kullanici siparis durumunu izleyebilir ve teslim edildi asamasinda teslim aldim butonunu kullanabilir.
- En az 1 admin, 5 user ve 20 urun seed verisi eklendi.
- PostgreSQL veritabani ve Laravel migration yapisi kuruldu.

## Ogrenme Sirasi

1. `routes/web.php` dosyasini oku. Hangi URL hangi controller metoduna gidiyor bunu takip et.
2. `database/migrations/2026_05_01_230000_create_shop_tables.php` dosyasini incele. ER diyagraminin temelini bu dosya olusturur.
3. `app/Models` klasorundeki iliskileri incele. Laravel Eloquent mantigi burada gorulur.
4. `app/Http/Controllers` klasorunde sirayla vitrin, sepet, odeme ve siparis akislarini takip et.
5. `resources/views` klasorundeki Blade sayfalarini incele. Kullanici ve admin ekranlari burada.
6. `database/seeders/DatabaseSeeder.php` dosyasindan demo verilerin nasil olustugunu incele.

## Sonraki Profesyonel Gelistirmeler

- Admin kategori yonetimi eklenebilir.
- Sifre sifirlama e-posta akisi eklenebilir.
- Siparis faturasi PDF olarak uretilebilir.
- Gercek odeme entegrasyonu yerine raporda simule odeme oldugu aciklanabilir.
- Rapor icin ER diyagrami ve akış diyagrami bu kod yapisindan cikarilabilir.
=======
# Ambalaj_web_sitesi
>>>>>>> d76d8534efc65814903325825e0991891ea49cd7
