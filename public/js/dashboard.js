const projects = document.querySelector('.ctn-dash-list-project');
if (projects) {
    projects.addEventListener('click', e =>{
      if (e.target.className === 'fas fa-trash-alt dash-list-project-icon delete') {
        if(confirm('Etes-vous sur ?')){
            const id = e.target.getAttribute('data-id')

            fetch(`/dashboard/delete-project/${id}`, {
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
      }
    });
}