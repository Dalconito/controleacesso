<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include_once "./phpqrcode-master/qrlib.php"; include_once "./qrcode/geradorQrcode.php";?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaner de QrCode</title>
    <link rel="stylesheet" href="./public/scannerQr.css">
</head>
<body>
    <div id="reader"></div>
    <p id="qrCodeParagh" class="escondido encontrado">QrCode Encontrado!</p>
    <div class="divBtn">
        <button type="submit" class="validar" id="btnValidar" onclick="validar()">Validando</button>
    </div>
    
<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    var linkQr = document.getElementById("linkqrCode");
    var btnValidar = document.getElementById("btnValidar");
    var html5QrCode;
    var xhr = new XMLHttpRequest();
    
    xhr.open("POST", "./controllers/dbTeste.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xhr.onload = () =>{
        if (xhr.status >=200 && xhr.status <300){
            var response = JSON.parse(xhr.responseText)
            alert(response.status + response.message)
        }
        else alert("NAO VEIO NADA")
    }

    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById("qrCodeParagh").style.display = "block";
        enviarPost(decodedText);
        // Para de ler após encontrar o QR Code
        html5QrCode.stop().then(() => {
            console.log("Scanner parado com sucesso.");
        }).catch(err => {
            console.error("Erro ao parar o scanner: ", err);
        });}

    function onScanError(errorMessage) {
        console.log('Erro de escaneamento: ', errorMessage);}

    function validar() {
        Html5Qrcode.getCameras().then(devices => {
            // Selecionar a câmera padrão (por exemplo, a frontal)
            const cameraId = devices[1].id; // Ou use devices[n] para outra câmera

            html5QrCode = new Html5Qrcode("reader");
            
            html5QrCode.start(cameraId,
                {fps: 30, qrbox: 250},
                onScanSuccess, onScanError
            );
        }).catch(err => {
            console.error("Erro ao obter câmeras: ", err);
        });}

    function enviarPost(decodedText) {
        
        xhr.open("POST", "./controllers/dbTeste.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                }};
        var dados = "qrCode=" + encodeURIComponent(decodedText);
        xhr.send(dados);}

</script>

</body>
</html>
