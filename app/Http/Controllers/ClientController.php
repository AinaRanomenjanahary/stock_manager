<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Client::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where('client_first_name', 'like', '%'.$request->search.'%')
                ->orWhere('client_last_name', 'like', '%'.$request->search.'%')
                ->orWhere('client_email', 'like', '%'.$request->search.'%')
                ->orWhere('client_phone', 'like', '%'.$request->search.'%');
        }

        // PAGINATION
        $clients = $query->orderBy('created_at', 'desc')
                        ->paginate(5);

        return view('admin.client.listeclient', compact('clients'));
    }

/**
 * Show create form
 */
public function create()
{
    return view('admin.client.ajoutclient');
}

/**
 * Store new client
 */
public function store(Request $request)
{
    $data = $request->validate([
    'client_first_name' => 'required',
    'client_last_name' => 'required',
    'client_email' => 'required|email',
    'client_phone' => 'required',
    'client_address' => 'required',
]);

Client::create($data);

    return redirect()->route('clients.index')
        ->with('status', 'Client ajouté avec succès');
}

/**
 * Show edit form
 */
public function edit($id)
{
    $client = Client::findOrFail($id);
    return view('admin.client.modifierclient', compact('client'));
}

/**
 * Update client
 */
public function update(Request $request, $id)
{
    $request->validate([
        'client_first_name' => 'required',
        'client_last_name' => 'required',
        'client_email' => 'required|email|unique:clients,client_email,' . $id,
        'client_phone' => 'required',
        'client_address' => 'required',
    ]);

    $client = Client::findOrFail($id);

    $client->update($request->all());

    return redirect()->route('clients.index')
        ->with('status', 'Client modifié avec succès');
}

/**
 * Delete client
 */
public function destroy($id)
{
    $client = Client::findOrFail($id);
    $client->delete();

    return redirect()->route('clients.index')
        ->with('status', 'Client supprimé avec succès');
}
}
