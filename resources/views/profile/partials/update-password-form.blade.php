<section>
    <h4 class="mb-3 font-weight-bold">Update Password</h4>
    <p class="text-muted mb-4">Use a strong password to keep your account secure.</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="form-group mb-3">
            <label>Current Password</label>
            <input type="password" name="current_password" class="form-control">
            @error('current_password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control">
            @error('password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
            @error('password_confirmation', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Update Password</button>

        @if (session('status') === 'password-updated')
            <span class="text-success ml-2">Saved!</span>
        @endif
    </form>
</section>