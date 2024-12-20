<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
            ]);

        \App\Models\Customer::factory(1000)->create();

        $items = \App\Models\Item::all();
        Purchase::factory(10000)->create()
        ->each(function(Purchase $purchase) use ($items){
        $purchase->items()->attach(
        $items->random(rand(1,3))->pluck('id')->toArray(),
        // 1～3個のitemをpurchaseにランダムに紐づけ
        ['quantity' => rand(1, 5) ] ); });
    }
}
