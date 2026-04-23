@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h3 class="mb-4 font-weight-bold">
                        ⚙️ Settings
                    </h3>

                    <div class="list-group">

                        {{-- =========================
                            ACCOUNT SECTION (ONLY AUTH USER)
                        ========================= --}}
                        @auth

                        <h6 class="text-muted mt-2 mb-2">ACCOUNT</h6>

                        <a href="{{ route('profile.index') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-user mr-2"></i> Profile Information</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <a href="{{ route('settings.account') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-lock mr-2"></i> Account Settings</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="dropdown-divider"></div>

                        @endauth


                        {{-- =========================
                            GENERAL POLICIES (ALL USERS)
                        ========================= --}}

                        <h6 class="text-muted mt-3 mb-2">POLICIES</h6>

                        <a href="{{ route('settings.privacy') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>📄 Privacy Policy</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <a href="{{ route('settings.return') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>↩️ Return Policy</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <a href="{{ route('settings.warranty') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>🛠️ Warranty Policy</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="dropdown-divider"></div>


                        {{-- =========================
                            SUPPORT (ALL USERS)
                        ========================= --}}

                        <h6 class="text-muted mt-3 mb-2">SUPPORT</h6>

                        <a href="{{ route('settings.help') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>❓ Help & Support</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>

                        <a href="{{ route('settings.report') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>⚠️ Report a Problem</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>


                        {{-- =========================
                            DANGER ZONE (ONLY AUTH)
                        ========================= --}}
                        @auth

                        <div class="dropdown-divider"></div>

                        <h6 class="text-muted mt-3 mb-2">DANGER ZONE</h6>

                        <form method="POST" action="{{ route('profile.destroy') }}"
                            onsubmit="return confirm('Are you sure you want to delete your account? This action is permanent.')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="list-group-item list-group-item-action text-danger d-flex justify-content-between align-items-center w-100">
                                <span><i class="fa fa-trash mr-2"></i> Delete Account</span>
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </form>

                        @endauth

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')