<div>
    @section('title', 'Email Verification Required')
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Hello {{auth()->user()->name}},</h2>
        </div>
        <div class="col-12">
            <div class="text-warning text-center"><i class="fa fa-handshake-alt fa-5x"></i></div>
            <div class="h5">We're excited to have you get started with managing your properties and reservations.</div>
            <div class="h5">However, the service you were trying to access requires that you verify your email address
                before continuing.
            </div>
            <div class="h5">A verification link was sent to the email address that you registered with but it could have
                expired by now.
            </div>
            <div class="h5">But don't worry about it, we have got your back. Just press the button below to resend the
                verification link to your registered email address.
            </div>
            <div class="text-center my-4">
                <a href="javascript:void(0);" wire:click="resendVerificationEmail"
                   class="btn btn-warning btn-block filled-btn">Resend Verification Link</a>
            </div>
            <div class="h5">If you are not ready to do this now, press the button below to return to home page.</div>
            <div class="text-center my-4">
                <a href="{{route('home')}}" class="btn btn-outline-warning btn-block">Take Me Back Home</a>
            </div>
        </div>
    </div>
</div>
