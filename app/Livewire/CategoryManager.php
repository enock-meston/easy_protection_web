<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryManager extends Component
{
    use WithFileUploads;
    public $categories;
    public $name;
    public $image;
    public $description;
    public $slug;
    public $categoryIdBeingUpdated = null;
    public $showModal = false;

    public function mount()
    {
        $this->categories = Category::latest()->get();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryIdBeingUpdated = $id;
        $this->name = $category->name;
        $this->image = $category->image;
        $this->description = $category->description;
        $this->slug = $category->slug;
        $this->showModal = true;
    }

   public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name,' . $this->categoryIdBeingUpdated,
            'image' => 'nullable|image|max:2048', // 2MB Max
            'description' => 'nullable|string|max:500',
        ]);

        $slug = Str::slug($this->name);

        // Upload image if new one provided
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('uploaded_image_category', 'public');
        }

        // If updating
        if ($this->categoryIdBeingUpdated) {
            $category = Category::findOrFail($this->categoryIdBeingUpdated);
            $category->update([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description,
                'image' => $imagePath ?? $category->image, // keep old image if not replaced
            ]);
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description,
                'image' => $imagePath,
            ]);
        }

        $this->resetFields();
        $this->showModal = false;
        $this->categories = Category::latest()->get();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        $this->categories = Category::latest()->get();
    }

   private function resetFields()
{
    $this->name = '';
    $this->image = null;
    $this->description = '';
    $this->slug = '';
    $this->categoryIdBeingUpdated = null;
}


    #[Layout('layouts.admin_layout')]
    public function render()
    {
        return view('livewire.category-manager');
    }
}
