        </div><!-- End main-content -->
    </div><!-- End row -->
</div><!-- End container-fluid -->

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Scripts -->
<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
    
    // Confirm delete function
    function confirmDelete(url, itemName) {
        if (confirm('Yakin ingin menghapus ' + (itemName || 'item') + ' ini?')) {
            window.location.href = url;
        }
        return false;
    }
</script>
</body>
</html>
