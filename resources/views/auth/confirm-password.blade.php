@include('customer.partial.header')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="text-center mb-3 font-weight-bold">
                        Confirm Password
                    </h4>

                    <p class="text-muted text-center mb-4">
                        This is a secure area. Please confirm your password before continuing.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required
                                   autocomplete="current-password">

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block">
                            Confirm
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')