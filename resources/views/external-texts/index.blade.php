<x-layout.app>
    @push('title', 'External Texts')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Manage external texts') }}</h3>

        <x-messages.flash-messages/>

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">{{ __('External texts') }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                     aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Key') }}</th>
                            <th>{{ __('Value') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($texts as $text)
                            <tr>
                                <td>{{ $text->key }}</td>
                                <td>{{ $text->value }}</td>
                                <td>
                                    <a href="{{route('external-texts.edit', $text)}}">{{__('Edit')}}</a>
                                    <form class="ml-2" action="{{ route('external-texts.delete', $text) }}"
                                          method="POST" onSubmit='confirmDelete("confirmBadgeDelete");'
                                          onSubmit="return confirm('{{ __('Are you sure you want to delete this badge?') }}');">
                                        @method('DELETE')
                                        @csrf

                                        <x-elements.danger-button tooltip-text="{{ __('Delete text') }}">
                                            <i class="fas fa-trash"></i>
                                        </x-elements.danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $texts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
