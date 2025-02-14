import $ from 'jquery';
import './bootstrap';
import './deleteModal';
import './userAvatar';
import select2 from 'select2';
select2();
import 'select2/dist/css/select2.css';
import './featured_img'

//Post category select placeholder
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Search for category...",
        allowClear: true,
    });
});

//Post tag add/select func
document.addEventListener("DOMContentLoaded", function () {
    let tags = [];
    const tagInput = document.getElementById("tagInput");
    const tagsContainer = document.getElementById("tagsContainer");
    const tagsField = document.getElementById("tagsField");

    document.querySelectorAll(".tag").forEach(tagElement => {
        const tagText = tagElement.getAttribute("data-name");
        if (!tags.includes(tagText)) {
            tags.push(tagText);
        }
    });

    updateTagsUI();

    tagInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter" && tagInput.value.trim() !== "") {
            event.preventDefault();
            const tagText = tagInput.value.trim();
            if (!tags.includes(tagText)) {
                tags.push(tagText);
                updateTagsUI();
            }
            tagInput.value = "";
        }
    });

    function updateTagsUI() {
        tagsContainer.innerHTML = "";
        tags.forEach(tag => {
            const tagElement = document.createElement("span");
            tagElement.textContent = tag;
            tagElement.classList.add("tag");
            tagElement.addEventListener("click", function () {
                tags = tags.filter(t => t !== tag);
                updateTagsUI();
            });
            tagsContainer.appendChild(tagElement);
        });
        tagsField.value = tags.join(",");
    }
});

