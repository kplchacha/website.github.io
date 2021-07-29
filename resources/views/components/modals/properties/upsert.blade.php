@props(['propertyId', 'users', 'location', 'locationKeys'])

<div wire:ignore.self class="modal fade" id="upsert-property-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                @if ($propertyId)
                <h5 class="modal-title fw-bold">Edit Property</h5>
                @else
                <h5 class="modal-title fw-bold">Add Property</h5>
                @endif
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="">
                    <label for="name" class="fw-bold form-label">Name</label>
                    <input type="text" wire:model.lazy="name" id="name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mt-2">
                    <label for="userId" class="fw-bold form-label">Owner</label>
                    <select wire:model="user_id" id="user_id"
                        class="form-select @error('user_id') is-invalid @enderror">
                        <option value="" selected>Select Owner...</option>
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

                <fieldset class="mt-2" id="location">
                    <label for="location" class="fw-bold form-label">Location</label>

                    @foreach ($location as $index => $item)
                    <div class="row align-items-center">

                        <div class="col-md-5 mt-2">
                            <input class="form-control @error('location.' . $index . '.key') is-invalid @enderror"
                                list="locations-{{ $index }}" placeholder="Key..."
                                wire:model.lazy="location.{{ $index }}.key">
                            <datalist id="locations-{{ $index }}">
                                @foreach ($locationKeys as $locationKey)
                                <option value="{{ $locationKey }}" />
                                @endforeach
                            </datalist>
                            @error('location.' . $index . '.key')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-5 mt-2">
                            <input class="form-control @error('location.' . $index . '.value') is-invalid @enderror"
                                type="text" placeholder="Value..." wire:model.lazy="location.{{ $index }}.value">
                            @error('location.' . $index . '.value')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2 mt-2">
                            <button wire:click="removeLocationItem({{ $index }})" class="btn btn-sm btn-warning">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12 pt-2">
                        <button wire:click="addLocationItem" class="btn btn-sm btn-dark">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </fieldset>

                <div class="mt-2">
                    <label for="description" class="fw-bold form-label">Description</label>
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

                @if ($propertyId)
                <button wire:click="updateProperty" class="btn btn-dark">Update</button>
                @else
                <button wire:click="createProperty" class="btn btn-dark">Submit</button>
                @endif  
            </div>
        </div>
    </div>
</div>