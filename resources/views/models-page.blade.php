<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porsche</title>
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/models.css') }}" rel="stylesheet">

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

    <section class="models-grid">
        <div class="model-card">
            <img src="{{ asset('images/Porsche_911_side.avif') }}" alt="">
            <div class="model-info">
                <h1><strong>911 Carrera</strong></h1>
                <div class="model-specs">
                    <div>
                        <h6>3.9 s</h6>
                        <p>Acceleration</p>
                    </div>
                    <div>
                        <h6>290 kW / 384 PS</h6>
                        <p>Power</p>
                    </div>
                    <div>
                        <h6>294 km/h</h6>
                        <p>Top Speed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer>

    <script src="{{ asset('javascript/home.js') }}"></script>
</body>
</html>