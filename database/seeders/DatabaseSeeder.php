<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kullanici',
            'email' => 'admin@ambalaj.test',
            'phone' => '05550000000',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        foreach (range(1, 5) as $index) {
            User::create([
                'name' => "Musteri {$index}",
                'email' => "user{$index}@ambalaj.test",
                'phone' => '0555000000'.$index,
                'address' => "Kocaeli depo bolgesi no {$index}",
                'password' => Hash::make('user123'),
                'role' => 'user',
                'wallet_balance' => $index === 1 ? 250 : 0,
                'is_active' => true,
            ]);
        }

        $categories = collect([
            ['Kargo Kutulari', 'E-ticaret gonderileri icin dayanikli koli ve kutular.'],
            ['Kargo Posetleri', 'Suya dayanikli, yapiskanli ve farkli ebatlarda posetler.'],
            ['Balonlu Naylon', 'Kirilabilir urunler icin darbe emici koruma.'],
            ['Koli Bandi', 'Depo ve sevkiyat operasyonlari icin guclu bantlar.'],
            ['Strec Film', 'Palet ve paket sabitleme icin strec cozumleri.'],
            ['Gida Ambalajlari', 'Paket servis ve gida saklama icin hijyenik urunler.'],
        ])->mapWithKeys(function (array $category) {
            $model = Category::create([
                'name' => $category[0],
                'slug' => Str::slug($category[0]),
                'description' => $category[1],
                'is_active' => true,
            ]);

            return [$model->name => $model];
        });

        $images = [
            'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1616401784845-180882ba9ba8?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1605600659908-0ef719419d41?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1607344645866-009c320f73e0?auto=format&fit=crop&w=900&q=80',
        ];

        $products = [
            ['Kargo Kutulari', 'E-Ticaret Kargo Kutusu 20x15x10', 8.90, 450, '20x15x10 cm', 'Oluklu mukavva'],
            ['Kargo Kutulari', 'Cift Oluklu Tasima Kolisi 40x30x30', 32.50, 180, '40x30x30 cm', 'Cift oluklu mukavva'],
            ['Kargo Kutulari', 'Mikro Kutu 15x10x8', 6.75, 600, '15x10x8 cm', 'Mikro oluklu karton'],
            ['Kargo Kutulari', 'Kraft Hediye Kutusu', 18.00, 220, '25x20x8 cm', 'Kraft karton'],
            ['Kargo Posetleri', 'Kargo Poseti 25x35', 1.65, 2500, '25x35 cm', 'LDPE'],
            ['Kargo Posetleri', 'Kargo Poseti 35x45', 2.20, 1900, '35x45 cm', 'LDPE'],
            ['Kargo Posetleri', 'Baskisiz Guvenlik Poseti', 3.10, 900, '30x40 cm', 'Gizlilik bantli plastik'],
            ['Balonlu Naylon', 'Balonlu Naylon 100 cm x 10 m', 95.00, 75, '100 cm x 10 m', 'PE baloncuklu film'],
            ['Balonlu Naylon', 'Balonlu Zarf 17x23', 4.50, 700, '17x23 cm', 'Kraft + baloncuk'],
            ['Balonlu Naylon', 'Kirilabilir Urun Koruma Rulosu', 145.00, 40, '120 cm x 10 m', 'Kaliteli PE film'],
            ['Koli Bandi', 'Seffaf Koli Bandi 45x100', 24.90, 320, '45 mm x 100 m', 'Akrilik yapiskan'],
            ['Koli Bandi', 'Kahverengi Koli Bandi', 22.50, 280, '45 mm x 100 m', 'Akrilik yapiskan'],
            ['Koli Bandi', 'Baski Uyari Bandi Kirilabilir', 36.00, 160, '45 mm x 100 m', 'OPP film'],
            ['Strec Film', 'El Tipi Strec Film', 89.00, 130, '50 cm x 300 m', 'PE strec'],
            ['Strec Film', 'Palet Strec Film Siyah', 125.00, 90, '50 cm x 300 m', 'Siyah PE strec'],
            ['Strec Film', 'Mini Strec Film', 42.00, 240, '10 cm x 150 m', 'PE strec'],
            ['Gida Ambalajlari', 'Kraft Salata Kasesi', 3.90, 1200, '1000 ml', 'Kraft + PE kaplama'],
            ['Gida Ambalajlari', 'Kagit Bardak 7 oz', 1.45, 3000, '7 oz', 'Gida uyumlu karton'],
            ['Gida Ambalajlari', 'Sos Kabi Kapakli', 0.95, 5000, '50 cc', 'PP plastik'],
            ['Gida Ambalajlari', 'Kraft Paket Servis Cantasi', 5.20, 850, '26x14x32 cm', 'Kraft kagit'],
        ];

        foreach ($products as $index => [$category, $name, $price, $stock, $size, $material]) {
            $product = Product::create([
                'category_id' => $categories[$category]->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'sku' => 'AMB-'.str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'description' => $name.' urunu stok kontrollu satis, sepet ve siparis akisi icin hazirlanmistir.',
                'price' => $price,
                'stock' => $stock,
                'unit' => 'adet',
                'size' => $size,
                'material' => $material,
                'color' => $index % 2 === 0 ? 'Kraft' : 'Seffaf',
                'min_order_quantity' => 1,
                'is_active' => true,
                'is_featured' => $index < 8,
            ]);

            $product->images()->create([
                'path' => $images[$index % count($images)],
                'alt_text' => $name,
                'is_primary' => true,
            ]);
        }
    }
}
