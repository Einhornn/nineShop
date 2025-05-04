document.addEventListener('DOMContentLoaded', function() {
    const searchNameInput = document.getElementById('search-name');
    const searchCodeInput = document.getElementById('search-code');

    if (searchNameInput && searchCodeInput) {
        searchNameInput.addEventListener('input', filterTable);
        searchCodeInput.addEventListener('input', filterTable);
    }

    function filterTable() {
        const nameInput = searchNameInput.value.toLowerCase();
        const codeInput = searchCodeInput.value.toLowerCase();
        const table = document.getElementById('roles-table');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const nameCell = rows[i].getElementsByTagName('td')[0];
            const codeCell = rows[i].getElementsByTagName('td')[1];
            const nameText = nameCell.textContent.toLowerCase();
            const codeText = codeCell.textContent.toLowerCase();

            if (nameText.includes(nameInput) && codeText.includes(codeInput)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
});