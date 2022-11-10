<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ rand() }}">
    <title>Document</title>
</head>
<body class='bg-light'>
    <header class="py-4 bg-img" id="home" style="background-image: url({{ asset('img/landing/header-bg.png') }});">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.svg') }}" height="42"></a>

            <button class="bg-transparent border-0 p-0 m-0 d-block d-sm-none" style="width:35px" onclick="$('header nav').toggleClass('view')">
                <span class="d-block mb-1 bg-white" style="height: 2px;"></span>
                <span class="d-block mb-1 bg-white" style="height: 2px;"></span>
                <span class="d-block mb-1 bg-white" style="height: 2px;"></span>
            </button>

            <nav class="fs-14">
                <button class="bg-transparent border-0 p-0 m-0 d-block d-sm-none text-white fs-24 lh-1 mb-5" onclick="$('header nav').toggleClass('view')">&times;</button>

                <a href="#home" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="#what-we-offer" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="#price" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="/blog" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                {{--<a href="#testimonials" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Testimonios</a>--}}
            </nav>
        </div>
    </header>
    <section class="text-white bg-img"  style="background-image: url('https://nebula.org/blog/wp-content/uploads/2020/05/christin-hume-mfB1B1s4sMc-unsplash-scaled.jpg'); padding:200px; background-repeat: no-repeat; background-size: cover;">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Espacio creado para tus dudas.</h1>
            <p class="lead"></p>
        </div>
    </section>
    <div class="bg-light py-2 pt-2 mt-4 mb-5">
        <div class="container mt-5 mb-5">
            
            <div class="row gx-5">
                @foreach ($categories as $category)

                    <div class="col ratio ratio-4x3 bg-img me-3 rounded-3 " style="background-image: url('{{$category -> image}}')">
                        <div class="p-3 text-center pt-5 text-white">{{$category -> name}}</div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <div class="container bg-light">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                @forelse ($posts as $post)

                    <div class="card mb-5 border-0">
                        <span class="position-absolute tm-new-badge">{{$post -> category -> name}}</span>
                        <div class="col ratio ratio-4x3 bg-img me-3 rounded-3 " style="background-image: url('{{$post -> image}}')"></div>
                        <div class="card-body p-5 entrada">
                            <div class="small text-warning">{{ $post -> created_at }}</div>
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
                            <input class="form-control" type="text" placeholder="Buscar..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-warning" id="button-search" type="button" style="display: none;"></button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4 border-0">
                    <div class="card-header border-0 text-warning text-center">CATEGORIAS</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($categories as $category)
                                        <li><a href="">{{$category-> name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4 border-0">
                    <div class="card-header border-0"></div>
                    <div class="card-body">
                        <img src="{{ asset('img/blogHome/tienda.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>