@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 text-center">

                    <h3 class="mb-3 font-weight-bold">
                        Email Verification
                    </h3>

                    <p class="text-muted mb-4">
                        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed you.
                        If you didn’t receive it, you can request another one.
                    </p>

                    {{-- Success message --}}
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success">
                            A new verification link has been sent to your email.
                        </div>
                    @endif

                    {{-- Resend email --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button type="submit" class="btn btn-primary btn-block">
                            Resend Verification Email
                        </button>
                    </form>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger btn-block">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')