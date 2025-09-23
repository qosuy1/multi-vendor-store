<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositories
{
    public function get(): Collection;
    public function add(Product $product, int $quantity = 1): Cart;
    public function update(Product $product, int $quantity): Cart;
    public function delete($id): void;
    public function clear(): void;
    public function count(): int;
    // public function total(): float;
    public function getTotalQuantity(): int;
    public function getTotalPrice(): float;
}
