@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Page Title -->
        <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
            <h2 class="font-weight-bold">My Profile</h2>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                Edit Profile
            </a>
        </div>

        <!-- Profile Card -->
        <div class="col-lg-12">

            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <div class="row">

                        <!-- Profile Image -->
                        <div class="col-md-3 text-center">
                            @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                class="img-fluid rounded-circle mb-3"
                                style="width:120px;height:120px;object-fit:cover;">
                            @else
                            <i class="fa fa-user-circle" style="font-size:120px;"></i>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="col-md-9">

                            <h4>{{ auth()->user()->name }}</h4>
                            <p class="text-muted mb-2">
                                {{ auth()->user()->email }}
                            </p>

                            @if (!auth()->user()->hasVerifiedEmail())
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <button type="submit" class="btn btn-sm btn-dark text-white mb-2">
                                    Verify Email
                                </button>

                                <small class="text-danger d-block mt-1">
                                    Email not verified
                                </small>
                            </form>
                            @else
                            <span class="badge badge-success mb-2">
                                Email Verified ✔
                            </span>
                            @endif

                            <hr>

                            <p><strong>Phone:</strong> {{ auth()->user()->phone ?? 'Not set' }}</p>
                            <p><strong>Address:</strong> {{ auth()->user()->address ?? 'Not set' }}</p>

                            <!-- Referral Code -->
                            <p>
                                <strong>Referral Code:</strong>
                                <span class="badge badge-info">
                                    {{ auth()->user()->referral_code }}
                                </span>
                            </p>

                            <!-- Referral Link -->
                            <p>
                                <strong>Referral Link:</strong><br>

                                @php
                                $refLink = url('/register?ref=' . auth()->user()->referral_code);
                                @endphp

                                <input type="text"
                                    class="form-control form-control-sm mt-1"
                                    value="{{ $refLink }}"
                                    readonly
                                    onclick="this.select();">

                                <small class="text-muted">
                                    Click to copy your referral link
                                </small>
                            </p>

                            <!-- Referred By -->
                            <p>
                                <strong>Referred By:</strong>
                                {{ auth()->user()->referrer->name ?? 'No referrer' }}
                            </p>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')