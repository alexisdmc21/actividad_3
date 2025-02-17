const apiURL = 'http://localhost/POO(MVC)/public/';

document.addEventListener('DOMContentLoaded', () => getCategorias());

const getCategorias = () => {
    axios.get(${ apiURL } / categorias)
        .then(response => {
            const categorias = response.data;
            const tbody = document.querySelector('#categoriasTable tbody');
            tbody.innerHTML = '';
            categorias.forEach(categoria => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${categoria.id}</td>
                <td>${categoria.nombre}</td>
                <td>${categoria.descripcion}</td>
                <td>
                    <button type="button" class="btn btn-danger">Danger</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                </td>
            `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => console.error(error));
}

document.getElementById('formCategoria').addEventListener('submit', (e) => {
    e.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    axios.post(`${apiURL}/categorias`, { nombre, descripcion })
        .then(response => {
            console.log(response);
            getCategorias();
        })
        .catch(error => console.error(error));
}