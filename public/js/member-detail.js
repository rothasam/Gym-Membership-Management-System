// public/js/member-detail.js

// function toggleView(view) {
//     const paymentTable = document.getElementById("paymentTable");
//     const attendanceTable = document.getElementById("attendanceTable");
//     const toggleTitle = document.getElementById("toggleTitle");
//     const btnPayment = document.getElementById("btn-payment");
//     const btnAttendance = document.getElementById("btn-attendance");

//     if (view === "payment") {
//         paymentTable.classList.remove("d-none");
//         attendanceTable.classList.add("d-none");
//         toggleTitle.textContent = "Payment History";
//         btnPayment?.classList.add("active");
//         btnAttendance?.classList.remove("active");
//     } else {
//         paymentTable.classList.add("d-none");
//         attendanceTable.classList.remove("d-none");
//         toggleTitle.textContent = "Attendance";
//         btnPayment?.classList.remove("active");
//         btnAttendance?.classList.add("active");
//     }
// }


// function toggleView(view) {
//     const views = ['paymentTable', 'attendanceTable', 'classTable'];
//     views.forEach(v => document.getElementById(v).classList.add('d-none'));
//     document.getElementById(view + 'Table').classList.remove('d-none');

//     const buttons = ['btn-payment', 'btn-attendance', 'btn-classes'];
//     buttons.forEach(b => document.getElementById(b).classList.remove('active'));
//     document.getElementById('btn-' + view).classList.add('active');

//     // Update title if needed
//     const titles = {
//         payment: "Payment History",
//         attendance: "Attendance",
//         classes: "Class Registration History"
//     };
//     document.getElementById('toggleTitle').textContent = titles[view];
// }


// function toggleView(view) {
//     const views = ['paymentTable', 'attendanceTable', 'classTable'];
//     const buttons = ['btn-payment', 'btn-attendance', 'btn-classes'];

//     views.forEach(v => document.getElementById(v).classList.add('d-none'));
//     buttons.forEach(b => document.getElementById(b).classList.remove('active'));

//     document.getElementById(view + 'Table').classList.remove('d-none');
//     document.getElementById('btn-' + view).classList.add('active');

//     const titles = {
//         payment: "Payment History",
//         attendance: "Attendance",
//         classes: "Class Registration History"
//     };
//     document.getElementById('toggleTitle').textContent = titles[view];
// }


function toggleView(view) {
    const views = {
        payment: {
            tableId: 'paymentTable',
            buttonId: 'btn-payment',
            title: 'Payment History'
        },
        attendance: {
            tableId: 'attendanceTable',
            buttonId: 'btn-attendance',
            title: 'Attendance'
        },
        classes: {
            tableId: 'classTable',
            buttonId: 'btn-classes',
            title: 'Class Registration History'
        }
    };

    // Hide all tables and remove active class from all buttons
    for (const key in views) {
        document.getElementById(views[key].tableId)?.classList.add('d-none');
        document.getElementById(views[key].buttonId)?.classList.remove('active');
    }

    // Show selected table and activate corresponding button
    document.getElementById(views[view].tableId)?.classList.remove('d-none');
    document.getElementById(views[view].buttonId)?.classList.add('active');
    document.getElementById('toggleTitle').textContent = views[view].title;
}

