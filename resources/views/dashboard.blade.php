<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tableaux de bord
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Clients -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Clients</p>
                <h1 class="text-3xl font-bold text-blue-600">
                    {{ $totalClients }}
                </h1>
            </div>

            <!-- Produits -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Produits</p>
                <h1 class="text-3xl font-bold text-green-600">
                    {{ $totalProducts }}
                </h1>
            </div>

            <!-- Stock faible -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Stock faible</p>
                <h1 class="text-3xl font-bold text-red-600">
                    {{ $lowStock }}
                </h1>
            </div>

            <!-- Valeur stock -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Valeur stock</p>
                <h1 class="text-3xl font-bold text-purple-600">
                    {{ number_format($stockValue, 0, ',', ' ') }} €
                </h1>
            </div>

        </div>

        <!-- Section graphique simple -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Alert stock -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h2 class="font-bold text-lg mb-4">⚠️ Produits en stock faible</h2>

                <ul class="space-y-2">
                    @foreach(\App\Models\Product::where('product_stock','<=',5)->get() as $p)
                        <li class="flex justify-between border-b pb-2">
                            <span>{{ $p->product_name }}</span>
                            <span class="text-red-600 font-bold">{{ $p->product_stock }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Top produits -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h2 class="font-bold text-lg mb-4">📦 Top produits</h2>

                <ul class="space-y-2">
                    @foreach(\App\Models\Product::orderBy('product_stock','desc')->limit(5)->get() as $p)
                        <li class="flex justify-between border-b pb-2">
                            <span>{{ $p->product_name }}</span>
                            <span class="text-green-600 font-bold">{{ $p->product_stock }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>

</x-app-layout>

