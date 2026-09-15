function openMenu() {
    document.getElementById("sideMenu").style.width = "250px";
    document.body.classList.add("menu-open");
}

// Função para fechar o menu lateral
function closeMenu() {
    document.getElementById("sideMenu").style.width = "0";
    document.body.classList.remove("menu-open");
}

document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./controllers/loginController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    document.getElementById('loader').style.display = 'block';

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    document.getElementById('loader').style.display = 'none';
                    window.location.href = "./dashboard.php"; // Substitua pela URL correta
                } else {
                    console.log(xhr.responseText);
                    document.getElementById('loader').style.display = 'none';

                    document.getElementById("errorMessage").textContent = response.message;
                }
            } catch (error) {
                document.getElementById('loader').style.display = 'block';
                console.error("Erro ao processar a resposta:", error);
            }
        } else {
            document.getElementById('loader').style.display = 'block';
            console.log("Erro ao comunicar com o servidor");
        }
    };

    xhr.onerror = function() {
        alert("Erro na requisição AJAX");
    };

    var login = encodeURIComponent(document.getElementById("username").value);
    var senha = encodeURIComponent(document.getElementById("password").value);

    xhr.send("login=" + login + "&senha=" + senha);
});

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