@include('customer.partial.header')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4 font-weight-bold">
                        Login to Your Account
                    </h3>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

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

                        <!-- Remember Me -->
                        <div class="form-group form-check">
                            <input type="checkbox"
                                   name="remember"
                                   class="form-check-input"
                                   id="remember">

                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>

                        <!-- Forgot Password -->
                        <div class="text-center mt-3">
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <!-- Divider -->
                        <div class="text-center my-3 text-muted">
                            OR
                        </div>

                        <!-- Google Login -->
                        <a href="{{ route('google.login') }}"
                           class="btn btn-danger btn-block">
                            <i class="fab fa-google mr-2"></i>
                            Continue with Google
                        </a>

                        <!-- Register Link -->
                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}">
                                Don't have an account? Register
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')