@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <h3>➕ Create Category</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('admin.categories.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- NAME --}}
                <div class="mb-3">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                {{-- IMAGE --}}
                <div class="mb-3">
                    <label>Category Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-success">
                    Save Category
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>

@include('admin.partials.footer')