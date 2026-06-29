<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

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
            <div class="links">
                <a href="/">Home</a>
                <a href="">Edit</a>
                <a href="">Users</a>
                <a href="">Profile</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button>Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <section>
        <div class="add_variant_form">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white p-4" 
                style="background-color:#333333;">
                    <h2 class="mb-0">Edit Variant</h2>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.editvariant') }}" method="POST" enctype="multipart/form-data" class="add-car-form">
                        @csrf

                        <input name="car_id" type="hidden" value="{{ $car->id }}">
                        <input name="variant_id" type="hidden" value="{{ $variant->id }}">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="variant">Variant</label>
                                <input type="text" id="variant" class="form-control" name="variant" value="{{ $variant->variant }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="year">Year</label>
                                <input type="text" id="year" class="form-control" name="year" placeholder="2025" value="{{ $variant->year }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="fuel_type">Fuel Type</label>
                                <input type="text" id="fuel_type" class="form-control" name="fuel_type" placeholder="Petrol" value="{{ $variant->fuel_type }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="gearbox">Gearbox</label>
                                <input type="text" id="gearbox" class="form-control" name="gearbox" value="{{ $variant->gearbox }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ $variant->title }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="title_content">Title content</label>
                                <textarea type="text" id="title_content" class="form-control" name="title_content" required >
                                    {{ $variant->title_content }}
                                </textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="drive_content">Drive content</label>
                                <textarea type="text" id="drive_content" class="form-control" name="drive_content" required >
                                    {{ $variant->drive_content }}
                                </textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="gallery_content">Gallery content</label>
                                <textarea type="text" id="gallery_content" class="form-control" name="gallery_content" required >
                                    {{ $variant->gallery_content }}
                                </textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ordering Index</label>
                                <input type="number" class="form-control" name="ordering_index" value="{{ $variant->order_index }}" min="1">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Parallax Image</label>
                            <input type="file" class="form-control" name="parallax_image">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Front Profile</label>
                            <input type="file" class="form-control" name="front_profile">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Side Profile</label>
                            <input type="file" class="form-control" name="side_profile">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Drive Parallax</label>
                            <input type="file" class="form-control" name="drive_parallax_image">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Gallery Image 1</label>
                            <input type="file" class="form-control" name="gallery_image_1">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Gallery Image 2</label>
                            <input type="file" class="form-control" name="gallery_image_2">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Gallery Image 3</label>
                            <input type="file" class="form-control" name="gallery_image_3">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn px-4" type="submit">
                                <span>
                                    <i class="fa-solid fa-square-plus me-2"></i> Add Review
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
   
</body>

</html>