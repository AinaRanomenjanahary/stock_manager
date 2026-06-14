<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
            $totalClients = Client::count();
            $totalProducts = Product::count();

            $lowStock = Product::where('product_stock', '<=', 5)->count();

            $stockValue = Product::all()->sum(function ($p) {
            return $p->product_price * $p->product_stock;
        });

        return view('dashboard', compact(
            'totalClients',
            'totalProducts',
            'lowStock',
            'stockValue'
        ));
    }
}
