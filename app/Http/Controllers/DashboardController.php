<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Carbon\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $list = Event::paginate(10);
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
        //
        $events = Event::all();
        $guest = Guest::all();

        $todayEvent = Event::where('dateStart', '<=', date('Y-m-d'))
            ->where('dateEnd', '>=', date('Y-m-d'))->get();

        $thisMonthEvent =
            Event::where('dateStart', '<=', date('Y-m'))
            ->where('dateEnd', '>=', date('Y-m'))->get();

        //dd($todayEvent);
        return view('dashboard', ['todayEvent' => $todayEvent, 'thisMonthEvent' => $thisMonthEvent, 'events' => $events, 'guest' => $guest]);
    }
}
