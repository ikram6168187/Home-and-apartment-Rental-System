<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $blog->title }} | Smart Rent</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/blogs_show.css') }}">
</head>

<body>

    {{-- NAVBAR & MODALS --}}
    @include('Navbar')
    @include('login modal')
    @include('Modal scripts')
    @include('Modal style')
    @include('Signup modal')
    @include('Logout modal')

    <!-- BLOG HEADER -->
    <section class="blog-header">
        <div class="container">
            <div class="blog-category">
                {{ $blog->category }}
            </div>

            <h1>
                {{ $blog->title }}
            </h1>

            <div class="blog-header-meta">
                <i class="fa-solid fa-user"></i>
                {{ $blog->user->name ?? 'Smart Rent Team' }}
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <i class="fa-regular fa-calendar"></i>
                {{ $blog->created_at->format('d F Y') }}
            </div>
        </div>
    </section>

    <div class="container">

        <!-- BACK BUTTON -->
        <div class="back-area">
            <a href="{{ route('blog.index') }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Blogs
            </a>
        </div>

        <!-- ARTICLE CONTENT -->
        <article class="article">

            <!-- IMAGE -->
            @if($blog->image)
                <div class="article-image">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
                </div>
            @endif

            <div class="article-body">

                <!-- EXCERPT -->
                @if($blog->excerpt)
                    <div class="excerpt">
                        {{ $blog->excerpt }}
                    </div>
                @endif

                <!-- MAIN CONTENT -->
                <div class="article-content">
                    {{ $blog->content }}
                </div>

                <!-- AUTHOR BOX -->
                <div class="author-box">
                    <div class="author-avatar">
                        {{ strtoupper(substr($blog->user->name ?? 'S', 0, 1)) }}
                    </div>

                    <div class="author-info">
                        <h4>
                            {{ $blog->user->name ?? 'Smart Rent Team' }}
                        </h4>
                        <p>
                            Smart Rent Blog Contributor
                        </p>
                    </div>
                </div>

            </div>

        </article>

        <!-- RELATED BLOGS -->
        @if($relatedBlogs->count())
            <section class="related-section">
                <h2 class="related-title">
                    Related Articles
                </h2>

                <div class="related-grid">
                    @foreach($relatedBlogs as $relatedBlog)
                        <div class="related-card">

                            @if($relatedBlog->image)
                                <div class="related-image">
                                    <img src="{{ asset('storage/'.$relatedBlog->image) }}" alt="{{ $relatedBlog->title }}">
                                </div>
                            @endif

                            <div class="related-content">
                                <span>
                                    {{ $relatedBlog->category }}
                                </span>

                                <h3>
                                    {{ $relatedBlog->title }}
                                </h3>

                                <a href="{{ route('blog.show', $relatedBlog->id) }}">
                                    Read Article
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>

    {{-- FOOTER --}}
    @include('footer')

</body>

</html>