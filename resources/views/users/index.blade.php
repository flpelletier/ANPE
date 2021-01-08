@extends('layouts.app', ['activePage' => 'Liste des utilisateurs', 'titlePage' => __('Gestion des utilisateurs')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{ __('Utilisateur') }}</h4>
          </div>
          <div class="card-body">
            @if (session('status'))
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                  </button>
                  <span>{{ session('status') }}</span>
                </div>
              </div>
            </div>
            @endif
            <div class="row">
              <div class="col-12 text-right">
                @can('user-create')
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un utilisateur') }}</a>
                @endcan
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                @can('user-delete')
                <button style="margin-bottom: 10px" class="btn btn-sm btn-primary delete_all" data-url="{{ url('users-deleteselection') }}">Supprimer la séléction</button>
                @endcan
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_id" class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      {{ __('Nom') }}
                    </th>
                    <th>
                      {{ __('Prénom') }}
                    </th>
                    <th>
                      {{ __('Email') }}
                    </th>
                    <th>
                      {{ __('Date de création') }}
                    </th>
                    <th>
                      {{ __('Role') }}
                    </th>
                    <th class="text-right">
                      {{ __('Actions') }}
                    </th>
                    <th width="50px"><input type="checkbox" id="master">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                      {{ $user->name }}
                    </td>
                    <td>
                      {{ $user->surname }}
                    </td>
                    <td>
                      {{ $user->email }}
                    </td>
                    <td>
                      {{ $user->created_at->format('Y-m-d') }}
                    </td>
                    <td>
                      @if(!empty($user->getRoleNames()))
                      @foreach($user->getRoleNames() as $v)
                      <label class="badge badge-success">{{ $v }}</label>
                      @endforeach
                      @endif
                    </td>
                    <td class="td-actions text-right">
                      @if ($user->id != auth()->id())
                      <form action="{{ route('user.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')

                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user) }}" data-original-title="" title="">
                          <i class="material-icons">edit</i>
                          <div class="ripple-container"></div>
                        </a>
                        <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Etes vous sur de vouloir supprimer cet utilisateur?") }}') ? this.parentElement.submit() : ''">
                          <i class="material-icons">close</i>
                          <div class="ripple-container"></div>
                        </button>
                      </form>
                      @else
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      @endif
                    </td>
                    <td>
                      <input type="checkbox" class="sub_chk" data-id="{{$user->id}}">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $users->onEachSide(5)->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection