const olho = document.getElementById('olho');

olho.addEventListener('click', () => {
    campo.type = campo.type == 'password' ? 'text' : 'password';
});