@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid pt-5">
    <div class="row justify-content-center px-xl-5">

        <div class="col-lg-6 col-md-8">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="text-center mb-4">
                        🎯 Complete Your Referral Setup
                    </h3>

                    <p class="text-center text-muted mb-4">
                        If someone referred you, enter their referral code below.<br>
                        You can also skip this step.
                    </p>

                    <!-- Referral Form -->
                    <form method="POST" action="{{ route('referral.store') }}">
                        @csrf

                        @php
                            $refCode = session('referral_code') ?? request()->get('ref');
                        @endphp

                        <div class="form-group">
                            <label><strong>Referral Code (Optional)</strong></label>

                            <input type="text"
                                   name="referral_code"
                                   class="form-control form-control-lg"
                                   placeholder="Enter referral code"
                                   value="{{ $refCode }}">
                        </div>

                        <div class="d-flex justify-content-between mt-4">

                            <!-- Skip -->
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                Skip for now
                            </a>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary">
                                Save & Continue
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')