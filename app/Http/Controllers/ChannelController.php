<?php
namespace App\Http\Controllers;
use App\Channel;
use Illuminate\Http\Request;
class ChannelController extends Controller
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
    public function show(Channel $channel)
    {
    }
    public function edit(Channel $channel)
    {
    }
    public function update(Request $request, Channel $channel)
    {
    }
    public function destroy(Channel $channel)
    {
    }
}
