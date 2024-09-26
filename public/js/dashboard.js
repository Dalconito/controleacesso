document.querySelectorAll('td.status').forEach(function (cell) {
    let status = parseInt(cell.textContent); // Converte o conteúdo para número
    if (status === 9) {
        cell.style.backgroundColor = '#d4edda'; // Verde para status 9
    } else {
        cell.style.backgroundColor = '#fff3cd'; // Amarelo claro para outros status
    }
});


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

async function selecionar(botao, cpf){
    let linha = botao.parentElement.parentElement
    let nome = linha.cells[0].innerText;
    let ingressoId = linha.cells[3].innerText;
    let data = {cpf: cpf, ingressoId: ingressoId}
    console.log("nome ", nome, "ingresso ", ingressoId, "cpf ", cpf)

    try{
        const response = await fetch('./controllers/generate.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)})

        const result = await response.json()

        if (result.success) {
            // Cria um elemento de imagem e define a fonte como a string base64
            const img = document.createElement('img');
            img.src = 'data:image/png;base64,' + result.qrCodeImage;
            img.alt = 'QR Code';
            
            // Limpa o resultado anterior e adiciona a nova imagem
            const resultadoDiv = document.getElementById('resultado');
            resultadoDiv.innerHTML = ''; // Limpa o conteúdo anterior
            resultadoDiv.appendChild(img);
        } else {
            alert(data.message); // Mostra a mensagem de erro
        }
    }catch(error) {
        console.error('Erro:', error);
    };
}
