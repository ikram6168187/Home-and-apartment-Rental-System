bash


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Arial, sans-serif; }
body { background:#f4f6f9; min-height:100vh; }

/* TOPBAR */
.topbar {
    background: rgb(51,47,46);
    padding: 16px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.topbar .logo {
    color:white; font-size:20px; font-weight:700;
    text-decoration:none; display:flex; align-items:center; gap:8px;
}
.topbar-right { display:flex; align-items:center; gap:12px; }
.back-btn {
    color:white; text-decoration:none; font-size:13px;
    display:flex; align-items:center; gap:6px;
    background:rgba(255,255,255,0.1);
    padding:8px 16px; border-radius:20px;
    border:1px solid rgba(255,255,255,0.2); transition:0.2s;
}
.back-btn:hover { background:rgba(255,255,255,0.18); }
.user-pill {
    display:flex; align-items:center; gap:8px;
    background:rgba(255,255,255,0.1);
    padding:6px 14px 6px 6px;
    border-radius:30px;
    border:1px solid rgba(255,255,255,0.15);
}
.user-avatar {
    width:30px; height:30px; border-radius:50%;
    background:#c8a882;
    display:flex; align-items:center; justify-content:center;
    font-size:11px; font-weight:700; color:#2d2926;
}
.user-pill span { color:white; font-size:13px; font-weight:500; }

/* PAGE */
.page-wrapper { max-width:860px; margin:40px auto; padding:0 20px 60px; }
.page-title   { font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:6px; }
.page-subtitle{ font-size:14px; color:#888; margin-bottom:30px; }

/* CARD */
.form-card {
    background:white; border-radius:16px;
    padding:32px 36px; box-shadow:0 2px 20px rgba(0,0,0,0.07);
    margin-bottom:24px;
}
.section-title {
    font-size:15px; font-weight:700; color:#1a1a2e;
    margin-bottom:20px; padding-bottom:10px;
    border-bottom:2px solid #f0f0f0;
    display:flex; align-items:center; gap:8px;
}
.section-title i { color:rgb(51,47,46); }

/* GRID */
.grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
.grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:18px; }
.col-full { grid-column:1/-1; }

/* FORM */
.form-group { display:flex; flex-direction:column; gap:6px; }
label { font-size:13px; font-weight:600; color:#444; }
input[type="text"],
input[type="number"],
select,
textarea {
    padding:11px 14px;
    border:1.5px solid #e0e0e0;
    border-radius:10px; font-size:14px;
    color:#333; outline:none;
    transition:border-color 0.2s;
    background:#fafafa; width:100%;
}
input:focus, select:focus, textarea:focus {
    border-color:rgb(51,47,46);
    box-shadow:0 0 0 3px rgba(51,47,46,0.08);
    background:#fff;
}
textarea { resize:vertical; min-height:110px; }

/* TOGGLE */
.toggle-group { display:flex; gap:10px; flex-wrap:wrap; }
.toggle-group input[type="radio"] { display:none; }
.toggle-group label {
    padding:9px 20px;
    border:1.5px solid #e0e0e0;
    border-radius:30px; font-size:13px;
    font-weight:600; color:#666;
    cursor:pointer; transition:all 0.2s;
    background:#fafafa;
}
.toggle-group input[type="radio"]:checked + label {
    background:rgb(51,47,46);
    color:white; border-color:rgb(51,47,46);
}

/* CURRENT IMAGE */
.current-img-wrap {
    position:relative; display:inline-block;
    margin-bottom:12px;
}
.current-img-wrap img {
    width:160px; height:120px;
    object-fit:cover; border-radius:10px;
    border:2px solid #eee;
}
.current-img-label {
    font-size:11px; color:#888;
    margin-top:4px; text-align:center;
}

/* UPLOAD */
.upload-area {
    border:2px dashed #d0d0d0; border-radius:12px;
    padding:28px 20px; text-align:center;
    cursor:pointer; transition:all 0.2s;
    background:#fafafa; position:relative;
}
.upload-area:hover { border-color:rgb(51,47,46); background:#f8f6f5; }
.upload-area input[type="file"] {
    position:absolute; inset:0; opacity:0;
    cursor:pointer; width:100%; height:100%;
}
.upload-area i { font-size:32px; color:#bbb; margin-bottom:8px; display:block; }
.upload-area p { font-size:13px; color:#888; margin:0; }
.upload-area span { font-size:11px; color:#bbb; }
#preview-img {
    max-width:100%; max-height:180px;
    border-radius:10px; margin-top:12px;
    display:none; object-fit:cover;
}

/* PRICE */
.price-wrap { position:relative; }
.price-wrap input { padding-left:40px; }
.price-wrap .currency {
    position:absolute; left:14px; top:50%;
    transform:translateY(-50%);
    font-size:14px; font-weight:700; color:#888;
}

/* BUTTONS */
.btn-row { display:flex; gap:12px; }
.submit-btn {
    flex:1; padding:15px; background:rgb(51,47,46);
    color:white; border:none; border-radius:12px;
    font-size:16px; font-weight:700; cursor:pointer;
    transition:all 0.2s; display:flex;
    align-items:center; justify-content:center; gap:10px;
}
.submit-btn:hover { background:#1a1a1a; transform:translateY(-1px); }
.cancel-btn {
    padding:15px 30px; background:#f5f5f5;
    color:#555; border:1.5px solid #e0e0e0;
    border-radius:12px; font-size:15px;
    font-weight:600; cursor:pointer; transition:0.2s;
    text-decoration:none; display:flex;
    align-items:center; gap:8px;
}
.cancel-btn:hover { background:#eee; }

/* ALERTS */
.error-msg { color:#dc3545; font-size:12px; margin-top:2px; }
.alert-error {
    background:#fff0f0; border:1px solid #ffcdd2;
    color:#c0392b; border-radius:10px;
    padding:14px 18px; margin-bottom:20px; font-size:13px;
}
.alert-success {
    background:#f0fff4; border:1px solid #b2dfdb;
    color:#1b5e20; border-radius:10px;
    padding:14px 18px; margin-bottom:20px; font-size:13px;
}

@media(max-width:600px) {
    .grid-2, .grid-3 { grid-template-columns:1fr; }
    .form-card { padding:22px 18px; }
    .topbar { padding:14px 20px; }
    .btn-row { flex-direction:column; }
}
</style>
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

            <div class="form-group col-full" style="margin-bottom:18px;">
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

            <div class="grid-2" style="margin-bottom:18px;">
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

            <div class="grid-3" style="margin-bottom:18px;">
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

    <div class="form-group" style="margin-bottom:26px;">
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
<div class="form-group" style="margin-bottom:22px;">
    <label>Current Additional Photos</label>
    <div id="existing-images-wrap" style="display:flex; flex-wrap:wrap; gap:12px; margin-top:10px;">
        @foreach($property->images as $img)
        <div class="existing-img-box" id="existing-img-{{ $img->id }}" style="position:relative; width:110px; transition:all 0.2s;">
            <img src="{{ asset('storage/' . $img->image_path) }}"
                 style="width:110px; height:90px; object-fit:cover; border-radius:8px; border:2px solid #eee;">

            <div onclick="toggleDeleteImage({{ $img->id }})"
                 style="position:absolute; top:4px; right:4px; background:#fff; border-radius:50%; width:24px; height:24px; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 1px 4px rgba(0,0,0,0.25);">
                <i id="trash-icon-{{ $img->id }}" class="fa-solid fa-trash" style="font-size:12px; color:#c0392b;"></i>
            </div>

            <input type="checkbox" name="delete_images[]" id="checkbox-{{ $img->id }}" value="{{ $img->id }}" style="display:none;">

            <div id="marked-label-{{ $img->id }}" style="display:none; position:absolute; bottom:0; left:0; right:0; background:rgba(192,57,43,0.9); color:#fff; font-size:10px; text-align:center; padding:3px 0; border-radius:0 0 8px 8px;">
                Will be deleted
            </div>
        </div>
        @endforeach
    </div>
    <span style="font-size:11px; color:#999; margin-top:6px; display:block;">
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
    <input type="file" name="images[]" id="hiddenImagesInput" multiple style="display:none;">
    <div id="preview-multi" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:12px;"></div>
    @error('images.*') <span class="error-msg">{{ $message }}</span> @enderror
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

// ===== Multiple images ko accumulate karne ka logic =====
let selectedFiles = []; // sab selected files yahan jama hongi

function handleNewImages(event) {
    const newFiles = Array.from(event.target.files);

    // nayi files ko purani list mein add karein
    newFiles.forEach(file => selectedFiles.push(file));

    updateFileInput();
    renderPreviews();

    // input ko reset karein taake dubara same file select ho sake
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
        icon.classList.add('fa-rotate-left'); // undo icon
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
    // DataTransfer se ek naya FileList banayein aur hidden input mein daal dein
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