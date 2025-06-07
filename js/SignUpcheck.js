document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.querySelector('form'); 
    const emailInput = document.getElementById('floating_email');
    const passwordInput = document.getElementById('floating_password');
    const repeatPasswordInput = document.getElementById('floating_repeat_password');
    const firstNameInput = document.getElementById('floating_first_name');
    const lastNameInput = document.getElementById('floating_last_name');

    function displayError(inputElement, message) {
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('p');
            errorElement.classList.add('error-message', 'text-blue-500', 'text-xs', 'mt-1'); 
            inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
        }
        errorElement.textContent = message;
        inputElement.classList.add('border-blue-500', 'focus:border-blue-500'); 
    }

    // Fonction d'aide pour masquer les messages d'erreur
    function clearError(inputElement) {
        let errorElement = inputElement.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = '';
            errorElement.remove(); 
        }
        inputElement.classList.remove('border-blue-500', 'focus:border-blue-500'); 
    }

    function validateName(input, fieldName) {
        const value = input.value.trim();
        const containsDigit = /\d/.test(value);

        if (value === '') {
            displayError(input, `${fieldName} est requis.`);
            return false;
        } else if (containsDigit) {
            displayError(input, `${fieldName} ne doit pas contenir de chiffres.`);
            return false;
        } else {
            clearError(input);
            return true;
        }
    }

    function validateEmail() {
        const value = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

        if (value === '') {
            displayError(emailInput, 'L\'adresse email est requise.');
            return false;
        } else if (!emailRegex.test(value)) {
            displayError(emailInput, 'Veuillez entrer une adresse email valide.');
            return false;
        } else {
            clearError(emailInput);
            return true;
        }
    }

    function validatePassword() {
        const value = passwordInput.value.trim();
        if (value === '') {
            displayError(passwordInput, 'Le mot de passe est requis.');
            return false;
        } else if (value.length < 8) {
            displayError(passwordInput, 'Le mot de passe doit contenir au moins 8 caractères.');
            return false;
        } else {
            clearError(passwordInput);
            return true;
        }
    }

    function validateRepeatPassword() {
        const passwordValue = passwordInput.value.trim();
        const repeatPasswordValue = repeatPasswordInput.value.trim();

        if (repeatPasswordValue === '') {
            displayError(repeatPasswordInput, 'Veuillez confirmer le mot de passe.');
            return false;
        } else if (passwordValue !== repeatPasswordValue) {
            displayError(repeatPasswordInput, 'Les mots de passe ne correspondent pas.');
            return false;
        } else {
            clearError(repeatPasswordInput);
            return true;
        }
    }

    firstNameInput.addEventListener('input', () => validateName(firstNameInput, 'Prénom'));
    lastNameInput.addEventListener('input', () => validateName(lastNameInput, 'Nom'));
    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', () => {
        validatePassword();
        if (repeatPasswordInput.value !== '') {
            validateRepeatPassword();
        }
    });
    repeatPasswordInput.addEventListener('input', validateRepeatPassword);

    registrationForm.addEventListener('submit', function(event) {
        const isFirstNameValid = validateName(firstNameInput, 'Prénom');
        const isLastNameValid = validateName(lastNameInput, 'Nom');
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();
        const isRepeatPasswordValid = validateRepeatPassword();

        if (!isFirstNameValid || !isLastNameValid || !isEmailValid || !isPasswordValid || !isRepeatPasswordValid) {
            event.preventDefault(); 
            console.log('Le formulaire contient des erreurs de validation. Soumission annulée.');
        } else {
            console.log('Toutes les validations JavaScript ont réussi. Le formulaire est soumis.');
        }
    });
});