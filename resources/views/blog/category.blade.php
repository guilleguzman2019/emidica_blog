@extends('blog.layout')

@section('content')

<div class="container bg-light mt-5">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            @forelse ($posts as $post)

                <div class="card mb-5 border-0">
                    <span class="position-absolute tm-new-badge">{{$post -> category -> name}}</span>
                    <div class="col ratio ratio-4x3 bg-img me-3 rounded-3 " style="background-image: url('/{{$post -> image}}')"></div>
                    <div class="card-body p-5 entrada">
                        <div class="small text-warning">{{ date_format($post -> created_at,"d/m/Y") }}</div>
                        <h2 class="card-title">{{$post -> title}}</h2>
                        <p class="card-text text-truncate text-acortado">{!!$post -> body!!}</p>
                        <a class="text-black" href="/blog/{{$post -> slug}}">Leer mas →</a>
                    </div>
                </div>
            @empty
                <p>No hay Entradas.</p>
            @endforelse
            <!-- Pagination-->
            @if ( $posts -> hasPages() )
                <div class="d-flex justify-content-center m-5">
                    {{ $posts -> links() }}
                </div>
            @endif
            
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4 border-0">
                <div class="card-body ">
                    <div class="input-group">
                        <livewire:blog.search/>  
                    </div>
                </div>
            </div>
            <!-- latest post widget-->

            

            <!-- Side widget-->
            <div class="card mb-4 border-0">
                <div class="card-body">
                    <img src="{{ asset('img/blogHome/tienda.png') }}" alt="" width="380px" height="400px">
                </div>
            </div>


            
        </div>
    </div>
</div>
    
@endsection
