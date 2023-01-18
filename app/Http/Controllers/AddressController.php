<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('post', [
            'address' => ['required'],
            'ip' => ['required'],
            'customer' => ['required'],
            'place' => ['required'],
            'purpose' => ['required'],
            'status' => ['required'],
        ]);
        Log::info($validated);
        return Address::create($validated);
    }
    public function show(Address $address)
    {
        return $address;
    }
    public function update(Request $request, Address $address)
    {
        $address->update($request->all());
        return $address;
    }
    public function destroy(Address $address)
    {
        $address->delete();
        return $address;
    }
}
