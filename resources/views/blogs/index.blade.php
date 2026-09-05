<!DOCTYPE html>
<html lang="en">


<head>


    <meta charset="UTF-8">


    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">


    <title>Blog | Smart Rent</title>


    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <style>


        /* =========================================
           GLOBAL
        ========================================= */


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }


        body {
            background: #f6f4f1;
            color: #1a1209;
        }


        a {
            text-decoration: none;
        }



        /* =========================================
           CONTAINER
        ========================================= */


        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }



        /* =========================================
           HERO SECTION
        ========================================= */


        .blog-hero {
            background: linear-gradient(
                135deg,
                rgba(26, 18, 9, 0.95),
                rgba(59, 43, 31, 0.92)
            );


            padding: 80px 20px;
            text-align: center;
            color: #fff;


            max-width: 1200px;
            margin: 20px auto 0;


            border-radius: 30px;


            position: relative;
            overflow: hidden;


            z-index: 1;
        }


        .blog-hero .hero-icon {


            width: 70px;
            height: 70px;


            background: rgba(255,255,255,0.12);


            border: 1px solid rgba(255,255,255,0.15);


            border-radius: 50%;


            display: flex;
            justify-content: center;
            align-items: center;


            margin: 0 auto 20px;


            font-size: 28px;


            color: #c8a882;


            position: relative;
            z-index: 2;
        }


        .blog-hero h1 {


            font-size: 44px;
            font-weight: 700;


            margin-bottom: 12px;


            position: relative;
            z-index: 2;
        }


        .blog-hero p {


            max-width: 650px;


            margin: auto;


            color: #ddd;


            font-size: 16px;


            line-height: 1.7;


            position: relative;
            z-index: 2;
        }



        /* =========================================
           SEARCH & FILTER AREA
        ========================================= */


        .blog-tools {


            background: #fff;


            padding: 20px;


            border-radius: 15px;


            margin-top: -32px;


            position: relative;
            z-index: 3;


            box-shadow:
                0 10px 30px rgba(0,0,0,0.08);


            display: flex;


            gap: 14px;


            align-items: center;


            flex-wrap: wrap;
        }


        .search-box {


            flex: 1;


            min-width: 250px;


            position: relative;
        }


        .search-box i {


            position: absolute;


            left: 15px;
            top: 50%;


            transform: translateY(-50%);


            color: #999;
        }


        .search-box input {


            width: 100%;


            height: 46px;


            padding: 12px 15px 12px 43px;


            border: 1px solid #ddd;


            border-radius: 8px;


            outline: none;


            font-size: 14px;


            transition: 0.3s;
        }


        .search-box input:focus {


            border-color: #8a6040;


            box-shadow:
                0 0 0 3px rgba(138,96,64,0.10);
        }


        .category-select {


            height: 46px;


            padding: 0 14px;


            border: 1px solid #ddd;


            border-radius: 8px;


            background: #fff;


            min-width: 190px;


            outline: none;


            color: #555;


            cursor: pointer;
        }


        .category-select:focus {


            border-color: #8a6040;
        }


        .filter-btn {


            height: 46px;


            border: none;


            background: #1a1209;


            color: #fff;


            padding: 0 22px;


            border-radius: 8px;


            cursor: pointer;


            font-weight: 600;


            transition: 0.3s;
        }


        .filter-btn:hover {


            background: #3b2b1f;


            transform: translateY(-2px);
        }


        .clear-btn {


            height: 46px;


            display: flex;


            align-items: center;


            gap: 7px;


            padding: 0 18px;


            border: 1px solid #ddd;


            color: #666;


            background: #fff;


            border-radius: 8px;


            font-size: 14px;


            transition: 0.3s;
        }


        .clear-btn:hover {


            border-color: #dc3545;


            color: #dc3545;
        }



        /* =========================================
           SECTION
        ========================================= */


        .section {


            padding: 60px 0;
        }


        .section-heading {


            display: flex;


            justify-content: space-between;


            align-items: center;


            margin-bottom: 25px;


            gap: 15px;
        }


        .section-title {


            font-size: 27px;


            font-weight: 700;


            color: #1a1209;
        }


        .results-info {


            font-size: 13px;


            color: #888;
        }



        /* =========================================
           FEATURED BLOG
        ========================================= */


        .featured-blog {


            display: grid;


            grid-template-columns: 1fr 1fr;


            background: #fff;


            border-radius: 20px;


            overflow: hidden;


            box-shadow:
                0 8px 25px rgba(0,0,0,0.08);


            margin-bottom: 65px;


            transition: 0.3s;
        }


        .featured-blog:hover {


            transform: translateY(-4px);


            box-shadow:
                0 15px 35px rgba(0,0,0,0.12);
        }


        .featured-image {


            height: 370px;


            overflow: hidden;
        }


        .featured-image img {


            width: 100%;
            height: 100%;


            object-fit: cover;


            transition: 0.5s;
        }


        .featured-blog:hover .featured-image img {


            transform: scale(1.05);
        }


        .featured-content {


            padding: 45px;


            display: flex;


            flex-direction: column;


            justify-content: center;
        }



        /* =========================================
           CATEGORY
        ========================================= */


        .category {


            color: #8a6040;


            font-size: 11px;


            font-weight: 700;


            text-transform: uppercase;


            letter-spacing: 1.5px;


            margin-bottom: 12px;
        }


        .featured-content h2 {


            font-size: 31px;


            line-height: 1.35;


            margin-bottom: 15px;


            color: #1a1209;
        }


        .featured-content p {


            color: #777;


            font-size: 15px;


            line-height: 1.8;


            margin-bottom: 20px;
        }


        .blog-meta {


            display: flex;


            flex-wrap: wrap;


            gap: 15px;


            font-size: 12px;


            color: #999;


            margin-bottom: 25px;
        }


        .blog-meta span {


            display: flex;


            align-items: center;


            gap: 6px;
        }


        .blog-meta i {


            color: #8a6040;
        }


        .read-btn {


            display: inline-flex;


            align-items: center;


            gap: 8px;


            background: #1a1209;


            color: #fff;


            padding: 12px 22px;


            border-radius: 8px;


            width: max-content;


            font-size: 14px;


            font-weight: 600;


            transition: 0.3s;
        }


        .read-btn:hover {


            background: #8a6040;


            transform: translateX(4px);
        }



        /* =========================================
           BLOG GRID
        ========================================= */


        .blog-grid {


            display: grid;


            grid-template-columns:
                repeat(3, 1fr);


            gap: 25px;
        }


        .blog-card {


            background: #fff;


            border-radius: 16px;


            overflow: hidden;


            box-shadow:
                0 4px 15px rgba(0,0,0,0.06);


            transition: 0.35s;


            display: flex;


            flex-direction: column;
        }


        .blog-card:hover {


            transform: translateY(-7px);


            box-shadow:
                0 15px 30px rgba(0,0,0,0.12);
        }



        /* =========================================
           BLOG IMAGE
        ========================================= */


        .blog-image {


            height: 210px;


            overflow: hidden;


            position: relative;
        }


        .blog-image img {


            width: 100%;
            height: 100%;


            object-fit: cover;


            transition: 0.5s;
        }


        .blog-card:hover .blog-image img {


            transform: scale(1.08);
        }



        /* =========================================
           BLOG CONTENT
        ========================================= */


        .blog-content {


            padding: 22px;


            display: flex;


            flex-direction: column;


            flex: 1;
        }


        .blog-content h3 {


            font-size: 19px;


            line-height: 1.45;


            color: #1a1209;


            margin-bottom: 12px;
        }


        .blog-content h3:hover {


            color: #8a6040;
        }


        .blog-content p {


            font-size: 14px;


            color: #777;


            line-height: 1.7;


            margin-bottom: 20px;
        }



        /* =========================================
           BLOG FOOTER
        ========================================= */


        .blog-footer {


            margin-top: auto;


            display: flex;


            justify-content: space-between;


            align-items: center;


            border-top: 1px solid #eee;


            padding-top: 15px;


            gap: 10px;
        }


        .blog-date {


            font-size: 12px;


            color: #999;


            display: flex;


            align-items: center;


            gap: 6px;
        }


        .read-more {


            color: #8a6040;


            font-size: 13px;


            font-weight: 700;


            display: flex;


            align-items: center;


            gap: 6px;


            transition: 0.3s;
        }


        .read-more:hover {


            color: #1a1209;


            gap: 10px;
        }



        /* =========================================
           EMPTY STATE
        ========================================= */


        .empty {


            background: #fff;


            border-radius: 15px;


            text-align: center;


            padding: 80px 20px;


            box-shadow:
                0 4px 15px rgba(0,0,0,0.05);
        }


        .empty-icon {


            width: 75px;
            height: 75px;


            margin: 0 auto 20px;


            border-radius: 50%;


            background: #f6f4f1;


            color: #8a6040;


            display: flex;


            align-items: center;


            justify-content: center;


            font-size: 30px;
        }


        .empty h3 {


            font-size: 22px;


            margin-bottom: 10px;


            color: #1a1209;
        }


        .empty p {


            color: #888;


            font-size: 14px;


            margin-bottom: 20px;
        }


        .empty a {


            display: inline-block;


            background: #1a1209;


            color: #fff;


            padding: 10px 20px;


            border-radius: 7px;


            font-size: 13px;
        }



        /* =========================================
           PAGINATION
        ========================================= */


        .pagination-wrapper {


            display: flex;


            justify-content: center;


            margin-top: 50px;
        }


        .pagination-wrapper nav {


            width: auto;
        }


        .pagination-wrapper svg {


            width: 18px;
            height: 18px;
        }



        /* =========================================
           LOGIN MODAL - BLOG PAGE FIX
        ========================================= */


        /*
         * IMPORTANT:
         * Blog page ki CSS modal ko affect na kare.
         */


        #loginModal.modal-overlay {


            display: none !important;


            position: fixed !important;


            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;


            width: 100% !important;
            height: 100% !important;


            z-index: 999999 !important;
        }


        #loginModal.modal-overlay.show {


            display: flex !important;
        }



        /*
         * Modal ke andar Blog ki global CSS ka
         * interference kam karne ke liye.
         */


        #loginModal .login-card {


            font-family: Arial, sans-serif;


            position: relative;


            z-index: 1000000;
        }


        #loginModal .login-card *,
        #loginModal .login-card input,
        #loginModal .login-card button,
        #loginModal .login-card a {


            font-family: Arial, sans-serif;
        }



        /* =========================================
           RESPONSIVE
        ========================================= */


        @media(max-width:1000px) {


            .blog-grid {


                grid-template-columns:
                    repeat(2, 1fr);
            }
        }



        @media(max-width:900px) {


            .featured-blog {


                grid-template-columns: 1fr;
            }


            .featured-image {


                height: 300px;
            }


            .featured-content {


                padding: 30px;
            }
        }



        @media(max-width:650px) {


            .container {


                width: 92%;
            }


            .blog-hero {


                padding: 60px 15px;


                margin: 12px auto 0;


                border-radius: 18px;
            }


            .blog-hero h1 {


                font-size: 34px;
            }


            .blog-tools {


                margin-top: -25px;


                padding: 15px;
            }


            .search-box {


                flex-basis: 100%;
            }


            .category-select {


                width: 100%;
            }


            .filter-btn {


                flex: 1;
            }


            .section {


                padding: 45px 0;
            }


            .section-heading {


                flex-direction: column;


                align-items: flex-start;
            }


            .section-title {


                font-size: 24px;
            }


            .blog-grid {


                grid-template-columns: 1fr;
            }


            .featured-image {


                height: 240px;
            }


            .featured-content {


                padding: 25px;
            }


            .featured-content h2 {


                font-size: 25px;
            }
        }


    </style>


