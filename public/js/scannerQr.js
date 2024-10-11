var linkQr = document.getElementById("linkqrCode");
var btnValidar = document.getElementById("btnValidar");
var html5QrCode; // Declare globalmente
var xhr = new XMLHttpRequest();

xhr.open("POST", "./controllers/dbTeste.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
xhr.onload = () => {
    if (xhr.status >= 200 && xhr.status < 300) {
        var response = JSON.parse(xhr.responseText)
        alert(response.status + response.message)
    } else alert("NAO VEIO NADA")
}

function onScanSuccess(decodedText, decodedResult) {
    // Parar a câmera após o sucesso
    enviarPost(decodedText);
    html5QrCode.stop().then(ignore => {
        console.log("Câmera parada com sucesso.");
    }).catch(err => {
        console.error("Erro ao parar a câmera: ", err);
    });
    
}

function onScanError(errorMessage) {
    console.log('Erro de escaneamento: ', errorMessage);
}

function validar() {
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            // Cria um dropdown para escolher a câmera
            let select = document.createElement('select');
            devices.forEach((device, index) => {
                let option = document.createElement('option');
                option.value = device.id;
                option.text = `Câmera ${index + 1}`;
                select.appendChild(option);
            });

            document.body.appendChild(select);

            // Quando o usuário seleciona a câmera
            select.onchange = () => {
                const cameraId = select.value;
                html5QrCode = new Html5Qrcode("reader");

                html5QrCode.start(
                    cameraId,
                    { fps: 30, qrbox: 250 },
                    onScanSuccess,
                    onScanError
                );
            };

        } else {
            console.error("Nenhuma câmera disponível.");
        }
    }).catch(err => {
        console.error("Erro ao obter câmeras: ", err);
    });
}

function enviarPost(decodedText) {
    xhr.open("POST", "./controllers/dbTeste.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status == "002"){
                alert("Código Escaneado com sucesso")
            }
            else{
                alert("Código ja Escaneado")
            }
        }
    };
    var dados = "qrCode=" + encodeURIComponent(decodedText);
    xhr.send(dados);
}
