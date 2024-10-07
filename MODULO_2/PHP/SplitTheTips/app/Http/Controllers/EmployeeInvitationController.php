<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeInvitation;
use Illuminate\Support\Str;

class EmployeeInvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:company');
    }

    public function sendInvite(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'area_id' => 'required|exists:areas,id',
        ]);

        $company = Auth::user()->company;

        // Crear un nuevo usuario
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => bcrypt(Str::random(8)),
            'role' => 'employee',
        ]);

        // Crear el empleado asociado
        $employee = Employee::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'area_id' => $validatedData['area_id'],
        ]);

        // Enviar el correo de invitación
        Mail::to($user->email)->send(new EmployeeInvitation($user, $company));

        return redirect()->route('company.employees.index')->with('success', 'Invitación enviada con éxito.');
    }
}