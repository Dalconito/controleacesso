document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const idQrCode = document.getElementById('idQrCode');
    const submitButton = form.querySelector('button');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', (e) => {
        if (idQrCode.value === '' || isNaN(idQrCode.value)) {
            e.preventDefault(); // Prevent form submission
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Por favor, insira um ID válido.';
        } else {
            errorMessage.style.display = 'none';
        }
    });
});
