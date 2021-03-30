<div>
    <section class="auth-form gird-view section-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    @include('auth.header')
                    @include('page-welcome-message', ['message' => 'Create your free account now!'])
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
                    @if ($errors->any())
                        <div class="alert alert-danger  alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    @endif
                    <form wire:submit.prevent="register">
                        <div class="row">
                            <div class="col-12 my-1">
                                <div class="input-wrap">
                                    <input type="text" placeholder="Your full name" wire:model.lazy="name" required>
                                    <i class="far fa-user-alt"></i>
                                </div>
                                @error('name')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-1">
                                <div class="input-wrap">
                                    <input type="email" placeholder="Your e-mail address" wire:model.lazy="email"
                                           required>
                                    <i class="far fa-envelope"></i>
                                </div>
                                @error('email')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-1">
                                <div class="input-wrap">
                                    <input type="text"
                                           placeholder="Your phone number (country code required e.g +256xxxxxxxxx)"
                                           wire:model.lazy="phone_number" required>
                                    <i class="far fa-envelope"></i>
                                </div>
                                @error('phone_number')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-1">
                                <div class="input-wrap">
                                    <input type="password" placeholder="Your password ****" wire:model.lazy="password"
                                           required>
                                    <i class="far fa-lock"></i>
                                </div>
                                @error('password')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-1">
                                <h4>Sign up as?</h4>
                                <div class="row input-wrap">
                                    @foreach($account_types as $value => $text)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <label class="form-check-label"
                                                       for="account_type_{{$value}}">{{$text}}</label>
                                                <input class="form-check-input" type="radio" wire:model="account_type"
                                                       value="{{$value}}" id="account_type_{{$value}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($account_type == 'manager')
                                <div class="col-12 my-1">
                                    <div class="input-wrap">
                                        <input type="text"
                                               placeholder="Your business name"
                                               wire:model.lazy="business_name"
                                               required>
                                        <i class="far fa-building"></i>
                                    </div>
                                    @error('business_name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-12 my-1 text-center">
                                <button type="submit" class="btn btn-warning filled-btn btn-block">Register</button>
                            </div>

                            <div class="col-12 my-1">
                                <h5 class="">Already have a free account?</h5>
                                <a href="{{route('login')}}" class="btn btn-outline-warning btn-block">Sing In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
</div>
