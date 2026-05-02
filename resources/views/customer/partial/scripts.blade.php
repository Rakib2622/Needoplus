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
<script>
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            let key = this.dataset.key;

            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/cart/remove/' + key;

            let csrf = document.createElement('input');
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            let method = document.createElement('input');
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        });
    });
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {

    function updateCart() {

        let items = {};

        document.querySelectorAll('.qty-input').forEach(input => {

            let key = input.dataset.key;
            let qty = parseInt(input.value) || 1;

            let max = parseInt(input.getAttribute('max')) || 999;

            // 🔥 Clamp to stock
            if (qty > max) qty = max;
            if (qty < 1) qty = 1;

            input.value = qty;

            let colorSelect = document.querySelector('.color-select[data-key="' + key + '"]');

            items[key] = {
                quantity: qty,
                color: colorSelect ? colorSelect.value : null
            };
        });

        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ items: items })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); // later we can make dynamic
            }
        });
    }

    // =========================
    // ➕ PLUS BUTTON
    // =========================
    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.addEventListener('click', function() {

            let key = this.dataset.key;
            let input = document.querySelector('.qty-input[data-key="' + key + '"]');

            let current = parseInt(input.value);
            let max = parseInt(input.getAttribute('max')) || 999;

            if (current < max) {
                input.value = current + 1;
                toggleButtons(input, key);
                updateCart();
            }
        });
    });

    // =========================
    // ➖ MINUS BUTTON
    // =========================
    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.addEventListener('click', function() {

            let key = this.dataset.key;
            let input = document.querySelector('.qty-input[data-key="' + key + '"]');

            let current = parseInt(input.value);

            if (current > 1) {
                input.value = current - 1;
                toggleButtons(input, key);
                updateCart();
            }
        });
    });

    // =========================
    // ✏️ MANUAL INPUT
    // =========================
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('input', function() {

            let key = this.dataset.key;

            let value = parseInt(this.value) || 1;
            let max = parseInt(this.getAttribute('max')) || 999;

            if (value > max) value = max;
            if (value < 1) value = 1;

            this.value = value;

            toggleButtons(this, key);
        });

        input.addEventListener('change', updateCart);
    });

    // =========================
    // 🔘 ENABLE / DISABLE BUTTONS
    // =========================
    function toggleButtons(input, key) {

        let value = parseInt(input.value);
        let max = parseInt(input.getAttribute('max')) || 999;

        let plusBtn = document.querySelector('.btn-plus[data-key="' + key + '"]');
        let minusBtn = document.querySelector('.btn-minus[data-key="' + key + '"]');

        if (plusBtn) {
            plusBtn.disabled = value >= max;
        }

        if (minusBtn) {
            minusBtn.disabled = value <= 1;
        }
    }

    // =========================
    // 🎨 COLOR CHANGE
    // =========================
    document.querySelectorAll('.color-select').forEach(select => {
        select.addEventListener('change', function() {
            updateCart();
        });
    });

    // =========================
    // ❌ REMOVE ITEM
    // =========================
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {

            let key = this.dataset.key;

            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('_method', 'DELETE');

            fetch('/cart/remove/' + key, {
                method: 'POST',
                body: formData
            })
            .then(() => location.reload());
        });
    });

    // =========================
    // 🔥 INITIAL BUTTON STATE
    // =========================
    document.querySelectorAll('.qty-input').forEach(input => {
        let key = input.dataset.key;
        toggleButtons(input, key);
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // =========================
    // 🛒 ADD TO CART (AJAX)
    // =========================
    document.querySelectorAll('.add-to-cart-form').forEach(form => {

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let url = this.action;
            let formData = new FormData(this);

            fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
            .then(res => res.text())
            .then(() => {

                showToast("✅ Added to cart");

                updateCartCount();
                loadCartDropdown(); // 🔥 also refresh dropdown

            })
            .catch(() => {
                showToast("❌ Something went wrong", true);
            });

        });

    });

    // =========================
    // 🔔 TOAST
    // =========================
    function showToast(message, isError = false) {
        let toast = document.createElement("div");

        toast.innerText = message;
        toast.style.position = "fixed";
        toast.style.top = "20px";
        toast.style.right = "20px";
        toast.style.padding = "10px 15px";
        toast.style.color = "#fff";
        toast.style.background = isError ? "#dc3545" : "#28a745";
        toast.style.borderRadius = "5px";
        toast.style.zIndex = "9999";

        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2000);
    }

    // =========================
    // 🛒 LOAD CART DROPDOWN
    // =========================
    function loadCartDropdown() {

    fetch("/cart/preview")
    .then(res => res.json())
    .then(data => {

        let container = document.getElementById("cart-items");
        let totalEl = document.getElementById("cart-total");

        container.innerHTML = "";

        if (!data.items || data.items.length === 0) {
            container.innerHTML = `
                <div class="text-center py-4">
                    <p class="text-muted mb-2">Your cart is empty</p>
                    <a href="/products" class="btn btn-sm btn-primary">
                        Start Shopping
                    </a>
                </div>
            `;
            totalEl.innerText = "0";
            return;
        }

        data.items.forEach(item => {

            container.innerHTML += `
                <div class="d-flex align-items-center px-3 py-2 border-bottom">

                    <!-- IMAGE -->
                    <img src="${item.image ? '/storage/' + item.image : '/assets/img/no-image.png'}"
                         style="width:55px;height:55px;object-fit:cover;border-radius:6px;"
                         class="mr-2">

                    <!-- INFO -->
                    <div class="flex-grow-1">

                        <div style="font-size:14px;font-weight:500;">
                            ${item.name}
                        </div>

                        ${item.type === 'package'
                            ? '<small class="text-info">Package</small><br>'
                            : ''
                        }

                        ${item.color
                            ? `<small class="text-muted">Color: ${item.color}</small><br>`
                            : ''
                        }

                        <small class="text-muted">
                            ৳${item.price} × ${item.quantity}
                        </small>

                    </div>

                    <!-- SUBTOTAL -->
                    <div style="font-size:13px;font-weight:600;">
                        ৳${item.subtotal}
                    </div>

                </div>
            `;
        });

        totalEl.innerText = data.total;
    });
}

    // =========================
    // ❌ REMOVE FROM DROPDOWN
    // =========================
    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('remove-mini')) {

            let key = e.target.getAttribute('data-key');
            let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/remove/${key}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(() => {
                loadCartDropdown();
                updateCartCount();
            })
            .catch(() => console.log("Remove failed"));
        }
    });

    // =========================
    // 🛒 CART COUNT
    // =========================
    function updateCartCount() {
        fetch("/cart/count")
        .then(res => res.json())
        .then(data => {
            let cartBadge = document.getElementById("cart-count");
            if (cartBadge) {
                cartBadge.innerText = data.count;
            }
        })
        .catch(() => console.log("Cart count error"));
    }

    // =========================
    // 🔥 TRIGGER DROPDOWN LOAD
    // =========================
    let cartBtn = document.getElementById("cartDropdown");

    if (cartBtn) {
        cartBtn.addEventListener("click", function () {
            loadCartDropdown();
        });
    }

    // =========================
    // 🚀 INITIAL LOAD
    // =========================
    updateCartCount();

});
</script>


