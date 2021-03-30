<div>
    <section class="auth-form gird-view section-bg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                @include('auth.header')
                @include('page-welcome-message', ['message' => 'Sign in to post or book a room!'])
                @if (session()->has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session()->get('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                            <div class="input-wrap">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" wire:model="remember_me">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <button type="submit" class="btn btn-warning filled-btn btn-block">Sing In</button>
                        </div>

                        <div class="col-12 my-2 text-center">
                            <a href="{{route('reset-password')}}" class="h5">Forgot your password?</a>
                        </div>

                        <div class="col-12 my-4">
                            <h5 class="">Don't have a free account yet?</h5>
                            <a href="{{route('register')}}" class="btn btn-outline-warning btn-block">Sing up now</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>
