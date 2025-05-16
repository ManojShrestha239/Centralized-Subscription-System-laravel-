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
if (apiKeyInput.value.trim() === "") {
    apiKeyInput.value = generateApiKey();
}

document.getElementById("copyBtn").addEventListener("click", function (event) {
    event.preventDefault();

    apiKeyInput.select();
    apiKeyInput.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("API Key copied to clipboard!");
});

document.getElementById("regenBtn").addEventListener("click", function (event) {
    event.preventDefault();

    apiKeyInput.value = generateApiKey();
    document.getElementById("error-message").classList.add("hidden");
});
