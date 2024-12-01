function hamburgerMenu() {
    let x = document.getElementById('myLinks');

    if (x.classList.contains('show')) {
        x.classList.remove('show');
    } else {
        x.classList.add('show');
    }
}

function hamburgerMenuHideOnly() {
    let x = document.getElementById('myLinks');

    if (x.classList.contains('show')) {
        x.classList.remove('show');
    }
}
