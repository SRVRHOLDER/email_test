document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("verifyForm").style.display = "none"; // Hide verification form initially

    document.getElementById("keyForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        const email = document.getElementById("email").value;

        // Replace this with your own logic to generate a 5-digit key
        const generatedKey = Math.floor(Math.random() * 90000) + 10000;

        // Send the generated key to the email (You'd need a backend for sending emails)
        // Here, we're just showing the generated key for demonstration purposes
        alert(`Key generated: ${generatedKey}`);
        
        // Show the verification form
        document.getElementById("verifyForm").style.display = "block";
    });

    document.getElementById("verifyForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const enteredKey = document.getElementById("key").value;
        const generatedKey = /* Get the generated key from wherever it's stored */;

        if (enteredKey === generatedKey) {
            document.getElementById("status").textContent = "Key verified successfully!";
        } else {
            document.getElementById("status").textContent = "Key verification failed. Please try again.";
        }
    });
});
