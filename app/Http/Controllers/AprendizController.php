<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use App\Models\Notification;
use Illuminate\Http\Request;

class AprendizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aprendiz.dashboard'); //Redirigir al dashboard del aprendiz
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Mark notification as read
     */
    public function markNotificationAsRead(Notification $notification)
    {
        // Verify that the notification belongs to the authenticated user
        if ($notification->from_user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        $notification->update(['read_at' => now()]);
        
        return response()->json(['success' => true, 'message' => 'Notificación marcada como leída']);
    }

    /**
     * Show notifications history for apprentice
     */
    public function notificationsHistory()
    {
        $notifications = Notification::where('from_user_id', auth()->id())
            ->where('type', 'delete_request')
            ->with(['organic'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('aprendiz.notifications.history', compact('notifications'));
    }
}
