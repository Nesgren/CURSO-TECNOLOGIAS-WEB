<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $employee = $user->employee; // Obtener el modelo del empleado relacionado
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $employee = $user->employee; // Obtener el modelo del empleado relacionado
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado con éxito.');
    }
}