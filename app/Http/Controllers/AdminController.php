<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.dashboard', compact('users', 'events'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'is_admin' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin ?? false,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'is_admin' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin ?? false,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // No permitir eliminar el propio usuario admin
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function events()
    {
        $events = Event::with('creator')->orderBy('date', 'desc')->get();
        return view('admin.events', compact('events'));
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        // Crear asistencias para todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'attended' => false,
            ]);
        }

        return redirect()->route('admin.events.index')->with('success', 'Evento creado exitosamente.');
    }

    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event->update([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Evento actualizado exitosamente.');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        
        // Eliminar las asistencias relacionadas
        $event->attendances()->delete();
        
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Evento eliminado exitosamente.');
    }

    public function attendances(Request $request)
    {
        $events = Event::with('creator')->orderBy('date', 'desc')->get();
        $attendances = collect();

        if ($request->has('event_id') && $request->event_id) {
            $attendances = Attendance::where('event_id', $request->event_id)
                ->with('user', 'event')
                ->orderBy('attended', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.attendances', compact('events', 'attendances'));
    }

    public function editAttendances($eventId)
    {
        $event = Event::findOrFail($eventId);
        $attendances = Attendance::where('event_id', $eventId)
            ->with('user')
            ->orderBy('attended', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.edit_attendances', compact('event', 'attendances'));
    }

    public function updateAttendances(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendances' => 'array',
            'attendances.*' => 'boolean',
        ]);

        $eventId = $request->event_id;
        
        // Primero marcar todas como no asistidas
        Attendance::where('event_id', $eventId)->update(['attended' => false]);
        
        // Luego marcar las seleccionadas como asistidas
        if ($request->has('attendances')) {
            foreach ($request->attendances as $attendanceId => $attended) {
                Attendance::where('id', $attendanceId)
                    ->where('event_id', $eventId)
                    ->update(['attended' => true]);
            }
        }

        return redirect()->route('admin.attendances.index', ['event_id' => $eventId])
            ->with('success', 'Asistencias actualizadas correctamente.');
    }

    public function scanner()
    {
        $events = Event::all();
        return view('admin.scanner', compact('events'));
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'qr_data' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);

        $qrData = $request->qr_data;
        list($userId, $eventId) = explode('-', $qrData);

        if ($eventId != $request->event_id) {
            return response()->json(['success' => false, 'message' => 'QR no corresponde al evento seleccionado.']);
        }

        $attendance = Attendance::where('user_id', $userId)->where('event_id', $eventId)->first();

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Asistencia no encontrada.']);
        }

        $attendance->update(['attended' => true]);

        return response()->json(['success' => true, 'message' => 'Asistencia marcada.']);
    }
}
