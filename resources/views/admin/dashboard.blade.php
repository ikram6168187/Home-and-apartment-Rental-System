
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
   <style>
    /* =========================================
   RECENT SERVICE REQUESTS
========================================= */

.recent-services-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 14px;
    overflow: hidden;
    margin-top: 24px;
}

.dashboard-card-header {
    padding: 18px 20px;
    border-bottom: 1px solid #eee;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-card-header h3 {
    margin: 0 0 4px;
    font-size: 15px;
    font-weight: 700;
    color: #1a1209;
}

.dashboard-card-header h3 i {
    color: #8a6040;
    margin-right: 6px;
}

.dashboard-card-header p {
    margin: 0;
    font-size: 11px;
    color: #999;
}

.view-all-btn {
    text-decoration: none;
    font-size: 12px;
    color: #8a6040;
    font-weight: 600;

    display: flex;
    align-items: center;
    gap: 5px;
}

.view-all-btn:hover {
    color: #1a1209;
}


/* TABLE */

.recent-services-table {
    width: 100%;
    border-collapse: collapse;
}

.recent-services-table th {
    background: #fafafa;
    color: #999;

    font-size: 10px;
    text-transform: uppercase;

    padding: 12px 15px;
    text-align: left;

    border-bottom: 1px solid #eee;
}

.recent-services-table td {
    padding: 14px 15px;

    border-bottom: 1px solid #f2f2f2;

    font-size: 12px;
    color: #555;
}

.recent-services-table tr:last-child td {
    border-bottom: none;
}


/* USER */

.service-user {
    display: flex;
    align-items: center;
    gap: 9px;
}

.service-user-avatar {
    width: 32px;
    height: 32px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #c8a882,
        #8a6040
    );

    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 11px;
    font-weight: 700;
}

.service-user strong {
    display: block;
    font-size: 12px;
    color: #1a1209;
}

.service-user small {
    font-size: 10px;
    color: #999;
}


/* SERVICE */

.service-type {
    display: flex;
    align-items: center;
    gap: 6px;

    font-weight: 600;
    color: #444;
}

.service-type i {
    color: #8a6040;
}


/* EMPTY */

.dashboard-empty-state {
    padding: 45px;
    text-align: center;
    color: #999;
}

.dashboard-empty-state i {
    font-size: 35px;
    margin-bottom: 10px;
    color: #ccc;
}

.dashboard-empty-state p {
    font-size: 13px;
}


/* RESPONSIVE */

@media(max-width:768px) {

    .dashboard-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

}
</style>

</head>
<body>

@include('admin.admin_sidebar')

<div class="main">
    <div class="topbar">
        <div class="topbar-title">Dashboard</div>
        <div class="topbar-right">
            <span class="admin-access-badge">
                <i class="fa-solid fa-shield-halved"></i> Admin Access
            </span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- STAT CARDS -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px;">

            <div style="background:#1a1209; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
                <div style="position:absolute; width:80px; height:80px; border-radius:50%; background:rgba(255,255,255,0.04); top:-20px; right:-20px;"></div>
                <i class="fa-solid fa-users" style="font-size:22px; color:rgba(200,168,130,0.6); margin-bottom:12px; display:block;"></i>
                <h2 style="font-size:28px; font-weight:800; color:#fff; margin:0 0 4px;">{{ $totalUsers }}</h2>
                <p style="font-size:12px; color:rgba(255,255,255,0.45); margin:0;">Total Users</p>
                <span style="display:inline-block; margin-top:8px; background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); padding:2px 10px; border-radius:10px; font-size:10px; font-weight:600;">Registered</span>
            </div>

            <div style="background:#c8a882; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
                <div style="position:absolute; width:80px; height:80px; border-radius:50%; background:rgba(0,0,0,0.06); top:-20px; right:-20px;"></div>
                <i class="fa-solid fa-building" style="font-size:22px; color:rgba(26,18,9,0.5); margin-bottom:12px; display:block;"></i>
                <h2 style="font-size:28px; font-weight:800; color:#1a1209; margin:0 0 4px;">{{ $totalProperties }}</h2>
                <p style="font-size:12px; color:rgba(26,18,9,0.55); margin:0;">Total Properties</p>
                <span style="display:inline-block; margin-top:8px; background:rgba(0,0,0,0.1); color:#1a1209; padding:2px 10px; border-radius:10px; font-size:10px; font-weight:600;">Listed</span>
            </div>

            <div style="background:#fff; border:1px solid #eee; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
                <i class="fa-solid fa-calendar-check" style="font-size:22px; color:#1565c0; margin-bottom:12px; display:block; opacity:0.7;"></i>
                <h2 style="font-size:28px; font-weight:800; color:#1a1209; margin:0 0 4px;">{{ $totalBookings }}</h2>
                <p style="font-size:12px; color:#888; margin:0;">Total Bookings</p>
                <span style="display:inline-block; margin-top:8px; background:#fff3e0; color:#e65100; padding:2px 10px; border-radius:10px; font-size:10px; font-weight:600;">{{ $pendingBookings }} Pending</span>
            </div>

            <div style="background:#fff0f0; border:1px solid #ffcdd2; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
                <i class="fa-solid fa-envelope" style="font-size:22px; color:#c0392b; margin-bottom:12px; display:block; opacity:0.7;"></i>
                <h2 style="font-size:28px; font-weight:800; color:#1a1209; margin:0 0 4px;">{{ $unreadMessages ?? 0 }}</h2>
                <p style="font-size:12px; color:#888; margin:0;">New Messages</p>
                <span style="display:inline-block; margin-top:8px; background:#ffcdd2; color:#c0392b; padding:2px 10px; border-radius:10px; font-size:10px; font-weight:600;">Unread</span>
            </div>

