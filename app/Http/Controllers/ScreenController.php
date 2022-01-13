<?php
namespace App\Http\Controllers;
use App\Channel;
use App\Layout;
use App\Screen;
use Illuminate\Http\Request;
class ScreenController extends Controller
{
    public function index($channel_id)
    {
        try
        {
            $channel = auth()->user()->channels()->find($channel_id);
            $screens = $channel->screens()->paginate(6);
            return view('backend.signage.screens.index')
                ->with('screens', $screens)
                ->with('channel', $channel);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@index"!');
            return back()->with('flash-error', "Die Screens des Channels können wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function create($channel_id)
    {
        try
        {
            $layouts = Layout::all()->pluck('name', 'id');
            return view('backend.signage.screens.create')
                ->with('channel_id', $channel_id)
                ->with('layouts', $layouts);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@create"!');
            return back()->with('flash-error', "Das Formular zum Anlegen eines neuen Screens konnte wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function store(Request $request, $channel_id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required | string | max:32',
                'description' => 'nullable | string | max:64',
                'layout_id' => 'required | exists:layouts,id'
            ]
        );
        try
        {
            $screen = new Screen();
            $screen->fill($request->all());
            $screen->layout()->associate(Layout::find($request->layout_id));
            $screen->channel()->associate(Channel::find($channel_id));
            $screen->save();
            return redirect()
                ->route('channels.screens.index', $channel_id)
                ->with('flash-success', "Der neue Screen $screen->name wurde angelegt.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@store"!');
            return back()->with('flash-error', "Der neue Screen konnte wegen eines Fehlers nicht angelegt werden.");
        }
    }
    public function show(Screen $screen)
    {
    }
    public function edit($channel_id, Screen $screen)
    {
        try {
            $layoutName = lcfirst($screen->layout->name);
            $layoutConfig = config('vspot.screens');
            $screenConfig = array_key_exists($layoutName, $layoutConfig) ? $layoutConfig[$layoutName] : [];
            $layouts = Layout::all()->pluck('name', 'id');
            return view('backend.signage.screens.edit')
                ->with('channel_id', $channel_id)
                ->with('layouts', $layouts)
                ->with('screenConfig', $screenConfig)
                ->with('screen', $screen);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "ScreenController@edit"!');
            return back()->with('flash-error', "Der Screen $screen->name kann wegen eines Fehlers nicht editiert werden.");
        }
    }
    public function update(Request $request, $channel_id, Screen $screen)
    {
        $this->validate(
            $request,
            [
                'name' => 'required | string | max:32',
                'description' => 'nullable | string | max:64',
                'layout_id' => 'required | exists:layouts,id'
            ]
        );
        try
        {
            $screen->fill($request->all());
            $screen->layout()->associate(Layout::find($request->layout_id));
            $screen->save();
            return redirect()->route('channels.screens.index', $channel_id)->with('flash-success', "Der Screen $screen->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@update"!');
            return back()->with('flash-error', "Der Screen $screen->name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }
    public function destroy($channel_id, Screen $screen)
    {
        try {
            $screen->delete();
            return redirect()
                ->route('channels.screens.index', $channel_id)
                ->with('flash-success', "Der Channel $screen->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@destroy"!');
            return back()->with('flash-error', "Der Screen $screen->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
}
