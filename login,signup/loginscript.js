
    document.querySelector("form").addEventListener("submit", function(event) {
        // Prevent the form from submitting
        event.preventDefault();

        // Get form values
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("conform-password").value;

        // Check if all required fields are filled
        const requiredFields = document.querySelectorAll("input[required], select[required]");
        for (let field of requiredFields) {
            if (!field.value) {
                alert("Please fill out all required fields.");
                return;
            }
        }

        // Check if passwords match
        if (newPassword !== confirmPassword) {
            alert("New Password and Confirm Password do not match.");
            return;
        }

        // If all checks pass, submit the form
        this.submit();
    });

    
    