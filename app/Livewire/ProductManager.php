<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductManager extends Component
{

    use WithFileUploads;

    public $products;
    public $categories;

    public $description='';
    public $category_id, $name, $price,$unit, $thumbnail, $images = [], $slug;
    public $productIdBeingUpdated = null;
    public $showModal = false;

    public function mount()
    {
        $this->products = Product::with('category')->latest()->get();
        $this->categories = Category::latest()->get();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $this->productIdBeingUpdated = $id;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->unit = $product->unit;
        $this->thumbnail = $product->thumbnail;
        $this->slug = $product->slug;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $this->productIdBeingUpdated,
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($this->name);
        $thumbnailPath = is_object($this->thumbnail) ? $this->thumbnail->store('thumbnails', 'public') : $this->thumbnail;

        if ($this->productIdBeingUpdated) {
            $product = Product::findOrFail($this->productIdBeingUpdated);
            $product->update([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => $slug,
                'price' => $this->price,
                'unit' => $this->unit,
                'description' => $this->description,
                'thumbnail' => $thumbnailPath ?? $product->thumbnail,
            ]);
        } else {
            $product = Product::create([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => $slug,
                'price' => $this->price,
                'unit' => $this->unit,
                'description' => $this->description,
                'thumbnail' => $thumbnailPath,
            ]);
        }

        // Save images
        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                $path = $img->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        $this->resetFields();
        $this->products = Product::with('category')->latest()->get();
        $this->showModal = false;
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        $this->products = Product::with('category')->latest()->get();
    }

    private function resetFields()
    {
        $this->category_id = '';
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->unit = '';
        $this->thumbnail = null;
        $this->images = [];
        $this->slug = '';
        $this->productIdBeingUpdated = null;
    }

    #[Layout('layouts.admin_layout')]
    public function render()
    {
        return view('livewire.product-manager');
    }
}
