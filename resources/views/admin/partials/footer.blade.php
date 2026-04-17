
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

</body>
</html>