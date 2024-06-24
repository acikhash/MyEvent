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
        return view('guest.qrcode', compact('guest', 'qrCode'));
    }

    public function checkin($id)
    {
        
        $guest = Guest::findOrFail($id);

        return view('guest.checkin', compact('guest'));

    }

 
}