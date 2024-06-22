<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Models\Event;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Writer\PngWriter;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class  GuestListManagementController extends Controller
{
    public function GuestList()
    {
        return view('guest.guestlist');
    }

    public function EventTables()
    {
        $events = Event::all();
        return view('guest.eventtables', compact('events'));
    }

    public function show($id)
    {
        // Fetch guest information 
        $guest = Guest::findOrFail($id);

        // Generate QR code content 
        $qrCodeContent = url('/confirmation/' . $guest->id);

        // Generate QR code image
        $qrCode = QrCode::size(200)->generate($qrCodeContent);

        // Pass the QR code image and guest data to the view
        return view('guest.show', compact('guest', 'qrCode'));
    }

    public function confirmation($id)
    {
        $guest = Guest::findOrFail($id);

        return view('guest.confirmation', compact('guest'));

    }


    public function create()
    {
        return view('guest.registrationform');
    }

    public function store()
    {
        $attributes = request()->validate([
            'eventid',
            'eventname',
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
        return redirect('/GuestList');
    }
}
