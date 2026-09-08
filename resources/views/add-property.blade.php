<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property — Smart Rent</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- External Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/add_property.css') }}">
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
                        <label for="office"><i class="fa-solid fa-briefcase"></i> Other</label>
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

                    <input type="url" name="map_link" class="form-control"
                        placeholder="Paste Google Maps location link here" value="{{ old('map_link') }}">

                    <small>
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

                {{-- Cover / Main Photo --}}
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

                {{-- Additional Photos --}}
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

        let selectedFiles = [];

        function handleNewImages(event) {
            const newFiles = Array.from(event.target.files);
            newFiles.forEach(file => selectedFiles.push(file));

            updateFileInput();
            renderPreviews();

            event.target.value = '';
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