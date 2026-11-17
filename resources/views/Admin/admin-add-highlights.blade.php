<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORSCHE CMS - Highlights</title>

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
                <h1>{{ $car->name }} {{ $variant->variant }}</h1>
                <span class="title-accent"></span>
                <p class="subtitle">Manage feature highlights carousel</p>
            </div>
        </header>

        <div class="admin-stack">
            <div class="card form-card shadow-sm border-0">
                <div class="card-header">
                    <h2 class="mb-0">Add Highlight</h2>
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

                    <form action="{{ route('admin.add.highlights') }}" method="POST" enctype="multipart/form-data"
                        class="add-car-form">
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
                            <label class="form-label">Highlight Image</label>
                            <input type="file" class="form-control" name="highlight_image">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" name="description"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-porsche-primary" type="submit">
                                <span>Add Highlight</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach($highlights as $x)
                <div class="card form-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Edit Highlight &mdash; {{ $x->title }}</h2>
                        <form action="{{ route('admin.delete.highlights') }}" method="POST" class="delete-variant-form inline-form">
                            @csrf
                            <input type="hidden" value="{{ $car->id }}" name="car_id">
                            <input type="hidden" value="{{ $variant->id }}" name="variant_id">
                            <input type="hidden" value="{{ $x->id }}" name="highlight_id">
                            <button class="delete-variant-form-button">Delete Highlight</button>
                        </form>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.edit.highlights') }}" method="POST" enctype="multipart/form-data"
                            class="add-car-form">
                            @csrf
                            <input type="hidden" value="{{ $car->id }}" name="car_id">
                            <input type="hidden" value="{{ $variant->id }}" name="variant_id">
                            <input type="hidden" value="{{ $x->id }}" name="highlight_id">

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $x->title }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Position</label>
                                    <input type="number" class="form-control" name="position" min="1"
                                        value="{{ $x->position }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Highlight Image</label>
                                <input type="file" class="form-control" name="highlight_image">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="4" name="description">{{ $x->description }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-porsche-primary" type="submit">
                                    <span>Update Highlight</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="{{ asset('javascript/admin.js') }}"></script>
</body>

</html>
