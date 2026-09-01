@include('admin.admin_sidebar')

<div class="main">

    <div class="topbar">

        <div>

            <div class="topbar-title">
                Edit Blog
            </div>

            <small style="color:#888;font-size:12px;">
                Update blog information
            </small>

        </div>


        <a href="{{ route('admin.blogs') }}"
           style="
                color:#555;
                text-decoration:none;
                font-size:13px;
           ">

            <i class="fa-solid fa-arrow-left"></i>
            Back to Blogs

        </a>

    </div>


    <div class="content">

        <div style="
            max-width:900px;
            margin:auto;
            background:#fff;
            border:1px solid #eee;
            border-radius:14px;
            padding:30px;
        ">

            @if($errors->any())

                <div class="alert-error">

                    @foreach($errors->all() as $error)

                        <div>{{ $error }}</div>

                    @endforeach

                </div>

            @endif


            <form action="{{ route('admin.blogs.update', $blog->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <!-- TITLE -->

                <div style="margin-bottom:20px;">

                    <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                        Blog Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title', $blog->title) }}"
                           required
                           style="
                                width:100%;
                                padding:12px;
                                border:1px solid #ddd;
                                border-radius:8px;
                           ">

                </div>


                <!-- CATEGORY + STATUS -->

                <div style="
                    display:grid;
                    grid-template-columns:1fr 1fr;
                    gap:20px;
                    margin-bottom:20px;
                ">

                    <div>

                        <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                            Category
                        </label>

                        <select name="category"
                                required
                                style="
                                    width:100%;
                                    padding:12px;
                                    border:1px solid #ddd;
                                    border-radius:8px;
                                ">

                            @php
                                $categories = [
                                    'Renting Tips',
                                    'Property Management',
                                    'Rental Guide',
                                    'Moving & Relocation',
                                    'Home Improvement',
                                    'Real Estate Trends'
                                ];
                            @endphp


                            @foreach($categories as $category)

                                <option value="{{ $category }}"
                                    {{ old('category', $blog->category) == $category ? 'selected' : '' }}>

                                    {{ $category }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div>

                        <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                            Status
                        </label>

                        <select name="status"
                                required
                                style="
                                    width:100%;
                                    padding:12px;
                                    border:1px solid #ddd;
                                    border-radius:8px;
                                ">

                            <option value="draft"
                                {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                        </select>

                    </div>

                </div>


                <!-- EXCERPT -->

                <div style="margin-bottom:20px;">

                    <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                        Short Description
                    </label>

                    <textarea name="excerpt"
                              rows="3"
                              style="
                                width:100%;
                                padding:12px;
                                border:1px solid #ddd;
                                border-radius:8px;
                              ">{{ old('excerpt', $blog->excerpt) }}</textarea>

                </div>


                <!-- CONTENT -->

                <div style="margin-bottom:20px;">

                    <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                        Blog Content
                    </label>

                    <textarea name="content"
                              rows="12"
                              required
                              style="
                                width:100%;
                                padding:14px;
                                border:1px solid #ddd;
                                border-radius:8px;
                              ">{{ old('content', $blog->content) }}</textarea>

                </div>


                <!-- IMAGE -->

                <div style="margin-bottom:25px;">

                    <label style="display:block;margin-bottom:7px;font-size:13px;font-weight:600;">
                        Featured Image
                    </label>


                    @if($blog->image)

                        <img src="{{ asset('storage/' . $blog->image) }}"
                             id="imagePreview"
                             style="
                                width:200px;
                                height:120px;
                                object-fit:cover;
                                border-radius:8px;
                                display:block;
                                margin-bottom:12px;
                             ">

                    @else

                        <img id="imagePreview"
                             style="
                                display:none;
                                width:200px;
                                height:120px;
                                object-fit:cover;
                                border-radius:8px;
                                margin-bottom:12px;
                             ">

                    @endif


                    <input type="file"
                           name="image"
                           accept="image/*"
                           onchange="previewImage(event)"
                           style="
                                width:100%;
                                padding:10px;
                                border:1px dashed #bbb;
                                border-radius:8px;
                           ">

                </div>


                <!-- BUTTON -->

                <button type="submit"
                        style="
                            background:#1a1209;
                            color:#fff;
                            border:none;
                            padding:12px 28px;
                            border-radius:8px;
                            cursor:pointer;
                            font-weight:600;
                        ">

                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Blog

                </button>

            </form>

        </div>

    </div>

</div>


<script>

function previewImage(event)
{
    const preview = document.getElementById('imagePreview');

    preview.src = URL.createObjectURL(
        event.target.files[0]
    );

    preview.style.display = 'block';
}

</script>