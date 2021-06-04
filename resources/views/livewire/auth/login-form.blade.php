<div>
    @section('title', 'Login')
    <h2 class="text-center mb-5">Login</h2>
    @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session()->get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
            </button>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
            </button>
        </div>
    @endif
    <form wire:submit.prevent="login()">
        <div class="row">
            <div class="col-12 my-2">
                <div class="input-wrap">
                    <input type="email" placeholder="Your e-mail address" wire:model.lazy="email" required>
                    <i class="far fa-envelope"></i>
                </div>
            </div>
            <div class="col-12 my-2">
                <div class="input-wrap">
                    <input type="password" placeholder="Your password" wire:model.lazy="password" required>
                    <i class="far fa-lock"></i>
                </div>
            </div>
            <div class="col-12 my-2">
                <div class="row input-wrap">
                    <label for="remember_me" class="col-8">Remember me</label>
                    <div class="col-4">
                        <input type="checkbox" wire:model="remember_me" class="form-checkbox-input" id="remember_me">
                    </div>
                </div>
            </div>
            <div class="col-12 my-2 text-center">
                <button type="submit" class="btn btn-warning filled-btn btn-block">Sing In
                </button>
            </div>

            <div class="col-12 my-2 text-center">
                <a href="{{route('reset-password')}}" class="h5">Forgot your password?</a>
            </div>

            <div class="col-12 my-4">
                <h5 class="">Don't have a free account yet?</h5>
                <a href="{{route('register')}}" class="btn btn-outline-warning btn-block">Sing
                    up now</a>
            </div>
        </div>
    </form>
</div>
