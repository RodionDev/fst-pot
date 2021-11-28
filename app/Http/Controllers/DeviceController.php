<?php
namespace App\Http\Controllers;
use App\Device;
use Illuminate\Http\Request;
class DeviceController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard')->with('flash-error', "TODO! Leider noch nicht umgesetzt.");
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(Device $device)
    {
    }
    public function edit(Device $device)
    {
    }
    public function update(Request $request, Device $device)
    {
    }
    public function destroy(Device $device)
    {
    }
}
