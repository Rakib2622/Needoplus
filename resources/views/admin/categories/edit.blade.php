@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <h3>✏️ Edit Category</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- NAME --}}
                <div class="mb-3">
                    <label>Category Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $category->name }}"
                           class="form-control">
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control">{{ $category->description }}</textarea>
                </div>

                {{-- CURRENT IMAGE --}}
                <div class="mb-3">
                    <label>Current Image</label><br>

                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}"
                             width="100"
                             class="rounded border mb-2">
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                {{-- NEW IMAGE --}}
                <div class="mb-3">
                    <label>Change Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>

@include('admin.partials.footer')