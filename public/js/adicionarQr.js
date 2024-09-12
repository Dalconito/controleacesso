document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const nomeC = document.getElementById('nomeC');
    const cpf = document.getElementById('cpf');
    const idIngresso = document.getElementById('idIngresso');
    const submitButton = form.querySelector('input[type="submit"]');

    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent default form submission for validation
        
        const cpfValue = cpf.value;
        const nomeValue = nomeC.value;
        const idIngressoValue = idIngresso.value;

        // Basic CPF validation (just checking length)
        if (cpfValue.length !== 11) {
            alert("Por favor, insira um CPF válido com 11 dígitos.");
            return;
        }

        // Basic check for empty fields
        if (nomeValue === '' || idIngressoValue === '') {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        // Simulate successful form submission
        alert("Cadastro realizado com sucesso!");
        form.submit();
    });
});
