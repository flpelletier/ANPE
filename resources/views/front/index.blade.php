@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'les-offres', 'title' => __('Nos offres')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            @can('offre-list')
                           <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Offre(s) disponible(s) :') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table">
                                <thead class=" text-primary">
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
                                </thead>
                                <tbody>
                                    @foreach($offre as $offres)
                                    <tr>
                                        <td>
                                            {{ $offres->titre }}
                                        </td>
                                        <td>
                                       {{ \Illuminate\Support\Str::limit($offres->description, 300, $end='...') }}
                                         <a href="{{ route('offres.show', $offres) }}"?id=description>Afficher plus</a>
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
</div>
@endsection