<x-app-layout>

@section('title')
    Modifier Client
@endsection

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white shadow-md rounded-lg p-6">

        <h4 class="text-xl font-semibold mb-6">Modifier Client</h4>

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

        <form action="{{ route('clients.update', $client->id) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- ID caché --}}
            <input type="hidden" name="id" value="{{ $client->id }}">

            {{-- Prénom --}}
            <div>
                <label for="client_first_name" class="block text-sm font-medium">
                    Prénom
                </label>
                <input
                    type="text"
                    name="client_first_name"
                    id="client_first_name"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ $client->client_first_name }}"
                >
            </div>

            {{-- Nom --}}
            <div>
                <label for="client_last_name" class="block text-sm font-medium">
                    Nom
                </label>
                <input
                    type="text"
                    name="client_last_name"
                    id="client_last_name"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ $client->client_last_name }}"
                >
            </div>

            {{-- Email --}}
            <div>
                <label for="client_email" class="block text-sm font-medium">
                    Email
                </label>
                <input
                    type="email"
                    name="client_email"
                    id="client_email"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ $client->client_email }}"
                >
            </div>

            {{-- Téléphone --}}
            <div>
                <label for="client_phone" class="block text-sm font-medium">
                    Téléphone
                </label>
                <input
                    type="text"
                    name="client_phone"
                    id="client_phone"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ $client->client_phone }}"
                >
            </div>

            {{-- Adresse --}}
            <div>
                <label for="client_address" class="block text-sm font-medium">
                    Adresse
                </label>
                <input
                    type="text"
                    name="client_address"
                    id="client_address"
                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-300"
                    value="{{ $client->client_address }}"
                >
            </div>

            {{-- Submit --}}
            <div>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    Modifier
                </button>
            </div>

        </form>

    </div>
</div>

</x-app-layout>
