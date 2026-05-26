<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushNotification\StorePushNotificationRequest;
use App\Http\Services\PushNotificationService;
use App\Models\Country;
use App\Models\Line;
use App\Models\PushNotification;
use App\Models\PushNotificationType;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        $userTypes = UserType::orderBy('name')->get(['id', 'name', 'plural_name']);

        $lines = Line::where('is_visible', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('modulos.admin.notification-form', compact('countries', 'userTypes', 'lines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePushNotificationRequest $request, PushNotificationService $service)
    {
        $data = $request->validated();

        $scheduleEnabled = (string) ($data['schedule_enabled'] ?? '0') === '1';

        $userTimezone = $request->user()->country?->timezone ?? config('app.timezone');

        $scheduledAtLocal = $scheduleEnabled
            ? Carbon::createFromFormat('Y-m-d H:i', $data['send_at_date'] . ' ' . $data['send_at_time'], $userTimezone)
            : null;
            
        $scheduledAtUtc = $scheduledAtLocal?->copy()->utc();

        // Para envío inmediato validamos destinatarios antes de crear el registro.
        // Para envío programado se omite: la audiencia puede cambiar antes de disparar.
        $recipients = null;

        if (! $scheduleEnabled) {
            $recipients = $service->filterRecipients($data);

            if ($recipients->isEmpty()) {
                return redirect()
                    ->route('web.admin.notifications.create')
                    ->with('warning', 'No hay usuarios con notificaciones activadas que coincidan con los filtros seleccionados.');
            }
        }

        // Save image in public storage before saving the notification

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('push-notifications', 'public');
        }

        // Create push notification in db

        $adminType = PushNotificationType::where('slug', PushNotificationType::ADMIN)->first();

        $pushNotification = PushNotification::create([
            'push_notification_type_id' => $adminType?->id,
            'title'        => $data['title'],
            'description'  => $data['description'],
            'image_path'   => $imagePath,
            'user_type_id' => $data['user_type_id'] ?? null,
            'country_id'   => $data['country_id'] ?? null,
            'line_id'      => $data['line_id'] ?? null,
            'status'       => $scheduleEnabled ? PushNotification::STATUS_PENDING : PushNotification::STATUS_SENDING,
            'scheduled_at' => $scheduleEnabled ? $scheduledAtUtc : now(),
            'created_by'   => $request->user()->id,
            'from_system'  => false,
        ]);

        if ($scheduleEnabled) {
            return redirect()
                ->route('web.admin.notifications.create')
                ->with('status', 'Notificación programada para el ' . $scheduledAtLocal->format('d/m/Y H:i') . '.');
        }

        // Validate notifications sent

        $result = $service->sendAdminNotification($pushNotification, $recipients);

        $pushNotification->update([
            'status'     => $result['success'] ? PushNotification::STATUS_SENT : PushNotification::STATUS_FAILED,
            'sent_at'    => now(),
            'recipients' => $result['total'],
            'success'    => $result['success'],
            'failed'     => $result['failed'],
            'comment'    => $result['error'],
        ]);

        if ($result['success'] === false) {
            return redirect()
                ->route('web.admin.notifications.create')
                ->with('error', 'Ocurrió un error al enviar las notificaciones, intenta nuevamente o contacta a Soporte.');
        }

        return redirect()
            ->route('web.admin.notifications.create')
            ->with('status', '¡Notificación enviada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PushNotification $pushNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}
