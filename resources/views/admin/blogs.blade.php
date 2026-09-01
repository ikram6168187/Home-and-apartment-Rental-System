@include('admin.admin_sidebar')

<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Blog Management</div>
            <small style="color:#888; font-size:12px;">
                Create and manage Smart Rent blog posts
            </small>
        </div>

        <a href="{{ route('admin.blogs.create') }}"
           style="
                background:#1a1209;
                color:#fff;
                padding:10px 18px;
                border-radius:8px;
                text-decoration:none;
                font-size:13px;
                font-weight:600;
           ">
            <i class="fa-solid fa-plus"></i>
            Create Blog
        </a>
    </div>


    <div class="content">

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif


        <!-- STATS -->
        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:18px;
            margin-bottom:24px;
        ">

            <!-- TOTAL -->
            <div style="
                background:#fff;
                padding:20px;
                border-radius:12px;
                border:1px solid #eee;
            ">
                <p style="font-size:12px;color:#888;margin-bottom:8px;">
                    Total Blogs
                </p>

                <h2 style="margin:0;color:#1a1209;">
                    {{ $blogs->count() }}
                </h2>
            </div>


            <!-- PUBLISHED -->
            <div style="
                background:#fff;
                padding:20px;
                border-radius:12px;
                border:1px solid #eee;
            ">
                <p style="font-size:12px;color:#888;margin-bottom:8px;">
                    Published
                </p>

                <h2 style="margin:0;color:#198754;">
                    {{ $published }}
                </h2>
            </div>


            <!-- DRAFT -->
            <div style="
                background:#fff;
                padding:20px;
                border-radius:12px;
                border:1px solid #eee;
            ">
                <p style="font-size:12px;color:#888;margin-bottom:8px;">
                    Drafts
                </p>

                <h2 style="margin:0;color:#d39e00;">
                    {{ $draft }}
                </h2>
            </div>

        </div>


        <!-- BLOG TABLE -->
        <div style="
            background:#fff;
            border-radius:12px;
            border:1px solid #eee;
            overflow:hidden;
        ">

            <div style="
                padding:18px;
                border-bottom:1px solid #eee;
                font-weight:700;
                color:#1a1209;
            ">
                All Blog Posts
            </div>


            @if($blogs->count() > 0)

                <div style="overflow-x:auto;">

                    <table style="
                        width:100%;
                        border-collapse:collapse;
                    ">

                        <thead style="background:#fafafa;">

                            <tr>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Image
                                </th>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Title
                                </th>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Category
                                </th>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Status
                                </th>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Author
                                </th>

                                <th style="padding:14px;text-align:left;font-size:12px;">
                                    Date
                                </th>

                                <th style="padding:14px;text-align:center;font-size:12px;">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($blogs as $blog)

                                <tr style="border-top:1px solid #eee;">

                                    <!-- IMAGE -->
                                    <td style="padding:12px;">

                                        @if($blog->image)

                                            <img src="{{ asset('storage/' . $blog->image) }}"
                                                 style="
                                                    width:65px;
                                                    height:45px;
                                                    object-fit:cover;
                                                    border-radius:6px;
                                                 ">

                                        @else

                                            <div style="
                                                width:65px;
                                                height:45px;
                                                background:#eee;
                                                border-radius:6px;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                color:#aaa;
                                            ">
                                                <i class="fa-solid fa-image"></i>
                                            </div>

                                        @endif

                                    </td>


                                    <!-- TITLE -->
                                    <td style="padding:12px;">

                                        <strong style="font-size:13px;color:#1a1209;">
                                            {{ Str::limit($blog->title, 40) }}
                                        </strong>

                                    </td>


                                    <!-- CATEGORY -->
                                    <td style="padding:12px;">

                                        <span style="
                                            background:#f3eee8;
                                            color:#8a6040;
                                            padding:5px 9px;
                                            border-radius:15px;
                                            font-size:11px;
                                        ">
                                            {{ $blog->category }}
                                        </span>

                                    </td>


                                    <!-- STATUS -->
                                    <td style="padding:12px;">

                                        @if($blog->status == 'published')

                                            <span style="
                                                color:#198754;
                                                background:#eaf7ef;
                                                padding:5px 9px;
                                                border-radius:15px;
                                                font-size:11px;
                                            ">
                                                Published
                                            </span>

                                        @else

                                            <span style="
                                                color:#d39e00;
                                                background:#fff8e1;
                                                padding:5px 9px;
                                                border-radius:15px;
                                                font-size:11px;
                                            ">
                                                Draft
                                            </span>

                                        @endif

                                    </td>


                                    <!-- AUTHOR -->
                                    <td style="padding:12px;font-size:12px;">
                                        {{ $blog->user->name ?? 'Admin' }}
                                    </td>


                                    <!-- DATE -->
                                    <td style="padding:12px;font-size:12px;color:#777;">
                                        {{ $blog->created_at->format('d M Y') }}
                                    </td>


                                    <!-- ACTIONS -->
                                    <td style="padding:12px;text-align:center;">

                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                           style="
                                                color:#0d6efd;
                                                margin-right:10px;
                                                text-decoration:none;
                                           ">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        <form action="{{ route('admin.blogs.delete', $blog->id) }}"
                                              method="POST"
                                              style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this blog?')"
                                                    style="
                                                        border:none;
                                                        background:none;
                                                        color:#dc3545;
                                                        cursor:pointer;
                                                    ">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- EMPTY STATE -->

                <div style="
                    text-align:center;
                    padding:60px 20px;
                    color:#999;
                ">

                    <i class="fa-solid fa-blog"
                       style="font-size:40px;margin-bottom:15px;">
                    </i>

                    <h4>No Blog Posts Yet</h4>

                    <p style="font-size:13px;">
                        Create your first Smart Rent blog post.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>