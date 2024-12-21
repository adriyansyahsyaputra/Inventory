// Sidebar Page
// Dropdown Logic
document.querySelectorAll(".dropdown-toggle").forEach((item) => {
    item.addEventListener("click", function () {
        const targetMenu = document.getElementById(
            this.getAttribute("data-dropdown")
        );
        const isHidden = targetMenu.classList.contains("hidden");

        // Hide other dropdown menus
        document
            .querySelectorAll(".dropdown-menu")
            .forEach((menu) => menu.classList.add("hidden"));

        // Toggle current dropdown
        if (isHidden) {
            targetMenu.classList.remove("hidden");
        } else {
            targetMenu.classList.add("hidden");
        }
    });
});

// Close dropdown if clicked outside
document.addEventListener("click", function (event) {
    if (!event.target.closest(".dropdown-toggle")) {
        document
            .querySelectorAll(".dropdown-menu")
            .forEach((menu) => menu.classList.add("hidden"));
    }
});

// Preview image before upload
// function previewImage(event) {
//     const file = event.target.files[0];
//     if (file) {
//         const reader = new FileReader();
//         const preview = document.getElementById("preview");

//         reader.onload = function (e) {
//             preview.src = e.target.result;
//             preview.classList.remove("hidden");
//         };

//         reader.readAsDataURL(file);
//     }
// }

// document.addEventListener("DOMContentLoaded", function () {
//     const fileInput = document.getElementById("file-upload");
//     const preview = document.getElementById("preview");

//     if (fileInput) {
//         fileInput.addEventListener("change", function (event) {
//             const file = event.target.files[0];

//             if (file) {
//                 // Validasi ukuran file (2MB)
//                 const maxSize = 2 * 1024 * 1024; // 2MB dalam byte
//                 if (file.size > maxSize) {
//                     alert("Ukuran file maksimal adalah 2MB.");
//                     fileInput.value = ""; // Reset input file
//                     preview.src = ""; // Reset preview
//                     preview.classList.add("hidden");
//                     return;
//                 }

//                 // Validasi tipe file (PNG, JPG, GIF)
//                 const validTypes = ["image/png", "image/jpeg", "image/gif"];
//                 if (!validTypes.includes(file.type)) {
//                     alert("Hanya file PNG, JPG, atau GIF yang diperbolehkan.");
//                     fileInput.value = ""; // Reset input file
//                     preview.src = ""; // Reset preview
//                     preview.classList.add("hidden");
//                     return;
//                 }

//                 // Tampilkan preview gambar
//                 const reader = new FileReader();
//                 reader.onload = function (e) {
//                     preview.src = e.target.result;
//                     preview.classList.remove("hidden");
//                 };
//                 reader.readAsDataURL(file);
//             }
//         });
//     }
// });
