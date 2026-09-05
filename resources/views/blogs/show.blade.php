<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $blog->title }} | Smart Rent</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',Arial,sans-serif;
        }

        body{
            background:#f6f4f1;
            color:#1a1209;
        }

        a{
            text-decoration:none;
        }

        .container{
            width:95%;
            margin:auto;
        }

        /* BLOG HEADER */

        .blog-header{
            background:#1a1209;
            color:white;
            padding: 70px 5% 60px; 
            text-align: center; 
            position: relative; 
            overflow: hidden; 
            margin: 35px 2.5% 0; 
            border-radius: 25px; 
        }

        .blog-category{
            display:inline-block;
            color:#c8a882;
            font-size:12px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:1px;
            margin-bottom:18px;
        }

        .blog-header h1{
            max-width:850px;
            margin:auto;
            font-size:42px;
            line-height:1.3;
        }

        .blog-header-meta{
            margin-top:20px;
            color:#cfcfcf;
            font-size:13px;
        }

        /* ARTICLE */

        .article{
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 8px 30px rgba(0,0,0,0.06);
        }

        .article-image{
            width:100%;
            height:450px;
        }

        .article-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .article-body{
            padding:45px 60px;
        }

        .excerpt{
            font-size:20px;
            line-height:1.7;
            color:#555;
            font-style:italic;
            background:#f6f4f1;
            border-left:4px solid #c8a882;
            padding:18px 22px;
            border-radius:0 10px 10px 0;
            margin-bottom:35px;
        }

        .article-content{
            font-size:16px;
            line-height:1.9;
            color:#444;
            white-space:pre-line;
        }

        /* AUTHOR */

        .author-box{
            margin-top:45px;
            padding:22px;
            border-radius:14px;
            background:#f6f4f1;
            display:flex;
            align-items:center;
            gap:16px;
            border:1px solid #ece8e2;
        }

        .author-avatar{
            width:52px;
            height:52px;
            border-radius:50%;
            background:#1a1209;
            color:#c8a882;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
            font-size:18px;
            flex-shrink:0;
        }

        .author-info h4{
            margin-bottom:4px;
        }

        .author-info p{
            font-size:13px;
            color:#777;
        }

        /* BACK BUTTON */

        .back-area{
            margin:35px 0;
        }

        .back-btn{
            display:inline-flex;
            align-items:center;
            gap:8px;
            background:#fff;
            color:#1a1209;
            padding:12px 20px;
            border-radius:8px;
            border:1px solid #ddd;
            font-weight:600;
            transition:0.3s;
        }

        .back-btn:hover{
            background:#1a1209;
            color:white;
        }

        /* RELATED BLOGS */

        .related-section{
            padding:60px 0 70px;
        }

        .related-title{
            font-size:26px;
            font-weight:700;
            margin-bottom:30px;
            position:relative;
            padding-left:18px;
        }

        .related-title::before{
            content:'';
            position:absolute;
            left:0;
            top:4px;
            bottom:4px;
            width:5px;
            background:#c8a882;
            border-radius:3px;
        }

        .related-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:28px;
        }

        .related-card{
            background:#fff;
            border-radius:16px;
            overflow:hidden;
            border:1px solid #ece8e2;
            box-shadow:0 4px 15px rgba(0,0,0,0.04);
            transition:all 0.35s ease;
        }

        .related-card:hover{
            transform:translateY(-6px);
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
            border-color:transparent;
        }

        .related-image{
            height:190px;
            overflow:hidden;
        }

        .related-image img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:transform 0.5s ease;
        }

        .related-card:hover .related-image img{
            transform:scale(1.08);
        }

        .related-content{
            padding:20px 22px 24px;
        }

        .related-content span{
            display:inline-block;
            background:#f6f4f1;
            color:#8a6040;
            font-size:11px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:0.5px;
            padding:5px 12px;
            border-radius:20px;
            margin-bottom:14px;
        }

        .related-content h3{
            margin:0 0 16px;
            font-size:17px;
            line-height:1.4;
            font-weight:600;
            color:#1a1209;
        }

        .related-content a{
            display:inline-flex;
            align-items:center;
            gap:6px;
            color:#8a6040;
            font-size:13px;
            font-weight:600;
            transition:gap 0.3s ease;
        }

        .related-content a:hover{
            gap:10px;
        }

        /* RESPONSIVE */

        @media(max-width:800px){

            .blog-header h1{
                font-size:30px;
            }

            .article-body{
                padding:30px 25px;
            }

            .article-image{
                height:280px;
            }

            .related-grid{
                grid-template-columns:1fr;
            }

        }

    </style>

</head>

<body>


{{-- NAVBAR --}}
@include('Navbar')
@include('login modal')
@include('Modal scripts')
@include('Modal style')
@include('Signup modal')


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


    <!-- BACK -->

    <div class="back-area">

        <a href="{{ route('blog.index') }}"
           class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Blogs

        </a>

    </div>


    <!-- ARTICLE -->

    <article class="article">


        <!-- IMAGE -->

        @if($blog->image)

            <div class="article-image">

                <img src="{{ asset('storage/'.$blog->image) }}"
                     alt="{{ $blog->title }}">

            </div>

        @endif


        <div class="article-body">


            <!-- EXCERPT -->

            @if($blog->excerpt)

                <div class="excerpt">

                    {{ $blog->excerpt }}

                </div>

            @endif


            <!-- CONTENT -->

            <div class="article-content">

                {{ $blog->content }}

            </div>


            <!-- AUTHOR -->

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

                                <img src="{{ asset('storage/'.$relatedBlog->image) }}"
                                     alt="{{ $relatedBlog->title }}">

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

@include('footer')
</body>
</html>