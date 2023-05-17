<x-layout.app>
    @push('title', 'Create external text')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Create external text') }}</h3>
        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Create external text') }}</p>
                            </div>
                            <div class="card-body">
                                <form action="{{route('external-texts.store')}}" method="POST">
                                    @method('POST')
                                    @csrf

                                    <div class="form-row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="caption">
                                                    <strong>{{__('Key')}}</strong>
                                                </label>

                                                <x-form.input name="key" type="text" value="{{ old('key', $text->key) }}" placeholder="{{ __('Key') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="caption">
                                                    <strong>{{__('Value')}}</strong>
                                                </label>

                                                <x-form.input name="value" type="text" value="{{ old('value', $text->value) }}" placeholder="{{ __('Value') }}"/>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            {{ __('Create text') }}
                                        </x-elements.primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
