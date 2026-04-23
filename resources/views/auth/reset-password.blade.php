@include('customer.partial.header')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="text-center mb-3 font-weight-bold">
                        Reset Password
                    </h4>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $request->email) }}"
                                   required
                                   autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>

                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block">
                            Reset Password
                        </button>

                        <!-- Back to login -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">
                                Back to Login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')