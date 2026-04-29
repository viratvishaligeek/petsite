<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SeoPluginController extends Controller
{
    private function getModel($type)
    {
        return match ($type) {
            'brand' => Brand::class,
            'category' =>  Category::class,
            'product' => Product::class,
            'blogcategory' =>  BlogCategory::class,
            'blog' =>  Blog::class,
            default => abort(404)
        };
    }
    public function index(Request $request, $type)
    {
        $model = $this->getModel($type);

        $pageName = $type . ' SEO List';
        $data = $model::with('seo')
            ->where('name', 'LIKE', "%{$request->string}%")
            ->get();

        return view('seo.index', compact('data', 'type', 'pageName'));
    }

    public function edit($type, $id)
    {
        $model = $this->getModel($type);
        $data = $model::with('seo')->findOrFail($id);
        $pageName = $data->name . ' SEO EDIT';

        return view('seo.edit', compact('data', 'type', 'pageName'));
    }

    public function update(Request $request, $type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);

        $item->saveSeo($request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
            'slug'
        ]));

        return redirect()->back()->with('success', 'SEO Saved');
    }
}
