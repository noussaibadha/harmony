document.addEventListener("DOMContentLoaded", function () {
    const uploadButton = document.getElementById("upload-button");
    const imagePreview = document.getElementById("image-preview");

    uploadButton.addEventListener("click", function () {
        const fileInput = document.getElementById("image_telechargement");
        const formData = new FormData();
        const nonce = document.querySelector('input[name="image_upload_nonce"]').value;

        if (fileInput.files.length === 0) {
            alert("Veuillez sélectionner une image.");
            return;
        }

        formData.append("action", "handle_image_upload");
        formData.append("image_upload_nonce", nonce);
        formData.append("image_telechargement", fileInput.files[0]);

        fetch(ajaxurl, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    imagePreview.innerHTML = `
                        <img src="${data.url}" alt="Image téléchargée" class="uploaded-image">
                        <button id="delete-button" class="delete-button" data-url="${data.delete_url}">Supprimer l'image</button>
                    `;
                } else {
                    alert(data.message || "Erreur lors du téléchargement.");
                }
            })
            .catch((error) => {
                console.error("Erreur :", error);
                alert("Erreur lors de la requête.");
            });
    });

    imagePreview.addEventListener("click", function (e) {
        if (e.target.id === "delete-button") {
            const deleteUrl = e.target.getAttribute("data-url");

            fetch(deleteUrl, { method: "GET" })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        imagePreview.innerHTML = `<p class="no-image-text">Aucune image téléchargée pour le moment.</p>`;
                    } else {
                        alert(data.message || "Erreur lors de la suppression.");
                    }
                })
                .catch((error) => {
                    console.error("Erreur :", error);
                    alert("Erreur lors de la requête.");
                });
        }
    });
});
