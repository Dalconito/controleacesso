<?php
$postData = isset($_POST['qrCode']) ? $_POST['qrCode'] : null;
$response = [];
function resposta() {
$conn = connectDb();
    $selectDbQuery = "SELECT * FROM qrcode WHERE qrcodeid=? ";
    $query = $conn->prepare($selectDbQuery);
    if($query === false){printError();}
    $query->bind_param("s", $postData);
    if($query->execute()){
        $resultDbQuery = $query->get_result();
        $resultQuery = $resultDbQuery->fetch_assoc();
        printSucesso("Selecao feita");
    }
    else {printErroExecute("Seleção");}
    $query->close(); $conn->close();

    if ($resultQuery['stat'] == 0)
    {updateQrCode($postData);}
    else enviarResposta($status="001", $message="QrCode Já validado");
}