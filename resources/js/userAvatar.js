document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("avatar");
    const preview = document.getElementById("avatar-preview");
    const avatarContainer = document.getElementById("avatar-container");
    const uploadContainer = document.getElementById("upload-container");

    if (dropArea && fileInput && preview && avatarContainer && uploadContainer) {

        function previewImage(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
                avatarContainer.style.display = "flex";
                uploadContainer.style.display = "none";
            };
            reader.readAsDataURL(file);
        }

        dropArea.addEventListener("dragover", (event) => {
            event.preventDefault();
            dropArea.classList.add("border-indigo-600");
        });

        dropArea.addEventListener("dragleave", () => {
            dropArea.classList.remove("border-indigo-600");
        });

        dropArea.addEventListener("drop", (event) => {
            event.preventDefault();
            dropArea.classList.remove("border-indigo-600");

            if (event.dataTransfer.files.length > 0) {
                const file = event.dataTransfer.files[0];
                fileInput.files = event.dataTransfer.files;
                previewImage(file);
            }
        });

        fileInput.addEventListener("change", (event) => {
            if (event.target.files.length > 0) {
                previewImage(event.target.files[0]);
            }
        });

        window.removeImage = function () {
            preview.src = "#";
            preview.classList.add("hidden");
            fileInput.value = "";
            avatarContainer.style.display = "none";
            uploadContainer.style.display = "block";
        };

    }
});
