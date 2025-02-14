document.addEventListener('DOMContentLoaded', function () {
    window.openDeleteModal = function (id, type) {
        document.getElementById('deleteModal').classList.remove('hidden');

        let basePath = '/dashboard/' + type + '/';
        document.getElementById('deleteForm').action = basePath + id;
    };

    window.closeDeleteModal = function () {
        document.getElementById('deleteModal').classList.add('hidden');
    };
});
