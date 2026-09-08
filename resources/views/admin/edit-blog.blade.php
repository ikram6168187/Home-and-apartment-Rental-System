@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_edit_blogs.css') }}">
@endpush

@include('admin.admin_sidebar')

<div class="main">

    <div class="topbar">

        <div>

            <div class="topbar-title">
                Edit Blog
            </div>

            <small class="topbar-subtitle">
                Update blog information
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

                <div class="form-group">

                    <label class="form-label">
                        Blog Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title', $blog->title) }}"
                           required
                           class="form-control">

                </div>


                <!-- CATEGORY + STATUS -->

                <div class="form-grid-2">

                    <div>

                        <label class="form-label">
                            Category
                        </label>

                        <select name="category"
                                required
                                class="form-control">

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

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                required
                                class="form-control">

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

                <div class="form-group">

                    <label class="form-label">
                        Short Description
                    </label>

                    <textarea name="excerpt"
                              rows="3"
                              class="form-textarea">{{ old('excerpt', $blog->excerpt) }}</textarea>

                </div>


                <!-- CONTENT -->

                <div class="form-group">

                    <label class="form-label">
                        Blog Content
                    </label>

                    <textarea name="content"
                              rows="12"
                              required
                              class="form-textarea-lg">{{ old('content', $blog->content) }}</textarea>

                </div>


                <!-- IMAGE -->

                <div class="form-group-image">

                    <label class="form-label">
                        Featured Image
                    </label>


                    @if($blog->image)

                        <img src="{{ asset('storage/' . $blog->image) }}"
                             id="imagePreview"
                             class="image-preview">

                    @else

                        <img id="imagePreview"
                             class="image-preview-hidden">

                    @endif


                    <input type="file"
                           name="image"
                           accept="image/*"
                           onchange="previewImage(event)"
                           class="file-input">

                </div>


                <!-- BUTTON -->

                <button type="submit" class="btn-save">

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