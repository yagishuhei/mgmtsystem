<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }
    public function store(Request $request)
    {
        return Address::create($request->all());
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
}
