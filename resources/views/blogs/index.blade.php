<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Smart Rent</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- External Blog CSS -->
    <link rel="stylesheet" href="{{ asset('css/blogs_index.css') }}">
</head>

<body>

    {{-- NAVBAR & MODALS --}}
    @include('Navbar')
    @include('login modal')
    @include('Modal scripts')
    @include('Modal style')
    @include('Signup modal')
    @include('Logout modal ')

    {{-- HERO SECTION --}}
    <section class="blog-hero">
        <div class="hero-icon">
            <i class="fa-solid fa-blog"></i>
        </div>

        <h1>Smart Rent Blog</h1>

        <p>
            Discover rental tips, property guides, expert advice
            and useful insights to help you make smarter decisions.
        </p>
    </section>

    <div class="container">

        {{-- SEARCH & FILTER --}}
        <form method="GET" action="{{ route('blog.index') }}" class="blog-tools">

            {{-- SEARCH --}}
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search blogs..."
                >
            </div>

            {{-- CATEGORY --}}
            <select name="category" class="category-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category }}" 
                        {{ request('category') == $category ? 'selected' : '' }}
                    >
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            {{-- FILTER BUTTON --}}
            <button type="submit" class="filter-btn">
                <i class="fa-solid fa-filter"></i>
                Filter
            </button>

            {{-- CLEAR FILTER --}}
            @if(request('search') || request('category'))
                <a href="{{ route('blog.index') }}" class="clear-btn">
                    <i class="fa-solid fa-xmark"></i>
                    Clear
                </a>
            @endif

        </form>

        <section class="section">

            {{-- FEATURED ARTICLE --}}
            @if($featuredBlog && !request('search') && !request('category'))
                <h2 class="section-title">Featured Article</h2>

                <div class="featured-blog">

                    {{-- IMAGE --}}
                    <div class="featured-image">
                        @if($featuredBlog->image)
                            <img src="{{ asset('storage/'.$featuredBlog->image) }}" alt="{{ $featuredBlog->title }}">
                        @else
                            <img src="{{ asset('images/default-blog.jpg') }}" alt="Default Blog Image">
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="featured-content">

                        <div class="category">
                            {{ $featuredBlog->category }}
                        </div>

                        <h2>{{ $featuredBlog->title }}</h2>

                        <p>{{ Str::limit($featuredBlog->excerpt, 220) }}</p>

                        {{-- META --}}
                        <div class="blog-meta">
                            <span>
                                <i class="fa-solid fa-user"></i>
                                {{ $featuredBlog->user->name ?? 'Smart Rent Team' }}
                            </span>

                            <span>
                                <i class="fa-regular fa-calendar"></i>
                                {{ $featuredBlog->created_at->format('d M Y') }}
                            </span>
                        </div>

                        {{-- READ FULL ARTICLE --}}
                        <a href="{{ route('blog.show', $featuredBlog->id) }}" class="read-btn">
                            Read Full Article
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>
            @endif

            {{-- SECTION HEADING --}}
            <div class="section-heading">
                <h2 class="section-title">
                    @if(request('search') || request('category'))
                        Search Results
                    @else
                        Latest Articles
                    @endif
                </h2>

                @if(request('search'))
                    <div class="results-info">
                        Results for: <strong>"{{ request('search') }}"</strong>
                    </div>
                @endif
            </div>

            {{-- BLOG GRID --}}
            @if($blogs->count())

                <div class="blog-grid">
                    @foreach($blogs as $blog)

                        {{-- BLOG CARD --}}
                        <article class="blog-card">

                            {{-- BLOG IMAGE --}}
                            <div class="blog-image">
                                @if($blog->image)
                                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
                                @else
                                    <img src="{{ asset('images/default-blog.jpg') }}" alt="Default Blog Image">
                                @endif
                            </div>

                            {{-- BLOG CONTENT --}}
                            <div class="blog-content">

                                {{-- CATEGORY --}}
                                <div class="category">
                                    {{ $blog->category }}
                                </div>

                                {{-- TITLE --}}
                                <h3>{{ $blog->title }}</h3>

                                {{-- EXCERPT --}}
                                <p>{{ Str::limit($blog->excerpt, 120) }}</p>

                                {{-- FOOTER --}}
                                <div class="blog-footer">
                                    <span class="blog-date">
                                        <i class="fa-regular fa-calendar"></i>
                                        {{ $blog->created_at->format('d M Y') }}
                                    </span>

                                    <a href="{{ route('blog.show', $blog->id) }}" class="read-more">
                                        Read More
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>

                        </article>

                    @endforeach
                </div>

                {{-- PAGINATION --}}
                @if(method_exists($blogs, 'links'))
                    <div class="pagination-wrapper">
                        {{ $blogs->withQueryString()->links() }}
                    </div>
                @endif

            @else

                {{-- EMPTY STATE --}}
                <div class="empty">
                    <div class="empty-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <h3>No Blogs Found</h3>

                    <p>We couldn't find any articles matching your search criteria.</p>

                    <a href="{{ route('blog.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        View All Blogs
                    </a>
                </div>

            @endif

        </section>

    </div>

    {{-- FOOTER --}}
    @include('footer')

</body>

</html>