@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header Start -->
<!-- <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">FAQs</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">FAQs</p>
        </div>
    </div>
</div> -->
<!-- Page Header End -->

<!-- FAQ Start -->
<div class="container-fluid pt-5">

    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">সাধারণ জিজ্ঞাসা (FAQs)</span>
        </h2>
    </div>

    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-9">

            <!-- FAQ ITEMS -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h5>১. আমি কিভাবে অর্ডার করবো?</h5>
                    <p>
                        Add to Cart করে Checkout করলে অর্ডার সম্পন্ন হবে।
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h5>২. ডেলিভারি কত দিনে হয়?</h5>
                    <p>
                        সাধারণত ২-৫ কর্মদিবসের মধ্যে ডেলিভারি সম্পন্ন হয়।
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h5>৩. ক্যাশ অন ডেলিভারি আছে কি?</h5>
                    <p>
                        হ্যাঁ, সারা বাংলাদেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।
                    </p>
                </div>
            </div>

            <!-- SUPPORT SECTION -->
            <div class="card border-0 shadow-sm mb-3 bg-light">
                <div class="card-body">

                    <h5 class="mb-3">📞 আরও সাহায্য দরকার?</h5>

                    <p class="mb-2">
                        দ্রুত সাপোর্টের জন্য আমাদের সাথে যোগাযোগ করুন:
                    </p>

                    <a href="https://wa.me/8801886699757" target="_blank" class="btn btn-success btn-sm mb-2">
                        💬 WhatsApp এ মেসেজ করুন
                    </a>

                    <a href="https://www.facebook.com/needoplus" target="_blank" class="btn btn-primary btn-sm mb-2">
                        📘 Facebook Inbox
                    </a>

                    <div class="mt-2">
                        <a href="{{ route('settings.help') }}" class="text-dark d-block">
                            ➜ Help & Support বিস্তারিত জানুন
                        </a>

                        <a href="{{ route('settings.report') }}" class="text-dark d-block">
                            ➜ সমস্যা রিপোর্ট করুন
                        </a>

                        <a href="{{ route('settings.return') }}" class="text-dark d-block">
                            ➜ Return Policy দেখুন
                        </a>

                        <a href="{{ route('settings.warranty') }}" class="text-dark d-block">
                            ➜ Warranty Policy দেখুন
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- FAQ End -->

@include('customer.partial.footer')