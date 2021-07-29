@props(['label', 'users'])

<div wire:ignore.self class="modal fade" tabindex="-1" id="let-room-modal">
    <div class="modal-dialog">
        <form wire:submit.prevent="letRoom" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Let Room</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>You will be letting the room <strong>{{ $label }}</strong> to the user you select</p>

                <div class="mt-3">
                    <label class="form-label" for="user">User</label>
                    <select wire:model="user_id" id="user" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="" selected>Select User</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-outline-dark">Nevermind</button>
                <button class="btn btn-dark">Complete</button>
            </div>
        </form>
    </div>
</div>