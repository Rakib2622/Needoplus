@include('customer.partial.header')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4 font-weight-bold">
                        Create Account
                    </h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Referral Code -->
                        <!-- <div class="form-group">
                            <label>Referral Code (Optional)</label>

                            <input type="text"
                                   name="ref"
                                   class="form-control"
                                   value="{{ old('ref', request('ref')) }}"
                                   placeholder="Enter referral code">

                            @error('ref')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <small class="text-muted">
                                If someone invited you, enter their referral code.
                            </small>
                        </div> -->

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password</label>
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
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-info btn-block mt-3">
                            Register
                        </button>

                        <!-- Divider -->
                        <div class="text-center my-3 text-muted">
                            OR
                        </div>

                        <!-- Google Login -->
                        <a href="{{ route('google.login') }}"
                           class="btn btn-outline-danger btn-block">
                            <i class="fab fa-google mr-2"></i>
                            Continue with Google
                        </a>

                        <!-- Login -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">
                                Already have an account? Login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')