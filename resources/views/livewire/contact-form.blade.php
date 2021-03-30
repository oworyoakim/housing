<div>
    <!-- Contact Form -->
    <section class="contact-form pb-2">
        <div class="container ">
            <div class="contact-form-wrap section-bg">
                <h2 class="form-title">Leave a Message</h2>
                <form wire:submit.prevent="saveMessage">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-wrap">
                                <input type="text" placeholder="Your Full Name" wire:model.lazy="name" required>
                                <i class="far fa-user-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrap">
                                <input type="email" placeholder="Your Email" wire:model.lazy="email" required>
                                <i class="far fa-envelope"></i>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-wrap text-area">
                                <textarea placeholder="Your message" wire:model.lazy="message" required></textarea>
                                <i class="far fa-pencil"></i>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning filled-btn btn-block">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
