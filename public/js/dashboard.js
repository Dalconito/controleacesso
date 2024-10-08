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

async function exibindo(button, cpf, ingressos){
    var resultadoDiv = document.getElementById('resultado')
    let data = {cpfPost: cpf, ingressoPost:ingressos}
    

    const row = button.closest('tr');
    
    // Pega o valor do <td> de status que está na mesma linha
    const statusCell = row.querySelector('td[class^="status-"]');
    const statusValue = statusCell.textContent.trim(); // Pega o valor do status
    
    // Verifica o valor do status
    if (statusValue != '9') {
        alert("Verifique se o Ingresso esta Disponivel");
    } else {





    try{
    const response  = await fetch ('./controllers/qrDashboard.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(data)})

    const result = await response.json()

    if (result.status){
        if(result.qrcode)
        {
            const img = document.createElement('img');
            img.src = 'data:image/png;base64,' + result.qrCodeImage;
            img.alt = 'QR Code';
            
            // Limpa o resultado anterior e adiciona a nova imagem
            const resultadoDiv = document.getElementById('resultado');
            resultadoDiv.innerHTML = ''; // Limpa o conteúdo anterior
            resultadoDiv.appendChild(img);
        }else{
            resultadoDiv.textContent = result.message
        }
    }
    else{resultadoDiv.textContent = "Erro ao Exibir o QrCode, verifique o status do Ingresso"}
    }
    catch(error){
        console.error("OLHA A MERDA", error)
    }
}
}