<div>

    <div class="table-responsive">

        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Room Label</th>
                    <th>Since</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @if ($tenancies->count())
                @foreach ($tenancies as $tenancy)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tenancy->user->name }}</td>
                    <td>{{ $tenancy->user->phone }}</td>
                    <td>{{ $tenancy->room->label }}</td>
                    <td>{{ $tenancy->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('tenants.show', $tenancy) }}" class="btn btn-sm btn-dark">View More</a>
                        @if (optional(Auth::user())->isAdmin())
                        <button wire:click="showRevokeTenancyModal({{ $tenancy }})" class="btn btn-sm btn-danger">Revoke
                            Tenancy</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">The property has not tenants yet!!</td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>

    <x-modals.tenancies.revoke :name="$name" :label="$label" />
</div>