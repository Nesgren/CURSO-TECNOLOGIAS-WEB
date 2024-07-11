const lista = document.getElementById('lista');

function dameHTML(item) {
    return `<li>
                <h2>${item.title}</h2>
                <p>${item.body}</p>
                <hr>
                <span>ID: ${item.id}</span>
            </li>`;
}

async function positivo(res) {
    if (res.ok) {
        let json = await res.json();
        let html = json.map(item => dameHTML(item)).join('');
        lista.innerHTML = html;
    } else {
        showError('status code: ' + response.status);
    }
}

fetch("https://jsonplaceholder.typicode.com/posts")
    .then(positivo)
    .catch(showError);

function showError(message) {
    console.error(message);
}
