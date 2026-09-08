<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property — Smart Rent</title>
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/edit_property.css') }}"/>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <a href="{{ route('home') }}" class="logo">
        <i class="fa-solid fa-house-chimney"></i> Smart Rent
    </a>
    <div class="topbar-right">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
        <div class="user-pill">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <span>{{ Auth::user()->name }}</span>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="page-wrapper">

    <h1 class="page-title">Edit Property</h1>
    <p class="page-subtitle">Update your property listing details below.</p>

    @if($errors->any())
    <div class="alert-error">
        <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- SECTION 1: Basic Info --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-circle-info"></i> Basic Information
            </div>

            <div class="form-group col-full mb-18">
                <label>Property Title *</label>
                <input type="text" name="title"
                       value="{{ old('title', $property->title) }}"
                       placeholder="e.g. Modern 3-Bedroom Apartment in Gulberg" required>
                @error('title') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Property Type *</label>
                <div class="toggle-group">
                    @foreach(['house','apartment','room','shop','office'] as $type)
                    <input type="radio" name="type" id="type_{{ $type }}" value="{{ $type }}"
                           {{ old('type', $property->type) == $type ? 'checked' : '' }}>
                    <label for="type_{{ $type }}">
                        @if($type == 'house') <i class="fa-solid fa-house"></i>
                        @elseif($type == 'apartment') <i class="fa-solid fa-building"></i>
                        @elseif($type == 'room') <i class="fa-solid fa-door-open"></i>
                        @elseif($type == 'shop') <i class="fa-solid fa-store"></i>
                        @elseif($type == 'office') <i class="fa-solid fa-briefcase"></i>
                        @endif
                        {{ ucfirst($type) }}
                    </label>
                    @endforeach
                </div>
                @error('type') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- SECTION 2: Location --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-location-dot"></i> Location
            </div>

            <div class="grid-2 mb-18">
                <div class="form-group">
                    <label>City *</label>
                    <select name="city" required>
                        <option value="">Select City</option>
                        @foreach(['Lahore','Karachi','Islamabad','Rawalpindi','Gujranwala','Faisalabad','Peshawar','Quetta','Multan','Sialkot'] as $city)
                            <option value="{{ $city }}"
                                {{ old('city', $property->city) == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('city') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Area / Locality *</label>
                    <input type="text" name="location"
                           value="{{ old('location', $property->location) }}"
                           placeholder="e.g. Gulberg, DHA, Bahria Town" required>
                    @error('location') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Full Address *</label>
                <textarea name="address" required>{{ old('address', $property->address) }}</textarea>
                @error('address') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- SECTION 3: Price & Details --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-sliders"></i> Price & Details
            </div>

            <div class="grid-3 mb-18">
                <div class="form-group">
                    <label>Price (PKR) *</label>
                    <div class="price-wrap">
                        <span class="currency">₨</span>
                        <input type="number" name="price"
                               value="{{ old('price', $property->price) }}"
                               placeholder="e.g. 25000" min="1" required>
                    </div>
                    @error('price') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Bedrooms</label>
                    <select name="bedrooms">
                        <option value="0">Studio / 0</option>
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ $i }}"
                                {{ old('bedrooms', $property->bedrooms) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label>Bathrooms</label>
                    <select name="bathrooms">
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ $i }}"
                                {{ old('bathrooms', $property->bathrooms) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Area (sq ft)</label>
                <input type="number" name="area_sqft"
                       value="{{ old('area_sqft', $property->area_sqft) }}"
                       placeholder="e.g. 1200" min="0">
            </div>
        </div>

        {{-- SECTION 4: Description --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-align-left"></i> Description
            </div>
            <div class="form-group">
                <label>Property Description *</label>
                <textarea name="description" rows="5" required>{{ old('description', $property->description) }}</textarea>
                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- SECTION 5: Photos --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-camera"></i> Property Photos
            </div>

            {{-- Current Cover Image --}}
            @if($property->image)
            <div class="current-img-wrap">
                <img src="{{ asset('storage/' . $property->image) }}" alt="Current Cover Image">
                <p class="current-img-label">Current Cover Image</p>
            </div>
            @endif

            <div class="form-group mb-26">
                <label>Change Cover Photo (optional)</label>
                <div class="upload-area">
                    <input type="file" name="image" id="imageInput"
                           accept="image/*" onchange="previewImage(event)">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Click to upload new cover photo</p>
                    <span>JPG, PNG, WEBP — Max 2MB</span>
                </div>
                <img id="preview-img" src="" alt="Preview">
                @error('image') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Existing Additional Images --}}
            @if($property->images->count() > 0)
            <div class="form-group mb-22">
                <label>Current Additional Photos</label>
                <div id="existing-images-wrap" class="existing-images-wrap">
                    @foreach($property->images as $img)
                    <div class="existing-img-box" id="existing-img-{{ $img->id }}">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Additional Photo">

                        <div class="delete-btn-overlay" onclick="toggleDeleteImage({{ $img->id }})">
                            <i id="trash-icon-{{ $img->id }}" class="fa-solid fa-trash trash-icon"></i>
                        </div>

                        <input type="checkbox" name="delete_images[]" id="checkbox-{{ $img->id }}" value="{{ $img->id }}" class="hidden-element">

                        <div id="marked-label-{{ $img->id }}" class="marked-delete-label">
                            Will be deleted
                        </div>
                    </div>
                    @endforeach
                </div>
                <span class="helper-info">
                    <i class="fa-solid fa-circle-info"></i> Trash icon pe click karein image ko delete ke liye mark karne ke liye (dubara click karein undo ke liye)
                </span>
            </div>
            @endif

            {{-- Add New Additional Images --}}
            <div class="form-group">
                <label>Add New Photos (optional)</label>
                <div class="upload-area">
                    <input type="file" id="imagesInput"
                           accept="image/*" multiple onchange="handleNewImages(event)">
                    <i class="fa-solid fa-images"></i>
                    <p>Click to upload multiple new photos</p>
                    <span>JPG, PNG, WEBP — Max 2MB each</span>
                </div>
                <input type="file" name="images[]" id="hiddenImagesInput" multiple class="hidden-element">
                <div id="preview-multi" class="preview-multi-grid"></div>
                @error('images.*') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- SECTION 6: Status --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-toggle-on"></i> Listing Status
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="toggle-group">
                    <input type="radio" name="status" id="active" value="active"
                           {{ old('status', $property->status) == 'active' ? 'checked' : '' }}>
                    <label for="active"><i class="fa-solid fa-circle-check"></i> Active</label>

                    <input type="radio" name="status" id="inactive" value="inactive"
                           {{ old('status', $property->status) == 'inactive' ? 'checked' : '' }}>
                    <label for="inactive"><i class="fa-solid fa-circle-xmark"></i> Inactive</label>
                </div>
            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="btn-row">
            <a href="{{ route('dashboard') }}" class="cancel-btn">
                <i class="fa-solid fa-xmark"></i> Cancel
            </a>
            <button type="submit" class="submit-btn">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>

    </form>
</div>

<script>
function previewImage(event) {
    var file = event.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = document.getElementById('preview-img');
        img.src = e.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

let selectedFiles = [];

function handleNewImages(event) {
    const newFiles = Array.from(event.target.files);
    newFiles.forEach(file => selectedFiles.push(file));

    updateFileInput();
    renderPreviews();

    event.target.value = '';
}

function toggleDeleteImage(imageId) {
    const checkbox = document.getElementById('checkbox-' + imageId);
    const box = document.getElementById('existing-img-' + imageId);
    const label = document.getElementById('marked-label-' + imageId);
    const icon = document.getElementById('trash-icon-' + imageId);

    checkbox.checked = !checkbox.checked;

    if (checkbox.checked) {
        box.style.opacity = '0.5';
        box.style.filter = 'grayscale(1)';
        label.style.display = 'block';
        icon.classList.remove('fa-trash');
        icon.classList.add('fa-rotate-left');
    } else {
        box.style.opacity = '1';
        box.style.filter = 'none';
        label.style.display = 'none';
        icon.classList.remove('fa-rotate-left');
        icon.classList.add('fa-trash');
    }
}

function removeSelectedFile(index) {
    selectedFiles.splice(index, 1);
    updateFileInput();
    renderPreviews();
}

function updateFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('hiddenImagesInput').files = dataTransfer.files;
}

function renderPreviews() {
    const previewContainer = document.getElementById('preview-multi');
    previewContainer.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const wrapper = document.createElement('div');
            wrapper.style.position = 'relative';
            wrapper.style.width = '100px';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.height = '90px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '8px';

            const removeBtn = document.createElement('div');
            removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            removeBtn.style.cssText = 'position:absolute; top:4px; right:4px; background:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 1px 4px rgba(0,0,0,0.3); font-size:11px; color:#c0392b;';
            removeBtn.onclick = () => removeSelectedFile(index);

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });
}
</script>
</body>
</html>