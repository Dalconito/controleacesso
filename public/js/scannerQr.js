var btnValidar = document.getElementById("btnValidar");
var html5QrCode;
var xhr = new XMLHttpRequest();

xhr.open("POST", "./controllers/dbTeste.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onload = () => {
    if (xhr.status >= 200 && xhr.status < 300) {
        var response = JSON.parse(xhr.responseText);
        alert(response.status + response.message);
    } else {
        alert("Erro ao comunicar com o servidor");
    }
};

function onScanSuccess(decodedText, decodedResult) {
    document.getElementById("qrCodeParagh").style.display = "block";
    enviarPost(decodedText);
    // Para de ler após encontrar o QR Code
    html5QrCode.stop().then(() => {
        console.log("Scanner parado com sucesso.");
    }).catch(err => {
        console.error("Erro ao parar o scanner: ", err);
    });
}

function onScanError(errorMessage) {
    console.log('Erro de escaneamento: ', errorMessage);
}

function validar() {
    Html5Qrcode.getCameras().then(devices => {
        // Selecionar a câmera padrão (por exemplo, a frontal)
        const cameraId = devices[1].id; // Ou use devices[n] para outra câmera

        html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start(cameraId,
            { fps: 30, qrbox: 250 },
            onScanSuccess, onScanError
        );
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
            console.log(response);
        }
    };
    var dados = "qrCode=" + encodeURIComponent(decodedText);
    xhr.send(dados);
}
