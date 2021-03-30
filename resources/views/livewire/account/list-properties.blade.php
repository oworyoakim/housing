<div>
    @section('title', 'Manage Properties')
    <div class="row">
        @forelse($properties as $property)
            <div class="col-lg-4 md-6">
                @livewire('account.property-card', ['property' => $property])
            </div>
        @empty
            <div class="col-md-12">
                <div class="h2 my-2">You do not have any properties added to your account.</div>
                <div class="h2 my-2">To create your properties, click the plus button at the bottom to get started!</div>
                <div class="text-center text-warning">
                    <i class="fa fa-arrow-down fa-5x"></i>
                </div>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="mt-5">
                {{ $properties->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <a href="{{route('create-property')}}" class="btn-float">
        <i class="fa fa-plus btn-float-icon"></i>
    </a>
</div>
