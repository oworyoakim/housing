<div>
    @section('title', 'Password Reset')
    <h2 class="text-center mb-5">Reset Your Password</h2>
    <div class="mb-2">Forgot your password? No problem. Just let us know your email address and we will email you a
        password reset link that you will use to choose a new one.
    </div>
    <form wire:submit.prevent="resetPassword()">
        <div class="row">
            <div class="col-12 my-2">
                <div class="input-wrap">
                    <input type="email" placeholder="Your e-mail address"
                           wire:model.lazy="email" required>
                    <i class="far fa-envelope"></i>
                </div>
            </div>
            <div class="col-12 my-2 text-center">
                <button type="submit" class="btn btn-warning filled-btn btn-block">
                    Send Password Reset Link
                </button>
            </div>
        </div>
    </form>
</div>
