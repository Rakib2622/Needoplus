@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Title -->
        <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
            <h2 class="font-weight-bold">Edit Profile</h2>

            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                Back to Profile
            </a>
        </div>

        <div class="col-lg-12">

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Image -->
                        <div class="form-group text-center mb-4">

                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                     class="rounded-circle mb-3"
                                     style="width:120px;height:120px;object-fit:cover;">
                            @else
                                <i class="fa fa-user-circle" style="font-size:120px;"></i>
                            @endif

                            <input type="file" name="profile_photo" class="form-control mt-3">
                            @error('profile_photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email (READ ONLY) -->
                        <div class="form-group mb-3">
                            <label>Email (cannot be changed)</label>
                            <input type="email" class="form-control"
                                   value="{{ $user->email }}" readonly>
                        </div>

                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Referral Code (READ ONLY) -->
                        <div class="form-group mb-3">
                            <label>Referral Code</label>
                            <input type="text" class="form-control"
                                   value="{{ $user->referral_code }}" readonly>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-primary">
                            Save Changes
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')