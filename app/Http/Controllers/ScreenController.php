<?php
namespace App\Http\Controllers;
use App\Channel;
use App\Layout;
use App\Rules\ValidColor;
use App\Screen;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
class ScreenController extends Controller
{
    public function index($channel_id)
    {
        try
        {
            $channel = auth()->user()->channels()->find($channel_id);
            $screens = $channel->screens()->orderBy('order', 'asc')->paginate(8);
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
                'name' => [
                    'required',
                    'string',
                    'between:3,32',
                    Rule::unique('screens')->where(function ($query) use ($channel_id) {
                        return $query->where('channel_id', $channel_id);
                    })
                ],
                'description' => 'nullable | string | max:128',
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
            $layoutName = strtolower($screen->layout->name);
            $layoutConfig = config('vspot.layouts');
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
    public function duplicate($channel_id, Screen $screen)
    {
        try {
            $screen->load('channel', 'layout');
            $newScreen = $screen->replicate();
            $newScreen->save();
            return redirect()
                ->route('channels.screens.index', $channel_id)
                ->with('flash-success', "Der Screen $screen->name wurde dupliziert.");
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "ScreenController@duplicate"!');
            return back()->with('flash-error', "Der Screen $screen->name kann wegen eines Fehlers nicht dupliziert werden.");
        }
    }
    public function update(Request $request, $channel_id, Screen $screen)
    {
        $colorValidator = new ValidColor();
        $this->validate(
            $request,
            [
                'name' => [
                    'required',
                    'string',
                    'between:3,32',
                    Rule::unique('screens')->ignore($screen)->where(function ($query) use ($channel_id) {
                        return $query->where('channel_id', $channel_id);
                    })
                ],
                'description' => 'nullable | string | max:128',
                'layout_id' => 'required | exists:layouts,id',
                'background_color' => ['nullable', $colorValidator],
                'bg_img_cdn_link' => 'nullable | url',
                'overlay_color' => ['nullable', $colorValidator],
                'text_color' => ['nullable', $colorValidator],
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
                ->with('flash-success', "Der Screen $screen->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ScreenController@destroy"!');
            return back()->with('flash-error', "Der Screen $screen->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
    public function move($channel_id, Screen $screen, $action)
    {
        try {
            switch ($action) :
                case 'start' :
                    $screen->moveToStart();
                    $message = 'an den Anfang';
                    break;
                case 'up' :
                    $screen->moveOrderUp();
                    $message = 'eine Position nach vorne';
                    break;
                case 'down' :
                    $screen->moveOrderDown();
                    $message = 'eine Position nach hinten';
                    break;
                case 'end' :
                    $screen->moveToEnd();
                    $message = 'an das Ende';
                    break;
            endswitch;
            return redirect()
                ->route('channels.screens.index', $channel_id)
                ->with('flash-success', "Der Screen „{$screen->name}“ wurde $message verschoben.");
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "ScreenController@move"!');
            return back()->with('flash-error', "Der Screen $screen->name kann wegen eines Fehlers nicht verschoben werden.");
        }
    }
}
