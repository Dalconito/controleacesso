document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const nomeC = document.getElementById('nomeC');
    const cpf = document.getElementById('cpf');
    const idIngresso = document.getElementById('idIngresso');
    const submitButton = form.querySelector('input[type="submit"]');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent default form submission for validation
        
        const msgUser = document.getElementById('msgUsr');
        const cpfValue = cpf.value;
        const nomeValue = nomeC.value;
        const idIngressoValue = idIngresso.value;
        let isValid = true; // Flag to track if the form is valid

        // Basic CPF validation (just checking length)
        if (cpfValue.length !== 14) {
            msgUser.style.display = 'block';
            msgUser.textContent = 'Por favor, insira um CPF válido.';
            isValid = false; // Mark the form as invalid
        } else {
            msgUser.style.display = 'none';
        }

        // Basic check for empty fields
        if (nomeValue === '' || idIngressoValue === '') {
            alert("Por favor, preencha todos os campos.");
            isValid = false; // Mark the form as invalid
        }

        // If all validations pass, submit the form
        if (isValid) {
            form.submit();
        }
    });
});
