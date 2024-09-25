async function logout() {
    const data = {"data":"logout"}
    try {
        const response = await fetch('./controllers/logoutController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/application/json' // Formato tradicional de formulário
            },
            body: JSON.stringify(data) // Não precisa usar JSON.stringify
        });

        if (!response.ok) {
            throw new Error(`Erro: ${response.status}`);
        }

        const respostaJSON = await response.json();
        if(respostaJSON.status == "success"){window.location.href="./index.php"}
        console.log('Resposta do servidor:', respostaJSON);

    } catch (error) {
        console.error('Erro ao enviar dados:', error);
    }
}

document.getElementById('botaoEnvia').addEventListener('click', async () => {
    var dataPost = {'novaSenha': "confirmaSenha"};

    try {
        const response = await fetch('./controllers/dashboardController.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(dataPost)
        });

        const data = await response.json();

        console.log(data);
    } catch (error) {
        console.error('ERROU AQUI', error);
    }
});
