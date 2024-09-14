var xhr = new XMLHttpRequest();

xhr.open("POST", "./../controllers/loginController.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onload = () => {
    if (xhr.status >= 200 && xhr.status < 300) {
        var response = JSON.parse(xhr.responseText);
        alert(response.status + response.message);
    } else {
        alert("Erro ao comunicar com o servidor");
    }
};