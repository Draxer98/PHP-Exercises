<footer class="footer py-3 mt-auto bg-body-tertiary">
    <div class="container" Style="text-align: center">
        <span class="text-body-secondary">@copyright 2025</span>
    </div>
</footer>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const message = document.getElementById('message');
        if (message) {
            setTimeout(function() {
                message.parentNode.removeChild(message);
            }, 5000)
        }
    })
</script>
</body>

</html>