function logout() {
    const dataToSend = {
        cpf: '12345678901',
        email: 'exemplo@email.com'
    };
    
    fetch("./controllers/adcController.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dataToSend),  // Converte os dados para JSON antes de enviar
    })
    .then(response => response.json())  // Converte a resposta para JSON
    .then(result => {
        console.log('Sucesso:', result);  // Processa a resposta
    })
    .catch(error => {
        console.error('Erro:', error);  // Exibe erros
    });

}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const nomeC = document.getElementById('nomeC');
    const cpf = document.getElementById('cpf');
    const idIngresso = document.getElementById('idIngresso');
    const submitButton = form.querySelector('input[type="submit"]');

    form.addEventListener('submit', async (e) => {
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

        // If all validations pass, submit the form via POST request

            // Create a FormData object to send the form data
            const formData = new FormData();
            formData.append('nomeC', nomeValue);
            formData.append('cpf', cpfValue);
            formData.append('idIngresso', idIngressoValue);

            try {
                // Send the data via POST request
                const response = await fetch("./controllers/loginController.php", {
                    method: 'POST',
                    body: formData
                });

                // Check the response
                if (response.ok) {
                    // Process the response if needed
                    const responseData = await response.json();
                    console.log('Success:', responseData);
                    // Optionally, redirect or show a success message
                } else {
                    // Handle errors if the request failed
                    console.error('Error:', response.statusText);
                }
            } catch (error) {
                console.error('Error:', error);
            }

    });
});
