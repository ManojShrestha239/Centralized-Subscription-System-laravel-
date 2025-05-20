// Function to generate a random API key
function generateApiKey() {
    const length = 40;
    const chars =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let apiKey = "";

    for (let i = 0; i < length; i++) {
        apiKey += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return apiKey;
}

const apiKeyInput = document.getElementById("api_key");
if (apiKeyInput) {
    if (apiKeyInput.value.trim() === "") {
        apiKeyInput.value = generateApiKey();
    }

    document
        .getElementById("copyBtn")
        .addEventListener("click", function (event) {
            event.preventDefault();

            apiKeyInput.select();
            apiKeyInput.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("API Key copied to clipboard!");
        });

    document
        .getElementById("regenBtn")
        .addEventListener("click", function (event) {
            event.preventDefault();

            apiKeyInput.value = generateApiKey();
            document.getElementById("error-message").classList.add("hidden");
        });
}

// Subscription Expiry Date Calculation
document.addEventListener("DOMContentLoaded", function () {
    const initialExpiryDate = document.getElementById(
        "subscription_expiry_date"
    ).value;

    document
        .getElementById("subscription_period")
        .addEventListener("change", calculateExpiryDate);

    function calculateExpiryDate() {
        const periodSelect = document.getElementById("subscription_period");
        const expiryDateField = document.getElementById(
            "subscription_expiry_date"
        );

        if (!periodSelect.value) {
            expiryDateField.value = initialExpiryDate;
            return;
        }

        const expiryDateData =
            expiryDateField.getAttribute("x-data-expiry-date");

        const monthsToAdd = parseInt(periodSelect.value);

        const today = new Date();

        let baseDate;

        if (expiryDateData) {
            const currentExpiryDate = new Date(expiryDateData);
            baseDate = currentExpiryDate;
        } else {
            baseDate = today;
        }

        const expiryDate = new Date(baseDate);

        expiryDate.setMonth(expiryDate.getMonth() + monthsToAdd);

        const year = expiryDate.getFullYear();
        const month = String(expiryDate.getMonth() + 1).padStart(2, "0");
        const day = String(expiryDate.getDate()).padStart(2, "0");

        expiryDateField.value = `${year}-${month}-${day}`;
    }
});
