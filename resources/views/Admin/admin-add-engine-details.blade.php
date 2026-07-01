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
    @include("components.flash-modal")
    <header>
        <nav>
            <h2>PORSCHE</h2>
            <div class="links">
                <a href="/">Home</a>
                <a href="/admin/dashboard">Dashboard</a>
                <a href="">Users</a>
                <a href="">Profile</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button class="logout-form-button">Logout</button>
                </form>
            </div>
        </nav>
    </header>


    <section>
        <div class="add_model_form">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white p-4" 
                style="background-color:#333333;">
                    <h2 class="mb-0">Add Engine Details</h2>
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

                    <form action="{{ route('admin.add.enginedetails') }}" method="POST" enctype="multipart/form-data" class="add-car-form">
                        @csrf
                        <input type="hidden" value="{{ $car->id }}" name="car_id">
                        <input type="hidden" value="{{ $variant->id }}" name="variant_id">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Position</label>
                                <input type="number" class="form-control" name="position" min="1">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Engine Detail Image</label>
                            <input type="file" class="form-control" name="engine_image">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="5" name="description"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn px-4" type="submit">
                                <span>
                                    <i class="fa-solid fa-square-plus me-2"></i> Add Engine Detail
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @foreach($engineDetails as $x)
        <section>
            <div class="add_model_form">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" style="background-color:#333333;">
                        <h2 class="mb-0">Edit Engine Detail</h2>
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

                        <form action="{{ route('admin.edit.enginedetails') }}" method="POST" enctype="multipart/form-data" class="add-car-form">
                            @csrf

                            <div class="row g-3 mb-4">
                                <input type="hidden" value="{{ $car->id }}" name="car_id">
                                <input type="hidden" value="{{ $variant->id }}" name="variant_id">
                                <input type="hidden" value="{{ $x->id }}" name="engine_detail_id">
                                
                                <div class="col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $x->title }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Position</label>
                                    <input type="number" class="form-control" name="position" min="1" value="{{ $x->position }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Engine Detail Image</label>
                                <input type="file" class="form-control" name="engine_image">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="5" name="description">
                                    {{ $x->description }}
                                </textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn px-4" type="submit">
                                    <span>
                                        <i class="fa-solid fa-square-plus me-2"></i> Edit Engine Detail
                                    </span>
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('admin.delete.enginedetails') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $car->id }}" name="car_id">
                            <input type="hidden" value="{{ $variant->id }}" name="variant_id">
                            <input type="hidden" value="{{ $x->id }}" name="engine_detail_id">
                            <button>Delete Engine Detail</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="{{ asset('javascript/admin.js') }}"></script>
   
</body>

</html>