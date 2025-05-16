<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['clients'] = Client::get();
        return view('dashboards.clients.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'domain' => 'required|string|max:255|unique:clients',
            'api_key' => 'required|string|max:255|unique:clients',
            'subscription_expiry_date' => 'required|date|after:' . today()->toDateString()
        ]);

        DB::beginTransaction();
        try {
            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'domain' => $request->domain,
                'api_key' => $request->api_key,
                'subscription_expiry_date' => $request->subscription_expiry_date
            ]);

            DB::commit();
            return redirect()->route('clients.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $data['client'] = $client;
        return view('dashboards.clients.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:clients,name,' . $client->id,
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'domain' => 'required|string|max:255|unique:clients,domain,' . $client->id,
            'api_key' => 'required|string|max:255|unique:clients,api_key,' . $client->id,
            'subscription_expiry_date' => 'required|date|after:' . today()->toDateString()
        ]);

        DB::beginTransaction();
        try {
            return ['updated' => $client];
            // Client::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'domain' => $request->domain,
            //     'api_key' => $request->api_key,
            //     'subscription_expiry_date' => $request->subscription_expiry_date
            // ]);

            DB::commit();
            return redirect()->route('clients.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        return ['delete' => $client];
    }
}
