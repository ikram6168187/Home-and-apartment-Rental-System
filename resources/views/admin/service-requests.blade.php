<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Service Requests — Smart Rent Admin</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        /* =========================================
           PAGE HEADER
        ========================================= */

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-heading-left h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1209;
            margin: 0 0 5px;
        }

        .page-heading-left p {
            font-size: 13px;
            color: #888;
            margin: 0;
        }


        /* =========================================
           STATISTICS CARDS
        ========================================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(0,0,0,0.03);
            right: -20px;
            top: -20px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .stat-card h3 {
            font-size: 25px;
            font-weight: 800;
            color: #1a1209;
            margin: 0 0 4px;
        }

        .stat-card p {
            font-size: 12px;
            color: #888;
            margin: 0;
        }

        .pending-icon {
            background: #fff3e0;
            color: #e65100;
        }

        .progress-icon {
            background: #e3f2fd;
            color: #1565c0;
        }

        .completed-icon {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .cancelled-icon {
            background: #fff0f0;
            color: #c0392b;
        }


        /* =========================================
           ALERT
        ========================================= */

        .success-alert {
            background: #f0fff4;
            border: 1px solid #b2dfdb;
            color: #1b5e20;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }


        /* =========================================
           TABLE CARD
        ========================================= */

        .table-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            overflow: hidden;
        }

        .table-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card-header h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #1a1209;
        }

        .table-card-header span {
            font-size: 11px;
            color: #888;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #fafafa;
            color: #999;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        table td {
            padding: 14px 15px;
            border-bottom: 1px solid #f2f2f2;
            font-size: 12px;
            color: #555;
            vertical-align: middle;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tbody tr {
            transition: 0.2s;
        }

        table tbody tr:hover {
            background: #fcfcfc;
        }


        /* =========================================
           USER
        ========================================= */

        .user-info {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg,#c8a882,#8a6040);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-info strong {
            display: block;
            color: #1a1209;
            font-size: 12px;
        }

        .user-info small {
            font-size: 10px;
            color: #999;
        }


        /* =========================================
           SERVICE BADGE
        ========================================= */

        .service-name {
            display: flex;
            align-items: center;
            gap: 7px;
            font-weight: 600;
            color: #333;
            white-space: nowrap;
        }

        .service-name i {
            color: #8a6040;
        }


        /* =========================================
           STATUS BADGES
        ========================================= */

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3e0;
            color: #e65100;
        }

        .status-in_progress {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-cancelled {
            background: #fff0f0;
            color: #c0392b;
        }


        /* =========================================
           ACTIONS
        ========================================= */

        .action-form {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .status-select {
            border: 1px solid #ddd;
            padding: 7px 8px;
            border-radius: 7px;
            font-size: 11px;
            outline: none;
            background: #fff;
            cursor: pointer;
        }

        .update-btn {
            border: none;
            background: #1a1209;
            color: #fff;
            padding: 7px 11px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 11px;
            transition: 0.2s;
        }

        .update-btn:hover {
            background: #8a6040;
        }

        .details-btn {
            border: 1px solid #ddd;
            background: #fff;
            color: #555;
            padding: 7px 10px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 11px;
            transition: 0.2s;
        }

        .details-btn:hover {
            background: #f5f5f5;
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .empty-state {
            padding: 70px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 55px;
            color: #ccc;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: #555;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .empty-state p {
            color: #999;
            font-size: 13px;
        }


        /* =========================================
           DETAILS MODAL
        ========================================= */

        .details-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .details-modal.active {
            display: flex;
        }

        .details-box {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .details-header {
            background: #1a1209;
            color: #fff;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .details-header h3 {
            margin: 0;
            font-size: 17px;
        }

        .close-details {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .details-content {
            padding: 22px;
        }

        .detail-row {
            margin-bottom: 15px;
        }

        .detail-label {
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }

        .detail-description {
            background: #f8f8f8;
            padding: 12px;
            border-radius: 8px;
            border-left: 3px solid #c8a882;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width:1000px) {
            .stats-grid {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media(max-width:600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }
        }

    </style>
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