</head>



<body>



    {{-- =========================================
       NAVBAR
    ========================================= --}}


    @include('Navbar')
 @include('login modal')
@include('Modal scripts')
@include('Modal style')
@include('Signup modal')



   
 



    {{-- =========================================
       HERO SECTION
    ========================================= --}}


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



        {{-- =========================================
           SEARCH & FILTER
        ========================================= --}}


        <form method="GET"
              action="{{ route('blog.index') }}"
              class="blog-tools">



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


            <select name="category"
                    class="category-select">


                <option value="">
                    All Categories
                </option>



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


            <button type="submit"
                    class="filter-btn">


                <i class="fa-solid fa-filter"></i>


                Filter


            </button>




            {{-- CLEAR FILTER --}}


            @if(request('search') || request('category'))


                <a href="{{ route('blog.index') }}"
                   class="clear-btn">


                    <i class="fa-solid fa-xmark"></i>


                    Clear


                </a>


            @endif



        </form>




        <section class="section">



            {{-- =========================================
               FEATURED ARTICLE
            ========================================= --}}


            @if($featuredBlog && !request('search') && !request('category'))


                <h2 class="section-title">


                    Featured Article


                </h2>



                <div class="featured-blog">



                    {{-- IMAGE --}}


                    <div class="featured-image">


                        @if($featuredBlog->image)


                            <img
                                src="{{ asset('storage/'.$featuredBlog->image) }}"
                                alt="{{ $featuredBlog->title }}"
                            >


                        @else


                            <img
                                src="{{ asset('images/default-blog.jpg') }}"
                                alt="Default Blog Image"
                            >


                        @endif


                    </div>




                    {{-- CONTENT --}}


                    <div class="featured-content">



                        <div class="category">


                            {{ $featuredBlog->category }}


                        </div>



                        <h2>


                            {{ $featuredBlog->title }}


                        </h2>



                        <p>


                            {{ Str::limit($featuredBlog->excerpt, 220) }}


                        </p>




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


                        <a
                            href="{{ route('blog.show', $featuredBlog->id) }}"
                            class="read-btn"
                        >


                            Read Full Article


                            <i class="fa-solid fa-arrow-right"></i>


                        </a>



                    </div>



                </div>


            @endif




            {{-- =========================================
               SECTION HEADING
            ========================================= --}}


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


                        Results for:
                        <strong>"{{ request('search') }}"</strong>


                    </div>


                @endif



            </div>




            {{-- =========================================
               BLOG GRID
            ========================================= --}}


            @if($blogs->count())



                <div class="blog-grid">



                    @foreach($blogs as $blog)



                        {{-- BLOG CARD --}}


                        <article class="blog-card">



                            {{-- BLOG IMAGE --}}


                            <div class="blog-image">



                                @if($blog->image)


                                    <img
                                        src="{{ asset('storage/'.$blog->image) }}"
                                        alt="{{ $blog->title }}"
                                    >


                                @else


                                    <img
                                        src="{{ asset('images/default-blog.jpg') }}"
                                        alt="Default Blog Image"
                                    >


                                @endif



                            </div>




                            {{-- BLOG CONTENT --}}


                            <div class="blog-content">



                                {{-- CATEGORY --}}


                                <div class="category">


                                    {{ $blog->category }}


                                </div>




                                {{-- TITLE --}}


                                <h3>


                                    {{ $blog->title }}


                                </h3>




                                {{-- EXCERPT --}}


                                <p>


                                    {{ Str::limit($blog->excerpt, 120) }}


                                </p>




                                {{-- FOOTER --}}


                                <div class="blog-footer">



                                    {{-- DATE --}}


                                    <span class="blog-date">


                                        <i class="fa-regular fa-calendar"></i>


                                        {{ $blog->created_at->format('d M Y') }}


                                    </span>




                                    {{-- READ MORE --}}


                                    <a
                                        href="{{ route('blog.show', $blog->id) }}"
                                        class="read-more"
                                    >


                                        Read More


                                        <i class="fa-solid fa-arrow-right"></i>


                                    </a>



                                </div>



                            </div>



                        </article>



                    @endforeach



                </div>




                {{-- =========================================
                   PAGINATION
                ========================================= --}}


                @if(method_exists($blogs, 'links'))


                    <div class="pagination-wrapper">


                        {{ $blogs->withQueryString()->links() }}


                    </div>


                @endif




            @else



                {{-- =========================================
                   EMPTY STATE
                ========================================= --}}


                <div class="empty">



                    <div class="empty-icon">


                        <i class="fa-solid fa-magnifying-glass"></i>


                    </div>



                    <h3>


                        No Blogs Found


                    </h3>



                    <p>


                        We couldn't find any articles matching
                        your search criteria.


                    </p>



                    <a href="{{ route('blog.index') }}">


                        <i class="fa-solid fa-arrow-left"></i>


                        View All Blogs


                    </a>



                </div>



            @endif



        </section>



    </div>




    



    {{-- =========================================
       FOOTER
    ========================================= --}}


    @include('footer')



</body>


</html>

