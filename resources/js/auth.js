document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.signin form');
    const registerForm = document.querySelector('.signup form');
    const eElement = document.getElementById('rsa-e');
    const nElement = document.getElementById('rsa-n');

    if (!eElement || !nElement) {
        console.warn("RSA public key elements not found in the DOM.");
        return;
    }

    const e = eElement.value;
    const n = nElement.value;

    console.log("rsa-e:", e);
    console.log("rsa-n:", n);

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const emailField = this.querySelector('input[name="email"]');
            const passwordField = this.querySelector('input[name="password"]');
            
            if (emailField && passwordField) {
                const encryptedPassword = rsaEncrypt(passwordField.value, e, n);
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'password_encrypted';
                hiddenInput.value = encryptedPassword;
                this.appendChild(hiddenInput);
                setTimeout(() => this.submit(), 10);    

            }
        });
    }
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const passwordField = this.querySelector('input[name="password"]');
            const confirmPasswordField = this.querySelector('input[name="confirm_password"]');
            
            if (passwordField && confirmPasswordField) {
                if (passwordField.value !== confirmPasswordField.value) {
                    alert('Passwords do not match!');
                    return;
                }
                if (passwordField.value.length < 8) {
                    alert('Password must be at least 8 characters long');
                    return;
                }
                const encryptedPassword = rsaEncrypt(passwordField.value, e, n);
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'password_encrypted';
                hiddenInput.value = encryptedPassword;
                this.appendChild(hiddenInput);
                
                this.submit();
            }
        });
    }
    
    function rsaEncrypt(message, e, n) {
        let encrypted = [];
        
        for (let i = 0; i < message.length; i++) {
            const m = message.charCodeAt(i);
            
            
            const c = modPow(BigInt(m), BigInt(e), BigInt(n));
            
            encrypted.push(c.toString());
        }
        
        return encrypted.join(' ');
    }
    
    
    function modPow(base, exponent, modulus) {
        if (modulus === 1n) return 0n;
        
        let result = 1n;
        base = base % modulus;
        
        while (exponent > 0n) {
            if (exponent % 2n === 1n) {
                result = (result * base) % modulus;
            }
            exponent = exponent / 2n;
            base = (base * base) % modulus;
        }
        
        return result;
    }
});