<div style="background:#e4f0ea; border:1px solid #c9e4d8; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
    <i class="fa-solid fa-envelope" style="font-size:22px; color:#2e9c6f; margin-bottom:12px; display:block; opacity:0.85;"></i>
    <h2 style="font-size:28px; font-weight:800; color:#1a1209; margin:0 0 4px;">{{ $totalServiceRequests ?? 0 }}</h2>
    <p style="font-size:12px; color:#888; margin:0;">Total Service Requests</p>
    <span style="display:inline-block; margin-top:8px; background:#cdecdd; color:#1e7d53; padding:2px 10px; border-radius:10px; font-size:10px; font-weight:600;">{{ $pendingServiceRequests }} Pending</span>
</div>
        </div>

        <!-- ROW 2 -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">

            <!-- RECENT USERS -->
            <div style="background:#fff; border-radius:14px; padding:20px; border:1px solid #eee;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f5f5f5;">
                    <h3 style="font-size:14px; font-weight:700; color:#1a1209; margin:0; display:flex; align-items:center; gap:7px;">
                        <i class="fa-solid fa-users" style="color:#8a7060;"></i> Recent Users
                    </h3>
                    <a href="{{ route('admin.users') }}" style="font-size:11px; color:#8a7060; border:1px solid #eee; padding:4px 12px; border-radius:20px; text-decoration:none;">View All →</a>
                </div>
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <th style="font-size:10px; font-weight:700; color:#aaa; text-transform:uppercase; padding:6px 8px; text-align:left; border-bottom:1px solid #f0f0f0;">Name</th>
                        <th style="font-size:10px; font-weight:700; color:#aaa; text-transform:uppercase; padding:6px 8px; text-align:left; border-bottom:1px solid #f0f0f0;">Email</th>
                        <th style="font-size:10px; font-weight:700; color:#aaa; text-transform:uppercase; padding:6px 8px; text-align:left; border-bottom:1px solid #f0f0f0;">Properties</th>
                        <th style="font-size:10px; font-weight:700; color:#aaa; text-transform:uppercase; padding:6px 8px; border-bottom:1px solid #f0f0f0;"></th>
                    </tr>
                    @foreach($recentUsers as $user)
                    <tr>
                        <td style="font-size:13px; font-weight:600; color:#1a1209; padding:10px 8px; border-bottom:1px solid #f8f8f8;">{{ $user->name }}</td>
                        <td style="font-size:11px; color:#888; padding:10px 8px; border-bottom:1px solid #f8f8f8;">{{ $user->email }}</td>
                        <td style="padding:10px 8px; border-bottom:1px solid #f8f8f8;">
                            <span style="background:#f5ede0; color:#8a5c30; padding:2px 10px; border-radius:10px; font-size:11px; font-weight:600;">
                                {{ $user->properties_count ?? 0 }}
                            </span>
                        </td>
                        <td style="padding:10px 8px; border-bottom:1px solid #f8f8f8;">
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this user?')"
                                    style="background:#fff0f0; color:#c0392b; border:none; width:26px; height:26px; border-radius:6px; cursor:pointer; font-size:12px;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        
           

            <!-- CITY BREAKDOWN -->
            <div style="background:#fff; border-radius:14px; padding:20px; border:1px solid #eee;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f5f5f5;">
                    <h3 style="font-size:14px; font-weight:700; color:#1a1209; margin:0; display:flex; align-items:center; gap:7px;">
                        <i class="fa-solid fa-map" style="color:#8a7060;"></i> Properties by City
                    </h3>
                </div>
                @php $maxCity = $cityBreakdown->max('total') ?: 1; @endphp
                @foreach($cityBreakdown as $city)
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                    <span style="font-size:12px; font-weight:600; color:#333; width:90px; flex-shrink:0;">{{ $city->city }}</span>
                    <div style="flex:1; height:8px; background:#f0f0f0; border-radius:4px; overflow:hidden;">
                        <div style="height:100%; border-radius:4px; background:linear-gradient(to right,#1a1209,#8a6040); width:{{ ($city->total / $maxCity) * 100 }}%;"></div>
                    </div>
                    <span style="font-size:12px; font-weight:700; color:#1a1209; width:20px; text-align:right;">{{ $city->total }}</span>
                </div>
                @endforeach
            </div>

        </div>

        <!-- ROW 3 -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

            <!-- RECENT BOOKINGS -->
            <div style="background:#fff; border-radius:14px; padding:20px; border:1px solid #eee;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f5f5f5;">
                    <h3 style="font-size:14px; font-weight:700; color:#1a1209; margin:0; display:flex; align-items:center; gap:7px;">
                        <i class="fa-solid fa-calendar" style="color:#8a7060;"></i> Recent Bookings
                    </h3>
                    <a href="{{ route('admin.bookings') }}" style="font-size:11px; color:#8a7060; border:1px solid #eee; padding:4px 12px; border-radius:20px; text-decoration:none;">View All →</a>
                </div>
                @foreach($recentBookings as $booking)
                <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #f8f8f8;">
                    <div style="flex:1;">
                        <p style="font-size:13px; font-weight:600; color:#1a1209; margin:0 0 3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:180px;">{{ $booking->property->title ?? 'N/A' }}</p>
                        <p style="font-size:11px; color:#888; margin:0;">{{ $booking->user->name ?? '' }} · {{ $booking->check_in->format('d M') }} – {{ $booking->check_out->format('d M') }}</p>
                    </div>
                    <span style="font-size:10px; padding:3px 10px; border-radius:20px; font-weight:600;
                        {{ $booking->status == 'confirmed' ? 'background:#e8f5e9; color:#2e7d32;' : ($booking->status == 'pending' ? 'background:#fff3e0; color:#e65100;' : 'background:#fff0f0; color:#c0392b;') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                @endforeach
            </div>

             <div class="dashboard-card recent-services-card">

    <div class="dashboard-card-header">

        <div>
            <h3>
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Recent Service Requests
            </h3>

            <p>
                Latest service requests submitted by users
            </p>
        </div>

        <a href="{{ route('admin.service-requests') }}"
           class="view-all-btn">

            View All
            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>


    @if($recentServiceRequests->count() > 0)

        <div class="table-responsive">

            <table class="recent-services-table">

                <thead>

                    <tr>
                        <th>User</th>
                        <th>Service</th>
                        <th>Property</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>

                </thead>


                <tbody>

                    @foreach($recentServiceRequests as $serviceRequest)

                        <tr>

                            {{-- USER --}}
                            <td>

                                <div class="service-user">

                                    <div class="service-user-avatar">

                                        {{ strtoupper(substr($serviceRequest->user->name ?? 'U', 0, 1)) }}

                                    </div>

                                    <div>

                                        <strong>
                                            {{ $serviceRequest->user->name ?? 'Unknown User' }}
                                        </strong>

                                        <small>
                                            {{ $serviceRequest->user->email ?? '' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- SERVICE --}}
                            <td>

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

                                <span class="service-type">

                                    <i class="fa-solid fa-screwdriver-wrench"></i>

                                    {{ $serviceNames[$serviceRequest->service_type]
                                        ?? ucfirst(str_replace('_', ' ', $serviceRequest->service_type)) }}

                                </span>

                            </td>


                            {{-- PROPERTY --}}
                            <td>

                                @if($serviceRequest->property)

                                    {{ $serviceRequest->property->title
                                        ?? 'Property #' . $serviceRequest->property->id }}

                                @else

                                    <span class="not-selected">
                                        Not Selected
                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}
                            <td>

                                @if($serviceRequest->preferred_date)

                                    {{ \Carbon\Carbon::parse(
                                        $serviceRequest->preferred_date
                                    )->format('d M Y') }}

                                @else

                                    <span class="not-selected">
                                        Not Specified
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td>

                                <span class="status-badge status-{{ $serviceRequest->status }}">

                                    {{ ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $serviceRequest->status
                                        )
                                    ) }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="dashboard-empty-state">

            <i class="fa-solid fa-clipboard-list"></i>

            <p>
                No service requests available yet.
            </p>

        </div>

    @endif

