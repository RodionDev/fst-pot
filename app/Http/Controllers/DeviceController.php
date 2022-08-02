<?php
namespace App\Http\Controllers;
use App\Device;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
class DeviceController extends Controller
{
    public function index()
    {
        try
        {
            $user = auth()->user();
            $devices = $user->devices()->orderBy('display_name', 'asc')->paginate(6);
            return view('backend.signage.devices.index')
                ->with('devices', $devices);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@index"!');
            return back()->with('flash-error', "Die Geräte des Benutzers können wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function create()
    {
        try
        {
            return view('backend.signage.devices.create');
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@create"!');
            return back()->with('flash-error', "Das Formular zum Anlegen eines neuen Gerätes konnte wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'display_name' => [
                'required',
                'string',
                'between:3,32',
                Rule::unique('devices')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'product_reference' => 'nullable | string | max:64',
            'location' => 'nullable | string | max:32',
            'description' => 'nullable | string | max:64'
        ]);
        try
        {
            $device = new Device();
            $device->fill($request->all());
            $device->user()->associate(auth()->user());
            $device->save();
            return redirect()->route('devices.index')->with('flash-success', "Das neue Gerät $device->display_name wurde angelegt.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@store"!');
            return back()->with('flash-error', "Das neue Gerät konnte wegen eines Fehlers nicht angelegt werden.");
        }
    }
    public function show(Device $device)
    {
        return redirect()->route('devices.index');
    }
    public function edit(Device $device)
    {
        try
        {
            $channels = auth()->user()->channels()->orderBy('name','asc')->pluck('name', 'id');
            $channels['0'] = 'Ohne Channel';
            return view('backend.signage.devices.edit')
                ->with('channels', $channels)
                ->with('device', $device);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "DeviceController@edit"!');
            return back()->with('flash-error', "Das Gerät $device->display_name kann wegen eines Fehlers nicht editiert werden.");
        }
    }
    public function update(Request $request, Device $device)
    {
        $user = auth()->user();
        $request->validate([
            'display_name' => [
                'required',
                'string',
                'between:3,32',
                Rule::unique('devices')->ignore($device)->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'product_reference' => 'nullable | string | max:64',
            'location' => 'nullable | string | max:32',
            'description' => 'nullable | string | max:128',
            'channel_id' => 'nullable | exists:channels,id',
        ]);
        try
        {
            $channelId = $request->channel;
            if($channelId === 0) {
                $device->channel()->associate(null);
            } else {
                $newChannel = auth()->user()->channels()->find($channelId);
                $device->channel()->associate($newChannel);
            }
            $device->fill($request->all())->save();
            return redirect()->route('devices.index')->with('flash-success', "Das Gerät $device->display_name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@update"!');
            return back()->with('flash-error', "Das Gerät $device->display_name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }
    public function destroy(Device $device)
    {
        try {
            $device->delete();
            return redirect()->route('devices.index')->with('flash-success', "Das Gerät $device->display_name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@destroy"!');
            return back()->with('flash-error', "Das Gerät $device->display_name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
    public function streamPdf($deviceId)
    {
        $user = auth()->user();
        $device = $user->devices()->whereId($deviceId)->first();
        $dt = Carbon::now();
        $qrCodeSize = 200;
        $data['date'] = $dt->isoFormat('D. MMMM GGGG');
        $data['time'] = $dt->isoFormat('HH:mm');
        $data['year'] = $dt->isoFormat('GGGG');
        $data['user'] = $user;
        $data['device'] = $device;
        $data['qrCodeSize'] = $qrCodeSize;
        $data['weburl'] = $device->weburl;
        $data['webqr_b64'] = base64_encode($device->makeQR(false, false, $qrCodeSize));
        $data['apiurl'] = $device->apiurl;
        $data['apiqr_b64'] = base64_encode($device->makeQR(true, false, $qrCodeSize));
        $pdf = PDF::loadView('pdf.device-access-links', $data);
        return $pdf->stream();
    }
}
