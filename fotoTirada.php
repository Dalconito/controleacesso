<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <video id="video" width="300" height="300" style="border: 1px solid black;"></video>
    <canvas id="canvas" hidden></canvas>
    <p id="output">Scanning...</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsqr/1.4.0/jsQR.min.js"></script>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const canvasContext = canvas.getContext('2d');
        const output = document.getElementById('output');

        // Acesso à câmera
        navigator.webkitGetUserMedia({ video: { facingMode: 'environment' } })
            .then((stream) => {
                video.srcObject = stream;
                video.play();
                scanQRCode();
            })
            .catch((err) => {
                console.error('Erro ao acessar a câmera: ', err);
                output.textContent = 'Erro ao acessar a câmera';
            });

        // Função para escanear QR Code
        function scanQRCode() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: 'dontInvert',
            });

            if (code) {
                output.textContent = `QR Code detectado: ${code.data}`;
                video.pause();
                // Aqui você pode enviar o resultado para o servidor usando PHP
                // Por exemplo, usando fetch() ou XMLHttpRequest
            } else {
                requestAnimationFrame(scanQRCode);
            }
        }
    </script>
</body>
</html>
