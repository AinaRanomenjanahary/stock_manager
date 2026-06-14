<x-app-layout>

@section('title')
    Clients
@endsection

<div class="min-h-screen bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

            <!-- TITLE -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Clients</h1>
                <p class="text-gray-500">Gestion des clients</p>
            </div>

            <!-- SEARCH -->
            <form method="GET"
                  action="{{ route('clients.index') }}"
                  class="flex w-full md:w-1/3">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Rechercher un client..."
                       class="w-full border rounded-l-lg p-2 focus:ring focus:ring-blue-200">

                <button type="submit"
                        class="bg-slate-200 text-white px-4 rounded-r-lg hover:bg-sky-300">
                    🔍
                </button>

            </form>

            <!-- BUTTON -->
            <a href="{{ url('/clients/create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow text-center">
                + Ajouter un client
            </a>

        </div>

        {{-- SUCCESS --}}
        @if (Session::has('status'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg">
                {{ Session::get('status') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left">

                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Prénom</th>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Téléphone</th>
                            <th class="px-6 py-4">Adresse</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse ($clients as $client)

                        <tr class="hover:bg-gray-50">

                            <!-- INDEX PAGINATION -->
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $clients->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $client->client_first_name }}
                            </td>

                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $client->client_last_name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $client->client_email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $client->client_phone }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $client->client_address }}
                            </td>

                            <td class="px-6 py-4 text-right space-x-2">

                                <a href="{{ url('/clients/'.$client->id.'/edit') }}"
                                   class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                    Edit
                                </a>

                                <form action="{{ route('clients.destroy', $client->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Supprimer ce client ?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                        Supprimer
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Aucun client trouvé
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $clients->withQueryString()->links() }}
        </div>

    </div>
</div>

</x-app-layout>
