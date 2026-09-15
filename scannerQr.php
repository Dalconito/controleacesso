<?php
session_start();
if (!$_SESSION) {
    header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php include_once "./phpqrcode-master/qrlib.php";
    require_once(__DIR__ . "/controllers/geradorQrcode.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaner de QrCode</title>
    <link rel="stylesheet" href="./public/css/scannerQr.css">
</head>

<body>
    <p id="qrcodeResultado"></p>
    <div id="reader"></div>
    <p id="qrCodeParagh" class="escondido encontrado">QrCode Encontrado!</p>
    <div class="divBtn">
        <button type="submit" class="validar" id="btnValidar" onclick="validar()">Validando</button>
    </div>

    <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
    <script>
        var linkQr = document.getElementById("linkqrCode");
        var btnValidar = document.getElementById("btnValidar");
        var html5QrCode; // Declare globalmente
        var xhr = new XMLHttpRequest();

        xhr.open("POST", "./controllers/dbTeste.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText)
                if (response.status == "001") {
                    document.getElementById('qrcodeResultado').textContent = "QrCode Já Utilizado, Acesso Negado"
                } else document.getElementById('qrcodeResultado').textContent = "QrCode Valido, Acesso Permitido"
            }

        }

        function onScanSuccess(decodedText, decodedResult) {
            // Parar a câmera após o sucesso
            html5QrCode.stop().then(ignore => {
                console.log("Câmera parada com sucesso.");
            }).catch(err => {
                console.error("Erro ao parar a câmera: ", err);
            });
            enviarPost(decodedText);
        }

        function onScanError(errorMessage) {
            console.log('Erro de escaneamento: ', errorMessage);
        }

        function validar() {
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    let cameraIdSalva = localStorage.getItem('cameraId');

                    if (cameraIdSalva) {
                        iniciarLeitorQr(cameraIdSalva);
                    } else {
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
                            // Salva a câmera escolhida no localStorage
                            localStorage.setItem('cameraId', cameraId);
                            iniciarLeitorQr(cameraId);
                        };
                    }

                } else {
                    console.error("Nenhuma câmera disponível.");
                }
            }).catch(err => {
                console.error("Erro ao obter câmeras: ", err);
            });
        }

        function iniciarLeitorQr(cameraId) {
            html5QrCode = new Html5Qrcode("reader");
            document.getElementById('qrcodeResultado').textContent = '';
            html5QrCode.start(
                cameraId, {
                    fps: 30,
                    qrbox: 250
                },
                onScanSuccess,
                onScanError
            );
        }


        function enviarPost(decodedText) {
            xhr.open("POST", "./controllers/dbTeste.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                }
            };
            var dados = "qrCode=" + encodeURIComponent(decodedText);
            xhr.send(dados);
        }
    </script>

</body>

</html>