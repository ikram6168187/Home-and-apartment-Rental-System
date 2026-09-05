@include('admin.admin_sidebar')

<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>
            <div class="topbar-title">
                Create New Blog
            </div>

            <small style="color:#888;font-size:12px;">
                Publish useful content for Smart Rent users
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

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <form action="{{ route('admin.blogs.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <!-- TITLE -->

                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Blog Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Enter blog title"
                           required
                           style="
                                width:100%;
                                padding:12px;
                                border:1px solid #ddd;
                                border-radius:8px;
                                outline:none;
                           ">

                </div>


                <!-- CATEGORY + STATUS -->

                <div style="
                    display:grid;
                    grid-template-columns:1fr 1fr;
                    gap:20px;
                    margin-bottom:20px;
                ">


                    <!-- CATEGORY -->

                    <div>

                        <label style="
                            display:block;
                            margin-bottom:7px;
                            font-size:13px;
                            font-weight:600;
                        ">
                            Category
                        </label>


                        <select name="category"
                                required
                                style="
                                    width:100%;
                                    padding:12px;
                                    border:1px solid #ddd;
                                    border-radius:8px;
                                    background:#fff;
                                ">

                            <option value="">
                                Select Category
                            </option>

                            <option value="Renting Tips">
                                Renting Tips
                            </option>
                              <option value="Apartment Tips">
                                Apartment Tips
                            </option>
                            <option value="Property Management">
                                Property Owner tips
                            </option>

                            <option value="Rental Guide">
                                Rental Guide
                            </option>

                            <option value="Moving & Relocation">
                                Moving & Relocation
                            </option>

                            <option value="Home Improvement">
                                Home Improvement
                            </option>

                            <option value="Real Estate Trends">
                                Real Estate Trends
                            </option>

                        </select>

                    </div>


                    <!-- STATUS -->

                    <div>

                        <label style="
                            display:block;
                            margin-bottom:7px;
                            font-size:13px;
                            font-weight:600;
                        ">
                            Publish Status
                        </label>


                        <select name="status"
                                required
                                style="
                                    width:100%;
                                    padding:12px;
                                    border:1px solid #ddd;
                                    border-radius:8px;
                                    background:#fff;
                                ">

                            <option value="draft">
                                Save as Draft
                            </option>

                            <option value="published">
                                Publish Now
                            </option>

                        </select>

                    </div>

                </div>


                <!-- EXCERPT -->

                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Short Description
                    </label>


                    <textarea name="excerpt"
                              rows="3"
                              placeholder="Write a short summary of your blog..."
                              style="
                                width:100%;
                                padding:12px;
                                border:1px solid #ddd;
                                border-radius:8px;
                                resize:vertical;
                              ">{{ old('excerpt') }}</textarea>

                </div>


                <!-- CONTENT -->

                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Blog Content
                    </label>


                    <textarea name="content"
                              rows="12"
                              required
                              placeholder="Write your complete blog content..."
                              style="
                                width:100%;
                                padding:14px;
                                border:1px solid #ddd;
                                border-radius:8px;
                                resize:vertical;
                              ">{{ old('content') }}</textarea>

                </div>


                <!-- IMAGE -->

                <div style="margin-bottom:25px;">

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Featured Image
                    </label>


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


                    <div style="margin-top:15px;">

                        <img id="imagePreview"
                             style="
                                display:none;
                                width:200px;
                                height:120px;
                                object-fit:cover;
                                border-radius:8px;
                             ">

                    </div>

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
                    Save Blog

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