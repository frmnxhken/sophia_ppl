const input = document.getElementById("file-input");
const preview = document.getElementById("file-preview");

function formatSize(bytes) {
    if (bytes >= 1024 * 1024) return (bytes / 1024 / 1024).toFixed(2) + " MB";
    if (bytes >= 1024) return (bytes / 1024).toFixed(2) + " KB";
    return bytes + " B";
}

input.addEventListener("change", () => {
    preview.innerHTML = "";
    Array.from(input.files).forEach((file) => {
        const ext = file.name.split(".").pop();
        preview.innerHTML += `
            <div class="d-flex align-items-center justify-content-between border rounded p-3 bg-white shadow-none mb-2">
                <div class="d-flex align-items-center w-100">
                    <i class="fa-solid fa-file fs-5 text-danger me-3 flex-shrink-0"></i>
                    <div class="text-truncate w-100">
                        <p class="fs-vs fw-bold mb-0 text-truncate">${
                            file.name
                        }</p>
                        <small class="fs-vs text-muted">${ext} • ${formatSize(
            file.size
        )}</small>
                            </div>
                        </div>
                    </div>
                `;
    });
});
