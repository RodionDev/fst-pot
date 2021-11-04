<div class="row">
    @foreach($users as $user)
        <div class="col-lg-6">
            <div class="panel panel-default panel--user">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">{!! Avatar::create($user->name)->toSvg() !!}</a>
                        </div>
                        <div class="media-body">
                            <div class="user-status-labels pull-right">
                                {!! $user->is('superadmin') ? '<span class="label label-primary">Superadmin</span>' : '' !!}
                                {!! $user->is('admin') ? '<span class="label label-primary">Admin</span>' : '' !!}
                                {!! $user->is('guest') ? '<span class="label label-danger">Gast</span>' : '' !!}
                            </div>
                            <h2 class="h3">{{$user->name}}</h2>
                            <p>Username: <b>{{$user->username}}</b><br>
                                Rollen:@forelse($user->roles as $role)@if(!$loop->first),@endif <b>{{ ucfirst($role->name) }}</b>@empty <b class="text-danger">Gast, ohne Benutzerrolle</b>@endforelse
                            </p>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>E-Mail</th>
                        <th>Anmeldung</th>
                        <th>ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->formatLocalized('%d.%m.%Y') }}</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    </tbody>
                </table>
                @if(!$user->is('superadmin'))
                    <ul class="list-group">
                        <li class="list-group-item text-right">
                            <form class="inline-form" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger">Löschen</button>
                            </form>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default">Editieren</a>
                        </li>
                    </ul>
                @else
                    <ul class="list-group">
                        <li class="list-group-item text-right">
                            <p class="text-center text-muted text-fit-button-line">Geschützter Benutzer</p>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
{{ $users->links() }}
