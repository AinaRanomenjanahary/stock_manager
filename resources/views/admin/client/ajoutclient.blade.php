
<x-app-layout>

    @section('title')
        Ajouter Client
    @endsection

    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

        <div class="w-full max-w-2xl">

            <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8">

                <h4 class="text-xl font-semibold mb-6 text-gray-800">
                    Ajouter Client
                </h4>

                {{-- SUCCESS --}}
                @if (Session::has('status'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ Session::get('status') }}
                    </div>
                @endif

                {{-- ERRORS --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('clients.store') }}"
                    method="POST"
                    class="space-y-4">

                    @csrf

                    <!-- PRENOM -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Prénom
                        </label>
                        <input type="text"
                            name="client_first_name"
                            value="{{ old('client_first_name') }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- NOM -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Nom
                        </label>
                        <input type="text"
                            name="client_last_name"
                            value="{{ old('client_last_name') }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email"
                            name="client_email"
                            value="{{ old('client_email') }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- TELEPHONE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Téléphone
                        </label>
                        <input type="text"
                            name="client_phone"
                            value="{{ old('client_phone') }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- ADRESSE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Adresse
                        </label>
                        <input type="text"
                            name="client_address"
                            value="{{ old('client_address') }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- BUTTON -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Ajouter Client
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>
