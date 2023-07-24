var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
ready(() => {
    document.querySelector(".header").style.height = window.innerHeight/4 + "px";
})

function displayAnotherPage() {
    // Replace 'another-page.html' with the URL of the page you want to display
    window.location.href = 'index.php/template1';
}

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