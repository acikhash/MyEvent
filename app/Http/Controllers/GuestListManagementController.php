<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class  GuestListManagementController extends Controller
{
    public function GuestList()
    {
        return view('guest.guestlist');
    }

    public function create()
    {
        return view('guest.registrationform');
    }

    public function store()
    {
        $attributes = request()->validate([
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
    
        ]);

        Guest::create($attributes);

        
        session()->flash('success', 'Guest added successfully.');
       
       // Auth::login($user); 
        return redirect('/Registrationform');
    }
}
