document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const successCard = document.getElementById("successCard");
    const backdrop = document.getElementById("deleteBackdrop");
    const continueBtn = document.getElementById("btnContinue");

    // Show success message when form is submitted
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent form submit
        successCard.classList.remove("d-none");
        backdrop.classList.remove("d-none");

        // Scroll to the card
        successCard.scrollIntoView({ behavior: "smooth" });
    });

    // Hide message when Continue is clicked
    continueBtn.addEventListener("click", function () {
        successCard.classList.add("d-none");
        backdrop.classList.add("d-none");
    });
});
