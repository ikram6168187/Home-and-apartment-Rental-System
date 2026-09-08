@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_create_blogs.css') }}">
@endpush

@include('admin.admin_sidebar')

<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>
            <div class="topbar-title">
                Create New Blog
            </div>

            <small class="topbar-subtitle">
                Publish useful content for Smart Rent users
            </small>
        </div>


        <a href="{{ route('admin.blogs') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Blogs
        </a>

    </div>


    <div class="content">

        <div class="form-card">

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

                <div class="form-group">

                    <label class="form-label">
                        Blog Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Enter blog title"
                           required
                           class="form-control">

                </div>


                <!-- CATEGORY + STATUS -->

                <div class="form-grid-2">


                    <!-- CATEGORY -->

                    <div>

                        <label class="form-label">
                            Category
                        </label>


                        <select name="category"
                                required
                                class="form-control">

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

                        <label class="form-label">
                            Publish Status
                        </label>


                        <select name="status"
                                required
                                class="form-control">

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

                <div class="form-group">

                    <label class="form-label">
                        Short Description
                    </label>


                    <textarea name="excerpt"
                              rows="3"
                              placeholder="Write a short summary of your blog..."
                              class="form-textarea">{{ old('excerpt') }}</textarea>

                </div>


                <!-- CONTENT -->

                <div class="form-group">

                    <label class="form-label">
                        Blog Content
                    </label>


                    <textarea name="content"
                              rows="12"
                              required
                              placeholder="Write your complete blog content..."
                              class="form-textarea-lg">{{ old('content') }}</textarea>

                </div>


                <!-- IMAGE -->

                <div class="form-group-image">

                    <label class="form-label">
                        Featured Image
                    </label>


                    <input type="file"
                           name="image"
                           accept="image/*"
                           onchange="previewImage(event)"
                           class="file-input">


                    <div class="image-preview-wrap">

                        <img id="imagePreview" class="image-preview">

                    </div>

                </div>


                <!-- BUTTON -->

                <button type="submit" class="btn-save">

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