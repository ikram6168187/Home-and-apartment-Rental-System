<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Service Requests — Smart Rent Admin</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin_service_requests.css') }}">
</head>

<body>

    {{-- ADMIN SIDEBAR --}}
    @include('admin.admin_sidebar')


    <div class="main">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div class="topbar-title">
                Service Requests
            </div>

            <div class="topbar-right">
                <span class="admin-access-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    Admin Access
                </span>
            </div>

        </div>


        <div class="content">


            {{-- PAGE HEADING --}}
            <div class="page-heading">

                <div class="page-heading-left">

                    <h2>
                        Service Requests
                    </h2>

                    <p>
                        Manage and track all service requests submitted by users.
                    </p>

                </div>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

                <div class="success-alert">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- STATISTICS --}}
            <div class="stats-grid">

                {{-- PENDING --}}
                <div class="stat-card">

                    <div class="stat-icon pending-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <h3>{{ $pending }}</h3>

                    <p>Pending Requests</p>

                </div>


                {{-- IN PROGRESS --}}
                <div class="stat-card">

                    <div class="stat-icon progress-icon">
                        <i class="fa-solid fa-spinner"></i>
                    </div>

                    <h3>{{ $inProgress }}</h3>

                    <p>In Progress</p>

                </div>


                {{-- COMPLETED --}}
                <div class="stat-card">

                    <div class="stat-icon completed-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <h3>{{ $completed }}</h3>

                    <p>Completed Requests</p>

                </div>


                {{-- CANCELLED --}}
                <div class="stat-card">

                    <div class="stat-icon cancelled-icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>

                    <h3>{{ $cancelled }}</h3>

                    <p>Cancelled Requests</p>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="table-card">

                <div class="table-card-header">

                    <h3>
                        All Service Requests
                    </h3>

                    <span>
                        Total: {{ $serviceRequests->count() }} Requests
                    </span>

                </div>


                @if($serviceRequests->count() > 0)

                    <div class="table-responsive">

                        <table>

                            <thead>

                                <tr>

                                    <th>User</th>
                                    <th>Service</th>
                                    <th>Property</th>
                                    <th>Preferred Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                    <th>Action</th>

                                </tr>

                            </thead>


                            <tbody>

                                @php

                                    $serviceNames = [

                                        'home_maintenance' =>
                                            'Home Maintenance',

                                        'property_inspection' =>
                                            'Property Inspection',

                                        'digital_rental_agreement' =>
                                            'Digital Rental Agreement',

                                        'moving_relocation' =>
                                            'Moving & Relocation',

                                        'photography_virtual_tour' =>
                                            'Photography & Virtual Tour',

                                    ];

                                @endphp


                                @foreach($serviceRequests as $request)

                                    <tr>


                                        {{-- USER --}}
                                        <td>

                                            <div class="user-info">

                                                <div class="user-avatar">

                                                    {{ strtoupper(substr($request->user->name ?? 'U', 0, 1)) }}

                                                </div>

                                                <div>

                                                    <strong>
                                                        {{ $request->user->name ?? 'Unknown User' }}
                                                    </strong>

                                                    <small>
                                                        {{ $request->user->email ?? '' }}
                                                    </small>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- SERVICE --}}
                                        <td>

                                            <div class="service-name">

                                                <i class="fa-solid fa-screwdriver-wrench"></i>

                                                {{ $serviceNames[$request->service_type]
                                                    ?? ucfirst(str_replace('_', ' ', $request->service_type)) }}

                                            </div>

                                        </td>


                                        {{-- PROPERTY --}}
                                        <td>

                                            @if($request->property)

                                                {{ $request->property->title ?? 'Property #' . $request->property->id }}

                                            @else

                                                <span style="color:#aaa;">
                                                    Not Selected
                                                </span>

                                            @endif

                                        </td>


                                        {{-- DATE --}}
                                        <td>

                                            @if($request->preferred_date)

                                                {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}

                                            @else

                                                <span style="color:#aaa;">
                                                    Not Specified
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}
                                        <td>

                                            <span class="status-badge status-{{ $request->status }}">

                                                {{ ucwords(str_replace('_', ' ', $request->status)) }}

                                            </span>

                                        </td>


                                        {{-- DETAILS BUTTON --}}
                                        <td>

                                            <button
                                                type="button"
                                                class="details-btn"
                                                onclick="openDetails(
                                                    '{{ addslashes($request->user->name ?? 'Unknown') }}',
                                                    '{{ addslashes($serviceNames[$request->service_type] ?? $request->service_type) }}',
                                                    '{{ addslashes($request->property->title ?? 'Not Selected') }}',
                                                    '{{ $request->preferred_date ? \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') : 'Not Specified' }}',
                                                    '{{ addslashes($request->request_details) }}'
                                                )">

                                                <i class="fa-solid fa-eye"></i>
                                                View

                                            </button>

                                        </td>


                                        {{-- ACTION --}}
                                        <td>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.service-requests.update', $request->id) }}"
                                                class="action-form">

                                                @csrf
                                                @method('PATCH')


                                                <select
                                                    name="status"
                                                    class="status-select">

                                                    <option
                                                        value="pending"
                                                        {{ $request->status == 'pending' ? 'selected' : '' }}>

                                                        Pending

                                                    </option>


                                                    <option
                                                        value="in_progress"
                                                        {{ $request->status == 'in_progress' ? 'selected' : '' }}>

                                                        In Progress

                                                    </option>


                                                    <option
                                                        value="completed"
                                                        {{ $request->status == 'completed' ? 'selected' : '' }}>

                                                        Completed

                                                    </option>


                                                    <option
                                                        value="cancelled"
                                                        {{ $request->status == 'cancelled' ? 'selected' : '' }}>

                                                        Cancelled

                                                    </option>

                                                </select>


                                                <button
                                                    type="submit"
                                                    class="update-btn">

                                                    Update

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else

                    {{-- EMPTY STATE --}}
                    <div class="empty-state">

                        <i class="fa-solid fa-clipboard-list"></i>

                        <h3>
                            No Service Requests Yet
                        </h3>

                        <p>
                            Service requests submitted by users will appear here.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- DETAILS MODAL --}}
    <div class="details-modal" id="detailsModal">

        <div class="details-box">

            <div class="details-header">

                <h3>
                    Service Request Details
                </h3>

                <button
                    class="close-details"
                    onclick="closeDetails()">

                    &times;

                </button>

            </div>


            <div class="details-content">

                <div class="detail-row">

                    <span class="detail-label">
                        User
                    </span>

                    <div
                        class="detail-value"
                        id="detailUser">

                    </div>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Service
                    </span>

                    <div
                        class="detail-value"
                        id="detailService">

                    </div>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Property
                    </span>

                    <div
                        class="detail-value"
                        id="detailProperty">

                    </div>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Preferred Date
                    </span>

                    <div
                        class="detail-value"
                        id="detailDate">

                    </div>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Request Details
                    </span>

                    <div
                        class="detail-value detail-description"
                        id="detailDescription">

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

        function openDetails(
            user,
            service,
            property,
            date,
            description
        ) {

            document.getElementById('detailUser').textContent =
                user;

            document.getElementById('detailService').textContent =
                service;

            document.getElementById('detailProperty').textContent =
                property;

            document.getElementById('detailDate').textContent =
                date;

            document.getElementById('detailDescription').textContent =
                description;

            document
                .getElementById('detailsModal')
                .classList.add('active');

        }


        function closeDetails() {

            document
                .getElementById('detailsModal')
                .classList.remove('active');

        }


        // Close modal when clicking outside

        document
            .getElementById('detailsModal')
            .addEventListener(
                'click',
                function(e) {

                    if (e.target === this) {

                        closeDetails();

                    }

                }
            );


        // Escape key close

        document.addEventListener(
            'keydown',
            function(e) {

                if (e.key === 'Escape') {

                    closeDetails();

                }

            }
        );

    </script>

</body>

</html>