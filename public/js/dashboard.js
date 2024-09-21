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
