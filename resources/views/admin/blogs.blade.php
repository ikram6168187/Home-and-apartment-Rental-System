@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_blogs.css') }}">
@endpush

@include('admin.admin_sidebar')

<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Blog Management</div>
            <small class="topbar-subtitle">
                Create and manage Smart Rent blog posts
            </small>
        </div>

        <a href="{{ route('admin.blogs.create') }}" class="create-blog-btn">
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
        <div class="blog-stats-grid">

            <!-- TOTAL -->
            <div class="stat-card">
                <p class="stat-label">
                    Total Blogs
                </p>

                <h2 class="stat-value">
                    {{ $blogs->count() }}
                </h2>
            </div>


            <!-- PUBLISHED -->
            <div class="stat-card">
                <p class="stat-label">
                    Published
                </p>

                <h2 class="stat-value-published">
                    {{ $published }}
                </h2>
            </div>


            <!-- DRAFT -->
            <div class="stat-card">
                <p class="stat-label">
                    Drafts
                </p>

                <h2 class="stat-value-draft">
                    {{ $draft }}
                </h2>
            </div>

        </div>


        <!-- BLOG TABLE -->
        <div class="blog-table-card">

            <div class="blog-table-header">
                All Blog Posts
            </div>


            @if($blogs->count() > 0)

                <div class="table-responsive">

                    <table class="blog-table">

                        <thead>

                            <tr>

                                <th>
                                    Image
                                </th>

                                <th>
                                    Title
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Author
                                </th>

                                <th>
                                    Date
                                </th>

                                <th class="th-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($blogs as $blog)

                                <tr>

                                    <!-- IMAGE -->
                                    <td>

                                        @if($blog->image)

                                            <img src="{{ asset('storage/' . $blog->image) }}"
                                                 class="blog-thumb">

                                        @else

                                            <div class="blog-thumb-placeholder">
                                                <i class="fa-solid fa-image"></i>
                                            </div>

                                        @endif

                                    </td>


                                    <!-- TITLE -->
                                    <td>

                                        <strong class="blog-title-text">
                                            {{ Str::limit($blog->title, 40) }}
                                        </strong>

                                    </td>


                                    <!-- CATEGORY -->
                                    <td>

                                        <span class="badge badge-category">
                                            {{ $blog->category }}
                                        </span>

                                    </td>


                                    <!-- STATUS -->
                                    <td>

                                        @if($blog->status == 'published')

                                            <span class="badge badge-published">
                                                Published
                                            </span>

                                        @else

                                            <span class="badge badge-draft">
                                                Draft
                                            </span>

                                        @endif

                                    </td>


                                    <!-- AUTHOR -->
                                    <td class="td-muted-sm">
                                        {{ $blog->user->name ?? 'Admin' }}
                                    </td>


                                    <!-- DATE -->
                                    <td class="td-date">
                                        {{ $blog->created_at->format('d M Y') }}
                                    </td>


                                    <!-- ACTIONS -->
                                    <td class="td-center">

                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="action-edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        <form action="{{ route('admin.blogs.delete', $blog->id) }}"
                                              method="POST"
                                              class="inline-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this blog?')"
                                                    class="action-delete">

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

                <div class="blog-empty-state">

                    <i class="fa-solid fa-blog blog-empty-state-icon"></i>

                    <h4>No Blog Posts Yet</h4>

                    <p class="blog-empty-state-text">
                        Create your first Smart Rent blog post.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>