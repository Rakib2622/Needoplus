
<script>
function toggleSidebar() {
    let sidebar = document.getElementById('sidebar');
    let mainContent = document.getElementById('mainContent');
    let overlay = document.getElementById('overlay');

    if (window.innerWidth < 768) {
        // MOBILE
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    } else {
        // DESKTOP
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');

    const ordersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: 'Orders',
                data: [12, 19, 10, 15, 22, 18, 25],
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
</script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalEl = document.getElementById('total-price');
    const finalEl = document.getElementById('final-price');
    const discountType = document.getElementById('discount-type');
    const discountValue = document.getElementById('discount-value');

    function calculate() {
        let total = 0;

        qtyInputs.forEach(input => {
            let qty = parseFloat(input.value) || 0;
            let price = parseFloat(input.dataset.price) || 0;

            total += qty * price;
        });

        totalEl.innerText = total.toFixed(2);

        let final = total;
        let discount = parseFloat(discountValue.value) || 0;

        if (discountType.value === 'percent') {
            final = total - (total * discount / 100);
        } else if (discountType.value === 'flat') {
            final = total - discount;
        }

        if (final < 0) final = 0;

        finalEl.innerText = final.toFixed(2);
    }

    qtyInputs.forEach(input => {
        input.addEventListener('input', calculate);
    });

    discountType.addEventListener('change', calculate);
    discountValue.addEventListener('input', calculate);

});
</script>

</body>
</html>