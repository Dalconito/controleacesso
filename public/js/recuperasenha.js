document.getElementById('recuperacaoForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Impede o envio automático do formulário
    
    const cpf = document.getElementById('cpf').value;
    const email = document.getElementById('email').value;
    const mensagemErro = document.getElementById('mensagemErro');

    // Verifica se o CPF e o e-mail estão preenchidos
    if (!validarCPF(cpf)) {
        mensagemErro.textContent = 'CPF inválido. Verifique o formato.';
        return;
    }

    if (email === '') {
        mensagemErro.textContent = 'Por favor, insira um e-mail válido.';
        return;
    }

    // Envia os dados do CPF e e-mail para o backend via AJAX ou Fetch API
    mensagemErro.textContent = '';  // Limpa a mensagem de erro se estiver tudo certo

    // Enviar para o backend (exemplo de fetch, ajuste conforme necessário)
    const data = { cpf, email };

// Enviando dados com POST
const dataToSend = {
    cpf: '12345678901',
    email: 'exemplo@email.com'
};

fetch("./controllers/recuperaController.php", {
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

});

// Validação simples de CPF (não garante 100% de validade)
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');  // Remove caracteres não numéricos
    if (cpf.length !== 11) return false;
    // Aqui você pode implementar uma validação mais complexa de CPF se quiser
    return true;
}
