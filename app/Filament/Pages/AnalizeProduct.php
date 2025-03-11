<?php

namespace App\Filament\Pages;

use App\Models\Product;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class AnalizeProduct extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.analize-product';

    public bool $isAnalized = false;

    public $availableProduct, $unavailableProduct, $topSelling, $totalProduct, $totalPrice, $recomendation;

    public function analize()
    {
        $this->availableProduct = $this->getAvailableProduct();
        $this->unavailableProduct = $this->getUnvailableProduct();
        $this->topSelling = $this->getTopSelling();
        $this->totalProduct = $this->getTotalProduct();
        $this->totalPrice = $this->getTotalPrice();
        $this->recomendation = $this->getRecommendation();
        $this->isAnalized = true;
    }

    public function getAvailableProduct()
    {
        return Product::select('name', 'stock')->where('stock', '>', 0)->pluck('name')->implode(', ');
    }

    public function getUnvailableProduct()
    {
        return Product::select('name', 'stock')->where('stock', '=', 0)->pluck('name')->implode(', ');
    }

    public function getTopSelling()
    {
        return Product::select('name')->withCount('transactions')->orderBy('transactions_count', 'desc')->limit(5)->pluck('name')->implode(', ');;
    }

    public function getTotalProduct()
    {
        return Product::count();
    }

    public function getTotalPrice()
    {
        return Product::select('name', 'stock')->sum(DB::raw('stock * price'));
    }

    public function getRecommendation(): array
    {
        $recommendations = [];
        if ($this->totalProduct === 0)
            return ["There are no products in the system. Please add products first."];

        if (count(explode(', ', $this->unavailableProduct)) > 10)
            $recommendations[] = "Many products are out of stock! Restock immediately to avoid losing customers.";

        if ($this->totalPrice < 1_000_000)
            $recommendations[] = "Total stock value is low. Consider adding high-demand products.";

        if (!empty($this->topSelling)) {
            $topSelling = explode(', ', $this->topSelling)[0];
            $recommendations[] = "The current best-selling product is {$topSelling}. Make sure to keep it in stock!";
        }

        return $recommendations ?: ["All products are in good condition. Keep up the great business performance!"];
    }
}
