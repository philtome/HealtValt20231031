var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
ready(() => {
    document.querySelector(".header").style.height = window.innerHeight/4 + "px";
})



const btnPage1 = document.getElementById("btnPage1");
if (btnPage1) {
    btnPage1.addEventListener("click", function() {
        loadNewPage(1);
    });
}
 document.getElementById("btnPage2").addEventListener("click", function() {
     loadNewPage(2);
 });



 // manage button example (manage careplan button, take user to specific carplan when clicked on
const manageButtonItems = document.querySelectorAll('.manageCpButton');
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handleManageItem(itemId);   // this routine is in editFunctions
    });
});

// Get the button element by its ID
const manageButtons = document.querySelectorAll('.manageButton');
manageButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        // Get the 'id' from the 'data-id' attribute
        const careplanId = button.dataset.id;

        // Perform the GET request to send the 'id' to your MVC system
        // Replace 'your-mvc-endpoint' with the actual URL of your MVC system
        //const url = `/index.php/careplans_manage/id=${id}`;
        const url = `/index.php`;
        displayFullItem(careplanId);
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('.testButton');
    var displayButtons = document.querySelectorAll('.displayTestButton');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var id = button.dataset.id;
            performAction(id);
        });
    });
    displayButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var id = button.dataset.id;
            displayitem(id);
        });
    });
});


