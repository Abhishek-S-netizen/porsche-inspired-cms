<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORSCHE CMS - Edit Variant</title>

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
                <p class="subtitle">Edit variant configuration, copy, and media assets</p>
            </div>
        </header>

        <div class="admin-stack">
            <div class="card form-card shadow-sm border-0">
                <div class="card-header">
                    <h2 class="mb-0">Edit Variant</h2>
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
                                <label class="form-label">Fuel Type</label>
                                <select name="fuel_type" class="form-control form-select-styled" required>
                                    <option value="Gasoline" {{ $variant->fuel_type === 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                                    <option value="Electric" {{ $variant->fuel_type === 'Electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="Hybrid" {{ $variant->fuel_type === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
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
                                <label class="form-label">Ordering Index</label>
                                <input type="number" class="form-control" name="ordering_index" value="{{ $variant->order_index }}" min="1">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label" for="title_content">Title Content</label>
                                <textarea id="title_content" class="form-control" rows="2" name="title_content" required>{{ $variant->title_content }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="drive_content">Drive Content</label>
                                <textarea id="drive_content" class="form-control" rows="2" name="drive_content" required>{{ $variant->drive_content }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="gallery_content">Gallery Content</label>
                                <textarea id="gallery_content" class="form-control" rows="2" name="gallery_content" required>{{ $variant->gallery_content }}</textarea>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Parallax Image</label>
                                <input type="file" class="form-control" name="parallax_image">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Front Profile</label>
                                <input type="file" class="form-control" name="front_profile">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Side Profile</label>
                                <input type="file" class="form-control" name="side_profile">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Drive Parallax</label>
                                <input type="file" class="form-control" name="drive_parallax_image">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gallery Image 1</label>
                                <input type="file" class="form-control" name="gallery_image_1">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gallery Image 2</label>
                                <input type="file" class="form-control" name="gallery_image_2">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gallery Image 3</label>
                                <input type="file" class="form-control" name="gallery_image_3">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-porsche-primary" type="submit">
                                <span>Update Variant</span>
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

    <script>
        (function () {
            function buildDropdown(select) {
                var wrapper = document.createElement('div');
                wrapper.className = 'custom-select-wrapper';

                var arrowSVG = '<svg class="cs-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';

                var trigger = document.createElement('div');
                trigger.className = 'custom-select-trigger';
                var selectedOption = select.options[select.selectedIndex];
                trigger.innerHTML = '<span class="cs-label">' + (selectedOption ? selectedOption.text : '') + '</span>' + arrowSVG;

                var optionsPanel = document.createElement('div');
                optionsPanel.className = 'custom-select-options';

                Array.from(select.options).forEach(function (opt, idx) {
                    var div = document.createElement('div');
                    div.className = 'custom-select-option' + (idx === select.selectedIndex ? ' selected' : '');
                    div.textContent = opt.text;
                    div.dataset.value = opt.value;

                    div.addEventListener('click', function () {
                        select.value = opt.value;
                        select.dispatchEvent(new Event('change', { bubbles: true }));
                        trigger.querySelector('.cs-label').textContent = opt.text;
                        optionsPanel.querySelectorAll('.custom-select-option').forEach(function (o) {
                            o.classList.remove('selected');
                        });
                        div.classList.add('selected');
                        wrapper.classList.remove('open');
                    });

                    optionsPanel.appendChild(div);
                });

                trigger.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var isOpen = wrapper.classList.contains('open');
                    document.querySelectorAll('.custom-select-wrapper.open').forEach(function (w) {
                        w.classList.remove('open');
                    });
                    if (!isOpen) wrapper.classList.add('open');
                });

                document.addEventListener('click', function () {
                    wrapper.classList.remove('open');
                });

                select.parentNode.insertBefore(wrapper, select);
                wrapper.appendChild(select);
                wrapper.appendChild(trigger);
                wrapper.appendChild(optionsPanel);
            }

            document.querySelectorAll('select.form-select-styled').forEach(buildDropdown);
        })();
    </script>
</body>

</html>
