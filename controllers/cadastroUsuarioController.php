<?php
$loginUsr = isset($_POST['login']) ? $_POST['login'] : null;
$cpfUsr = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$emailUsr = isset($_POST['email']) ? $_POST['email'] : null;
$tipoUsr = isset($_POST['tipo_grupo']) ? $_POST['tipo_grupo'] : null;
$passUser = isset($_POST['password']) ? $_POST['password'] : null;

if($loginUsr && $cpfUsr && $emailUsr && $tipoUsr && $passUser !=null){
    createUser($loginUsr, $cpfUsr, $emailUsr, $tipoUsr, $passUser);
}

function connectDbUsuarios(){
    $host = "webdecision.mysql.uhserver.com";
    $user = "dalconito";
    $database = "webdecision";
    $senha = "HelloWorld*89";
    $conn = mysqli_connect($host, $user, $senha, $database);
    return $conn;
}

function createUser($login,$cpf,$email,$tipoConta,$senha ){
    $conn = connectDb();
    $query = "INSERT INTO usuarios (loginusr, cpf, email,tipo_conta, senha) VALUES (?,?,?,?,?);";
    $queryCreate = $conn->prepare($query);
    if($queryCreate === false){echo "Erro ao preparar";}
    $queryCreate->bind_param('sssis', $login,$cpf,$email,$tipoConta,$senha);

    if($queryCreate->execute()){
        echo "usuario criado com sucesso";
    }else {"Erro ao Criar Usuario";}
    $queryCreate->close(); $conn->close();
}

