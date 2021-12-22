<?php
namespace App\Http\Controllers;
use App\Device;
use Illuminate\Http\Request;
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
        $this->validate(
            $request,
            [
                'display_name' => 'required | alpha_dash | max:32 | unique:devices',
                'product_reference' => 'nullable | string | max:32',
                'location' => 'nullable | string | max:32',
                'description' => 'nullable | string | max:64'
            ]
        );
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
            return view('backend.signage.devices.edit')
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
        $this->validate(
            $request,
            [
                'display_name' => 'required | alpha_dash | max:32 | unique:devices',
                'product_reference' => 'nullable | string | max:32',
                'location' => 'nullable | string | max:32',
                'description' => 'nullable | string | max:64'
            ]
        );
        try
        {
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
        if(auth()->user()->devices()->count() < 2)
        {
            return back()->with('flash-error', 'Das letzte verbleibende Gerät darf nicht gelöscht werden.');
        }
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
}
