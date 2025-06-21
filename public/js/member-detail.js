// public/js/member-detail.js

function toggleView(view) {
    const paymentTable = document.getElementById("paymentTable");
    const attendanceTable = document.getElementById("attendanceTable");
    const toggleTitle = document.getElementById("toggleTitle");
    const btnPayment = document.getElementById("btn-payment");
    const btnAttendance = document.getElementById("btn-attendance");

    if (view === "payment") {
        paymentTable.classList.remove("d-none");
        attendanceTable.classList.add("d-none");
        toggleTitle.textContent = "Payment History";
        btnPayment?.classList.add("active");
        btnAttendance?.classList.remove("active");
    } else {
        paymentTable.classList.add("d-none");
        attendanceTable.classList.remove("d-none");
        toggleTitle.textContent = "Attendance";
        btnPayment?.classList.remove("active");
        btnAttendance?.classList.add("active");
    }
}