{{-- JS --}}
@isset($total)
<script>
document.addEventListener("DOMContentLoaded", function () {

    // ✅ Get subtotal from DOM (safe way)
    let subtotal = parseFloat(document.getElementById('subtotal').dataset.value);

    function updateTotal() {

        let selected = document.querySelector('input[name="shipping_area"]:checked');
        if (!selected) return;

        let shippingType = selected.value;

        // ✅ Your required logic
        let charge = (shippingType === 'inside') ? 80 : 120;

        document.getElementById('shipping').innerText = '৳ ' + charge;
        document.getElementById('final-total').innerText = '৳ ' + (subtotal + charge);
    }

    // ✅ Run on page load (important)
    updateTotal();

    // ✅ Listen for change
    document.querySelectorAll('.shipping-option').forEach(option => {
        option.addEventListener('change', updateTotal);
    });

});
</script>
@endisset

<script>
document.addEventListener("DOMContentLoaded", function () {

    let input = document.getElementById("search-input");
    let resultBox = document.getElementById("search-results");

    let timeout = null;

    input.addEventListener("keyup", function () {

        let query = this.value;

        clearTimeout(timeout);

        // 🔥 delay for better performance
        timeout = setTimeout(() => {

            if (query.length < 2) {
                resultBox.style.display = "none";
                return;
            }

            fetch(`/search/products?q=${query}`)
            .then(res => res.json())
            .then(data => {

                resultBox.innerHTML = "";

                if (data.length === 0) {
                    resultBox.innerHTML = `<div class="p-2 text-muted">No results found</div>`;
                    resultBox.style.display = "block";
                    return;
                }

                data.forEach(product => {

                    resultBox.innerHTML += `
                        <a href="/product/${product.slug}"
                           class="d-flex align-items-center p-2 border-bottom text-dark text-decoration-none">

                            <img src="${product.image ? '/storage/' + product.image : '/assets/img/no-image.png'}"
                                 style="width:40px;height:40px;object-fit:cover;margin-right:10px;">

                            <div>
                                <div style="font-size:14px;">${product.name}</div>
                                <small class="text-muted">৳${product.price}</small>
                            </div>

                        </a>
                    `;
                });

                resultBox.style.display = "block";
            });

        }, 300); // debounce

    });

    // 🔴 click outside = close
    document.addEventListener("click", function(e) {
        if (!input.contains(e.target)) {
            resultBox.style.display = "none";
        }
    });

});
</script>