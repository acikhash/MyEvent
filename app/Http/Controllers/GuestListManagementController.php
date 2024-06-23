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
            'guesttype' => [],
            'bringrep'=>'',
            'attendance' => [],
    
        ]);

        // Assign default values 
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Invitation';
        $attributes['attendance'] = $attributes['attendance'] ?? 'off';

        Guest::create($attributes);

        
        session()->flash('success', 'Guest added successfully.');
       
       // Auth::login($user); 
        return redirect('/GuestList');
    }






    public function showEdit($id)
    {
    // Fetch the guest data for editing, assuming Guest model exists
    $guest = Guest::find($id);
    
    // Return view with guest data
    return view('guest.edit', compact('guest'));
    }





    public function edit(Request $request, $id)
    {
        $attributes = $request->validate([
            'eventid',
            'eventname',
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'bringrep' =>'',
    
        ]);


        $guest = Guest::find($id);

        $guest->bringrep = $request->has('bringrep') ? 'on' : 'off';

        // Assuming fillable fields in Guest model
        $guest->fill($attributes); 
        $guest->save();


        
        session()->flash('success', 'successfully updated.');
       
       // Auth::login($user); 
        return redirect('/GuestList');
    }

    public function RepresentativeCreate()
    {
        return view('guest.representativeform');
    }

    public function RepresentativeStore()
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
            'guesttype' => [],
            'attendance' => [],
    
        ]);

        // Assign default values 
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Representative';
        $attributes['attendance'] = $attributes['attendance'] ?? 'off';

        Guest::create($attributes);

        
        session()->flash('success', 'Guest added successfully.');
       
       // Auth::login($user); 
        return redirect('/GuestList');
    }



    public function walkincreate()
    {
        return view('guest.walkinregistrationform');
    }




    public function walkinstore()
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
            'guesttype' => [],
            'bringrep'=>'',
            'attendance' => [],
            'checkedin' => [],
    
        ]);

        // Assign default values 
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Walk-in';
        $attributes['attendance'] = $attributes['attendance'] ?? 'on';
        $attributes['bringrep'] = $attributes['bringrep'] ?? 'off';
        $attributes['checkedin'] = $attributes['checkedin'] ?? 'on';

        Guest::create($attributes);

        
        session()->flash('success', 'Guest added successfully.');
       
       // Auth::login($user); 
        return redirect('/Walk-inRegistrationform');
    }










     /* QR code
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

    }*/

}
