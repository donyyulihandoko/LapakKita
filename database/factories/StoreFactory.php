<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->company() . ' Store';

        return [
            // Otomatis membuatkan User baru jika tidak di-override
            'user_id' => User::factory(),

            // Informasi Profil Toko
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
           // Dummy Image URL yang langsung bisa di-render/download
            'logo' => 'https://picsum.photos/seed/' . Str::slug($name) . '-logo/300/300',
            'banner' => 'https://picsum.photos/seed/' . Str::slug($name) . '-banner/1200/400',

            // Berkas Verifikasi Penjual
            'ktp_number' => fake()->numerify('32##############'),
            'ktp_image' => 'https://picsum.photos/seed/' . Str::slug($name) . '-ktp/800/500',

            // Status Moderasi & Operasional Default
            'approval_status' => 'approved',
            'message' => null,
            'status' => 'active',
            'is_verified' => false,
        ];
    }
}
