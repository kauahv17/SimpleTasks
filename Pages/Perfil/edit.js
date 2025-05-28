document.querySelector('.upload-icon input')?.addEventListener('change', () => {
  document.querySelector('.upload-icon').closest('form').submit();
});

let isEditing = false;

document.querySelector('#btn-editar-nome')?.addEventListener('click', () => {
  const input = document.querySelector('#input-nome');
  const btn = document.querySelector('#btn-editar-nome');
  const form = document.querySelector('#form-nome');

  if (!isEditing) {
    // Habilita a edição
    input.removeAttribute('readonly');
    input.focus();
    btn.src = '/ProjetoIndividual/imgs/editar.png';
    isEditing = true;
  } else {
    // Desabilita a edição e envia o formulário
    input.setAttribute('readonly', 'readonly');
    btn.src = '/ProjetoIndividual/imgs/editar.png';
    isEditing = false;

    // Verifica se o nome não está vazio
    if (input.value.trim() === '') {
      alert('O nome não pode ficar vazio!');
      return;
    }

    form.submit();
  }
});

document.querySelector('#input-nome')?.addEventListener('keydown', (e) => {
  if (e.key === 'Enter') {
    e.preventDefault();
    document.querySelector('#btn-editar-nome').click();
  }
});
