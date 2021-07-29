<div class="py-3">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h4">Your Messages</h1>
    </div>
    <div class="">
        <input type="search" wire:model="needle" id="needle" class="form-control">
    </div>
    <div class="list-group list-group-flush border-bottom mt-3">
        @foreach ($users as $user)
        <a href="{{ route('users.messages.index', $user) }}"
            class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">{{ $user->name }}</strong>
                <small>{{ $user->phone }}</small>
            </div>
            <div class="col-10 mb-1 small">{{ $user->email }}</div>
        </a>
        @endforeach
    </div>

    <div class="d-flex justify-content-center p-3">
        {{ $users->links() }}
    </div>
</div>