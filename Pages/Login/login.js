// Função para validar o formulário de login
function validateLoginForm() {
    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('senha').value;

    if (!usuario || !senha) {
        alert('Por favor, preencha todos os campos!');
        return false;
    }
    return true;
}

// Função para validar o formulário de cadastro
function validateRegisterForm() {
    const nome = document.getElementById('nome').value;
    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('senha').value;

    if (!nome || !usuario || !senha) {
        alert('Por favor, preencha todos os campos!');
        return false;
    }

    return true;
}

// Adiciona os event listeners quando o documento estiver carregado
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            if (!validateRegisterForm()) {
                e.preventDefault();
            }
        });
    }
}); 