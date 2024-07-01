<?php

namespace App\Http\Controllers;

use carbon\Carbon;
use Illuminate\Database\Query\Builder;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

class DashboardController extends Controller
{
    use WithExport;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $list = Event::paginate(10);
        return view('event.index');
    }


    public function dashboard()
    {

        //
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $today = Carbon::today()->toDateString();

        // Get events for today
        $todayEvents = Event::where('dateStart', '<=', $today)
            ->where('dateEnd', '>=', $today)
            ->whereNull('deleted_at')
            ->get();

        // Get IDs of today's events
        $todayEventIds = $todayEvents->pluck('id');

        // Get today's guests who have checked in
        $todaysGuests = Guest::whereIn('event_id', $todayEventIds)
            ->where('checkedin', true)
            ->get();

        // Get events for this month
        $thisMonthEvents = Event::where(function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('dateStart', [$startOfMonth, $endOfMonth])
                ->orWhereBetween('dateEnd', [$startOfMonth, $endOfMonth]);
        })
            ->whereNull('deleted_at')
            ->get();

        // Get IDs of this month's events
        $thisMonthEventIds = $thisMonthEvents->pluck('id');

        // Get this month's guests who have checked in
        $thisMonthGuests = Guest::whereIn('event_id', $thisMonthEventIds)
            ->where('checkedin', true)
            ->get();
        $schedule = 'all';

        //get count of rsvp for all event
        $trends = Event::query()
            ->join('guests', 'guests.event_id', '=', 'events.id')
            ->select([
                DB::raw('COUNT(guests.id) as totalGuest'),
                DB::raw('SUM(CASE WHEN guests.checkedin is not null THEN 1 ELSE 0 END) as checkedin'),
                DB::raw('SUM(CASE WHEN guests.attendance is not null THEN 1 ELSE 0 END) as attendance'),
                DB::raw('SUM(CASE WHEN guests.guesttype ="Invitation" THEN 1 ELSE 0 END) as invitation'),
                DB::raw('SUM(CASE WHEN guests.guesttype="Representative" THEN 1 ELSE 0 END) as representative'),
                DB::raw('SUM(CASE WHEN guests.guesttype="Walk-in" THEN 1 ELSE 0 END) as walkin'),
                'events.name as event_name', 'events.id as id',
                'events.maxGuest as event_max_guest'
            ])
            ->groupBy('guests.event_id',  'events.name', 'events.maxGuest')
            ->orderBy('guests.event_id', 'ASC')->get();

        return view('dashboard', [
            'todayEvents' => $todayEvents,
            'todayGuests' => $todaysGuests,
            'thisMonthEvents' => $thisMonthEvents,
            'thisMonthGuests' => $thisMonthGuests,
            'schedule' => $schedule,
            'trends' => $trends,

        ]);
    }
}