</div>


            <!-- RECENT ACTIVITY -->
            <div style="background:#fff; border-radius:14px; padding:20px; border:1px solid #eee;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f5f5f5;">
                    <h3 style="font-size:14px; font-weight:700; color:#1a1209; margin:0; display:flex; align-items:center; gap:7px;">
                        <i class="fa-solid fa-bolt" style="color:#8a7060;"></i> Recent Activity
                    </h3>
                </div>
                @foreach($recentActivity as $activity)
                @php
                    $colors = ['success'=>['#e8f5e9','#2e7d32','fa-circle-check'], 'info'=>['#e3f2fd','#1565c0','fa-circle-info'], 'warning'=>['#fff3e0','#e65100','fa-triangle-exclamation'], 'danger'=>['#fff0f0','#c0392b','fa-trash']];
                    $c = $colors[$activity->type] ?? $colors['info'];
                @endphp
                <div style="display:flex; align-items:flex-start; gap:10px; padding:9px 0; border-bottom:1px solid #f8f8f8;">
                    <div style="width:32px; height:32px; border-radius:8px; background:{{ $c[0] }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fa-solid {{ $c[2] }}" style="font-size:13px; color:{{ $c[1] }};"></i>
                    </div>
                    <div>
                        <p style="font-size:12px; font-weight:600; color:#1a1209; margin:0 0 2px;">{{ $activity->title }}</p>
                        <p style="font-size:11px; color:#aaa; margin:0;">{{ $activity->user->name ?? '' }} · {{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>


</body>
</html>
