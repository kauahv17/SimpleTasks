// document.addEventListener('DOMContentLoaded', function() {
//     // Lógica para checkboxes (opcional)
//     document.querySelectorAll('.task-checkbox').forEach(checkbox => {
//         checkbox.addEventListener('change', function() {
//             if (this.checked) {
//                 console.log('Tarefa concluída:', this.nextElementSibling.textContent);
//             }
//         });
//     });
// });

function toggleDropdown(button) {
    const card = button.closest('.task-card');
    card.classList.toggle('expanded');
  }