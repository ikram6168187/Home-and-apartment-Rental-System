<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property — Smart Rent</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Arial, sans-serif; }

body { background: #f4f6f9; min-height: 100vh; }

/* ── TOPBAR ── */
.topbar {
    background: rgb(51,47,46);
    padding: 16px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.topbar .logo {
    color: white;
    font-size: 20px;
    font-weight: 700;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
}
.topbar .back-btn {
    color: white;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
    opacity: 0.85;
    transition: opacity 0.2s;
}
.topbar .back-btn:hover { opacity: 1; }

/* ── PAGE WRAPPER ── */
.page-wrapper {
    max-width: 860px;
    margin: 40px auto;
    padding: 0 20px 60px;
}

.page-title {
    font-size: 26px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 6px;
}
.page-subtitle {
    font-size: 14px;
    color: #888;
    margin-bottom: 30px;
}

/* ── CARD ── */
.form-card {
    background: white;
    border-radius: 16px;
    padding: 32px 36px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.07);
    margin-bottom: 24px;
}

.section-title {
    font-size: 15px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.section-title i { color: rgb(51,47,46); }

/* ── GRID ── */
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; }
.col-full { grid-column: 1 / -1; }

/* ── FORM ELEMENTS ── */
.form-group { display: flex; flex-direction: column; gap: 6px; }

label {
    font-size: 13px;
    font-weight: 600;
    color: #444;
}

input[type="text"],
input[type="number"],
select,
textarea {
    padding: 11px 14px;
    border: 1.5px solid #e0e0e0;
    border-radius: 10px;
    font-size: 14px;
    color: #333;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fafafa;
    width: 100%;
}

input:focus, select:focus, textarea:focus {
    border-color: rgb(51,47,46);
    box-shadow: 0 0 0 3px rgba(51,47,46,0.08);
    background: #fff;
}

textarea { resize: vertical; min-height: 110px; }

select { cursor: pointer; }

/* ── TYPE TOGGLE ── */
.toggle-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.toggle-group input[type="radio"] { display: none; }

.toggle-group label {
    padding: 9px 20px;
    border: 1.5px solid #e0e0e0;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    cursor: pointer;
    transition: all 0.2s;
    background: #fafafa;
}

.toggle-group input[type="radio"]:checked + label {
    background: rgb(51,47,46);
    color: white;
    border-color: rgb(51,47,46);
}

/* ── IMAGE UPLOAD ── */
.upload-area {
    border: 2px dashed #d0d0d0;
    border-radius: 12px;
    padding: 36px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    background: #fafafa;
    position: relative;
}
.upload-area:hover { border-color: rgb(51,47,46); background: #f8f6f5; }
.upload-area input[type="file"] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.upload-area i { font-size: 36px; color: #bbb; margin-bottom: 10px; display: block; }
.upload-area p { font-size: 14px; color: #888; margin: 0; }
.upload-area span { font-size: 12px; color: #bbb; }

#preview-img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 10px;
    margin-top: 12px;
    display: none;
    object-fit: cover;
}

/* ── PRICE INPUT ── */
.price-wrap { position: relative; }
.price-wrap input { padding-left: 40px; }
.price-wrap .currency {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    font-weight: 700;
    color: #888;
}

/* ── SUBMIT BTN ── */
.submit-btn {
    width: 100%;
    padding: 15px;
    background: rgb(51,47,46);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: 0.3px;
}
.submit-btn:hover { background: #1a1a1a; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }

/* ── ERRORS ── */
.error-msg { color: #dc3545; font-size: 12px; margin-top: 2px; }
.alert-error {
    background: #fff0f0;
    border: 1px solid #ffcdd2;
    color: #c0392b;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 20px;
    font-size: 13px;
}

/* ── SUCCESS ── */
.alert-success {
    background: #f0fff4;
    border: 1px solid #b2dfdb;
    color: #1b5e20;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 20px;
    font-size: 13px;
}

@media (max-width: 600px) {
    .grid-2, .grid-3 { grid-template-columns: 1fr; }
    .form-card { padding: 22px 18px; }
    .topbar { padding: 14px 20px; }
}
/* =========================================================
   GOOGLE MAPS LOCATION LINK - FORM GROUP
========================================================= */

.form-group {
    margin-bottom: 22px;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #2d2926;
    margin-bottom: 8px;
}

.form-group label i {
    color: #c8a882;
    font-size: 15px;
}

.form-group .form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e0e0e0;
    border-radius: 10px;
    font-size: 14px;
    color: #333;
    background: #fafafa;
    outline: none;
    transition: 0.2s ease;
    font-family: 'Segoe UI', Arial, sans-serif;
}

.form-group .form-control::placeholder {
    color: #aaa;
}

.form-group .form-control:focus {
    border-color: #2d2926;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(45, 41, 38, 0.08);
}

.form-group .form-control:hover {
    border-color: #c8a882;
}

.form-group small {
    font-size: 12.5px;
    color: #999;
    margin-top: 6px;
    display: block;
    line-height: 1.5;
}

.form-group .text-danger {
    display: block;
    color: #dc3545;
    font-size: 12.5px;
    margin-top: 6px;
    font-weight: 500;
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
    <a href="{{ route('home') }}" class="logo">
        <i class="fa-solid fa-house-chimney"></i>
        Smart Rent
    </a>
    <a href="{{ route('home') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back to Home
    </a>
</div>

<!-- CONTENT -->
<div class="page-wrapper">

    <h1 class="page-title">List Your Property</h1>
    <p class="page-subtitle">Fill in the details below to post your property listing.</p>

    {{-- Errors --}}
    @if($errors->any())
    <div class="alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- Success --}}
    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ── SECTION 1: Basic Info ── --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-circle-info"></i> Basic Information
            </div>

            <div class="grid-2" style="margin-bottom:18px;">

                <div class="form-group col-full">
                    <label>Property Title *</label>
                    <input type="text" name="title" placeholder="e.g. Modern 3-Bedroom Apartment in Gulberg"
                           value="{{ old('title') }}" required>
                    @error('title') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

            </div>

            {{-- Purpose --}}
            <div class="form-group" style="margin-bottom:18px;">
                <label>Purpose *</label>
                <div class="toggle-group">
                    <input type="radio" name="purpose" id="rent" value="rent"
                           {{ old('purpose','rent') == 'rent' ? 'checked' : '' }}>
                    <label for="rent"><i class="fa-solid fa-key"></i> For Rent</label>

                  {{-- <input type="radio" name="purpose" id="sale" value="sale"
                           {{ old('purpose') == 'sale' ? 'checked' : '' }}>
                    <label for="sale"><i class="fa-solid fa-tag"></i> For Sale</label> --}}
                </div>
            </div>  

            {{-- Property Type --}}
            <div class="form-group">
                <label>Property Type *</label>
                <div class="toggle-group">
                    <input type="radio" name="type" id="house" value="house"
                           {{ old('type','house') == 'house' ? 'checked' : '' }}>
                    <label for="house"><i class="fa-solid fa-house"></i> House</label>

                    <input type="radio" name="type" id="apartment" value="apartment"
                           {{ old('type') == 'apartment' ? 'checked' : '' }}>
                    <label for="apartment"><i class="fa-solid fa-building"></i> Apartment</label>

                    <input type="radio" name="type" id="room" value="room"
                           {{ old('type') == 'room' ? 'checked' : '' }}>
                    <label for="room"><i class="fa-solid fa-door-open"></i> Room</label>

                    <input type="radio" name="type" id="shop" value="shop"
                           {{ old('type') == 'shop' ? 'checked' : '' }}>
                    <label for="shop"><i class="fa-solid fa-store"></i> Shop</label>

                    <input type="radio" name="type" id="office" value="office"
                           {{ old('type') == 'office' ? 'checked' : '' }}>
                    <label for="office"><i class="fa-solid fa-briefcase"></i> other</label>
                </div>
                @error('type') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- ── SECTION 2: Location ── --}}
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
                            <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                    @error('city') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Area / Locality *</label>
                    <input type="text" name="location" placeholder="e.g. Gulberg, DHA, Bahria Town"
                           value="{{ old('location') }}" required>
                    @error('location') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Full Address *</label>
                <textarea name="address" placeholder="Street no, house no, near landmark..." required>{{ old('address') }}</textarea>
                @error('address') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
    <label>
        <i class="fa-solid fa-map-location-dot"></i>
        Google Maps Location Link
    </label>

    <input
        type="url"
        name="map_link"
        class="form-control"
        placeholder="Paste Google Maps location link here"
        value="{{ old('map_link') }}"
    >

    <small style="color:#888; display:block; margin-top:6px;">
        Open Google Maps, select your property location, click Share and paste the link here.
    </small>

    @error('map_link')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
        </div>

        {{-- ── SECTION 3: Price & Details ── --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-sliders"></i> Price & Details
            </div>

            <div class="grid-3" style="margin-bottom:18px;">

                <div class="form-group">
                    <label>Price (PKR) *</label>
                    <div class="price-wrap">
                        <span class="currency">₨</span>
                        <input type="number" name="price" placeholder="e.g. 25000"
                               value="{{ old('price') }}" min="1" required>
                    </div>
                    @error('price') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Bedrooms</label>
                    <select name="bedrooms">
                        <option value="0">Studio / 0</option>
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ $i }}" {{ old('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label>Bathrooms</label>
                    <select name="bathrooms">
                        @for($i=1; $i<=10; $i++)
                            <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label>Area (sq ft)</label>
                <input type="number" name="area_sqft" placeholder="e.g. 1200"
                       value="{{ old('area_sqft') }}" min="0">
            </div>
        </div>

        {{-- ── SECTION 4: Description ── --}}
        <div class="form-card">
            <div class="section-title">
                <i class="fa-solid fa-align-left"></i> Description
            </div>

            <div class="form-group">
                <label>Property Description *</label>
                <textarea name="description" rows="5"
                    placeholder="Describe your property — features, nearby places, condition, etc.">{{ old('description') }}</textarea>
                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

       {{-- ── SECTION 5: Photos ── --}}
<div class="form-card">
    <div class="section-title">
        <i class="fa-solid fa-camera"></i> Property Photos
    </div>

    {{-- Cover / Main Photo (sirf 1) --}}
    <div class="form-group" style="margin-bottom:22px;">
        <label>Cover Photo (Main Image) *</label>
        <div class="upload-area" id="uploadArea">
            <input type="file" name="image" id="imageInput" accept="image/*"
                   onchange="previewImage(event)" required>
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <p>Click to upload or drag & drop</p>
            <span>JPG, PNG, WEBP — Max 2MB</span>
        </div>
        <img id="preview-img" src="" alt="Preview">
        @error('image') <span class="error-msg">{{ $message }}</span> @enderror
    </div>

    {{-- Additional Photos (ek line mein) --}}
    <div class="form-group">
        <label>Additional Photos (optional)</label>
        <div class="upload-area">
            <input type="file" id="imagesInput" accept="image/*"
                   multiple onchange="handleNewImages(event)">
            <i class="fa-solid fa-images"></i>
            <p>Click to upload multiple photos</p>
            <span>JPG, PNG, WEBP — Max 2MB each</span>
        </div>

        <input type="file" name="images[]" id="hiddenImagesInput" multiple style="display:none;">

        <div id="preview-multi" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:12px;"></div>
        @error('images.*') <span class="error-msg">{{ $message }}</span> @enderror
    </div>
</div>


            {{-- SUBMIT --}}
        <button type="submit" class="submit-btn">
            <i class="fa-solid fa-paper-plane"></i>
            Post Property Listing
        </button>

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

// ===== Multiple images accumulate karne ka logic (ek line mein sab dikhengi) =====
let selectedFiles = [];

function handleNewImages(event) {
    const newFiles = Array.from(event.target.files);
    newFiles.forEach(file => selectedFiles.push(file));

    updateFileInput();
    renderPreviews();

    event.target.value = ''; // taake dubara same file select ho sake
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
            wrapper.style.cssText = 'position:relative; width:100px;';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:100px; height:90px; object-fit:cover; border-radius:8px;';

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