<x-layout.app>
    @push('title', 'Catalog pages')

    <div class="container-fluid">
        <x-messages.flash-messages />

        <div class="row mb-4">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="You can search for multiple instances of each search criteria by comma seperating them. Eg. if you select page IDs you can enter the following 1,2,3,4,5">
                <i class="far fa-question-circle"></i>
            </div>

            <div class="input-group d-flex justify-content-between">
                <form action="{{ route('catalog-page.search') }}" method="GET">
                    <div class="d-block d-md-flex">
                        <div class="col-12 col-lg-4">
                            <select class="form-control" name="sort_by">
                                <option value="page_ids">Page IDs</option>
                                <option value="parent_ids">Parent IDs</option>
                                <option value="captions">Captions</option>
                                <option value="page_layouts">Page layouts</option>
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

                <form action="{{ route('catalog-pages.rcon-update') }}" method="POST" class="mr-2">
                    @csrf

                    <x-elements.danger-button>
                        {{ __('Update catalog (RCON)') }}
                    </x-elements.danger-button>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between">
                <p class="text-primary m-0 font-weight-bold">{{ __('Catalog pages list') }}</p>

                <a href="{{ route('catalog-pages.create') }}" class="font-weight-bold">
                    Create catalog page
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Parent ID') }}</th>
                            <th>{{ __('Caption save') }}</th>
                            <th>{{ __('Caption') }}</th>
                            <th>{{ __('Page layout') }}</th>
                            <th>{{ __('Icon') }}</th>
                            <th>{{ __('Min rank') }}</th>
                            <th>{{ __('Order num') }}</th>
                            <th>{{ __('Visible') }}</th>
                            <th>{{ __('Enabled') }}</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->parent_id }}</td>
                                    <td>{{ $page->caption_save }}</td>
                                    <td>{{ $page->caption }}</td>
                                    <td>{{ $page->page_layout }}</td>
                                    <td>{{ $page->icon_image }}</td>
                                    <td>{{ $page->min_rank }}</td>
                                    <td>{{ $page->order_num }}</td>
                                    <td>{{ $page->visible }}</td>
                                    <td>{{ $page->enabled }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission('manage_catalog_pages'))
                                                <a href="{{ route('catalog-pages.edit', $page) }}">
                                                    <x-elements.primary-button tooltip-text="{{ __('Edit page') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </x-elements.primary-button>
                                                </a>
                                            @endif

                                            @if(hasPermission('delete_catalog_pages'))
                                                <form class="ml-2" id="deletePageForm" action="{{ route('catalog-pages.delete', $page) }}" method="POST"  onSubmit="return confirm('Are you sure you want to delete this catalog page?');">
                                                    @method('DELETE')
                                                    @csrf

                                                    <x-elements.danger-button tooltip-text="Delete page">
                                                        <i class="fas fa-trash"></i>
                                                    </x-elements.danger-button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $pages->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>