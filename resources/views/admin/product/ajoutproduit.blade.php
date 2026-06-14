<x-app-layout>

@section('title')
    Ajouter Produit
@endsection

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white shadow-md rounded-lg p-6">

        <h4 class="text-xl font-semibold mb-6">Ajouter un produit</h4>

        {{-- Success message --}}
        @if (Session::has('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ Session::get('status') }}
            </div>
        @endif

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ action('App\Http\Controllers\ProductController@store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4"
        >

            @csrf

            {{-- Nom produit --}}
            <div>
                <label for="product_name" class="block text-sm font-medium">
                    Nom du produit
                </label>
                <input
                    type="text"
                    name="product_name"
                    id="product_name"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ old('product_name') }}"
                >
            </div>

            {{-- Prix --}}
            <div>
                <label for="product_price" class="block text-sm font-medium">
                    Prix du produit
                </label>
                <input
                    type="number"
                    name="product_price"
                    id="product_price"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ old('product_price') }}"
                >
            </div>

            {{-- Catégorie --}}
            <div>
                <label for="product_stock" class="block text-sm font-medium">
                    Quantité du produit
                </label>
                <input
                    type="number"
                    name="product_stock"
                    id="product_stock"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ old('product_stock') }}"
                >
            </div>

            {{-- Image --}}
            <div>
                <label for="product_image" class="block text-sm font-medium">
                    Image
                </label>
                <input
                    type="file"
                    name="product_image"
                    id="product_image"
                    class="w-full mt-1 p-2 border rounded"
                >
            </div>

            {{-- Submit --}}
            <div>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    Ajouter
                </button>
            </div>

        </form>

    </div>
</div>

</x-app-layout>

