<section>
    <h4 class="mb-3 font-weight-bold">Profile Information</h4>
    <p class="text-muted mb-4">Update your account's profile information and email address.</p>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email Verification -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mb-3">
                <p class="text-warning">Your email is not verified.</p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">
                        Resend Verification Email
                    </button>
                </form>

                @if (session('status') === 'verification-link-sent')
                    <small class="text-success">Verification link sent!</small>
                @endif
            </div>
        @endif

        <button class="btn btn-primary">Save Changes</button>

        @if (session('status') === 'profile-updated')
            <span class="text-success ml-2">Saved!</span>
        @endif
    </form>
</section>