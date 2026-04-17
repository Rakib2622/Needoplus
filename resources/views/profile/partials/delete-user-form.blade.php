<section>
    <h4 class="mb-3 font-weight-bold text-danger">Delete Account</h4>
    <p class="text-muted mb-4">
        Once your account is deleted, all data will be permanently removed.
    </p>

    <!-- Button trigger modal -->
    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
        Delete Account
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p>Enter your password to confirm account deletion.</p>

                        <input type="password" name="password" class="form-control" placeholder="Password">

                        @error('password', 'userDeletion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-danger">
                            Delete Account
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>