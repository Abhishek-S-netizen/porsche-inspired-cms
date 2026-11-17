<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORSCHE CMS - Edit Model</title>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body>
    @include("components.flash-modal")

    <header>
        <nav>
            <h2 class="brand-title">PORSCHE</h2>
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

    <main class="admin-main">
        <header class="admin-main-header">
            <div class="header-brand-info">
                <h1>Edit Model &mdash; {{ $car->name }}</h1>
                <span class="title-accent"></span>
                <p class="subtitle">Update chassis overview, ordering index, and thumbnail asset</p>
            </div>
        </header>

        <div class="admin-stack">
            <div class="card form-card shadow-sm border-0">
                <div class="card-header">
                    <h2 class="mb-0">Edit Model</h2>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.editcar') }}" method="POST" enctype="multipart/form-data" class="add-car-form">
                        @csrf
                        <input type="hidden" id="car_id" name="car_id" value="{{ $car->id }}" required>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="model">Model</label>
                                <input type="text" id="model" class="form-control" name="model" value="{{ $car->name }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ordering Index</label>
                                <input type="number" class="form-control" name="ordering_index" min="1" value="{{ $car->order_index }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" name="thumbnail_image">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="5" name="description">{{ $car->description }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-porsche-primary" type="submit">
                                <span>Update Model</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="{{ asset('javascript/admin.js') }}"></script>
</body>

</html>
