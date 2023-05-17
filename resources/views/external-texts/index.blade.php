<x-layout.app>
    @push('title', 'External Texts')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Manage external texts') }}</h3>

        <div class="row mb-4">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="You can search for multiple instances of each search criteria by comma seperating them. Eg. if you select page IDs you can enter the following 1,2,3,4,5">
                <i class="far fa-question-circle"></i>
            </div>

            <div class="input-group d-flex justify-content-between">
                <form action="{{ route('external-texts.index') }}" method="GET">
                    <div class="d-block d-md-flex">
                        <div class="col-12 col-lg-4">
                            <select class="form-control" name="sort_by">
                                <option value="key">{{__('Key')}}</option>
                                <option value="value">{{__('Value')}}</option>
                            </select>
                        </div>

                        <div class="input-group col-12 col-lg-10">
                            <div class="form-outline">
                                <input style="width: 300px;" type="search" name="criteria" placeholder="Enter your search criteria" class="form-control">
                            </div>

                            <button type="submit" class="ml-2 btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                                    <a href="{{route('external-texts.edit', $text)}}">
                                        <x-elements.primary-button tooltip-text="{{ __('Edit text') }}">
                                            <i class="fas fa-edit"></i>
                                        </x-elements.primary-button>
                                    </a>
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
