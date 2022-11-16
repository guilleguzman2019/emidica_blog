<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ rand() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Document</title>
    @livewireStyles
</head>
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

    @yield('content')

    <footer class="py-5 bg-dark">
        <div class="container text-white text-center">
            <img src="{{ asset('img/logo.svg') }}" height="70" class="f-brightness mb-3">
            <p class="fs-12 text-white fw-300 m-0">Copyright © {{ date('Y') }} Emidica. Todos los derechos reservados.</p>
        </div>
    </footer>
    
</body>

@livewireScripts
<script>
    // Select the carousel you'll need to manipulate and the buttons you'll add events to
const carousel = document.querySelector("[data-target='carousel']");
const card = carousel.querySelector("[data-target='card']");
const leftButton = document.querySelector("[data-action='slideLeft']");
const rightButton = document.querySelector("[data-action='slideRight']");

// Prepare to limit the direction in which the carousel can slide, 
// and to control how much the carousel advances by each time.
// In order to slide the carousel so that only three cards are perfectly visible each time,
// you need to know the carousel width, and the margin placed on a given card in the carousel
const carouselWidth = carousel.offsetWidth;
const cardStyle = card.currentStyle || window.getComputedStyle(card)
const cardMarginRight = Number(cardStyle.marginRight.match(/\d+/g)[0]);

// Count the number of total cards you have
const cardCount = carousel.querySelectorAll("[data-target='card']").length;

// Define an offset property to dynamically update by clicking the button controls
// as well as a maxX property so the carousel knows when to stop at the upper limit
let offset = 0;
const maxX = -((cardCount / 3) * carouselWidth + 
               (cardMarginRight * (cardCount / 3)) - 
               carouselWidth - cardMarginRight);


// Add the click events
leftButton.addEventListener("click", function() {
  if (offset !== 0) {
    offset += carouselWidth + cardMarginRight;
    carousel.style.transform = `translateX(${offset}px)`;
    }
})
  
rightButton.addEventListener("click", function() {
  if (offset !== maxX) {
    offset -= carouselWidth + cardMarginRight;
    carousel.style.transform = `translateX(${offset}px)`;
  }
})
</script>
</html>