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

            <div class="table-responsive">
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

                                {{-- IMAGE --}}
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             width="60"
                                             height="60"
                                             class="rounded border">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                {{-- NAME --}}
                                <td><strong>{{ $category->name }}</strong></td>

                                {{-- SLUG --}}
                                <td><small class="text-muted">{{ $category->slug }}</small></td>

                                {{-- DESCRIPTION --}}
                                <td>
                                    {{ Str::limit($category->description, 50) }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="text-end">

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

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
                                <td colspan="6" class="text-center text-muted py-3">
                                    No categories found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@include('admin.partials.footer')