@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📂 Categories</h3>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
    <div class="card-body">

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                         width="50" height="50"
                                         class="rounded border">
                                @endif
                            </td>

                            <td><strong>{{ $category->name }}</strong></td>

                            <td><small>{{ $category->slug }}</small></td>

                            <td>{{ Str::limit($category->description, 50) }}</td>

                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="d-md-none">
            @forelse($categories as $category)

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-2">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     width="50" height="50"
                                     class="rounded me-2">
                            @endif

                            <div>
                                <strong>{{ $category->name }}</strong><br>
                                <small class="text-muted">{{ $category->slug }}</small>
                            </div>
                        </div>

                        <p class="mb-2">
                            {{ Str::limit($category->description, 80) }}
                        </p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="btn btn-sm btn-warning w-50 me-1">Edit</a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST" class="w-50 ms-1">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            @empty
                <p class="text-center">No categories found</p>
            @endforelse
        </div>

    </div>
</div>

</div>

@include('admin.partials.footer')