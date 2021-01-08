@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'Nos offres > Détail', 'title' => __('Nos offres')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{ __('Détails de l\'offre ') }}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
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
                  <tr>
                    <td>
                      {{ $offre->titre }}
                    </td>
                    <td>
                      {{ $offre->description }}
                    </td>
                    <td>
                      {{ $offre->niveau }}
                    </td>
                    <td>
                      <!-- Création d'un lien vers le pdf -->
                      <div class="card shadow">
                        <div class="card-body">
                          <a href="{{ asset($offre->pdf) }}" target="_blank">PDF</a>
                        </div>
                      </div>
                    </td>
                  </tr>
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