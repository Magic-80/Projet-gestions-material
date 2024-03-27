let arrow_icons = document.querySelectorAll(".arrow_img");
let nav_dropdowns = document.querySelectorAll(".nav_links_dropdown");

arrow_icons.forEach((arrow_icon, index) => {
  arrow_icon.addEventListener("click", () => toggleDropdown(index));
});

function toggleDropdown(index) {
  nav_dropdowns[index].classList.toggle("active_dropdown");
  arrow_icons[index].classList.toggle("arrow_img_down");
}


document.addEventListener('DOMContentLoaded', function() {
    const searchInputs = document.querySelectorAll('.search-input');
    const table = document.querySelectorAll('.table_body');

    searchInputs.forEach((searchInput, index) => {
        searchInput.addEventListener('input', function(event) {
            const searchTerm = searchInput.value.trim();
            const tableBody = table[index];

            fetch('/materials/search?searchTerm=' + encodeURIComponent(searchTerm))
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = '';

                    data.forEach(material => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${material.name}</td>
                            <td class="td_bg_gray">${material.tagNumber}</td>
                            <td>${material.borrowAt ? material.borrowAt : '-'}</td>
                            <td class="td_bg_gray">${material.actualReturnDate ? material.actualReturnDate : '-'}</td>
                            <td class="td_bg_gray">${material.firstname ? material.firstname : '-'}</td>
                            <td>${material.comment}</td>
                        `;
                        tableBody.appendChild(row);
                    });

                })

                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        });
    });
});

