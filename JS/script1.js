
const modal = document.getElementById('modal');
const openModalBtn = document.getElementById('openModalBtn');

let div = document.getElementById("error-msg");

let button = document.getElementById(`subForm`);

function checkValidity(event) {
    let email = document.getElementById(`email`).value;
    let password = document.getElementById(`password`).value;
    let phone = document.getElementById("phone");

    if (password == '' || email == '' || phone == '') {
        const paragraph = document.createElement('p');
        paragraph.textContent = 'One or more required field is empty!.';
        div.appendChild(paragraph);
        return false;
    }

    if (password.length < 8) {
        const paragraph = document.createElement('p');
        paragraph.textContent = 'The password is NOT 8-Characters long.';
        div.appendChild(paragraph);
        return false;
    }

    return true;
}

document.getElementById("form").onsubmit = checkValidity;
