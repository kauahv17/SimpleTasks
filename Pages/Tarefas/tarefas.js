document.addEventListener('DOMContentLoaded', function () {
    // Gerenciamento das abas
    const btns = document.querySelectorAll('.btn-custom');
    const lists = document.querySelectorAll('.task-list');
    const qntdTasks = document.getElementById('qntd-tasks');

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.target;

            // Atualiza botões
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Atualiza listas
            lists.forEach(list => {
                if (list.id === target) {
                    list.classList.add('active');
                    const count = list.querySelectorAll('.task-item').length;
                    qntdTasks.textContent = count;
                } else {
                    list.classList.remove('active');
                }
            });
        });
    });

    // Gerenciamento das checkboxes
    document.addEventListener('change', function (e) {
        if (e.target.type === 'checkbox') {
            const taskItem = e.target.closest('.task-item');
            if (!taskItem) return;

            const estado = e.target.checked;
            const idtarefa = taskItem.getAttribute('data-id');

            // Envia a requisição para atualizar o estado da tarefa
            fetch('/ProjetoIndividual/DB/atualizarTarefa.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `idtarefa=${idtarefa}&estado=${estado ? 1 : 0}`,
                credentials: 'include'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Atualiza a barra de cor
                        const taskBar = taskItem.querySelector('.task-bar');
                        taskBar.classList.remove('verde', 'amarelo');
                        taskBar.classList.add(estado ? 'verde' : 'amarelo');

                        // Clona a tarefa para as outras listas
                        const taskClone = taskItem.cloneNode(true);

                        // Remove a tarefa de todas as listas
                        document.querySelectorAll(`[data-id="${idtarefa}"]`).forEach(task => task.remove());

                        // Adiciona nas listas apropriadas
                        const todasList = document.getElementById('todas');
                        const pendentesList = document.getElementById('pendentes');
                        const concluidasList = document.getElementById('concluidas');

                        // Sempre adiciona em "Todas"
                        todasList.appendChild(taskClone);

                        // Adiciona em "Pendentes" ou "Concluídas" baseado no estado
                        if (estado) {
                            concluidasList.appendChild(taskClone.cloneNode(true));
                        } else {
                            pendentesList.appendChild(taskClone.cloneNode(true));
                        }

                        // Atualiza a contagem de tarefas
                        const activeList = document.querySelector('.task-list.active');
                        const count = activeList.querySelectorAll('.task-item').length;
                        qntdTasks.textContent = count;

                        // Reaplica os event listeners na tarefa clonada
                        addEventListenersToTask(taskClone);
                    } else {
                        // Se falhou, reverte o checkbox
                        e.target.checked = !estado;
                        alert('Erro ao atualizar a tarefa: ' + data.message);
                    }
                })
                .catch(error => {
                    // Se falhou, reverte o checkbox
                    e.target.checked = !estado;
                    console.error('Erro:', error);
                    alert('Erro ao atualizar a tarefa');
                });
        }
    });

    // Função para adicionar event listeners a uma tarefa
    function addEventListenersToTask(taskItem) {
        // Event listener para o botão de visualizar
        const verButton = taskItem.querySelector('.btn-ver');
        if (verButton) {
            verButton.addEventListener('click', function (e) {
                e.preventDefault();
                taskItem.classList.toggle('expanded');
            });
        }

        // Event listener para o checkbox
        const checkbox = taskItem.querySelector('input[type="checkbox"]');
        if (checkbox) {
            checkbox.addEventListener('change', function (e) {
                const changeEvent = new Event('change', { bubbles: true });
                this.dispatchEvent(changeEvent);
            });
        }

        // Event listener para o botão de excluir
        const deleteButton = taskItem.querySelector('.excluir-tarefa');
        if (deleteButton) {
            deleteButton.addEventListener('click', function (e) {
                e.preventDefault();
                const clickEvent = new Event('click', { bubbles: true });
                this.dispatchEvent(clickEvent);
            });
        }
    }

    // Gerenciamento da visualização da descrição
    document.addEventListener('click', function (e) {
        const verButton = e.target.closest('.btn-ver');
        if (verButton) {
            e.preventDefault();
            const taskItem = verButton.closest('.task-item');
            if (!taskItem) return;

            // Toggle da classe expanded
            taskItem.classList.toggle('expanded');
        }
    });

    // Gerenciamento da lixeira
    document.addEventListener('click', function (e) {
        if (e.target.closest('.excluir-tarefa')) {
            e.preventDefault();
            const taskItem = e.target.closest('.task-item');
            if (!taskItem) return;

            const idtarefa = taskItem.getAttribute('data-id');

            // Envia a requisição para excluir a tarefa
            fetch('/ProjetoIndividual/DB/excluirTarefa.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `idtarefa=${idtarefa}`,
                credentials: 'include'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove a tarefa de todas as listas
                        const todasList = document.getElementById('todas');
                        const pendentesList = document.getElementById('pendentes');
                        const concluidasList = document.getElementById('concluidas');

                        // Remove da lista "Todas"
                        const taskInTodas = todasList.querySelector(`[data-id="${idtarefa}"]`);
                        if (taskInTodas) taskInTodas.remove();

                        // Remove da lista "Pendentes"
                        const taskInPendentes = pendentesList.querySelector(`[data-id="${idtarefa}"]`);
                        if (taskInPendentes) taskInPendentes.remove();

                        // Remove da lista "Concluídas"
                        const taskInConcluidas = concluidasList.querySelector(`[data-id="${idtarefa}"]`);
                        if (taskInConcluidas) taskInConcluidas.remove();

                        // Atualiza a contagem de tarefas
                        const activeList = document.querySelector('.task-list.active');
                        const count = activeList.querySelectorAll('.task-item').length;
                        qntdTasks.textContent = count;
                    } else {
                        alert('Erro ao excluir a tarefa: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao excluir a tarefa');
                });
        }
    });

    // Inicializar com a contagem da lista ativa (todas)
    const initialCount = document.querySelector('#todas').querySelectorAll('.task-item').length;
    qntdTasks.textContent = initialCount;
}); 