<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORSCHE CMS - Admin Console</title>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    @include("components.flash-modal")

    <header>
        <nav>
            <h2 class="brand-title">PORSCHE</h2>
            <div class="links">
                <a href="/">Home</a>
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
                <h1>Registry Dashboard</h1>
                <span class="title-accent"></span>
                <p class="subtitle">Active models and specifications catalog</p>
            </div>
            <div class="telemetry-bar">
                <div class="telemetry-metric">
                    <span class="metric-label">Active Models</span>
                    <span class="metric-value">{{ count($cars) }}</span>
                </div>
                <div class="telemetry-metric">
                    <span class="metric-label">Total Configurations</span>
                    <span class="metric-value">
                        @php
                            $totalVariants = 0;
                            foreach ($cars as $car) {
                                $totalVariants += $car->variants->count();
                            }
                        @endphp
                        {{ $totalVariants }}
                    </span>
                </div>
            </div>
        </header>

        <div class="admin-stack">
            <!-- Active Registry (Manage Models & Variants) -->
            <div class="card registry-card shadow-sm border-0 mb-5">
                <div class="card-header">
                    <h2 class="mb-0">Active Registry</h2>
                </div>
                <div class="card-body p-0">
                    <div class="edit-garage-container">
                        @foreach($cars as $x)
                            <div class="edit-garage">
                                <div class="model-row">
                                    <div class="model-info">
                                        <a href="{{ route('admin.edit.model', $x->slug) }}" class="model-name-link">
                                            {{ $x->name }}
                                        </a>
                                    </div>
                                    <div class="model-actions">
                                        <form action="{{ route('admin.deletemodel') }}" method="POST"
                                            class="delete-variant-form inline-form">
                                            @csrf
                                            <input type="hidden" value="{{ $x->id }}" name="car_id">
                                            <button class="delete-variant-form-button">Decommission</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="edit-variants">
                                    @if($x->variants->count() == 0)
                                        <div class="empty-variants-message">No variant profiles registered.</div>
                                    @else
                                        @foreach($x->variants as $xVariant)
                                            <div class="variant-row">
                                                <div class="variant-info">
                                                    <span class="variant-name">{{ $xVariant->variant }}</span>
                                                    <span class="variant-meta">{{ $xVariant->year }} &bull;
                                                        {{ $xVariant->fuel_type }}</span>
                                                </div>
                                                <div class="variant-actions">
                                                    <a href="{{ route('admin.edit.variant', [$x->slug, $xVariant->slug]) }}"
                                                        class="btn-tech-outline">
                                                        Edit
                                                    </a>

                                                    <a href="{{ route('admin.specspage', [$x->slug, $xVariant->slug]) }}"
                                                        class="btn-tech-outline">
                                                        Specs
                                                    </a>

                                                    <a href="{{ route('admin.highlightspage', [$x->slug, $xVariant->slug]) }}"
                                                        class="btn-tech-outline">
                                                        Highlights
                                                    </a>
                                                    <a href="{{ route('admin.enginedetailspage', [$x->slug, $xVariant->slug]) }}"
                                                        class="btn-tech-outline">
                                                        Engine
                                                    </a>
                                                    <form action="{{ route('admin.deletevariant') }}" method="POST"
                                                        class="delete-variant-form inline-form">
                                                        @csrf
                                                        <input type="hidden" value="{{ $x->id }}" name="car_id">
                                                        <input type="hidden" value="{{ $xVariant->id }}" name="variant_id">
                                                        <button class="delete-variant-form-button">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Add Model Form -->
            <div class="card form-card shadow-sm border-0 mb-5">
                <div class="card-header">
                    <h2 class="mb-0">Add Model</h2>
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

                    <form action="{{ route('admin.addcar') }}" method="POST" enctype="multipart/form-data"
                        class="add-car-form">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="model">Model</label>
                                <input type="text" id="model" class="form-control" name="model"
                                    placeholder="Eg: 911 or Cayenne" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ordering Index</label>
                                <input type="number" class="form-control" name="ordering_index" min="1" placeholder="1">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" name="thumbnail_image">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" name="intro_text"
                                placeholder="Enter introductory overview..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-porsche-primary" type="submit">
                                <span>Add Model</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Variant Form -->
            <div class="card form-card shadow-sm border-0">
                <div class="card-header">
                    <h2 class="mb-0">Add Variant</h2>
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

                    <form action="{{ route('admin.addvariant') }}" method="POST" enctype="multipart/form-data"
                        class="add-variant-form">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Select Chassis</label>
                            <select name="car_id" class="form-control form-select-styled" required>
                                @foreach($cars as $x)
                                    <option value="{{ $x->id }}">{{ $x->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="variant">Variant</label>
                                <input type="text" id="variant" class="form-control" name="variant"
                                    placeholder="Carrera S or GT3 RS" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="year">Year</label>
                                <input type="text" id="year" class="form-control" name="year" placeholder="2025"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fuel Type</label>
                                <select name="fuel_type" class="form-control form-select-styled" required>
                                    <option value="Gasoline">Gasoline</option>
                                    <option value="Electric">Electric</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="gearbox">Gearbox</label>
                                <input type="text" id="gearbox" class="form-control" name="gearbox" required
                                    placeholder="Eg: 8-speed PDK">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" required
                                    placeholder="Eg: The new 911 Carrera">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ordering Index</label>
                                <input type="number" class="form-control" name="ordering_index" min="1" placeholder="1">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label" for="title_content">Title Content</label>
                                <textarea id="title_content" class="form-control" rows="2" name="title_content" required
                                    placeholder="Details..."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="drive_content">Drive Content</label>
                                <textarea id="drive_content" class="form-control" rows="2" name="drive_content" required
                                    placeholder="Drive characteristics..."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="gallery_content">Gallery Content</label>
                                <textarea id="gallery_content" class="form-control" rows="2" name="gallery_content"
                                    required placeholder="Gallery description..."></textarea>
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
                                <span>Add Variant</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="{{ asset('javascript/admin.js') }}"></script>

    <script>
        // Custom dropdown — wraps each .form-select-styled <select>
        // The native <select> stays hidden but remains the form's submission value.
        (function () {
            function buildDropdown(select) {
                var wrapper = document.createElement('div');
                wrapper.className = 'custom-select-wrapper';

                // Chevron SVG
                var arrowSVG = '<svg class="cs-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';

                // Build trigger
                var trigger = document.createElement('div');
                trigger.className = 'custom-select-trigger';
                var selectedOption = select.options[select.selectedIndex];
                trigger.innerHTML = '<span class="cs-label">' + (selectedOption ? selectedOption.text : '') + '</span>' + arrowSVG;

                // Build options panel
                var optionsPanel = document.createElement('div');
                optionsPanel.className = 'custom-select-options';

                Array.from(select.options).forEach(function (opt, idx) {
                    var div = document.createElement('div');
                    div.className = 'custom-select-option' + (idx === select.selectedIndex ? ' selected' : '');
                    div.textContent = opt.text;
                    div.dataset.value = opt.value;

                    div.addEventListener('click', function () {
                        // Update real select
                        select.value = opt.value;
                        select.dispatchEvent(new Event('change', { bubbles: true }));

                        // Update trigger label
                        trigger.querySelector('.cs-label').textContent = opt.text;

                        // Update selected class
                        optionsPanel.querySelectorAll('.custom-select-option').forEach(function (o) {
                            o.classList.remove('selected');
                        });
                        div.classList.add('selected');

                        // Close
                        wrapper.classList.remove('open');
                    });

                    optionsPanel.appendChild(div);
                });

                // Toggle open/close
                trigger.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var isOpen = wrapper.classList.contains('open');
                    // Close all other open dropdowns
                    document.querySelectorAll('.custom-select-wrapper.open').forEach(function (w) {
                        w.classList.remove('open');
                    });
                    if (!isOpen) wrapper.classList.add('open');
                });

                // Close on outside click
                document.addEventListener('click', function () {
                    wrapper.classList.remove('open');
                });

                // Insert wrapper before the select, move select inside
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