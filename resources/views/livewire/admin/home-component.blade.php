<body class='bg-light'>

    <header class="py-4 bg-img" wire:ignore id="home" style="background-image: url({{ asset('img/landing/header-bg.png') }});">
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
                        <div class="p-3 text-center pt-5 text-white">
                            <a class="text-white" href="{{route('home.category', $category -> slug )}}">{{$category -> name}}</a>
                            
                        </div>
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
                <div class="card widget widget-latest-post  border-0">
                    <div class="widget-title">
                        <h5 class="card-header text-center text-warning bg-white border-0 pb-3">ULTIMOS POST</h5>
                    </div>
                    <div class="widget-body">
                        @foreach ($ultimosPosts as $p)
                            <div class="latest-post-aside media p-3">
                                <div class="lpa-left media-body">
                                    <div class="">
                                        <span><a class="text-black" href="/blog/{{$p -> slug}}">{{ \Illuminate\Support\Str::limit($p->title,30) }}</a></span>
                                    </div>
                                    <div class="lpa-meta">
                                        <a class="name" href="">
                                            
                                        </a>
                                        <a class="date text-warning" href="">
                                            {{date_format($p -> created_at,"d/m/Y") }}
                                        </a>
                                    </div>
                                </div>
                                <div class="lpa-right">
                                    <a href="#">
                                        <img src="{{$p->image}}" title="" alt="" height="90px" width="70px">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4 border-0">
                    <h5 class="card-header text-center text-warning bg-white border-0 p-3">ETIQUETAS</h5>
                    <div class="card-body">
                        @foreach ($tags as $t)

                            <span class="badge bg-warning">
                                <a class="text-white" href="{{route('home.tag', $t -> slug )}}">{{$t->name}}</a>
                            </span>

                        @endforeach
                    </div>
                </div>

                <!-- Side widget-->
                <div class="card mb-4 border-0">
                    <div class="card-body">
                        <img src="{{ asset('img/blogHome/tienda.png') }}" alt="" width="380px" height="400px">
                    </div>
                </div>


                
            </div>
        </div>
    </div>
    <footer class="py-5 bg-dark">
        <div class="container text-white text-center">
            <img src="{{ asset('img/logo.svg') }}" height="70" class="f-brightness mb-3">
            <p class="fs-12 text-white fw-300 m-0">Copyright © {{ date('Y') }} Emidica. Todos los derechos reservados.</p>
        </div>
    </footer>
    
</body>
