@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">About Us</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">About Us</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- About Start -->
<div class="container-fluid pt-5">

    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">আমাদের সম্পর্কে</span>
        </h2>
    </div>

    <div class="row px-xl-5">

    <!-- CONTACT FORM (LEFT on desktop, BOTTOM on mobile) -->
    <div class="col-lg-6 mb-5 order-2 order-lg-1">

        <div class="contact-form">

            <h5 class="font-weight-semi-bold mb-3">📩 আমাদের মেসেজ পাঠান</h5>

            <div id="success"></div>

            <form>

                <div class="control-group mb-3">
                    <input type="text" class="form-control" placeholder="আপনার নাম" required>
                </div>

                <div class="control-group mb-3">
                    <input type="text" class="form-control" placeholder="ফোন নাম্বার" required>
                </div>

                <div class="control-group mb-3">
                    <input type="text" class="form-control" placeholder="বিষয়">
                </div>

                <div class="control-group mb-3">
                    <textarea class="form-control" rows="6" placeholder="আপনার বার্তা লিখুন"></textarea>
                </div>

                <button class="btn btn-info py-2 px-4" type="submit">
                    Send Message
                </button>

            </form>

        </div>

    </div>


    <!-- COMPANY INFO (RIGHT on desktop, TOP on mobile) -->
    <div class="col-lg-6 mb-5 order-1 order-lg-2">

        <h5 class="font-weight-semi-bold mb-3">🏢 Needo+ সম্পর্কে</h5>

        <p>
            Needo+ একটি আধুনিক ই-কমার্স প্ল্যাটফর্ম যা বাংলাদেশে মানসম্মত প্রোডাক্ট,
            দ্রুত ডেলিভারি এবং বিশ্বস্ত সেবা প্রদান করার জন্য কাজ করছে।
        </p>

        <hr>

        <h6 class="font-weight-semi-bold">📍 ঠিকানা</h6>
        <p>#1752 Janotabag, Rayerbag, Dhaka, Bangladesh, 1362</p>

        <h6 class="font-weight-semi-bold">📞 যোগাযোগ</h6>
        <p>01886699757 (WhatsApp Available)</p>

        <hr>

        <h6 class="font-weight-semi-bold">🔗 সোশ্যাল মিডিয়া</h6>

        <div class="d-flex align-items-center" style="gap: 12px; font-size: 22px;">

            <a href="https://www.facebook.com/needoplus" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>

            <a href="https://www.instagram.com/needoplus757/" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="https://www.linkedin.com/company/needoplus/" target="_blank">
                <i class="fab fa-linkedin"></i>
            </a>

            <a href="https://www.youtube.com/@NeedoPlus" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>

        </div>

        <hr>

        <p class="text-muted small">
            আমরা গ্রাহকের সন্তুষ্টি, দ্রুত সার্ভিস এবং সঠিক প্রোডাক্ট ডেলিভারিকে সর্বোচ্চ গুরুত্ব দিই।
        </p>

    </div>

</div>
</div>
<!-- About End -->

@include('customer.partial.footer')