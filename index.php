<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de html5-qrcode</title>
    <style>
        #reader {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Teste de QR Code</h1>
    <div id="reader"></div>

    <!-- Inclusão da biblioteca html5-qrcode -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            alert('QR Code detectado: ' + decodedText);
            // Parar a câmera após encontrar um QR code
            html5QrcodeScanner.clear();
        }

        function onScanError(errorMessage) {
            console.log('Erro de escaneamento: ', errorMessage);
        }

        // Instanciar e renderizar o scanner de QR code
        const html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 }, false);
        
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
</body>
</html>
