// confirm-password.js

document.addEventListener("DOMContentLoaded", function() {
    const passwordField = document.querySelector("input[name='new-password']");
    const confirmPasswordField = document.querySelector("input[name='confirm-password']");
    const signupButton = document.querySelector(".signup-btn");

    // Add event listener to confirm password field to check match
    confirmPasswordField.addEventListener("input", function() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmPasswordField.setCustomValidity("Passwords do not match");
        } else {
            confirmPasswordField.setCustomValidity(""); // Reset validity if passwords match
        }
    });

    // Optional: Disable form submission if passwords do not match
    signupButton.addEventListener("click", function(event) {
        if (passwordField.value !== confirmPasswordField.value) {
            event.preventDefault();  // Prevent form submission
            alert("Passwords do not match!");
        }
    });
});
