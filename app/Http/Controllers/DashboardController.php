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


        return view('dashboard');
    }
}
