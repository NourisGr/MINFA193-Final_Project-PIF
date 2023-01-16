function verifyLogin(event) {
    try {
        const error_element = document.querySelector(".error-msg");
        const username = document.getElementsByName("username").val;
        if (username.length < 3 || username.length > 16) {
            throw new Error("Username must be between 3 and 16 characters.");
        }
        
        const password = document.getElementsByName("password").val;
        if (password.length < 4 || password.length > 32) {
            throw new Error("Password must be between 4 and 32 characters.");
        }
    } catch(e) {
        event.preventDefault();
        error_element.textContent = e;
    }
}