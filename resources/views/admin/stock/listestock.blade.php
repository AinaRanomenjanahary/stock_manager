<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des stocks
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 p-6">

        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Stocks</h1>
                    <p class="text-gray-500">Gestion des stocks des produits</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Produit</th>
                                <th class="px-6 py-4">Stock</th>
                                <th class="px-6 py-4">Statut</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse($produits as $produit)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- PRODUIT -->
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $produit->product_name }}
                                </td>

                                <!-- STOCK -->
                                <td class="px-6 py-4">

                                    <form action="{{ route('stocks.update', $produit->id) }}"
                                          method="POST"
                                          class="flex items-center gap-2">

                                        @csrf
                                        @method('PUT')

                                        <!-- - -->
                                        <button type="button"
                                                onclick="changeStock(this, -1)"
                                                class="w-8 h-8 rounded bg-red-100 text-red-700 font-bold hover:bg-red-200">
                                            -
                                        </button>

                                        <!-- INPUT -->
                                        <input type="number"
                                               name="product_stock"
                                               value="{{ $produit->product_stock }}"
                                               min="0"
                                               onchange="this.form.submit()"
                                               class="w-20 text-center border rounded-lg">

                                        <!-- + -->
                                        <button type="button"
                                                onclick="changeStock(this, 1)"
                                                class="w-8 h-8 rounded bg-green-100 text-green-700 font-bold hover:bg-green-200">
                                            +
                                        </button>

                                    </form>

                                </td>

                                <!-- STATUS -->
                                <td class="px-6 py-4">

                                    @if($produit->product_stock <= 5)
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                            Stock faible
                                        </span>
                                    @elseif($produit->product_stock <= 20)
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">
                                            Stock moyen
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                            Disponible
                                        </span>
                                    @endif

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    Aucun produit trouvé
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script>
        function changeStock(button, value) {
            let form = button.closest('form');
            let input = form.querySelector('input[name="product_stock"]');

            let current = parseInt(input.value || 0);
            let newValue = current + value;

            if (newValue < 0) newValue = 0;

            input.value = newValue;
            form.submit();
        }
    </script>

</x-app-layout>
