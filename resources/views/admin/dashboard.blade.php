@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
@endpush

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
        <div class="stat-cards-row">

            <div class="stat-card-dark">
                <div class="stat-card-circle-light"></div>
                <i class="fa-solid fa-users stat-icon-dark"></i>
                <h2 class="stat-value-dark">{{ $totalUsers }}</h2>
                <p class="stat-label-dark">Total Users</p>
                <span class="stat-badge-dark">Registered</span>
            </div>
               
            <div class="stat-card-gold">
                <div class="stat-card-circle-dark"></div>
                <i class="fa-solid fa-building stat-icon-gold"></i>
                <h2 class="stat-value-gold">{{ $totalProperties }}</h2>
                <p class="stat-label-gold">Total Properties</p>
                <span class="stat-badge-gold">Listed</span>
            </div>

            <div class="stat-card-light">
                <i class="fa-solid fa-calendar-check stat-icon-blue"></i>
                <h2 class="stat-value-light">{{ $totalBookings }}</h2>
                <p class="stat-label-light">Total Bookings</p>
                <span class="stat-badge-orange">{{ $pendingBookings }} Pending</span>
            </div>

            <div class="stat-card-red">
                <i class="fa-solid fa-envelope stat-icon-red"></i>
                <h2 class="stat-value-light">{{ $unreadMessages ?? 0 }}</h2>
                <p class="stat-label-light">New Messages</p>
                <span class="stat-badge-red">Unread</span>
            </div>

            <div class="stat-card-green">
                <i class="fa-solid fa-envelope stat-icon-green"></i>
                <h2 class="stat-value-light">{{ $totalServiceRequests ?? 0 }}</h2>
                <p class="stat-label-light">Total Service Requests</p>
                <span class="stat-badge-green">{{ $pendingServiceRequests }} Pending</span>
            </div>

            <div class="stat-card-blue">
                <i class="fa-solid fa-money-bill-wave stat-icon-payment"></i>
                <h2 class="stat-value-light">{{ $totalPayments ?? 0 }}</h2>
                <p class="stat-label-light">Total Payments</p>
                <span class="stat-badge-blue">{{ $pendingPayments ?? 0 }} Pending</span>
            </div>

            <div class="stat-card-purple">
                <i class="fa-solid fa-blog stat-icon-purple"></i>
                <h2 class="stat-value-light">{{ $totalBlogs ?? 0 }}</h2>
                <p class="stat-label-light">Total Blogs</p>
                <span class="stat-badge-purple">{{ $draftBlogs ?? 0 }} Draft</span>
            </div>

                    <div class="stat-card-dark">
                <div class="stat-card-circle-light"></div>
                <i class="fa-solid fa-user-shield stat-icon-dark"></i>
                <h2 class="stat-value-dark">{{ $totalAdmins ?? 0 }}</h2>
                <p class="stat-label-dark">Total Admins</p>
                <span class="stat-badge-dark">Super Admin</span>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="dashboard-row-2">

            <!-- RECENT USERS -->
            <div class="dashboard-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-users icon-brand"></i> Recent Users
                    </h3>
                    <a href="{{ route('admin.users') }}" class="panel-view-all">View All →</a>
                </div>
                <table class="panel-table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Properties</th>
                        <th></th>
                    </tr>
                    @foreach($recentUsers as $user)
                    <tr>
                        <td class="td-strong">{{ $user->name }}</td>
                        <td class="td-muted">{{ $user->email }}</td>
                        <td>
                            <span class="count-badge">
                                {{ $user->properties_count ?? 0 }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-form">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this user?')" class="btn-delete-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <!-- CITY BREAKDOWN -->
            <div class="dashboard-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-map icon-brand"></i> Properties by City
                    </h3>
                </div>
                @php $maxCity = $cityBreakdown->max('total') ?: 1; @endphp
                @foreach($cityBreakdown as $city)
                <div class="city-row">
                    <span class="city-name">{{ $city->city }}</span>
                    <div class="city-bar-track">
                        <div class="city-bar-fill" style="width:{{ ($city->total / $maxCity) * 100 }}%;"></div>
                    </div>
                    <span class="city-count">{{ $city->total }}</span>
                </div>
                @endforeach
            </div>

        </div>

        <!-- ROW 3 -->
        <div class="dashboard-row-3">

            <!-- RECENT BOOKINGS -->
            <div class="dashboard-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-calendar icon-brand"></i> Recent Bookings
                    </h3>
                    <a href="{{ route('admin.bookings') }}" class="panel-view-all">View All →</a>
                </div>
                @foreach($recentBookings as $booking)
                <div class="booking-row">
                    <div class="booking-row-info">
                        <p class="booking-row-title">{{ $booking->property->title ?? 'N/A' }}</p>
                        <p class="booking-row-sub">{{ $booking->user->name ?? '' }} · {{ $booking->check_in->format('d M') }} – {{ $booking->check_out->format('d M') }}</p>
                    </div>
                    <span class="booking-status-badge"
                        style="{{ $booking->status == 'confirmed' ? 'background:#e8f5e9; color:#2e7d32;' : ($booking->status == 'pending' ? 'background:#fff3e0; color:#e65100;' : 'background:#fff0f0; color:#c0392b;') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- RECENT SERVICE REQUESTS -->
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
            <!-- /RECENT SERVICE REQUESTS -->

        </div>
        <!-- /ROW 3 -->

        <!-- ROW 4: RECENT PAYMENTS + RECENT BLOGS -->
        <div class="dashboard-row-3">

            <!-- RECENT PAYMENTS -->
            <div class="dashboard-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-money-bill-wave icon-brand"></i> Recent Payments
                    </h3>
                    <a href="{{ route('admin.admin.payments') }}" class="panel-view-all">View All →</a>
                </div>

                @forelse($recentPayments as $payment)
                <div class="booking-row">
                    <div class="booking-row-info">
                        <p class="booking-row-title">
                            {{ $payment->user->name ?? 'N/A' }} — Rs. {{ number_format($payment->amount, 0) }}
                        </p>
                        <p class="booking-row-sub">
                            {{ $payment->booking->property->title ?? 'N/A' }} · {{ ucfirst($payment->payment_method) }}
                        </p>
                    </div>
                    <span class="booking-status-badge"
                        style="{{ $payment->status == 'verified' ? 'background:#e8f5e9; color:#2e7d32;' : ($payment->status == 'submitted' ? 'background:#fff3e0; color:#e65100;' : 'background:#fff0f0; color:#c0392b;') }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                @empty
                <div class="dashboard-empty-state">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <p>No payments yet.</p>
                </div>
                @endforelse
            </div>

            <!-- RECENT BLOGS -->
            <div class="dashboard-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-blog icon-brand"></i> Recent Blogs
                    </h3>
                    <a href="{{ route('admin.blogs') }}" class="panel-view-all">View All →</a>
                </div>

                @forelse($recentBlogs as $blog)
                <div class="booking-row">
                    <div class="booking-row-info">
                        <p class="booking-row-title">{{ \Illuminate\Support\Str::limit($blog->title, 35) }}</p>
                        <p class="booking-row-sub">
                            {{ $blog->category }} · {{ $blog->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <span class="booking-status-badge"
                        style="{{ $blog->status == 'published' ? 'background:#e8f5e9; color:#2e7d32;' : 'background:#fff3e0; color:#e65100;' }}">
                        {{ ucfirst($blog->status) }}
                    </span>
                </div>
                @empty
                <div class="dashboard-empty-state">
                    <i class="fa-solid fa-blog"></i>
                    <p>No blogs yet.</p>
                </div>
                @endforelse
            </div>

        </div>
        <!-- /ROW 4 -->

        <!-- ROW 5: RECENT ACTIVITY (full width) -->
        <div class="dashboard-row-3">

            <div class="dashboard-panel" style="grid-column: 1 / -1;">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="fa-solid fa-bolt icon-brand"></i> Recent Activity
                    </h3>
                </div>
                @foreach($recentActivity as $activity)
                @php
                    $colors = ['success'=>['#e8f5e9','#2e7d32','fa-circle-check'], 'info'=>['#e3f2fd','#1565c0','fa-circle-info'], 'warning'=>['#fff3e0','#e65100','fa-triangle-exclamation'], 'danger'=>['#fff0f0','#c0392b','fa-trash']];
                    $c = $colors[$activity->type] ?? $colors['info'];
                @endphp
                <div class="activity-row">
                    <div class="activity-icon-wrap" style="background:{{ $c[0] }};">
                        <i class="fa-solid {{ $c[2] }} activity-icon" style="color:{{ $c[1] }};"></i>
                    </div>
                    <div>
                        <p class="activity-title">{{ $activity->title }}</p>
                        <p class="activity-sub">{{ $activity->user->name ?? '' }} · {{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <!-- /ROW 5 -->

    </div>
</div>