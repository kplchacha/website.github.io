@props(['name' => null, 'label' => null])

<div wire:ignore.self class="modal fade" id="revoke-tenancy-modal" tabindex="-1">
    <div class="modal-dialog">
        <form wire:submit.prevent="revokeTenancy" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Revoking Tenancy</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are sure you want to revoke <strong>{{ $name ?? 'N/A' }}</strong> tenancy, from room
                    <strong>{{ $label ?? 'N/A' }}</strong>?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>