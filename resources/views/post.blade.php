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
<body class="bg-light ">
    <header class="py-4 bg-img" id="home" style="background-image: url({{ asset('img/landing/header-bg.png') }});">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.svg') }}" height="42"></a>

            <nav class="fs-14">

                <a href="#home" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="#what-we-offer" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="#price" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                <a href="/blog" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')"></a>
                {{--<a href="#testimonials" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Testimonios</a>--}}
            </nav>
        </div>
    </header>
    <!-- Page content-->
    <div class="container mt-5 bg-white p-3 mb-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <div class="text-warning fst-italic mb-2">{{$post -> created_at }}</div>
                        <div class="row">
                            <div class="col-9">
                                <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                            </div>
                            <div class="col-3">
                                <h5><span class="badge bg-warning">{{$post -> category -> name}}</span></h5>
                            </div>
                        </div>
                        <!-- Post meta content-->
                        
                        <!-- Post categories-->
                    </header>
                    <!-- Preview image figure-->
                    <div class="col ratio ratio-4x3 bg-img me-3 rounded-3 " style="background-image: url('/{{$post -> image}}')"></div>
                    <!-- Post content-->
                    <section class="mb-3 p-3">
                        <p class="fs-5 mb-4">{!!$post->body!!}</p>
                    </section>

                    @php
                        $post_tags = [];
                        foreach ($post -> postTags as $pt) {

                            $post_Tags[] = $pt -> tagBlogs -> name;
                        }
                    @endphp


                    <div class="">
                        @foreach ($post_Tags as $tag)
                            
                                <span class="badge bg-warning">{{$tag}}</span>
                            
                        @endforeach
                    </div>
                </article>
                <!-- Comments section-->
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4 mt-5">
                <!-- Search widget-->
                <div class="card mb-4 border-0">
                    <div class="card-body">
                        <div class="input-group">
                            <livewire:blog.search/>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4 border-0">
                    <div class="card-body">
                        <img src="{{ asset('img/blogHome/tienda.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container text-white text-center">
            <img src="{{ asset('img/logo.svg') }}" height="70" class="f-brightness mb-3">
            <p class="fs-12 text-white fw-300 m-0">Copyright © {{ date('Y') }} Emidica. Todos los derechos reservados.</p>
        </div>
    </footer>
    @livewireScripts
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>