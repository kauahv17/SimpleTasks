document.getElementById('tarefaForm').addEventListener('submit', function(e) {
  
  const titulo = document.getElementById('titulo').value;
  const descricao = document.getElementById('descricao').value;
  const estado = document.querySelector('input[name="estado"]:checked').value;

  console.log('Salvar:', { titulo, descricao, estado });
});