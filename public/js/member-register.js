// Auto update price when plan selected
document.getElementById("plan-select").addEventListener("change", function () {
    const selected = this.options[this.selectedIndex];
    const price = selected.getAttribute("data-price");
    document.getElementById("plan-price").value = price
        ? `$${parseFloat(price).toFixed(2)}`
        : "";
});

// Show success message when register button is clicked
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent actual form submission

    // Show the success card
    const card = document.getElementById("successCard");
    document.getElementById("deleteBackdrop").classList.remove("d-none");
    card.classList.remove("d-none");

    // Optional scroll
    card.scrollIntoView({ behavior: "smooth" });
});

// Hide the success card when 'Continue' button is clicked
document
    .querySelector("#successCard button")
    .addEventListener("click", function () {
        const card = document.getElementById("successCard");
        document.getElementById("deleteBackdrop").classList.add("d-none");
        card.classList.add("d-none");
    });
