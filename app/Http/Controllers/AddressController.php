<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Role;

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
            'memo' => ['max:200'],
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
        $validated = $request->validateWithBag('post', [
            'address' => ['required'],
            'ip' => ['required'],
            'customer' => ['required'],
            'place' => ['required'],
            'purpose' => ['required'],
            'status' => ['required'],
            'memo' => ['max:200'],
            Rule::unique('addresses')->ignore($address->id),
        ]);
        return $address->update($validated);
    }
    public function destroy(Address $address)
    {
        $address->delete();
        return $address;
    }
}
