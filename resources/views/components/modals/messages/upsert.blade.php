<div wire:ignore.self id="upsert-message-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Message</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <label class="form-label fw-bold" for="content">Content</label>
                    <textarea wire:model.lazy="content" id="content" cols="100" rows="4" class="form-control @error('content') is-invalid @endif">
                    </textarea>
                    @error('content')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                <button wire:click="create" class="btn btn-dark">Submit</button>
            </div>
        </div>
    </div>
</div>