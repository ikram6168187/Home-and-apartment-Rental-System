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
            width:90%;
            max-width:1000px;
            margin:auto;
        }

        /* BLOG HEADER */

        .blog-header{
            background:#1a1209;
            color:white;
            padding:60px 20px;
            text-align:center;
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
            margin-top:40px;
            margin-bottom:50px;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 5px 25px rgba(0,0,0,0.07);
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
            border-left:4px solid #c8a882;
            padding-left:20px;
            margin-bottom:30px;
        }

        .article-content{
            font-size:16px;
            line-height:1.9;
            color:#444;
            white-space:pre-line;
        }

        /* AUTHOR */

        .author-box{
            margin-top:40px;
            padding:20px;
            border-radius:12px;
            background:#f6f4f1;
            display:flex;
            align-items:center;
            gap:15px;
        }

        .author-avatar{
            width:50px;
            height:50px;
            border-radius:50%;
            background:#1a1209;
            color:#c8a882;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
            font-size:18px;
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
            padding-bottom:70px;
        }

        .related-title{
            font-size:26px;
            margin-bottom:25px;
        }

        .related-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:22px;
        }

        .related-card{
            background:#fff;
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
            transition:0.3s;
        }

        .related-card:hover{
            transform:translateY(-5px);
        }

        .related-image{
            height:180px;
        }

        .related-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .related-content{
            padding:18px;
        }

        .related-content span{
            color:#8a6040;
            font-size:11px;
            font-weight:bold;
            text-transform:uppercase;
        }

        .related-content h3{
            margin:10px 0;
            font-size:17px;
            line-height:1.4;
        }

        .related-content a{
            color:#8a6040;
            font-size:13px;
            font-weight:600;
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


</body>
</html>