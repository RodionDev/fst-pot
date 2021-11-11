<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UsersController extends Controller
{
    public function index()
    {
        try
        {
            $users = User::verified()->paginate(6);
            return view('backend.admin.users.index')
                ->with('users', $users);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@index"!');
            return redirect()->route('dashboard')->with('flash-error', "Die Benutzer können wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function indexRegistrations()
    {
        try
        {
            $users = User::unverified()->paginate(6);
            return view('backend.admin.users.index_registrations')
                ->with('users', $users);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@indexRegistrations"!');
            return redirect()->route('dashboard')->with('flash-error', "Die Registrierungen (unverifizierte Benutzer) können wegen eines Fehlers nicht angezeigt werden.");
        }
    }
    public function edit(User $user)
    {
        if($user->is('superadmin')) {
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht editiert werden.');
        }
        try
        {
            $standardRolesAvailable = Role::standard()->pluck('name', 'id');
            return view('backend.admin.users.edit')
                ->with([
                    'user' => $user,
                    'rolesAvailable' => $standardRolesAvailable
                ]);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "UsersController@edit"!');
            return redirect()->route('dashboard')->with('flash-error', "Der Benutzer $user->name kann wegen eines Fehlers nicht editiert werden.");
        }
    }
    public function update(Request $request, User $user)
    {
        if($user->is('superadmin')) {
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht verändert werden.');
        }
        $this->validate(
            $request,
            [
            'username' => 'required | alpha_dash | max:32 | unique:users,username,'.$user->id,
            'email' => 'required | string | email | max:128 | unique:users,email,'.$user->id,
            'first_name' => 'required | string | max:128',
            'last_name' => 'required | string | max:128'
            ]
        );
        try
        {
            $user->roles()->sync($request->roles);
            $user->fill($request->all())->save();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@update"!');
            return redirect()->route('admin.users.index')->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }
    public function destroy(User $user)
    {
        if($user->is('superadmin'))
        {
            return redirect()->route('admin.users.index')->with('flash-error', 'Der Benutzer $user->name ist Superadministrator und kann nicht gelöscht werden.');
        }
        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@destroy"!');
            return redirect()->route('admin.users.index')->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
}
