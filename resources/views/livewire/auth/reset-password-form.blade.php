<div>
    <section class="auth-form gird-view section-bg section-padding">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-8 offset-2">
                    @include('auth.auth-header')
                    @include('page-welcome-message', ['message' => "I don't blame you for being here!"])
                    <form wire:submit.prevent="resetPassword()">
                        <div class="row">
                            <div class="col-12 my-2">
                                <div class="input-wrap">
                                    <input type="email" placeholder="Your e-mail address" wire:model.lazy="email" required>
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="col-12 my-2 text-center">
                                <button type="submit" class="btn btn-warning filled-btn btn-block">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
