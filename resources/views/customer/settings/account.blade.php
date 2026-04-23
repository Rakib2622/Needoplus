@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    @if (session('status') === 'password-updated')
                    <div class="alert alert-success">
                        ✅ Password updated successfully
                    </div>
                    @endif

                    <h4 class="mb-4 font-weight-bold">🔐 Account Settings</h4>

                    <div id="settingsAccordion">


                        <!-- ===================== -->
                        <!-- PASSWORD -->
                        <!-- ===================== -->
                        <div class="card mb-3">
                            <div class="card-header bg-light" data-toggle="collapse" data-target="#passwordSection" style="cursor:pointer;">
                                <strong>Change Password</strong>
                            </div>

                            <div id="passwordSection" class="collapse" data-parent="#settingsAccordion">
                                <div class="card-body">

                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('PUT')

                                        <!-- Current Password -->
                                        <div class="form-group mb-3">
                                            <label>Current Password</label>
                                            <input type="password"
                                                name="current_password"
                                                class="form-control"
                                                required>

                                            @error('current_password', 'updatePassword')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- New Password -->
                                        <div class="form-group mb-3">
                                            <label>New Password</label>
                                            <input type="password"
                                                name="password"
                                                class="form-control"
                                                required>

                                            @error('password', 'updatePassword')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Confirm -->
                                        <div class="form-group mb-3">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                name="password_confirmation"
                                                class="form-control"
                                                required>
                                        </div>

                                        <button class="btn btn-warning btn-sm">
                                            Update Password
                                        </button>

                                        @if (session('status') === 'password-updated')
                                        <span class="text-success ml-2">Saved!</span>
                                        @endif
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- ===================== -->
                        <!-- DELETE -->
                        <!-- ===================== -->
                        <div class="card mb-3">
                            <div class="card-header bg-danger text-white" data-toggle="collapse" data-target="#deleteSection" style="cursor:pointer;">
                                <strong>Delete Account</strong>
                            </div>

                            <div id="deleteSection" class="collapse" data-parent="#settingsAccordion">
                                <div class="card-body">

                                    <form method="POST"
                                        action="{{ route('profile.destroy') }}"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password"
                                                name="password"
                                                class="form-control"
                                                required>
                                        </div>

                                        <button class="btn btn-danger btn-sm">
                                            Delete Account
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@include('customer.partial.footer')