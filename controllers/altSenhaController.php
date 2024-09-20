<?PHP
function conectando(){
    $host = "webdecision.mysql.uhserver.com";
    $user = "dalconito";
    $database = "webdecision";
    $senha = "HelloWorld*89";
    $conn = mysqli_connect($host, $user, $senha, $database);
    return $conn;
}
function updatePassword($loginUsr, $novaSenha): void {
    $conn = conectando();
    // Verifique se o nome da coluna está correto, talvez seja 'login' ou algo semelhante
    $selectDbQuery = "UPDATE usuarios SET senha=? WHERE loginusr=?";  // Atualize com o nome correto da coluna
    $query = $conn->prepare($selectDbQuery);

    if ($query === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao preparar a query'
        ]);
        exit();
    }

    $query->bind_param("ss", $novaSenha, $loginUsr);
    if ($query->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Senha atualizada com sucesso'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao executar a query'
        ]);
    }
    exit();
}




function soma($a, $b){
    return ($a+$b);
}