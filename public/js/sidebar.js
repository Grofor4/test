document.addEventListener('DOMContentLoaded', function() {
    // Hide all content sections except dashboard initially
    const allContents = document.querySelectorAll('[id^="content-"]');
    allContents.forEach(content => {
        if (content.id !== 'content-dashboard') {
            content.classList.add('d-none');
        }
    });

    // Add click handlers for sidebar menu items
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            
            // Hide all contents first
            allContents.forEach(content => {
                content.classList.add('d-none');
            });
            
            // Show target content
            if (targetId) {
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.classList.remove('d-none');
                }
            }

            // Update active state
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Add handler for pelanggan form toggle
    const btnShowAddPelanggan = document.getElementById('btnShowAddPelanggan');
    if (btnShowAddPelanggan) {
        btnShowAddPelanggan.addEventListener('click', function() {
            const form = document.getElementById('addPelangganForm');
            if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        });
    }
});
