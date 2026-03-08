<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
use App\Models\Movement;

class InventoryManager extends Component
{
    public $products = [];
    public $categories = [];
    public $locations = [];
    public $search = '';
    public $showScanner = false;
    public $scannedCode = '';
    public $showPicking = false;
    public $pickingProduct = null;
    public $pickingQuantity = 1;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->categories = Category::all()->toArray();
        $this->locations = Location::all()->toArray();
        $this->products = Product::with(['category', 'location'])->get()->toArray();
    }

    public function render()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStock = Product::whereRaw('stock <= min_stock')->count();
        $recentMovements = Movement::with('product')->orderBy('created_at', 'desc')->limit(10)->get();

        $filteredProducts = Product::with(['category', 'location'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('sku', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.inventory-manager', [
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'lowStock' => $lowStock,
            'recentMovements' => $recentMovements,
            'filteredProducts' => $filteredProducts,
        ]);
    }

    public function processScan()
    {
        $product = Product::where('sku', $this->scannedCode)->first();
        
        if ($product) {
            $this->pickingProduct = $product;
            $this->showPicking = true;
            $this->showScanner = false;
        } else {
            $this->dispatch('notify', 'Producto no encontrado');
        }
        
        $this->scannedCode = '';
    }

    public function confirmPicking()
    {
        if ($this->pickingProduct && $this->pickingQuantity > 0) {
            $this->pickingProduct->stock -= $this->pickingQuantity;
            $this->pickingProduct->save();

            Movement::create([
                'product_id' => $this->pickingProduct->id,
                'type' => 'out',
                'quantity' => $this->pickingQuantity,
                'notes' => 'Picking confirmado',
            ]);

            $this->dispatch('notify', 'Picking registrado correctamente');
            $this->showPicking = false;
            $this->pickingProduct = null;
            $this->pickingQuantity = 1;
            $this->loadData();
        }
    }

    public function addStock($productId)
    {
        $product = Product::find($productId);
        $product->stock += 10;
        $product->save();

        Movement::create([
            'product_id' => $productId,
            'type' => 'in',
            'quantity' => 10,
            'notes' => 'Stock agregado',
        ]);

        $this->loadData();
    }
}
