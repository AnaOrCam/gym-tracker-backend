<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return response()->json($users,200);
    }
     // Añadir un usuario
     public function store(Request $request)
     {
         $request->validate([
            'username' => 'required|string|max:255',
             'name' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'role' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|string|min:6',
         ]);
 
         $user = User::create([
            'username' => $request->username,
             'name' => $request->name,
             'lastname'=>$request->lastname,
             'role'=>$request->role,
             'email' => $request->email,
             'password' => $request->password,
         ]);
 
         return response()->json($user, 201);
     }
 
     // Obtener un usuario
     public function show($id)
     {
         $user = User::find($id);
 
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }
 
         return response()->json($user);
     }
}
