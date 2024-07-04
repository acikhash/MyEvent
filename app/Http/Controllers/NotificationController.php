<?php

namespace App\Http\Controllers;

use App\Mail\SendInvite;
use App\Mail\SendQR;
use App\Models\Guest;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NotificationController extends Controller
{
    //
    public function sendInvitation($id)
    {
        $guest = Guest::find($id);

        //dd($guest);
        $data['name'] = $guest->name;
        $data['eventname'] = $guest->event->name;
        $data['eventdate'] = $guest->event->dateStart;
        $data['starttime'] = $guest->event->timeStart;
        $data['eventveneu'] = $guest->event->veneu;
        $data['eventrsvp'] = route('guest.Updateattendancestore', $guest->id);
        $data['email'] = $guest->email; //$guest->email;

        // The email sending is done using the to method on the Mail facade
        Mail::to($data['email'])->send(new SendInvite($data));
        //return redirect('guest', $guest->event_id)->with('success', 'Invitation Sent Successfully');
        $guest->update(['invited' => now()]);
        return redirect()->route('guestl.index', $guest->event_id)->with('success', 'Invitation Sent Successfully');
    }

    public function sendQR($id)
    {
        $guest = Guest::find($id);

        // Generate QR code content
        $qrCodeContent = url('/checkin/' . $guest->id);

        // Generate QR code image
        $qrCode = QrCode::size(200)->generate($qrCodeContent);

        $data['name'] = $guest->name;
        $data['eventname'] = $guest->event->name;
        $data['eventdate'] = $guest->event->dateStart;
        $data['starttime'] = $guest->event->timeStart;
        $data['eventveneu'] = $guest->event->veneu;
        $data['qrCode'] = $qrCode;
        $data['eventrsvp'] = "event";
        $data['email'] = "a@test.com"; //$guest->email;
        // dd($guest);
        // The email sending is done using the to method on the Mail facade
        Mail::to($data['email'])->send(new SendQR($data));
        //return redirect('guest', $guest->event_id)->with('success', 'Invitation Sent Successfully');
        return redirect()->route('guestl.index', $guest->event_id)->with('success', 'QR Code Sent Successfully');
    }
}
