@props(['roomId' => null])

<div wire:ignore.self class="modal fade" id="upsert-room-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if (boolval($roomId))
                <div class="modal-title">Update Room</div>
                @else
                <div class="modal-title">Add Room</div>
                @endif
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="label" class="form-label fw-bold">Label</label>
                    <input wire:model.lazy="label" type="text" id="label"
                        class="form-control @error('label') is-invalid @enderror">
                    @error('label')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="cost" class="form-label fw-bold">Cost</label>
                    <input wire:model.lazy="cost" type="number" step="0.01" id="cost"
                        class="form-control @error('cost') is-invalid @enderror">
                    @error('cost')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label fw-bold">Descrition</label>
                    <textarea wire:model.lazy="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                @if ($roomId)
                <button wire:click="updateRoom" class="btn btn-dark">Update</button>
                @else
                <button wire:click="createRoom" class="btn btn-dark">Submit</button>
                @endif
            </div>
        </div>
    </div>
</div>