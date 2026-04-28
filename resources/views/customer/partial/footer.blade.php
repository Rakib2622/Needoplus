 <!-- Vendor Start -->

 <!-- Vendor End -->


 <!-- Footer Start -->
 <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
     <div class="row px-xl-5 pt-5">
         <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
             <a href="" class="text-decoration-none">
                 <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
             </a>
             <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
             <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
             <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
             <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
         </div>
         <div class="col-lg-8 col-md-12">
             <div class="row">
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                     <div class="d-flex flex-column justify-content-start">
                         <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                         <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                         <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                         <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                         <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                         <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                     </div>
                 </div>
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                     <div class="d-flex flex-column justify-content-start">
                         <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                         <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                         <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                         <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                         <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                         <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                     </div>
                 </div>
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                     <form action="">
                         <div class="form-group">
                             <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                         </div>
                         <div class="form-group">
                             <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                 required="required" />
                         </div>
                         <div>
                             <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="row border-top border-light mx-xl-5 py-4">
         <div class="col-md-6 px-xl-0">
             <p class="mb-md-0 text-center text-md-left text-dark">
                 &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                 by
                 <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                 Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
             </p>
         </div>
         <div class="col-md-6 px-xl-0 text-center text-md-right">
             <img class="img-fluid" src="{{ asset('assets/img/payments.png') }}" alt="">
         </div>
     </div>
 </div>
 <!-- Footer End -->


 <!-- Back to Top -->
 <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


 <!-- JavaScript Libraries -->
 <!-- 🔥 1. jQuery (ONLY ONCE) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

 <!-- 🔥 2. Bootstrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

 <!-- 🔥 3. Plugins -->
 <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
 <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

 <!-- 🔥 4. Contact scripts -->
 <script src="{{ asset('assets/mail/jqBootstrapValidation.min.js') }}"></script>
 <script src="{{ asset('assets/mail/contact.js') }}"></script>

 <!-- 🔥 5. Main JS (LAST) -->
 <script src="{{ asset('assets/js/main.js') }}"></script>



 <script>
     $(document).ready(function() {

         let currentPrice = 0;

         // 🔥 OPEN QUICK VIEW
         $(document).on('click', '.quick-view-btn', function() {

             let productId = $(this).data('id');

             $('#quickViewModal').modal('show');

             $('#qv-loading').show();
             $('#qv-content').hide();

             $.get('/product/quick-view/' + productId, function(data) {

                 // NAME
                 $('#qv-name').text(data.name);

                 // IMAGE
                 $('#qv-image').attr(
                     'src',
                     data.image ? data.image : '/assets/img/no-image.png'
                 );

                 // PRODUCT ID
                 $('#qv-product-id').val(data.id);

                 // PRICE
                 currentPrice = data.final_price ?? data.price;

                 if (data.final_price < data.price) {
                     $('#qv-price').html(
                         '<h5 class="text-danger d-inline">৳ ' + data.final_price + '</h5>' +
                         '<small class="text-muted ml-2"><del>৳ ' + data.price + '</del></small>'
                     );
                 } else {
                     $('#qv-price').html('<h5>৳ ' + data.price + '</h5>');
                 }

                 // STOCK
                 $('#qv-stock').html(
                     data.stock > 0 ?
                     '<span class="text-success">✔ In Stock</span>' :
                     '<span class="text-danger">✖ Out of Stock</span>'
                 );

                 // COLORS
                 let colorHtml = '';
                 if (data.colors && data.colors.length > 0) {
                     colorHtml += '<strong>Colors:</strong><br><div class="mt-2">';
                     data.colors.forEach(color => {
                         colorHtml += `
                        <span class="qv-color"
                            data-color="${color}"
                            style="width:25px;height:25px;border-radius:50%;
                                   background:${color};
                                   display:inline-block;margin-right:6px;
                                   border:2px solid #ddd;cursor:pointer;">
                        </span>`;
                     });
                     colorHtml += '</div><small id="qv-selected-color" class="text-muted"></small>';
                 }
                 $('#qv-colors').html(colorHtml);

                 // DESCRIPTION
                 $('#qv-description').html(data.description ?? 'No description available');

                 // RESET QTY
                 $('#qv-qty').val(1);
                 $('#qv-cart-qty').val(1);

                 // TOTAL
                 $('#qv-total').text(currentPrice);

                 // WHATSAPP
                 $('#qv-whatsapp').attr(
                     'href',
                     `https://wa.me/8801886699757?text=I want to order ${data.name}`
                 );

                 $('#qv-details').attr(
                     'href',
                     '/product/' + data.slug
                 );

                 $('#qv-loading').hide();
                 $('#qv-content').fadeIn();

             }).fail(function() {
                 alert('Failed to load product!');
             });

         });

         // 🔥 COLOR SELECT
         $(document).on('click', '.qv-color', function() {

             $('.qv-color').css('border', '2px solid #ddd');

             $(this).css('border', '2px solid #000');

             let selectedColor = $(this).data('color');

             $('#qv-selected-color').text('Selected: ' + selectedColor);
             $('#qv-cart-color').val(selectedColor);

         });

         // 🔥 QTY PLUS
         $(document).on('click', '.qv-plus', function() {

             let qty = parseInt($('#qv-qty').val());
             qty++;

             $('#qv-qty').val(qty);
             $('#qv-cart-qty').val(qty);

             updateTotal();

         });

         // 🔥 QTY MINUS
         $(document).on('click', '.qv-minus', function() {

             let qty = parseInt($('#qv-qty').val());

             if (qty > 1) qty--;

             $('#qv-qty').val(qty);
             $('#qv-cart-qty').val(qty);

             updateTotal();

         });

         // 🔥 MANUAL INPUT
         $(document).on('input', '#qv-qty', function() {

             let qty = parseInt($(this).val());

             if (isNaN(qty) || qty < 1) qty = 1;

             $('#qv-qty').val(qty);
             $('#qv-cart-qty').val(qty);

             updateTotal();

         });

         // 🔥 TOTAL CALCULATION
         function updateTotal() {
             let qty = parseInt($('#qv-qty').val());
             let total = qty * currentPrice;

             $('#qv-total').text(total);
         }

     });
 </script>
 <script>
     function changeImage(src, el) {
         document.getElementById('mainImage').src = src;

         // active thumb
         document.querySelectorAll('.thumb-img').forEach(img => {
             img.classList.remove('active-thumb');
         });
         el.classList.add('active-thumb');
     }

     /* 🔍 ZOOM EFFECT */
     const img = document.getElementById('mainImage');

     img.addEventListener('mousemove', function(e) {
         const rect = img.getBoundingClientRect();
         const x = ((e.clientX - rect.left) / rect.width) * 100;
         const y = ((e.clientY - rect.top) / rect.height) * 100;

         img.style.transformOrigin = `${x}% ${y}%`;
         img.style.transform = "scale(2)";
     });

     img.addEventListener('mouseleave', function() {
         img.style.transform = "scale(1)";
     });

     /* 🔥 CLICK → FULL PREVIEW */
     img.addEventListener('click', function() {
         document.getElementById('previewImage').src = this.src;
         $('#imageModal').modal('show');
     });
 </script>

 <script>
     let qty = 1;
     let price = parseFloat(document.getElementById('unit-price').innerText);

     function updateTotal() {
         document.getElementById('total-price').innerText = (qty * price).toFixed(2);
         document.getElementById('cart-qty').value = qty;
         document.getElementById('order-qty').value = qty;
         document.getElementById('qty').value = qty;
     }

     document.getElementById('plus').onclick = () => {
         qty++;
         updateTotal();
     };
     document.getElementById('minus').onclick = () => {
         if (qty > 1) qty--;
         updateTotal();
     };

     // COLOR SELECT
     document.querySelectorAll('.color-circle').forEach(el => {
         el.addEventListener('click', function() {

             document.querySelectorAll('.color-circle').forEach(c => c.style.border = '2px solid #ddd');

             this.style.border = '2px solid black';

             let color = this.dataset.color;

             document.getElementById('selected-color').innerText = "Selected: " + color;
             document.getElementById('color-input').value = color;
             document.getElementById('cart-color').value = color;
         });
     });
 </script>

 <script>
     const tabs = document.querySelectorAll('.tab-btn');

     tabs.forEach(tab => {
         tab.addEventListener('click', function() {

             // ACTIVE TAB STYLE
             tabs.forEach(t => t.classList.remove('active'));
             this.classList.add('active');

             let target = this.dataset.target;

             // HIDE ALL
             document.querySelectorAll('.tab-content-box').forEach(box => {
                 box.classList.add('d-none');
             });

             // SHOW BASED ON TAB
             if (target === 'description') {
                 document.getElementById('description').classList.remove('d-none');
                 document.getElementById('description-right').classList.remove('d-none');
             }

             if (target === 'reviews') {
                 document.getElementById('reviews').classList.remove('d-none');
                 document.getElementById('reviews-left').classList.remove('d-none');
             }

         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {

         const container = document.getElementById("review-list");

         if (!container) return;

         let reviews = Array.from(container.querySelectorAll(".review-item"));

         // 🔀 Shuffle
         for (let i = reviews.length - 1; i > 0; i--) {
             let j = Math.floor(Math.random() * (i + 1));
             [reviews[i], reviews[j]] = [reviews[j], reviews[i]];
         }

         // 🧹 Clear + show only 4 (change if needed)
         container.innerHTML = "";

         reviews.slice(0, 10).forEach(el => {
             container.appendChild(el);
         });

     });
 </script>
 </body>

 </html>