<div>
    <div class="d-flex justify-content-between align-items-center py-3">
        <h1 class="h4"> {{ $user->name }} Messages</h1>
        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-message-modal">
            <div class="d-inline-flex">
                <span><i class="fa fa-plus"></i></span>
                <span class="ms-1">Message</span>
            </div>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Sent</th>
                    <th>Read?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">{{ $messages->links() }}</td>
                </tr>
            </tfoot>
            <tbody>
                @if ($messages->count())
                @foreach ($messages as $message)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->sender->name }}</td>
                    <td>{{ $message->recipient->name }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ optional($message->read_at)->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <div class="d-inline-flex">
                            <button wire:click="read({{ $message }})" class="btn btn-sm btn-dark">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-eye"></i></span>
                                    <span class="ms-1">Read</span>
                                </div>
                            </button>
                            <button wire:click="delete({{ $message }})" class="btn btn-sm btn-danger ms-2">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-trash-alt"></i></span>
                                    <span class="ms-1">Delete</span>
                                </div>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">No messages sent or received yet</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modals.messages.upsert />
    <x-modals.messages.read :content="$content" />
</div>

@push('scripts')
<script>
    const upsertMessageModal = new bootstrap.Modal(document.getElementById('upsert-message-modal'))
    const readMessageModal = new bootstrap.Modal(document.getElementById('read-message-modal'))

    livewire.on('hide-upsert-message-modal', event => upsertMessageModal.hide())

    livewire.on('show-read-message-modal', event => readMessageModal.show())
</script>    
@endpush