<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
class WebAccessController extends Controller
{
    public function respond(Request $request, $user_id, $device_id)
    {
        $user = User::find($user_id);
        if($user->api_token != $request->api_token) abort(403, 'Unberechtigter Zugriff');
        $device = $user->devices->find($device_id);
        if($request->exists('timestamp')) {
            $lastUpdate = $device->updated_at->timestamp;
            if($device->channel && $device->channel->updated_at->timestamp > $lastUpdate)
                $lastUpdate = $device->channel->updated_at->timestamp;
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
