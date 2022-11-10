<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}?v={{ rand() }}">

        @livewireStyles
    </head>
    <body>

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

                    <a href="#home" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Inicio</a>
                    <a href="#what-we-offer" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Qué ofrecemos</a>
                    <a href="#price" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Precio</a>
                    <a href="/blog" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Blog</a>
                    {{--<a href="#testimonials" class="text-white ms-sm-4 mb-3 mb-sm-0" onclick="$('header nav').removeClass('view')">Testimonios</a>--}}

                    @if ( Auth::user() )
                        <a href="{{ route('redirects') }}" class="bg-white px-3 py-2 rounded-pill text-dark ms-sm-4 mb-3 mb-sm-0">Panel de control</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-sm-4 mb-3 mb-sm-0 rounded-pill bg-white text-dark py-2 px-4">Registrarse</a>
                        @endif
                        <a href="{{ route('login') }}" class="ms-sm-2 rounded-pill bg-yellow text-white py-2 px-4">Acceder</a>
                    @endif
                </nav>
            </div>
        </header>

        <main>
            <div class="banner">
                <div id="carouselDesktop" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="#price" class="d-none d-sm-block"><img src="{{ asset('img/landing/SLIDER-01.jpg') }}" class="w-100"></a>
                            <a href="#price" class="d-block d-sm-none"><img src="{{ asset('img/landing/SLIDER-MOBILE-1.jpg') }}" class="w-100"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="#price" class="d-none d-sm-block"><img src="{{ asset('img/landing/SLIDER-EMIDICA-02.jpg') }}" class="w-100"></a>
                            <a href="#price" class="d-block d-sm-none"><img src="{{ asset('img/landing/SLIDER-EMIDICA-MOBILE-2.jpg') }}" class="w-100"></a>
                        </div>
                    </div>
                    <button class="carousel-control-prev bg-black rounded-circle p-2 top-50 translate-middle-y w-auto" type="button" data-bs-target="#carouselDesktop" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next bg-black rounded-circle p-2 top-50 translate-middle-y w-auto" type="button" data-bs-target="#carouselDesktop" data-bs-slide="next">
                        <span class="carousel-control-next-icon " aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="bg-light py-2 pt-5">
                <div class="container pt-5">
                    <h2 class="text-center text-uppercase fs-32 after-yelow fw-700">Ventajas de tener <br class="d-md-block d-none"> tu propia tienda online con Emidica</h2>

                    <div class="row text-center py-5 mt-5 my-5 d-md-flex d-none">
                        <div class="col-sm-4 px-5 mt-5 mb-5 mb-sm-0">
                            <div class="bg-white br-10 position-relative pt-5 px-4 pb-4 h-100">
                                <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                    <img src="{{ asset('img/landing/ico-1b.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                </div>

                                <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">DROPSHIPPING:</h5>
                                <p class="fs-14 lh-base text-muted">Recibe pedidos, enviaselos a Emidica <br class="d-md-block d-none">y nosotros te lo enviamos a ti o a tu cliente final.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 px-5 mt-5 mb-5 mb-sm-0">
                            <div class="bg-white br-10 position-relative pt-5 px-4 pb-4 h-100">
                                <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                    <img src="{{ asset('img/landing/ico-2.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                </div>
                                <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">Stock online de <br class="d-md-block d-none"> productos:</h5>
                                <p class="fs-14 lh-base text-muted">Miles de productos <br class="d-md-block d-none"> para ofrecer.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 px-5 mt-5">
                            <div class="bg-white br-10 position-relative pt-5 px-4 pb-4 h-100">
                                <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                    <img src="{{ asset('img/landing/ico-3.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                </div>
                                <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">Un negocio adaptado <br class="d-md-block d-none"> a tus tiempos:</h5>
                                <p class="fs-14 lh-base text-muted">Maneja tu tienda online <br class="d-md-block d-none"> donde y cuando quieras.</p>
                            </div>
                        </div>
                    </div>

                    <div id="carouselVentajas" class="carousel slide d-block d-md-none mt-5 pt-5" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner" style=" overflow: visible;">
                            <div class="carousel-item active">
                                <div class="bg-white br-10 position-relative pt-5 px-3 pb-4 h-100 text-center" style="min-height: 240px;">
                                    <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                        <img src="{{ asset('img/landing/ico-1b.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                    </div>

                                    <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">DROPSHIPPING:</h5>
                                    <p class="fs-14 lh-base text-muted">Recibe pedidos, enviaselos a Emidica <br class="d-md-block d-none">y nosotros te lo enviamos a ti o a tu cliente final.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="bg-white br-10 position-relative pt-5 px-3 pb-4 h-100 text-center" style="min-height: 240px;">
                                    <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                        <img src="{{ asset('img/landing/ico-2.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                    </div>
                                    <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">Stock online de <br class="d-md-block d-none"> productos:</h5>
                                    <p class="fs-14 lh-base text-muted">Miles de productos <br class="d-md-block d-none"> para ofrecer.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="bg-white br-10 position-relative pt-5 px-3 pb-4 h-100 text-center" style="min-height: 240px;">
                                    <div class="position-absolute top-0 start-50 translate-middle ratio ratio-1x1 rounded-circle overflow-hidden bg-black p-4" style="width: 128px;">
                                        <img src="{{ asset('img/landing/ico-3.png') }}" class="top-50 start-50 translate-middle" style="height: 64px; width: 64px;">
                                    </div>
                                    <h5 class="fs-16 fw-700 text-uppercase mb-4 mt-5">Un negocio adaptado <br class="d-md-block d-none"> a tus tiempos:</h5>
                                    <p class="fs-14 lh-base text-muted">Maneja tu tienda online <br class="d-md-block d-none"> donde y cuando quieras.</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-indicators mt-4" style="position: initial;">
                            <button type="button" data-bs-target="#carouselVentajas" data-bs-slide-to="0" class="active mx-2" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselVentajas" data-bs-slide-to="1" class="mx-2" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselVentajas" data-bs-slide-to="2" class="mx-2" aria-label="Slide 3"></button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-dark py-5" id="what-we-offer">
                <div class="container-fluid py-sm-5">
                    <div class="row align-items-center">
                        <div class="col-sm-4 offset-sm-1">
                            <h3 class="fw-700 fs-21 mb-5 text-white text-uppercase">Flexibilidad, Innovación y Satisfacción</h3>
                            <p class="text-white mb-4">¿Estás pensando en abrir una Tienda Online? Emidica te da la posibilidad de tenerla con una suscripción de $3900 por mes</p>
                            <p class="text-white mb-5">Enterate cómo acceder y ofrecer nuestros productos con una tienda online a tu nombre.</p>
                            <a href="#price" class="d-none d-md-inline-block bg-yellow rounded-pill py-2 px-4 fs-18 fw-500 text-dark mb-5 mb-sm-0">Iniciá tu registro</a>
                        </div>
                        <div class="col-sm-5 offset-sm-1">
                            <div class="ratio ratio-16x9">
                                <video controls poster="{{ asset('img/landing/video-sample.jpg') }}">
                                    <source src="{{ asset('Promo_Emidica.mp4') }}" type="video/mp4">
                                </video>
                            </div>

                            <p class="text-center mt-4 mb-0 d-block d-md-none"><a href="#price" class="bg-yellow rounded-pill py-2 px-4 fs-18 fw-500 d-inline-block text-dark">Iniciá tu registro</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pb-5">
                <div id="offer" class="row my-sm-5 pt-5 py-sm-5 align-items-center">
                    <div class="col-sm-5 offset-sm-2">
                        <div class="me-sm-5 pe-sm-5">
                            <h2 class="mb-4 fs-32 fw-700 after-yelow-start mb-5 text-uppercase">Preguntas frecuentes</h2>
                            <div class="accordion mb-4 mb-sm-0" id="accordionExample">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header mb-2" id="headingOne">
                                        <button class="accordion-button fw-700 bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">¿Cómo hacen mis clientes para comprar en mi tienda online?</button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Una vez creada tu tienda vas a poder compartir el link de la misma con quien quieras.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header mb-2" id="headingTwo">
                                        <button class="accordion-button fw-700 bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">¿Cuánto cuesta tener una tienda digital en Emidica?</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Nuestra plataforma trabaja con suscripción mensual dentro de las cuales tienes dos opciones. La misma se renueva todos los meses automáticamente. Puedes darle de baja cuando quieras.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header mb-2" id="headingThree">
                                        <button class="accordion-button fw-700 bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">¿Se puede personalizar mi página?</button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Puedes personalizar varios aspectos de tu tienda para diferenciarte del resto.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header mb-2" id="headingFive">
                                        <button class="accordion-button fw-700 bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Nunca vendí por internet ¿Puedo recibir ayuda?</button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Sí, contamos con un equipo capacitado en E-commerce y atención al público, dispuestos a ayudarte cuando lo necesites. No dudes en enviarnos un mensaje a través de nuestro canales de contacto y te ayudaremos a brevedad.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header mb-2" id="headingFour">
                                        <button class="accordion-button fw-700 bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">¿Tienes dudas?</button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Escribenos al <a href="https://wa.me/5493515738378" class="text-success" target="_blank">+54 9 351 573 8378</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-1 pe-0 d-none d-md-block">
                        <img src="{{ asset('img/landing/img-faq.jpg') }}" class="w-100">
                    </div>
                </div>
            </div>

            <div id="cta" class="bg-black">
                <div class="container py-5 px-4 px-md-3">
                    <div class="row">
                        <div class="col-sm-5">
                            <img src="{{ asset('img/landing/img-start.jpg') }}" class="img-fluid img d-none d-sm-block">
                        </div>
                        <div class="col-sm-7 pt-4 text-white ps-sm-5">
                            <h4 class="text-white fw-700 text-uppercase fs-21">Comienza hoy ¡es muy fácil!</h4>
                            <p class="mb-5">Si necesitas asesoramiento personalizado, puedes usar nuestra asistencia telefónica, whatsapp o correo electrónico.</p>
                            <p class="mb-4">
                                <strong>Contáctanos</strong><br>
                                <a href="https://wa.me/5493515738378" target="_blank" class="rounded-pill mt-2 d-inline-block bg-yellow text-white py-2 ps-3 pe-4"><img src="{{ asset('img/landing/ico-wa.svg') }}" width="21" class="me-2 f-invert" style="margin-top: -2px;"> Whatsapp</a>
                            </p>
                            <p>Email: <a class="text-white" href="mailto:info@emidica.com">info@emidica.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="pt-5 bg-yellow"></div>
                <div class="py-5 bg-light d-none d-md-block"><p>&nbsp;</p></div>
            </div>

            <div id="price" class="py-sm-5">
                <div class="container py-5">
                    <h3 class="fw-700 after-yelow text-center text-uppercase fs-32 mb-5">Precio</h3>

                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="border border-yellow br-10 bg-white p-5 mb-4 mb-sm-0">
                                <h3 class="text-center fs-28 fw-700">Basic</h3>
                                <h2 class="text-center fs-56 fw-700">
                                    <span class="fs-24 position-relative" style="top:-12px">$</span>3900<span class="fs-16 fw-400">/mes</span>
                                </h2>

                                <ul class="list-unstyled mt-4">
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Acceso a miles productos para ofrecer a tus clientes.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Podrás compartirlo con todas las personas que quieras.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Puede cancelar la suscripción cuando desees</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Tienda personalizada y en línea para vender las 24hs.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Métodos de pago en efectivo.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago por transferencia.</del></li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago con tarjetas de crédito y débito.</del></li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago a través de PagoFacil, Rapipago, etc.</del></li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Envío de productos directo a tus clientes.</del></li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Dominio personalizado (ej.: latiendadepaula.com).</del></li>
                                </ul>

                                <div class="text-center mt-5"><a href="{{ route('register') }}" class="bg-yellow rounded-pill py-2 px-4 fs-18 fw-500 d-inline-block text-white">Comenzar ahora</a></div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="border border-yellow br-10 bg-white p-5">
                                <h3 class="text-center fs-28 fw-700">Premium</h3>
                                <h2 class="text-center fs-56 fw-700">
                                    <span class="fs-24 position-relative" style="top:-12px">$</span>6900<span class="fs-16 fw-400">/mes</span>
                                </h2>

                                <ul class="list-unstyled mt-4">
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Acceso a miles productos para ofrecer a tus clientes.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Podrás compartirlo con todas las personas que quieras.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Puede cancelar la suscripción cuando desees</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Tienda personalizada y en línea para vender las 24hs.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Métodos de pago en efectivo.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Método de pago por transferencia.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Método de pago con tarjetas de crédito y débito.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Método de pago a través de PagoFacil, Rapipago, etc.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Envío de productos directo a tus clientes.</li>
                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Dominio personalizado (ej.: latiendadepaula.com).</li>
                                </ul>

                                <div class="text-center mt-5"><a href="{{ route('register') }}" class="bg-yellow rounded-pill py-2 px-4 fs-18 fw-500 d-inline-block text-white">Comenzar ahora</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="container py-5" id="testimonials">
                <h4 class="text-center fw-700 after-yelow text-uppercase mb-5 fs-32">Testimonios</h4>

                <div class="row text-center mt-5 mb-5 pt-5 d-none d-md-flex">
                    <div class="col-sm-4 mb-5 mb-sm-0 pb-5 pb-sm-0">
                        <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                            <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                            <div class="mt-5 pt-4 mb-4">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                            </div>

                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                            <p>Suscriber name</p>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-5 mb-sm-0 pb-5 pb-sm-0">
                        <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                            <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                            <div class="mt-5 pt-4 mb-4">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                            </div>

                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                            <p>Suscriber name</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                            <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                            <div class="mt-5 pt-4 mb-4">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                            </div>

                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                            <p>Suscriber name</p>
                        </div>
                    </div>
                </div>

                <div id="carouselTestimonies" class="carousel slide d-block d-md-none mt-5 pt-5" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner" style=" overflow: visible;">
                        <div class="carousel-item active">
                            <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                                <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                                <div class="mt-5 pt-4 mb-4">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                                </div>

                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                                <p>Suscriber name</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                                <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                                <div class="mt-5 pt-4 mb-4">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                                </div>

                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                                <p>Suscriber name</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="bg-secondary bg-opacity-10 p-4 position-relative h-100 mb-4">
                                <div class="rounded-circle position-absolute border border-yellow border-4 ratio ratio-1x1 top-0 start-50 translate-middle overflow-hidden bg-img" style="background-image: url({{ asset('img/Profile-Photo-Wallpaper.jpeg') }}); width: 124px;"></div>
                                <div class="mt-5 pt-4 mb-4">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star.png') }}" width="30" class="mx-2">
                                    <img src="{{ asset('img/star-w.png') }}" width="30" class="mx-2">
                                </div>

                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                                <p>Suscriber name</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-indicators mt-4" style="position: initial;">
                        <button type="button" data-bs-target="#carouselTestimonies" data-bs-slide-to="0" class="active mx-2" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselTestimonies" data-bs-slide-to="1" class="mx-2" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselTestimonies" data-bs-slide-to="2" class="mx-2" aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>--}}

            <div class="py-5 bg-img text-white" style="background-image: url({{ asset('img/landing/contact-bg.jpg') }});">
                <div class="container py-sm-5">
                    <div class="row px-3 px-sm-2">
                        <div class="col-sm-6">
                            <h3 class="text-uppercase fs-32 fw-700 after-yelow-start mb-5">Contacto</h3>
                            <p class="mb-4 pb-sm-4 pb-0">Envianos un mensaje a través de nuestro formulario y te responderemos a la brevedad.</p>

                            <div class="d-none d-sm-block">
                                <p class="fw-600 mb-4 pb-4">
                                    Teléfono: +54 9 351 573 8378<br>
                                    Correo: <a href="mailto:info@emidica.com" class="text-white">info@emidica.com</a><br>
                                </p>
                                <p class="fw-600 mb-5 mb-sm-0">
                                    Seguinos<br>
                                    <a href="https://www.facebook.com/emidica.joyas" target="_blank"><img src="{{ asset('img/landing/ico-fb.svg') }}" height="16" class="f-invert me-3"></a>
                                    <a href="https://www.instagram.com/emidicashop/" target="_blank"><img src="{{ asset('img/landing/ico-ig.svg') }}" height="16" class="f-invert me-3"></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-black text-dark p-4 p-sm-5 mb-3 mb-sm-0">
                                @livewire('landing.contact-form')
                            </div>

                            <div class="d-block d-sm-none">
                                <p class="fw-600">
                                    Teléfono: +54 9 351 573 8378<br>
                                    Correo: <a href="mailto:info@emidica.com" class="text-white">info@emidica.com</a><br>
                                </p>
                                <p class="fw-600">
                                    Seguinos<br>
                                    <a href="https://www.facebook.com/emidica.joyas" target="_blank"><img src="{{ asset('img/landing/ico-fb.svg') }}" height="16" class="f-invert me-3"></a>
                                    <a href="https://www.instagram.com/emidicashop/" target="_blank"><img src="{{ asset('img/landing/ico-ig.svg') }}" height="16" class="f-invert me-3"></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-yellow text-white text-center py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-10">
                            <div class="d-sm-flex d-block justify-content-between align-items-center">
                                <p class="text-uppercase mb-4 mb-sm-0 fs-24 fw-700 lh-1 m-0">¡Suscribite a nuestra plataforma y comienza a vender hoy!</p>
                                <a href="#price" class="btn bg-black rounded-pill px-4 text-white">Iniciá tu registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-5 bg-dark">
            <div class="container text-white text-center">
                <img src="{{ asset('img/logo.svg') }}" height="70" class="f-brightness mb-3">
                <p class="fs-12 text-white fw-300 m-0">Copyright © {{ date('Y') }} Emidica. Todos los derechos reservados.</p>
            </div>
        </footer>

        <a href="https://wa.me/5493515738378" target="_blank" class="d-block position-fixed bottom-0 end-0 mb-3 me-3"><img src="{{ asset('img/panel/ico-wa-color.svg') }}" width="48" height="48"></a>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        @livewireScripts
    </body>
</html>
