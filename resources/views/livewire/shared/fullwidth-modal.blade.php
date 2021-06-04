<div>
@if($isOpen)
    <!-- Modal -->
        <div class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
            <div class="modal-dialog mw-100 w-100 h-100 p-0 m-0">
                <div class="modal-content h-100 overflow-auto border-0">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-bold ml-lg-5">{{$title}}</h5>
                        <button type="button" wire:click="closeModal()" class="close"
                                data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire($content, $data)
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
