<div class="card elevation-2">
    <div class="card-body">
        <div class="login-logo">
            <h2><b>Housing</b></h2>
            <h5>(Administrator Authorization)</h5>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session()->get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        @endif
        <form wire:submit.prevent="login()">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-user"></span>
                    </div>
                </div>
                <input type="text"
                       wire:model.lazy="email"
                       placeholder="Email address"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </div>
                </div>
                <input type="password"
                       wire:model.lazy="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password">
                @error('password')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" wire:loading.class="disabled">
                    <span wire:loading wire:target="login" class="fa fa-spinner fa spin"></span>
                    <span wire:loading.remove>Login</span>
                </button>
            </div>
        </form>
    </div>
</div>
