
function searchTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.getElementById("reportTable");
    let tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        let tdUserName = tr[i].getElementsByTagName("td")[0];
        let tdOrderNumber = tr[i].getElementsByTagName("td")[1];
        let tdOrderDate = tr[i].getElementsByTagName("td")[2];
        if (tdUserName || tdOrderNumber || tdOrderDate) {
            let txtValueUserName = tdUserName.textContent || tdUserName.innerText;
            let txtValueOrderNumber = tdOrderNumber.textContent || tdOrderNumber.innerText;
            let txtValueOrderDate = tdOrderDate.textContent || tdOrderDate.innerText;
            if (txtValueUserName.toLowerCase().indexOf(filter) > -1 ||
                txtValueOrderNumber.toLowerCase().indexOf(filter) > -1 ||
                txtValueOrderDate.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
