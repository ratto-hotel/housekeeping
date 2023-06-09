<x-layout.app>
    @push('title', 'Badges')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Manage badges') }}</h3>

        <x-messages.flash-messages/>

        <div class='card mb-2'>
            <div class='card-body'>
                <form action="{{ route('manage-badges.create') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="input-group mb-3">
                        <input name="image" id="image" type="file"
                               class="form-control @error('file') is-invalid @enderror">
                        <div class="input-group-append">
                            <x-elements.primary-button tooltip-text="{{ __('Create badge') }}">
                                <i class="fas fa-send"></i>
                            </x-elements.primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">{{ __('Badges') }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                     aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Username') }}</th>
                            <th>{{ __('Badge') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($badges as $badge)
                            <tr>
                                <td class="d-flex overflow-hidden" style="height: 50px;">
                                    <img class="avatar"
                                         src="{{ setting('avatar_imager') }}{{ $badge->user?->look }}&direction=2&headonly=1&head_direction=2&gesture=sml"
                                         alt="">
                                    {{ $badge->user?->username }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <img
                                            src="https://www.rattohotel.com/swf/c_images/Album1584/{{ $badge->badge_imaging }}"
                                            height="32" width="32"/>
                                        @if ($badge->status === 'accept')
                                            <x-form.input name="badge-code" disabled="1"
                                                          value="{{ str_replace('.gif', '',$badge->badge_imaging) }}"/>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ __('badge_status.' . $badge->status) }}</td>
                                <td>
                                    <div class="btn-group" role="group">

                                        @if ($badge->status === 'open')
                                            <form class="ml-2" action="{{ route('manage-badges.accept', $badge) }}"
                                                  method="POST" onSubmit='confirmDelete("confirmBadgeAccept");'
                                                  onSubmit="return confirm('{{ __('Are you sure you want to accept this badge?') }}');">
                                                @method('PUT')
                                                @csrf

                                                <x-elements.success-button tooltip-text="{{ __('Approve badge') }}">
                                                    <i class="fas fa-check"></i>
                                                </x-elements.success-button>
                                            </form>
                                        @endif
                                        <form class="ml-2" action="{{ route('manage-badges.delete', $badge) }}"
                                              method="POST" onSubmit='confirmDelete("confirmBadgeDelete");'
                                              onSubmit="return confirm('{{ __('Are you sure you want to delete this badge?') }}');">
                                            @method('DELETE')
                                            @csrf

                                            <x-elements.danger-button tooltip-text="{{ __('Delete badge') }}">
                                                <i class="fas fa-trash"></i>
                                            </x-elements.danger-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $badges->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
