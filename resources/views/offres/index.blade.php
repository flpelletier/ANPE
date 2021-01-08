@extends('layouts.app', ['activePage' => 'Liste des offres', 'titlePage' => __('Liste des offres')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Toutes les offres</h4>
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
                @can('offre-create')
                <a href="{{ route('offres.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter une offre') }}</a>
                @endcan
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                @can('offre-delete')
                <button style="margin-bottom: 10px" class="btn btn-sm btn-primary delete_all" data-url="{{ url('offres-deleteselection') }}">Supprimer la séléction</button>
                @endcan
              </div>
            </div>
              <div class="table-responsive">
                <table class="table" id="table_id">
                  <thead class=" text-primary">
                    <tr>
                    <th>
                      {{ __('Titre') }}
                    </th>
                    <th>
                      {{ __('Description') }}
                    </th>
                    <th>
                      {{ __('Niveau') }}
                    </th>
                    <th>
                      {{ __('PDF') }}
                    </th>
                    <th>
                      {{ __('Date de création') }}
                    </th>
                    <th class="text-right">
                      {{ __('Actions') }}
                    </th>
                    @can('offre-delete')
                    <th width="50px"><input type="checkbox" id="master" >
                    </th>
                    @endcan
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($offre as $offres)
                    <tr>
                      <td>
                        {{ $offres->titre }}
                      </td>
                      <td>

                        {{ \Illuminate\Support\Str::limit($offres->description, 100, $end='...') }}
                        <a rel="tooltip" href="{{ route('offres.show', $offres) }}" data-original-title="" title="">
                          {{ 'Afficher plus' }}
                        </a>

                      </td>
                      <td>
                        {{ $offres->niveau }}
                      </td>
                      <td>
                        <!-- Création d'un lien vers le pdf -->
                        <div class="card shadow">
                          <div class="card-body">
                            <a href="{{ asset($offres->pdf) }}" target="_blank">PDF</a>
                          </div>
                        </div>
                        <!-- -->
                      </td>
                      <td>
                        {{ $offres->created_at }}
                      </td>
                      <td class="td-actions text-right">
                        <form action="{{ route('offres.destroy', $offres) }}" method="post">
                          @csrf
                          @method('delete')
                          @can('offre-edit')
                          <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('offres.edit', $offres) }}" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                          </a>
                          @endcan
                          @can('offre-delete')
                          <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Êtes vous sur de vouloir supprimer cette offre?") }}') ? this.parentElement.submit() : ''">
                            <i class="material-icons">close</i>
                            <div class="ripple-container"></div>
                          </button>
                        </form>
                        @endcan
                      </td>
                      @can('offre-delete')
                      <td>
                        <input type="checkbox" class="sub_chk" data-id="{{$offres->id}}">
                      </td>
                      @endcan
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection