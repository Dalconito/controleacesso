<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./public/css/cadastroUsuario.css">
</head>
<body>
    <div class="form-container">
        <form id="registerForm" method="post">
            <h2>Cadastro</h2>
            <div class="input-group">
                <input type="text" id="login" name="login" required>
                <label for="login">Login</label>
            </div>
            <div class="input-group">
                <input type="text" id="cpf" name="cpf" oninput="formatarCPF(this)" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Senha</label>
            </div>
            <button type="submit">Cadastrar</button>
            <a href="./index.php" class="back-button">Voltar</a>
            <div id="errorMessage" class="input-group"></div>

            <div style="display: flex;justify-content: center;" class="input-group">
                <div class="loader" id="loader"></div> <!-- Animação de espera -->
            </div>
        </form>
    </div>

    <script>
        function esperar(tempo){
            return new Promise(resolve => setTimeout(resolve, tempo))
        }

        const form = document.getElementById('registerForm')
        form.addEventListener('submit', async(e)=>{
            e.preventDefault()
            const loginForm =document.getElementById('login')
            const cpfForm =document.getElementById('cpf')
            const emailForm =document.getElementById('email')
            const passwordForm =document.getElementById('password')
            const loader = document.getElementById('loader')
            const mensagem = document.getElementById('errorMessage')
            const data = {login: loginForm.value , cpf: cpfForm.value,
                email: emailForm.value, senha:passwordForm.value}
            loader.style.display = 'block'
            const response = await fetch('./controllers/cadastroUsuarioController.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })

            const result = await response.json();

            if(result.status){
                mensagem.style.display = 'block'
                mensagem.style.color = 'green'
                mensagem.textContent = result.message
                await esperar(1700)
                loader.style.display = 'none'
                window.location.href = "./index.php"
            }
            else{
                mensagem.style.display = 'block'
                mensagem.style.color = 'red'
                mensagem.textContent = result.message
                await esperar(1200)
                loader.style.display = 'none'
                location.reload()
                console.log('Erro ao processar dados')
            }
        })


        function formatarCPF(cpfInput) {
    // Remove todos os caracteres que não são dígitos
    let cpf = cpfInput.value.replace(/\D/g, "");

    // Adiciona os pontos e traço conforme o CPF é digitado
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");        // 123.456
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");        // 123.456.789
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");  // 123.456.789-01
    }

    // Atualiza o valor do input com o CPF formatado
    cpfInput.value = cpf;
}

    </script>
</body>
</html>

