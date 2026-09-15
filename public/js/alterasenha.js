const senha = document.getElementById('novaSenha');
const novaSenha = document.getElementById('confirmaSenha');
const mensagemErro = document.getElementById('mensagemErro');


async function validar(email){
    if (senha.value != novaSenha.value){
        mensagemErro.textContent = "Senhas não Coincidem";
    }else{
    const senhaPost = senha.value
    const data = {
        novaSenha: senhaPost,
        email: email
    };
    try {
        const response = await fetch('./controllers/altSenhaController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        // Exibe a mensagem de sucesso ou erro
        mensagemErro.textContent = result.message;
        if (result.status) {
            mensagemErro.style.color = 'green';
            await esperar(1000)
            window.location.href = "./index.php"
        } else {
            mensagemErro.style.color = 'red';
        }

    } catch (error) {
        console.error('Erro na requisição:', error);
        mensagemErro.textContent = 'Erro ao enviar dados!';
    }

    }

}

function esperar(tempo){
    return new Promise(resolve => setTimeout(resolve, tempo))

}