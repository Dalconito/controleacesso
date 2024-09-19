document.getElementById('recuperacaoForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const cpf = document.getElementById('cpf').value;
    const email = document.getElementById('email').value;

    // Cria o objeto de dados
    const data = {
        cpf: cpf,
        email: email
    };

    try {
        const response = await fetch('./controllers/recuperaController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        // Exibe a mensagem de sucesso ou erro
        const mensagemErro = document.getElementById('mensagemErro');
        mensagemErro.textContent = result.mensagem;
        if (result.status === 'sucesso') {
            mensagemErro.style.color = 'green';
        } else {
            mensagemErro.style.color = 'red';
        }

    } catch (error) {
        console.error('Erro na requisição:', error);
        document.getElementById('mensagemErro').textContent = 'Erro ao enviar dados!';
    }
});
