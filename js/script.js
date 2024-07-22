$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

function filterCustomers() {
    const searchInput = document.getElementById('customerSearch').value.toLowerCase();
    const customerTableBody = document.getElementById('customerTableBody');
    const rows = customerTableBody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        const firstName = cells[2].textContent.toLowerCase();
        const lastName = cells[3].textContent.toLowerCase();
        const contactNumber = cells[4].textContent.toLowerCase();
        const district = cells[5].textContent.toLowerCase();

        if (firstName.includes(searchInput) || lastName.includes(searchInput) || contactNumber.includes(searchInput) || district.includes(searchInput)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

function filterItems() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("itemSearch");
    filter = input.value.toUpperCase();
    table = document.querySelector(".tbl table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 1; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}

function toggleDetails(button) {
    const detailsRow = button.closest('tr').nextElementSibling;
    $(detailsRow).toggle();
}


