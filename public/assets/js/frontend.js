document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       🔥 IMAGE ZOOM + PREVIEW
    ========================== */
    const img = document.getElementById('mainImage');

    if (img) {

        img.addEventListener('mousemove', function (e) {
            const rect = img.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = "scale(2)";
        });

        img.addEventListener('mouseleave', function () {
            img.style.transform = "scale(1)";
        });

        img.addEventListener('click', function () {
            const preview = document.getElementById('previewImage');
            if (preview) preview.src = this.src;

            if (window.$) {
                $('#imageModal').modal('show');
            }
        });
    }

    // change image (global function)
    window.changeImage = function (src, el) {
        const main = document.getElementById('mainImage');
        if (main) main.src = src;

        document.querySelectorAll('.thumb-img').forEach(img => {
            img.classList.remove('active-thumb');
        });

        if (el) el.classList.add('active-thumb');
    };


    /* =========================
       🔢 QUANTITY CONTROL
    ========================== */
    let qty = 1;

    const unitPriceEl = document.getElementById('unit-price');

    if (unitPriceEl) {

        let price = parseFloat(unitPriceEl.innerText) || 0;

        function updateTotal() {
            const totalEl = document.getElementById('total-price');
            const cartQty = document.getElementById('cart-qty');
            const orderQty = document.getElementById('order-qty');
            const qtyInput = document.getElementById('qty');

            if (totalEl) totalEl.innerText = (qty * price).toFixed(2);
            if (cartQty) cartQty.value = qty;
            if (orderQty) orderQty.value = qty;
            if (qtyInput) qtyInput.value = qty;
        }

        const plusBtn = document.getElementById('plus');
        const minusBtn = document.getElementById('minus');

        if (plusBtn) {
            plusBtn.addEventListener('click', () => {
                qty++;
                updateTotal();
            });
        }

        if (minusBtn) {
            minusBtn.addEventListener('click', () => {
                if (qty > 1) qty--;
                updateTotal();
            });
        }
    }


    /* =========================
       🎨 COLOR SELECT
    ========================== */
    const colorCircles = document.querySelectorAll('.color-circle');

    if (colorCircles.length > 0) {

        colorCircles.forEach(el => {
            el.addEventListener('click', function () {

                colorCircles.forEach(c => {
                    c.style.border = '2px solid #ddd';
                });

                this.style.border = '2px solid black';

                let color = this.dataset.color;

                const label = document.getElementById('selected-color');
                const input1 = document.getElementById('color-input');
                const input2 = document.getElementById('cart-color');

                if (label) label.innerText = "Selected: " + color;
                if (input1) input1.value = color;
                if (input2) input2.value = color;
            });
        });
    }


    /* =========================
       📑 TAB SWITCHING
    ========================== */
    const tabs = document.querySelectorAll('.tab-btn');

    if (tabs.length > 0) {

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {

                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                let target = this.dataset.target;

                document.querySelectorAll('.tab-content-box').forEach(box => {
                    box.classList.add('d-none');
                });

                if (target === 'description') {
                    document.getElementById('description')?.classList.remove('d-none');
                    document.getElementById('description-right')?.classList.remove('d-none');
                }

                if (target === 'reviews') {
                    document.getElementById('reviews')?.classList.remove('d-none');
                    document.getElementById('reviews-left')?.classList.remove('d-none');
                }
            });
        });
    }


    /* =========================
       ⭐ RANDOM REVIEWS
    ========================== */
    const reviewContainer = document.getElementById("review-list");

    if (reviewContainer) {

        let reviews = Array.from(reviewContainer.querySelectorAll(".review-item"));

        // shuffle
        for (let i = reviews.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [reviews[i], reviews[j]] = [reviews[j], reviews[i]];
        }

        reviewContainer.innerHTML = "";

        reviews.slice(0, 10).forEach(el => {
            reviewContainer.appendChild(el);
        });
    }


    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    // =========================
    // 🖼 IMAGE CHANGE + ZOOM
    // =========================
    window.changeImage = function (src, el) {
        const mainImage = document.getElementById('mainImage');
        if (!mainImage) return;

        mainImage.src = src;

        document.querySelectorAll('.thumb-img').forEach(img => {
            img.classList.remove('active-thumb');
        });

        if (el) el.classList.add('active-thumb');
    };

    const img = document.getElementById('mainImage');

    if (img) {
        img.addEventListener('mousemove', function (e) {
            const rect = img.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = "scale(2)";
        });

        img.addEventListener('mouseleave', function () {
            img.style.transform = "scale(1)";
        });

        img.addEventListener('click', function () {
            const preview = document.getElementById('previewImage');
            if (preview) preview.src = this.src;

            if (typeof $ !== 'undefined') {
                $('#imageModal').modal('show');
            }
        });
    }


    // =========================
    // ➕ PRODUCT QTY CONTROL
    // =========================
    let qty = 1;

    const unitPriceEl = document.getElementById('unit-price');
    let price = unitPriceEl ? parseFloat(unitPriceEl.innerText) : 0;

    function updateTotal() {
        const totalEl = document.getElementById('total-price');
        if (totalEl) totalEl.innerText = (qty * price).toFixed(2);

        const cartQty = document.getElementById('cart-qty');
        const orderQty = document.getElementById('order-qty');
        const qtyInput = document.getElementById('qty');

        if (cartQty) cartQty.value = qty;
        if (orderQty) orderQty.value = qty;
        if (qtyInput) qtyInput.value = qty;
    }

    const plusBtn = document.getElementById('plus');
    const minusBtn = document.getElementById('minus');

    if (plusBtn) plusBtn.onclick = () => { qty++; updateTotal(); };
    if (minusBtn) minusBtn.onclick = () => {
        if (qty > 1) qty--;
        updateTotal();
    };


    // =========================
    // 🎨 COLOR SELECT
    // =========================
    document.querySelectorAll('.color-circle').forEach(el => {
        el.addEventListener('click', function () {

            document.querySelectorAll('.color-circle').forEach(c => {
                c.style.border = '2px solid #ddd';
            });

            this.style.border = '2px solid black';

            let color = this.dataset.color;

            let selected = document.getElementById('selected-color');
            if (selected) selected.innerText = "Selected: " + color;

            let colorInput = document.getElementById('color-input');
            let cartColor = document.getElementById('cart-color');

            if (colorInput) colorInput.value = color;
            if (cartColor) cartColor.value = color;
        });
    });


    // =========================
    // 🧾 TAB SWITCHING
    // =========================
    const tabs = document.querySelectorAll('.tab-btn');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            let target = this.dataset.target;

            document.querySelectorAll('.tab-content-box').forEach(box => {
                box.classList.add('d-none');
            });

            if (target === 'description') {
                document.getElementById('description')?.classList.remove('d-none');
                document.getElementById('description-right')?.classList.remove('d-none');
            }

            if (target === 'reviews') {
                document.getElementById('reviews')?.classList.remove('d-none');
                document.getElementById('reviews-left')?.classList.remove('d-none');
            }
        });
    });


    // =========================
    // 🔀 RANDOM REVIEWS
    // =========================
    const reviewContainer = document.getElementById("review-list");

    if (reviewContainer) {
        let reviews = Array.from(reviewContainer.querySelectorAll(".review-item"));

        for (let i = reviews.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [reviews[i], reviews[j]] = [reviews[j], reviews[i]];
        }

        reviewContainer.innerHTML = "";

        reviews.slice(0, 10).forEach(el => {
            reviewContainer.appendChild(el);
        });
    }


    // =========================
    // 🛒 ADD TO CART (AJAX)
    // =========================
    document.querySelectorAll('.add-to-cart-form').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let url = this.action;
            let formData = new FormData(this);

            fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
                .then(() => {
                    showToast("✅ Added to cart");
                })
                .catch(() => {
                    showToast("❌ Error adding to cart", true);
                });

        });

    });


    // =========================
    // 🔄 CART UPDATE (AJAX)
    // =========================
    function updateCart() {

        let items = {};

        document.querySelectorAll('.qty-input').forEach(input => {

            let key = input.dataset.key;
            let qty = parseInt(input.value) || 1;

            let colorSelect = document.querySelector('.color-select[data-key="' + key + '"]');

            items[key] = {
                quantity: qty,
                color: colorSelect ? colorSelect.value : null
            };
        });

        fetch("/cart/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ items })
        })
            .then(res => res.json())
            .then(() => location.reload());
    }


    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.addEventListener('click', function () {
            let input = document.querySelector('.qty-input[data-key="' + this.dataset.key + '"]');
            input.value = parseInt(input.value) + 1;
            updateCart();
        });
    });

    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.addEventListener('click', function () {
            let input = document.querySelector('.qty-input[data-key="' + this.dataset.key + '"]');
            if (parseInt(input.value) > 1) {
                input.value -= 1;
                updateCart();
            }
        });
    });


    // =========================
    // ❌ REMOVE ITEM
    // =========================
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            let key = this.dataset.key;

            let formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('_method', 'DELETE');

            fetch('/cart/remove/' + key, {
                method: 'POST',
                body: formData
            })
                .then(() => location.reload());
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
    // ⚡ QUICK VIEW (jQuery REQUIRED)
    // =========================
    if (typeof $ !== "undefined") {

        $(document).ready(function () {

            let currentPrice = 0;

            // OPEN QUICK VIEW
            $(document).on('click', '.quick-view-btn', function () {

                let productId = $(this).data('id');

                $('#quickViewModal').modal('show');

                $('#qv-loading').show();
                $('#qv-content').hide();

                $.get('/product/quick-view/' + productId, function (data) {

                    $('#qv-name').text(data.name);

                    $('#qv-image').attr(
                        'src',
                        data.image ? data.image : '/assets/img/no-image.png'
                    );

                    $('#qv-product-id').val(data.id);

                    currentPrice = data.final_price ?? data.price;

                    if (data.final_price && data.final_price < data.price) {
                        $('#qv-price').html(
                            '<h5 class="text-danger d-inline">৳ ' + data.final_price + '</h5>' +
                            '<small class="text-muted ml-2"><del>৳ ' + data.price + '</del></small>'
                        );
                    } else {
                        $('#qv-price').html('<h5>৳ ' + data.price + '</h5>');
                    }

                    $('#qv-stock').html(
                        data.stock > 0
                            ? '<span class="text-success">✔ In Stock</span>'
                            : '<span class="text-danger">✖ Out of Stock</span>'
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

                    $('#qv-description').html(data.description ?? 'No description available');

                    $('#qv-qty').val(1);
                    $('#qv-cart-qty').val(1);

                    $('#qv-total').text(currentPrice);

                    $('#qv-whatsapp').attr(
                        'href',
                        `https://wa.me/8801886699757?text=I want to order ${data.name}`
                    );

                    $('#qv-details').attr('href', '/product/' + data.slug);

                    $('#qv-loading').hide();
                    $('#qv-content').fadeIn();

                }).fail(function () {
                    alert('Failed to load product!');
                });
            });


            // COLOR SELECT
            $(document).on('click', '.qv-color', function () {

                $('.qv-color').css('border', '2px solid #ddd');

                $(this).css('border', '2px solid #000');

                let selectedColor = $(this).data('color');

                $('#qv-selected-color').text('Selected: ' + selectedColor);
                $('#qv-cart-color').val(selectedColor);
            });


            // QTY +
            $(document).on('click', '.qv-plus', function () {

                let qty = parseInt($('#qv-qty').val());
                qty++;

                $('#qv-qty').val(qty);
                $('#qv-cart-qty').val(qty);

                updateTotal();
            });


            // QTY -
            $(document).on('click', '.qv-minus', function () {

                let qty = parseInt($('#qv-qty').val());

                if (qty > 1) qty--;

                $('#qv-qty').val(qty);
                $('#qv-cart-qty').val(qty);

                updateTotal();
            });


            // MANUAL INPUT
            $(document).on('input', '#qv-qty', function () {

                let qty = parseInt($(this).val());

                if (isNaN(qty) || qty < 1) qty = 1;

                $('#qv-qty').val(qty);
                $('#qv-cart-qty').val(qty);

                updateTotal();
            });


            function updateTotal() {
                let qty = parseInt($('#qv-qty').val());
                let total = qty * currentPrice;

                $('#qv-total').text(total);
            }

        });
    }


    // =========================
    // 🚚 CHECKOUT SHIPPING CALCULATION
    // =========================
    document.addEventListener("DOMContentLoaded", function () {

        if (!window.checkoutConfig) return;

        let subtotal = window.checkoutConfig.subtotal;

        function updateTotal() {

            let selected = document.querySelector('input[name="shipping_area"]:checked');
            if (!selected) return;

            let shipping = selected.value;
            let charge = shipping === 'inside' ? 80 : 120;

            let shippingEl = document.getElementById('shipping');
            let totalEl = document.getElementById('final-total');

            if (shippingEl) shippingEl.innerText = '৳ ' + charge;
            if (totalEl) totalEl.innerText = '৳ ' + (subtotal + charge);
        }

        document.querySelectorAll('.shipping-option').forEach(option => {
            option.addEventListener('change', updateTotal);
        });

    });

});