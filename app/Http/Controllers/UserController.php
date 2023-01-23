<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function search(Request $request)
    {
        //キーワードを変数に格納
        $keyword = $request->input('keyword');
        $query = User::query();
        //絞り込み検索
        if (!empty($keyword)) {
            $query
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%");
        }
        $users = $query->get();
        Log::info($users);
        return $users;
    }
}
