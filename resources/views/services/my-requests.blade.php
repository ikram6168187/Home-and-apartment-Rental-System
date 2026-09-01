<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Service Requests | Smart Rent</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }

        body {
            background: #f5f5f5;
            color: #222;
        }

        /* ==============================
           PAGE CONTAINER
        ============================== */

        .page-container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        /* ==============================
           PAGE HEADER
        ============================== */

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 38px;
            color: #332f2e;
            margin-bottom: 10px;
        }

        .page-header h1 i {
            margin-right: 10px;
        }

        .page-header p {
            color: #777;
            font-size: 17px;
        }

        /* ==============================
           ALERTS
        ============================== */

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 16px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        /* ==============================
           REQUEST CARD
        ============================== */

        .requests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
            gap: 25px;
        }

        .request-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #eee;
            transition: 0.3s ease;
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .request-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 15px;
        }

        .service-title {
            font-size: 22px;
            font-weight: bold;
            color: #332f2e;
            line-height: 1.3;
        }

        /* ==============================
           STATUS BADGES
        ============================== */

        .status {
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-in_progress {
            background: #cfe2ff;
            color: #084298;
        }

        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }

        /* ==============================
           DETAILS
        ============================== */

        .request-info {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .info-row {
            display: flex;
            gap: 10px;
            margin-bottom: 13px;
            font-size: 15px;
        }

        .info-row i {
            width: 20px;
            color: #555;
            margin-top: 3px;
        }

        .info-label {
            font-weight: bold;
            min-width: 105px;
        }

        .info-value {
            color: #666;
            flex: 1;
        }

        .details-box {
            background: #f8f8f8;
            padding: 12px;
            border-radius: 8px;
            margin-top: 5px;
            line-height: 1.5;
            color: #555;
        }

        /* ==============================
           FOOTER
        ============================== */

        .request-footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .request-date {
            font-size: 13px;
            color: #888;
        }

        /* ==============================
           CANCEL BUTTON
        ============================== */

        .cancel-btn {
            border: none;
            background: #dc3545;
            color: white;
            padding: 9px 16px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .cancel-btn:hover {
            background: #b02a37;
            transform: translateY(-2px);
        }

        /* ==============================
           EMPTY STATE
        ============================== */

        .empty-state {
            text-align: center;
            background: white;
            padding: 70px 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
        }

        .empty-state i {
            font-size: 70px;
            color: #bbb;
            margin-bottom: 20px;
        }

        .empty-state h2 {
            color: #444;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #888;
            margin-bottom: 25px;
        }

        .browse-btn {
            display: inline-block;
            padding: 12px 25px;
            background: #332f2e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .browse-btn:hover {
            background: #555;
            transform: translateY(-2px);
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 600px) {

            .page-container {
                width: 94%;
                margin: 30px auto;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .request-card {
                padding: 18px;
            }

            .request-top {
                flex-direction: column;
            }

            .request-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

    </style>
</head>

<body>

    {{-- ================= HEADER ================= --}}
    @include('Navbar')


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


        {{-- REQUESTS --}}
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


                        <div class="request-info">

                            {{-- PROPERTY --}}
                            <div class="info-row">

                                <i class="fa-solid fa-house"></i>

                                <span class="info-label">
                                    Property:
                                </span>

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

                                <span class="info-label">
                                    Preferred:
                                </span>

                                <span class="info-value">

                                    @if($request->preferred_date)
                                        {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}
                                    @else
                                        Not Specified
                                    @endif

                                </span>

                            </div>


                            {{-- DETAILS --}}
                            <div class="info-row" style="display:block;">

                                <div style="display:flex; gap:10px; margin-bottom:8px;">

                                    <i class="fa-solid fa-file-lines"></i>

                                    <span class="info-label">
                                        Details:
                                    </span>

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

                                <form method="POST"
                                      action="{{ route('services.cancel', $request->id) }}">

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

                <a href="{{ route('services.index') }}"
                   class="browse-btn">

                    <i class="fa-solid fa-arrow-right"></i>
                    Explore Services

                </a>

            </div>

        @endif

    </div>

</body>
</html>