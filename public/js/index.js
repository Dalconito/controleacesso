document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./controllers/loginController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    alert(response.message);
                    window.location.href = "./adicionarQr.php"; // Substitua pela URL correta
                } else {
                    console.log(xhr.responseText);
                    document.getElementById("errorMessage").textContent = response.message;
                }
            } catch (error) {
                console.error("Erro ao processar a resposta:", error);
                alert("Erro ao processar a resposta do servidor.");
            }
        } else {
            alert("Erro ao comunicar com o servidor");
        }
    };

    xhr.onerror = function() {
        alert("Erro na requisição AJAX");
    };

    var login = encodeURIComponent(document.getElementById("username").value);
    var senha = encodeURIComponent(document.getElementById("password").value);

    xhr.send("login=" + login + "&senha=" + senha);
});
