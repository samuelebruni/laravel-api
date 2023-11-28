@extends('layouts.admin')

@section('content')


    <section class="container my-5">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-muted text-uppercase">All Technologies</h4>
            <a href="{{route('admin.technologies.create')}}" class="btn btn-primary">Create Technology</a>
        </div>

        <div class="my-1">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{session('message')}}</strong> 
            </div>
            @endif
        </div>

        <div class="card">

            <div class="table-responsive-sm">
                <table class="table table-light mb-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">


                        @forelse ($technologies as $technology)
                        <tr class="">
                            <td scope="row">{{$technology->id}}</td>
                    
                            <td class="w-25">{{$technology->name}}</td>
                            <td>{{$technology->slug}}</td>
                            <td>

                        
                                <a href="{{route('admin.technologies.edit', $technology->slug)}}" class="btn btn-secondary">Edit</a>
                                
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$technology->id}}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{$technology->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$technology->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{$technology->id}}">Identificativo progetto: {{$technology->id}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Attenzione! Se procedi eliminando il prodotto non potrai più tornare indietro, confermi?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <!-- Delete form -->
                                                <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection