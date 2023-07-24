var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
ready(() => {
    document.querySelector(".header").style.height = window.innerHeight/4 + "px";
})

function displayAnotherPage() {
    // Make an AJAX request to your server (index.php) to handle the redirection
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=template1', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Upon successful response, redirect to the page returned by the server
            const response = JSON.parse(xhr.responseText);
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }
    };
    xhr.send();
}



//
// function displayAnotherPage() {
//     // Replace 'another-page.html' with the URL of the page you want to display
//     window.location.href = 'index.php/template1';
// }




// setTimeout(function() {
//     $('#demo-modal').modal();
// }, 500);

// const myModal = new bootstrap.Modal("#demo-modal");
// window.addEventListener('DOMContentLoaded', () => {
//     myModal.show();
// });
// $('#demo-modal').on('shown.bs.modal', function () {
//     $('#myInput').trigger('focus')
// })