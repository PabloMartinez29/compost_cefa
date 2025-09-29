<?php

namespace App\Http\Controllers\Aprendiz;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Obtener notificaciones del aprendiz
     */
    public function getNotifications()
    {
        $notifications = Notification::with(['fromUser', 'organic'])
            ->where('user_id', auth()->id())
            ->whereIn('status', ['approved', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    /**
     * Marcar notificación como leída
     */
    public function markAsRead(Request $request)
    {
        $notification = Notification::findOrFail($request->notification_id);
        
        if ($notification->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
