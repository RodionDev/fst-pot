<?php
namespace App\Http\Controllers\Access;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
class DeviceWebAccessController extends Controller
{
    public function respond_v1(Request $request, $user_id, $device_id)
    {
        \Debugbar::disable();
        $user = User::find($user_id);
        $device = $user->devices->find($device_id);
        $device_views_public_channel = $device->channel->web_is_public ?? false;
        if(!$device_views_public_channel) {
            if(!$request->api_token || $device->api_token != $request->api_token) abort(403, 'Unberechtigter Zugriff');
        }
        if($request->exists('timestamp')) {
            $lastUpdateDevice = $device->updated_at->timestamp;
            $lastUpdate = $lastUpdateDevice;
            if($device->channel) {
                $lastUpdateChannel = $device->channel->updated_at->timestamp;
                if($lastUpdateChannel > $lastUpdateDevice) $lastUpdate = $lastUpdateChannel;
            }
            return response()->json([
                'lastUpdate' => $lastUpdate
            ]);
        }
        if(!$device->channel) return view('web.access')
            ->with('noChannel', true)
            ->withUser($user)
            ->withDevice($device);
        $channel = $device->channel;
        $screens = $channel->screens;
        return view('web.access')
            ->with('noChannel', false)
            ->withUser($user)
            ->withDevice($device)
            ->withChannel($channel)
            ->withScreens($screens);
    }
}
