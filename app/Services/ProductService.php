<?php

namespace App\Services;

use App\Model\Product;
use App\Model\Taxonomy;

class ProductService
{
    private function attachTags(array $tags, Product $product): void
    {
        $tagsIds = [];
        foreach ($tags as $tagData) {
            $tag = Taxonomy::where('name', $tagData)->where('type', Taxonomy::TYPE_TAG)->first();
            if (!$tag instanceof Taxonomy) {
                $tag = Taxonomy::create([
                    'name' => $tagData,
                    'type' => Taxonomy::TYPE_TAG,
                    'description' => 'Created from product.',
                ]);
            }
            $tagsIds[] = $tag->id;
        }
        $product->tags()->sync($tagsIds);
    }

    private function uploadImage(array &$data, $path = '/uploads'): void
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $name = md5(time().rand(0, 9999)).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($path);
            $image->move($destinationPath, $name);
            $data['image_path'] = "{$path}/{$name}";
            unset($data['image']);
        }
    }

    public function create(array $productData): void
    {
        $this->uploadImage($productData);
        $product = Product::create($productData);
        $tags = json_decode($productData['tags'], true) ?? [];
        $this->attachTags($tags, $product);
    }

    public function update(array $productData, Product $product): void
    {
        $this->uploadImage($productData);
        $product->update($productData);
        $tags = json_decode($productData['tags'], true) ?? [];
        $this->attachTags($tags, $product);
    }

    public function remove(Product $product): void
    {
        $product->delete();
    }
}
