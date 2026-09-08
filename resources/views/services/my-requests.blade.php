<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Service Requests | Smart Rent</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- External CSS Link --}}
    <link rel="stylesheet" href="{{ asset('css/services_my_requests.css') }}">
</head>

<body>

    {{-- ================= HEADER ================= --}}
    @include('Navbar')
    @include('Modal style')
    @include('Modal scripts')
    @include('Logout modal')

    <div class="page-container">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h1>
                <i class="fa-solid fa-clipboard-list"></i>
                My Service Requests
            </h1>

            <p>
                Track and manage all your requested Smart Rent services.
            </p>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- REQUESTS GRID --}}
        @if($requests->count() > 0)

            <div class="requests-grid">

                @foreach($requests as $request)

                    @php
                        $serviceNames = [
                            'home_maintenance' => 'Home Maintenance',
                            'property_inspection' => 'Property Inspection',
                            'digital_rental_agreement' => 'Digital Rental Agreement',
                            'moving_relocation' => 'Moving & Relocation',
                            'photography_virtual_tour' => 'Photography & Virtual Tour',
                        ];
                    @endphp

                    <div class="request-card">

                        {{-- CARD TOP --}}
                        <div class="request-top">
                            <div class="service-title">
                                {{ $serviceNames[$request->service_type] ?? ucfirst(str_replace('_', ' ', $request->service_type)) }}
                            </div>

                            <span class="status status-{{ $request->status }}">
                                {{ str_replace('_', ' ', $request->status) }}
                            </span>
                        </div>

                        {{-- CARD INFO --}}
                        <div class="request-info">

                            {{-- PROPERTY --}}
                            <div class="info-row">
                                <i class="fa-solid fa-house"></i>
                                <span class="info-label">Property:</span>
                                <span class="info-value">
                                    @if($request->property)
                                        {{ $request->property->title ?? 'Property #' . $request->property->id }}
                                    @else
                                        Not Selected
                                    @endif
                                </span>
                            </div>

                            {{-- PREFERRED DATE --}}
                            <div class="info-row">
                                <i class="fa-solid fa-calendar"></i>
                                <span class="info-label">Preferred:</span>
                                <span class="info-value">
                                    @if($request->preferred_date)
                                        {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}
                                    @else
                                        Not Specified
                                    @endif
                                </span>
                            </div>

                            {{-- DETAILS --}}
                            <div class="info-row-block">
                                <div class="info-row-header">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <span class="info-label">Details:</span>
                                </div>
                                <div class="details-box">
                                    {{ $request->request_details }}
                                </div>
                            </div>

                        </div>

                        {{-- CARD FOOTER --}}
                        <div class="request-footer">
                            <span class="request-date">
                                <i class="fa-regular fa-clock"></i>
                                Requested:
                                {{ $request->created_at->format('d M Y, h:i A') }}
                            </span>

                            {{-- CANCEL BUTTON --}}
                            @if($request->status === 'pending')
                                <form method="POST" action="{{ route('services.cancel', $request->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" 
                                            class="cancel-btn"
                                            onclick="return confirm('Are you sure you want to cancel this service request?')">
                                        <i class="fa-solid fa-xmark"></i>
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">
                <i class="fa-solid fa-clipboard-question"></i>
                <h2>No Service Requests Yet</h2>
                <p>
                    You haven't requested any service yet.
                    Explore our services and submit your first request.
                </p>
                <a href="{{ route('services.index') }}" class="browse-btn">
                    <i class="fa-solid fa-arrow-right"></i>
                    Explore Services
                </a>
            </div>

        @endif

    </div>

    @include('footer')
</body>
</html>