<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porsche</title>
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/variant.css') }}" rel="stylesheet">

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
        <img id="hero-image" class="hero-image" src="{{ $variant->parallax_image_url }}" alt="">
        <div class="hero-content">
            <h1>{{ $variant->title }}</h1>
            <h4>
                {{ $variant->title_content }}
            </h4>
        </div>
    </header>

    <section class="side-profile">
        <div class='side-profile-image-container'>
            <img src="{{ $variant->side_profile_url }}" alt="">
            <h2 class="name">{{ $car->name }}</h2>
        </div>
        <div class="model-variant-name">
            <h1>{{ $car->name }} {{ $variant->variant }}</h1>
        </div>
    </section>

    <section class="specification-section">
        <div class="specification-container">
            <div>
                <h1>3.0 s</h1>
                <h5>0-60 mph</h5>
                <br><br>
                <h1>532 hp</h1>
                <h5>Max. Power Combined</h5>
                <br><br>
                <h1>194 mph</h1>
                <h5>Top track speed</h5>
            </div>
            <img src="{{ $variant->front_profile_url }}" alt="">
        </div>
    </section>

    <section class="gallery-section">
        <div class="gallery-content">
            <h5>
                {{ $variant->gallery_content }}
            </h5>
        </div>
        <div class="gallery-container">
            <img id="gallery-1" src="{{ $variant->gallery_1_url }}" alt="">
            <img id="gallery-2" src="{{ $variant->gallery_2_url }}" alt="">
            <img id="gallery-3" src="{{ $variant->gallery_3_url }}" alt="">
        </div>
    </section>

    <section class="highlights-section">
        <div class="highlights-container">

            @foreach($highlights as $x)
                <div class="highlight-card">
                    <img src="{{ $x->highlight_image_url }}" alt="">
                    <div class="highlight-content">
                        <h2>{{ $x->title }}</h2>
                        <h6>
                            {{ $x->description }}  
                        </h6>
                    </div>
                </div>
            @endforeach
            <!-- <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/highlights_demo.avif') }}" alt="">
                <div class="highlight-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div> -->
        </div>
    </section>

    <section class="drive-parallax-section">
        <section class="drive-parallax-container">
            <img id="drive-parallax-image" class="drive-parallax-image" src="{{ $variant->drive_parallax_url }}" alt="">
        </section>
    </section>

    <!-- <section class="video">
        <video autoplay muted loop playsinline>
            <source src="https://videos.porsche.com/id/e011c44d-7927-4f3f-bbb2-c8c2f59168a4/911carrerasnippetdesktop/hls.m3u8"
                    type="application/x-mpegURL">
        </video>
        <img src="{{ asset('images/demo_image.jpg') }}" alt="">
    </section> -->

    <section class="engine-section">
        <div class="engine-content">
            <h1><strong>Drive</strong></h1>
            <h5>
                {{ $variant->drive_content }}
            </h5>
        </div>

        <div class="drive-container">
            @foreach($engineDetails as $x)
                <div class="drive-card">
                    <img src="{{ $x->engine_image_url }}" alt="">
                    <div class="drive-content">
                        <h2>{{ $x->title }}</h2>
                        <h6>
                            {{ $x->description }}  
                        </h6>
                    </div>
                </div>
            @endforeach
            <!-- <div class="drive-card">
                <img src="{{ asset('images/engine_demo.avif') }}" alt="">
                <div class="drive-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div>
            <div class="drive-card">
                <img src="{{ asset('images/engine_demo_2.avif') }}" alt="">
                <div class="drive-content">
                    <h2>Design</h2>
                    <h6>
                        Clear lines and a muscular rear section create a much sharper character. On the GTS models, the newly designed front Fascia, with striking vertical aerodynamic elements including adaptive air intake flaps, provide an additional distinctive visual feature.  
                    </h6>
                </div>
            </div> -->
        </div>
    </section>

    <section>
        <div>
            
        </div>
    </section>

    <x-footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    <script src="{{ asset('javascript/variant.js') }}"></script>
</body>
</html>