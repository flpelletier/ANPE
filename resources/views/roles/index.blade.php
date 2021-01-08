@extends('layouts.app')


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Gestion des rôles</h4>
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <div class="col-12 text-right">
                                        @can('role-create')
                                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">{{ __('Ajouter un role') }}</a>
                                        @endcan

                                    </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            {{ __('No') }}
                                        </th>
                                        <th>
                                            {{ __('Nom') }}
                                        </th>

                                        <th class="text-right">
                                            {{ __('Actions') }}
                                        </th>
                                    </thead>

                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>

                                        <td class="td-actions text-right">
                                            @csrf
                                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                            @can('role-edit')
                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('roles.edit',$role->id) }}" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            @endcan

                                            @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-link']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $roles->render() !!}
                                @endsection