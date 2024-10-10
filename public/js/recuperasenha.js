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
        document.getElementById('mensagemErro').textContent = 'Erro ao enviar dados! \n Verifique os dados e Tente Novamente';
    }
});


function formatarCPF(cpfInput) {
    // Remove todos os caracteres que não são dígitos
    let cpf = cpfInput.value.replace(/\D/g, "");

    // Adiciona os pontos e traço conforme o CPF é digitado
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");        // 123.456
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");        // 123.456.789
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");  // 123.456.789-01
    }

    // Atualiza o valor do input com o CPF formatado
    cpfInput.value = cpf;
}