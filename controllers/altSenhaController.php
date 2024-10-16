<?PHP
require_once __DIR__ . "/../database/database.php";

$dataPost = json_decode(file_get_contents("php://input"), true);

if (empty($dataPost)) {
    echo json_encode([
        "status"=> false,
        "message"=> "Sem dados para enviar"
    ]);
}
else{
    $emailPost = $dataPost['email'];
    $senhaPost = $dataPost['novaSenha'];
    updatePassword($emailPost, $senhaPost);
}

function updatePassword($email, $novaSenha): void {
    $conn = connectDb();

    $selectDbQuery = "UPDATE usuarios SET senha=? WHERE email=?";  // Atualize com o nome correto da coluna
    $query = $conn->prepare($selectDbQuery);

    if ($query === false) {
        echo json_encode([
            'status' => false,
            'message' => 'Erro ao preparar a query'
        ]);
        exit();
    }

    $query->bind_param("ss", $novaSenha, $email);
    if ($query->execute()) {
        echo json_encode([
            'status' => true,
            'message' => 'Senha atualizada com sucesso'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Erro ao executar a query'
        ]);
    }
    exit();
}

