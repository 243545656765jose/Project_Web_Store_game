document.addEventListener('DOMContentLoaded', function () {
    setupSearch();
});

function setupSearch() {
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(function (item) {
            const title = item.querySelector('.card-title').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
}
