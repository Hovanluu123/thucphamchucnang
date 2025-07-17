<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Vitamin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Collagen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thực phẩm bổ sung', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Vitamin C 1000mg',
                'price' => 250000,
                'description' => 'Hỗ trợ tăng cường hệ miễn dịch, chống oxy hóa mạnh mẽ.',
                'image' => 'https://via.placeholder.com/300x200?text=Sản+phẩm+1',
                'is_hot' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 2,
                'name' => 'Collagen Type II',
                'price' => 350000,
                'description' => 'Hỗ trợ sức khỏe xương khớp và làn da.',
                'image' => 'https://via.placeholder.com/300x200?text=Sản+phẩm+2',
                'is_hot' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more products
        ]);

        DB::table('offers')->insert([
            [
                'title' => 'Ưu đãi 1',
                'description' => 'Giảm giá 20% cho các sản phẩm vitamin.',
                'image' => 'https://via.placeholder.com/300x150?text=Ưu+đãi+1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Ưu đãi 2',
                'description' => 'Mua 2 tặng 1 cho collagen.',
                'image' => 'https://via.placeholder.com/300x150?text=Ưu+đãi+2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Ưu đãi 3',
                'description' => 'Freeship toàn quốc cho đơn từ 500k.',
                'image' => 'https://via.placeholder.com/300x150?text=Ưu+đãi+3',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}