<?php

// app/Http/Livewire/ProductSearch.php

namespace app\Livewire;
use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';
    public $products = [];

    public function searchProduct()
    {
        // Filter 
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')
                                  ->orWhere('brand', 'like', '%' . $this->search . '%')
                                  ->get();
    }

    public function render()
    {
        // Initially load all products if no search term
        if (!$this->search) {
            $this->products = Product::all();
        }

        return view('livewire.product-search');
    }
}
