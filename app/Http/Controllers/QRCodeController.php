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


class  QRCodeController extends Controller
{

    public function QRcode($id)
    {
        // Fetch guest information
        $guest = Guest::findOrFail($id);

        // Generate QR code content
        $qrCodeContent = url('/checkin/' . $guest->id);

        // Generate QR code image
        $qrCode = QrCode::size(200)->generate($qrCodeContent);

        // Pass the QR code image and guest data to the view
        return view('guest.Attendance.qrcode', compact('guest', 'qrCode'));
    }

    public function checkin($id)
    {

        $guest = Guest::findOrFail($id);

        return view('guest.Attendance.checkin', compact('guest'));
    }


    public function checkinupdate(Request $request, $id)
    {

        $guest = Guest::findOrFail($id);

        $guest = Guest::find($id);

        $attributes = $request->validate([

            'checkedin' => [],

        ]);




        if ($guest->checkedin == 'Yes') {
            return redirect("/Thankyouform");
        } else {

            $attributes['checkedin'] = $attributes['checkedin'] ?? 'no';

            // Validate request data
            $guest->fill($attributes);
            $guest->checked = now();
            $guest->save();


            return redirect('/Thankyouform')->with('success', 'Information updated successfully.');
        }
    }

    public function scan()
    {
        return view('guest.Attendance.scan');
    }

    public function processScan(Request $request)
    {
        // Ensure it's a POST request
        if ($request->isMethod('post')) {
            $qrCodeContent = $request->input('qrCodeContent');

            // Implement your logic to handle the scanned QR code content here
            // For example, you can save it to a database, perform actions, etc.

            return response()->json(['status' => 'success', 'data' => $qrCodeContent]);
        }

        // Handle other cases if necessary
        //abort(405); // Method Not Allowed
    }
}
