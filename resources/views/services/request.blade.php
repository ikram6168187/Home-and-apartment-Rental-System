<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Service - Smart Rent</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Included Styles --}}
    @include('Modal style')

    {{-- External CSS Link --}}
    <link rel="stylesheet" href="{{ asset('css/services_requests.css') }}">
</head>

<body>

    {{-- NAVBAR --}}
    @include('navbar')

    {{-- MODALS --}}
    @include('login modal')
    @include('signup modal')
    @include('logout modal')

    <div class="request-container">

        <!-- Header -->
        <div class="request-header">
            <div class="small-title">
                Smart Rent Services
            </div>
            <h1>Request a Service</h1>
            <p>
                Fill in the details below and submit your service request.
            </p>
        </div>

        <!-- Form Card -->
        <div class="request-card">

            <!-- Selected Service -->
            <div class="selected-service">
                <i class="fa-solid fa-handshake"></i>
                <div>
                    <h3 id="selectedServiceName">
                        Service Request
                    </h3>
                    <p>
                        You are requesting a Smart Rent service.
                    </p>
                </div>
            </div>

            <form id="serviceRequestForm" action="{{ route('services.store') }}" method="POST">
                @csrf

                <!-- Service Type -->
                <input type="hidden" name="service_type" value="{{ $serviceType }}">

                <!-- Property + Date -->
                <div class="form-row">

                    <div class="form-group">
                        <label>
                            Related Property
                        </label>
                        <select name="property_id" class="form-control">
                            <option value="">
                                Select Property (Optional)
                            </option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}">
                                    {{ $property->title ?? 'Property #' . $property->id }}
                                </option>
                            @endforeach
                        </select>

                        @error('property_id')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            Preferred Date
                        </label>
                        <input type="date" 
                               name="preferred_date" 
                               min="{{ date('Y-m-d') }}" 
                               class="form-control" 
                               value="{{ old('preferred_date') }}">

                        @error('preferred_date')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

                <!-- Request Details -->
                <div class="form-group">
                    <label>
                        Request Details <span>*</span>
                    </label>
                    <textarea id="requestDetailsField" 
                              name="request_details" 
                              class="form-control" 
                              placeholder="Please describe your requirements in detail...">{{ old('request_details') }}</textarea>

                    <span class="error-message" id="requestDetailsClientError" style="display:none;">
                        The request details field is required.
                    </span>

                    @error('request_details')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    Submit Service Request
                </button>

            </form>

            <a href="{{ route('services.index') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Services
            </a>

        </div>

    </div>

    <script>
        const serviceNames = {
            home_maintenance: 'Home Maintenance',
            property_inspection: 'Property Inspection',
            digital_rental_agreement: 'Digital Rental Agreement',
            moving_relocation: 'Moving & Relocation',
            photography_virtual_tour: 'Photography & Virtual Tour'
        };

        const selectedService = "{{ $serviceType }}";

        if (serviceNames[selectedService]) {
            document.getElementById('selectedServiceName').innerText = serviceNames[selectedService];
        }

        // AUTH CHECK BEFORE SUBMIT
        const isUserLoggedIn = @json(auth()->check());
        const serviceForm = document.getElementById('serviceRequestForm');

        serviceForm.addEventListener('submit', function (e) {

            // 1) Agar user login nahi hai -> LOGIN modal open karein
            if (!isUserLoggedIn) {
                e.preventDefault();

                const loginModalEl = document.getElementById('loginModal');

                if (loginModalEl && typeof bootstrap !== 'undefined') {
                    const loginModal = new bootstrap.Modal(loginModalEl);
                    loginModal.show();
                } else if (typeof openLoginModal === 'function') {
                    openLoginModal();
                } else {
                    console.warn('Login modal open karne wala function/ID nahi mila.');
                }

                return;
            }

            // 2) User login hai -> Validation check
            const detailsField = document.getElementById('requestDetailsField');
            const detailsError = document.getElementById('requestDetailsClientError');

            if (detailsField.value.trim() === '') {
                e.preventDefault();
                detailsError.style.display = 'block';
                detailsField.focus();
            } else {
                detailsError.style.display = 'none';
            }
        });
    </script>

    {{-- MODAL SCRIPTS & FOOTER --}}
    @include('Modal scripts')
    @include('footer')

</body>

</html>