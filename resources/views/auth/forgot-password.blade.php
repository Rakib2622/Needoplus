@include('customer.partial.header')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="text-center mb-3 font-weight-bold">
                        Forgot Password
                    </h4>

                    <p class="text-muted text-center mb-4">
                        No problem. Enter your email and we will send you a password reset link.
                    </p>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group">
                            <label>Email Address</label>
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

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block">
                            Email Password Reset Link
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