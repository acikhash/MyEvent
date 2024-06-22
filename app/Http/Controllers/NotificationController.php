<?php

namespace App\Http\Controllers;

use App\Mail\MyTestEmail;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function sendInvitation(Request $request)
    {
        $event = Event::find($request->id);
        $data['name'] = $request['name'];
        $data['eventname'] = $event->name;
        $data['eventdate'] = $event->startDate;
        $data['starttime'] = $event->timeStart;
        $data['eventveneu'] = $event->veneu;
        $data['eventrsvp'] = $request['eventrsvp'];

        // The email sending is done using the to method on the Mail facade
        Mail::to($data['email'])->send(new MyTestEmail($data));
    }
}
