
<style>

/* LINKS */
.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    transition: all 0.25s ease;
}

.footer-links a:hover {
    color: #fff;
    padding-left: 6px;
    text-decoration: none;
}

/* SOCIAL BUTTONS */
.social-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    color: #fff;
    margin-right: 8px;
    transition: all 0.3s ease;
}

.social-btn:hover {
    background: #fff;
    color: #53c3d2;
    transform: translateY(-3px);
}

/* SMOOTH LOOK */


</style>

<!-- Footer Start -->

<div class="container-fluid position-relative bg-primary mt-5 pt-5"
     style="color:#fff;">

    <!-- TOP -->
    <div class="row px-xl-5 pb-4">

        <!-- BRAND -->
        <div class="col-lg-4 col-md-6 mb-4">

            <a href="{{ route('home') }}"
               class="d-flex align-items-center text-decoration-none mb-3">

                <img src="{{ asset('assets/img/logg.png') }}" style="height:50px;">

                    <span class="silver-text">NEEDO+</span>
            
            </a>

            <p style="font-size:14px; opacity:.9; line-height:1.6;">
                Needo+ is a modern eCommerce platform in Bangladesh delivering quality
                products with fast service and trusted customer support.
            </p>

            <div class="mt-3" style="font-size:14px; opacity:.95;">
                <p class="mb-1"><i class="fa fa-map-marker-alt mr-2"></i> Rayerbag, Dhaka</p>
                <p class="mb-1"><i class="fa fa-phone-alt mr-2"></i> 01886699757</p>
                <p class="mb-0"><i class="fab fa-whatsapp mr-2"></i> WhatsApp Available</p>
            </div>

        </div>

        <!-- QUICK LINKS -->
        <div class="col-lg-2 col-md-6 mb-4">

            <h6 class="mb-3 text-light font-weight-bold" style="letter-spacing:1px;">Quick Links</h6>

            <ul class="list-unstyled footer-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Shop</a></li>
                <li><a href="{{ route('packages.index') }}">Packages</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
            </ul>

        </div>

        <!-- SUPPORT -->
        <div class="col-lg-3 col-md-6 mb-4">

            <h6 class="mb-3 text-light font-weight-bold" style="letter-spacing:1px;">Support</h6>

            <ul class="list-unstyled footer-links">
                <li><a href="{{ route('settings.help') }}">Help & Support</a></li>
                <li><a href="{{ route('settings.privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('settings.return') }}">Return Policy</a></li>
                <li><a href="{{ route('settings.warranty') }}">Warranty</a></li>
                <li><a href="{{ route('terms') }}">FAQs</a></li>
            </ul>

        </div>

        <!-- SOCIAL -->
        <div class="col-lg-3 col-md-6 mb-4">

            <h6 class="mb-3 text-light font-weight-bold" style="letter-spacing:1px;">Connect</h6>

            <div class="d-flex mb-3">

                <a href="https://www.facebook.com/needoplus" target="_blank"
                   class="social-btn"><i class="fab fa-facebook-f"></i></a>

                <a href="https://www.instagram.com/needoplus757/" target="_blank"
                   class="social-btn"><i class="fab fa-instagram"></i></a>

                <a href="https://www.linkedin.com/company/needoplus/" target="_blank"
                   class="social-btn"><i class="fab fa-linkedin-in"></i></a>

                <a href="https://www.youtube.com/@NeedoPlus" target="_blank"
                   class="social-btn"><i class="fab fa-youtube"></i></a>

            </div>

            <p style="font-size:13px; opacity:.9;">
                Follow us for updates, offers and new arrivals.
            </p>

        </div>

    </div>

    <!-- DIVIDER -->
    <div style="height:1px; background:rgba(255,255,255,0.2);"></div>

    <!-- BOTTOM -->
    <div class="row px-xl-5 py-3">

        <div class="col-md-6 text-center text-md-left">
            <p class="mb-0" style="font-size:13px; opacity:.9;">
                &copy; {{ date('Y') }} <strong>Needo+</strong>. All rights reserved.
            </p>
        </div>

        <div class="col-md-6 text-center text-md-right">
            <small style="opacity:.9;">Made in Bangladesh 🇧🇩</small>
        </div>

    </div>

</div>
<!-- Footer End -->
<!-- Footer End -->


<!-- Back to Top -->
 <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


 @include('customer.partial.scripts')
 </body>

 </html>