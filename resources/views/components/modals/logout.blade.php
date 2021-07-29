<div class="modal fade" tabindex="-1" role="dialog" id="logout-modal" aria-labelledby="logout-modal-title"
    aria-hidden="true">
    <form action="{{ route('logout') }}" method="POST" class="modal-dialog" role="form">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logout-modal-title">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to sign out of the application, your current session will be destroy with all
                    the session saved items ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </div>
    </form>
</div>