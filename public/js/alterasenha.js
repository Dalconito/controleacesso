
document.getElementById('botao').addEventListener('click', async function(){
    var novaSenha = document.getElementById('novaSenha').value
    var confirmaSenha = document.getElementById('confirmaSenha').value
    var dataPost = {'senha': novaSenha, 'novaSenha':confirmaSenha}
    console.log(novaSenha)
    console.log(confirmaSenha)
    if(novaSenha != confirmaSenha)
        alert ("acerta ae")
  
        try{
            const response = await fetch('./controllers/altSenhaController.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: JSON.stringify(dataPost)
            });

            const result = await response.json()
        }
        catch(error) {

        }
    
})