// // Search filter
// document.getElementById("searchInput").addEventListener("keyup", function () {
//     const filter = this.value.toLowerCase();
//     const rows = document.querySelectorAll("#membersTbody tr");
//     rows.forEach((row) => {
//         row.style.display = row.innerText.toLowerCase().includes(filter)
//             ? ""
//             : "none";
//     });
// });

// // Sort function
// function sortTable(n) {
//     const table = document.getElementById("membersTable");
//     let switching = true,
//         dir = "asc",
//         switchcount = 0;
//     while (switching) {
//         switching = false;
//         const rows = table.rows;
//         for (let i = 1; i < rows.length - 1; i++) {
//             let shouldSwitch = false;
//             const x = rows[i].getElementsByTagName("TD")[n];
//             const y = rows[i + 1].getElementsByTagName("TD")[n];
//             const xVal = x.textContent || x.innerText;
//             const yVal = y.textContent || y.innerText;

//             if (
//                 (dir == "asc" && xVal.toLowerCase() > yVal.toLowerCase()) ||
//                 (dir == "desc" && xVal.toLowerCase() < yVal.toLowerCase())
//             ) {
//                 shouldSwitch = true;
//                 break;
//             }
//         }
//         if (shouldSwitch) {
//             rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
//             switching = true;
//             switchcount++;
//         } else if (switchcount == 0 && dir == "asc") {
//             dir = "desc";
//             switching = true;
//         }
//     }
// }
//  srcipt delete
let currentDeleteRow = null;

function showConfirm() {
    document.getElementById("deleteBackdrop").classList.remove("d-none");
    document.getElementById("deleteConfirmCard").classList.remove("d-none");
}

function cancelDelete() {
    document.getElementById("deleteBackdrop").classList.add("d-none");
    document.getElementById("deleteConfirmCard").classList.add("d-none");
    currentDeleteRow = null;
}

function confirmDelete() {
    if (currentDeleteRow) {
        currentDeleteRow.remove();
    }
    cancelDelete();
}
