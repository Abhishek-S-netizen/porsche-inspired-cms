<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porsche</title>
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Genos:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <h2>PORSCHE</h2>
        </nav>

        <section class='parallax-container'>
            <img id="hero-image" class='parallax' src="{{ asset('images/Porsche_911_GT3_SC.jpg') }}" alt="">
            <div class="title-container">
                <h1 class="title">911 GT3 S/C</h1>
                <a href="">Discover More</a>
            </div>
        </section>
    </header>

    <section class="featured">
        <div class="featured-container">
            <div class='featured-card'>
                <img src="{{ asset('images/demo_1.webp') }}" alt="">
            </div>
            <div class='featured-card'>
                <img src="{{ asset('images/demo_2.jpg') }}" alt="">
            </div>
            <div class='featured-card'>
                <img src="{{ asset('images/demo_3.jpg') }}" alt="">
            </div>
        </div>
    </section>

    <section class="models">
        <div>
            @foreach($cars->chunk(2) as $row)
                <div class="models-container">
                    @foreach($row as $x)
                        <div class="models-card">
                            <img src="{{ $x->thumbnail_image_url }}" alt="Porsche">
                            <h1>{{ $x->name }}</h1>
                            <a href="/models/{{ $x->slug }}">Discover More</a>
                        </div>
                    @endforeach
                </div>
            @endforeach    
        </div>
    </section>

    <x-footer />

    <script src="{{ asset('javascript/home.js') }}"></script>
</body>
</html>