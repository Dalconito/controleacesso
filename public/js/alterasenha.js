
document.getElementById('botao').addEventListener('click', async function(){
    var novaSenha = document.getElementById('novaSenha').value
    var confirmaSenha = document.getElementById('confirmaSenha').value
    var dataPost = {'novaSenha':confirmaSenha}
    var msgErro = document.getElementById('mensagemErro')
    console.log(novaSenha)
    console.log(confirmaSenha)
    if(novaSenha != confirmaSenha)
        msgErro.textContent = "Senhas nao coincidem"
    else{
            const response = await fetch('./controllers/SenhaController.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(dataPost)
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('ERROU AQUI', error))
    }
    
})