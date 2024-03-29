<?php
namespace App\Http\Controllers;
use App\Channel;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
class ChannelController extends Controller
{
    public function index()
    {
        try
        {
            $user = auth()->user();
            $channels = $user->channels()->orderBy('name', 'asc')->paginate(6);
            return view('backend.signage.channels.index')
                ->with('channels', $channels);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@index"!');
            return back()->with('flash-error', "Die Channels konnten wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function create()
    {
        try
        {
            return view('backend.signage.channels.create');
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@create"!');
            return back()->with('flash-error', "Das Formular zum Anlegen eines neuen Channels konnte wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'between:3,32',
                Rule::unique('channels')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'description' => 'nullable | string | max:128'
        ]);
        try
        {
            $channel = new Channel();
            $channel->fill($request->all());
            $channel->user()->associate(auth()->user());
            $channel->save();
            return redirect()->route('channels.index')->with('flash-success', "Der neue Channel $channel->name wurde angelegt.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@store"!');
            return back()->with('flash-error', "Der neue Channel konnte wegen eines Fehlers nicht angelegt werden.");
        }
    }
    public function show(Channel $channel)
    {
        return redirect()->route('channels.index');
    }
    public function edit(Channel $channel)
    {
        try {
        return view('backend.signage.channels.edit')
                ->with('channel', $channel);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "ChannelController@edit"!');
            return back()->with('flash-error', "Der Channel $channel->name kann wegen eines Fehlers nicht editiert werden.");
        }
    }
    public function update(Request $request, Channel $channel)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'between:3,32',
                Rule::unique('channels')->ignore($channel)->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'description' => 'nullable | string | max:128',
            'is_public' => 'boolean',
            'display_time' => 'integer | between:500,30000',
            'transition_time' => 'integer | between:50,3000',
            'refresh_time' => 'integer | between:1,300',
            'uses_parallax' => 'boolean'
        ]);
        try
        {
            if($request->missing('web_is_public')) $request->merge(['web_is_public' => 0]);
            if($request->missing('api_is_public')) $request->merge(['api_is_public' => 0]);
            if($request->missing('uses_parallax')) $request->merge(['uses_parallax' => 0]);
            $channel->fill($request->all())->save();
            return redirect()->route('channels.index')->with('flash-success', "Der Channel $channel->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@update"!');
            return back()->with('flash-error', "Der Channel $channel->name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }
    public function destroy(Channel $channel)
    {
        try {
            $channel->delete();
            return redirect()->route('channels.index')->with('flash-success', "Der Channel $channel->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@destroy"!');
            return back()->with('flash-error', "Der Channel $channel->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
}
