<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use stdClass;
class ApiAccessController extends Controller
{
    public function respond_v1(Request $request, $user_id, $device_id)
    {
        \Debugbar::disable();
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
        if(!$device->channel) return response()->json(new stdClass());
        $channel = $device->channel;
        $screens = $channel->screens;
        $layoutConfig = config('vspot.layouts');
        $screenContentTypes = config('vspot.screen_content_types');
        foreach ($screens as $index => $screen) {
            if($screen->active != 1) {
                unset($screens[$index]);
                continue;
            };
            $layout = strtolower($screen->layout_name);
            $screenConfig = array_key_exists($layout, $layoutConfig) ? $layoutConfig[$layout] : [];
            foreach ($screenContentTypes as $type) {
                if(!in_array($type, $screenConfig)) unset($screen->$type);
            }
            if($layout == 'test') {
                $name = $user->name;
                $deviceName = $device->display_name;
                $product = $device->product_reference ?? 'ohne Angabe';
                $location = $device->location ?? 'ohne Angabe';
                $screen->hml_block =
                "<p>Benutzer: <strong>$name</strong><br>Gerätename: <strong>$deviceName</strong><br>Gerätekennung: <strong>$product</strong><br>Location: <strong>$location</strong></p>";
            };
        }
        return response()->json($channel);
    }
}
