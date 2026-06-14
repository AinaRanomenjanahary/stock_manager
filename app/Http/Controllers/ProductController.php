<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * LISTE + RECHERCHE + PAGINATION
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%'.$request->search.'%');
        }

        // PAGINATION
        $produits = $query->orderBy('id', 'desc')->paginate(5);

        return view('admin.product.listeproduit', compact('produits'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        return view('admin.product.ajoutproduit');
    }

    /**
     * STORE PRODUCT
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5999',
        ]);

        // IMAGE UPLOAD PROPRE
        if ($request->hasFile('product_image')) {
            $fileNameToStore = $request->file('product_image')
                ->store('product_images', 'public');
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        Product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_stock' => $request->product_stock,
            'product_image' => $fileNameToStore,
        ]);

        return redirect()->route('produits.index')
            ->with('status', 'Produit ajouté avec succès');
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.modifierproduit', compact('product'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5999',
        ]);

        $product = Product::findOrFail($id);

        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_stock = $request->product_stock;

        if ($request->hasFile('product_image')) {

            $fileNameToStore = $request->file('product_image')
                ->store('product_images', 'public');

            // delete old image
            if ($product->product_image && $product->product_image != 'noimage.jpg') {
                Storage::disk('public')->delete($product->product_image);
            }

            $product->product_image = $fileNameToStore;
        }

        $product->save();

        return redirect()->route('produits.index')
            ->with('status', 'Produit modifié avec succès');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && $product->product_image != 'noimage.jpg') {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();

        return redirect()->route('produits.index')
            ->with('status', 'Produit supprimé avec succès');
    }
}
