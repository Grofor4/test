document.addEventListener('DOMContentLoaded', function() {
    // Toggle form tambah pelanggan
    document.getElementById('btnShowAddPelanggan').onclick = function() {
        const form = document.getElementById('addPelangganForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    };

    // Edit pelanggan
    document.querySelectorAll('.btn-edit-pelanggan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const tr = btn.closest('tr');
            tr.querySelectorAll('span').forEach(span => span.classList.add('d-none'));
            tr.querySelectorAll('input').forEach(input => input.classList.remove('d-none'));
            tr.querySelector('.btn-edit-pelanggan').classList.add('d-none');
            tr.querySelector('.btn-save-pelanggan').classList.remove('d-none');
            tr.querySelector('.btn-cancel-edit-pelanggan').classList.remove('d-none');
        });
    });

    // Cancel edit
    document.querySelectorAll('.btn-cancel-edit-pelanggan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const tr = btn.closest('tr');
            tr.querySelectorAll('span').forEach(span => span.classList.remove('d-none'));
            tr.querySelectorAll('input').forEach(input => input.classList.add('d-none'));
            tr.querySelector('.btn-edit-pelanggan').classList.remove('d-none');
            tr.querySelector('.btn-save-pelanggan').classList.add('d-none');
            tr.querySelector('.btn-cancel-edit-pelanggan').classList.add('d-none');
        });
    });

    // Delete pelanggan
    document.querySelectorAll('.btn-delete-pelanggan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const nama = btn.getAttribute('data-nama');
            const id = btn.getAttribute('data-pelangganid');
            if(confirm('Yakin ingin menghapus pelanggan "' + nama + '"?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/pelanggan/' + id + '/delete';
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
