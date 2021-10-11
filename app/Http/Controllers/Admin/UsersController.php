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
            $users = User::verified()->get();
            $unverifiedUsers = User::unverified()->get();
            return view('backend.admin.users.index')
                ->with('users', $users)
                ->with('unverifiedUsers', $unverifiedUsers);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
    }
    public function edit(User $user)
    {
        if($user->is('superadmin')) {
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht editiert werden.');
        }
        $standardRoles = Role::standard();
        return view('backend.admin.users.edit')
            ->with([
                'user' => $user,
                'roles' => $standardRoles
            ]);
    }
    public function update(Request $request, User $user)
    {
        if($user->is('superadmin')) {
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht verändert werden.');
        }
        try {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
    }
    public function destroy(User $user)
    {
        if($user->is('superadmin'))
        {
            return redirect()->route('admin.users.index')->with('flash-error', 'Der Benutzer $user->name ist Superadministrator und kann nicht gelöscht werden.');
        }
        try {
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
    }
}
