<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function qr(Request $request)
    {
        $events = Event::all();
        $selectedEvent = null;

        if ($request->has('event_id')) {
            $selectedEvent = Event::find($request->event_id);
        }

        return view('user.qr', compact('events', 'selectedEvent'));
    }
}
