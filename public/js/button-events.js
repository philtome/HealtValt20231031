// this program detects events, then sends processing to other programs to process


const btnPage1 = document.getElementById("btnPage1");  // this is an id
if (btnPage1) {
    btnPage1.addEventListener("click", function() {
        loadNewPage(1);
    });
}
const btnPage2Items = document.querySelectorAll('#btnPage2');  // use # for queryselector abd ud
btnPage2Items.forEach(item => {
    item.addEventListener('click', function() {
        loadNewPage(2);
    });
});
// document.getElementById("btnPage2").addEventListener("click", function() {
//      loadNewPage(2);
//  });

var createButtonItems = document.querySelectorAll('.create');  //this is a class
createButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        var itemController = this.getAttribute('data-sa-object');
        var itemAction = this.getAttribute('data-sa-action')
        handleCreateItem(itemController,itemAction);   // this routine is in editFunctions
    });
});


// manage button example (manage careplan button, take user to specific carplan when clicked on
var manageButtonItems = document.querySelectorAll('.manageParButton');  //this is a class
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handlePartManage(itemId);   // this routine is in editFunctions
    });
});

// SAVE CarePlan button , start to gather up data and save **20230805**
var btnSaveCareplan = document.getElementById("btn_careplan_save");  // this is an id
if (btnSaveCareplan) {
    btnSaveCareplan.addEventListener('click', function(event){
        event.preventDefault();
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        // how to check for id, on edit...const itemId = this.getAttribute('data-item-id');
        handleSaveCareplan();   // add itemID when save is edit (handleSaveContact(itemID)
        // this routine is in editFunctions
    });
}

// SAVE Contact button , start to gather up data and save **20230801**
var btnSaveContact = document.getElementById("btn_contacts_save");  // this is an id
if (btnSaveContact) {
    btnSaveContact.addEventListener('click', function(event){
        event.preventDefault();

        const itemElement = btnSaveContact.closest('.saveButton');
        const itemId = itemElement.dataset.itemId;

        // Get the item ID from the "data-item-id" attribute of the clicked list item
        // how to check for id, on edit...const itemId = this.getAttribute('data-item-id');
        handleSaveContact(itemId);   // add itemID when save is edit (handleSaveContact(itemID)
                      // this routine is in editFunctions
    });
}

// CANCEL Contact button , start to gather up data and save **20230801**
var btnCancelContact = document.getElementById("btn_contacts_cancel");  // this is an id
if (btnCancelContact) {
    btnCancelContact.addEventListener('click', function(event){
        event.preventDefault();
        returnUrlUpOne(window.location.href);
    });
}

if (btnPage1) {
    btnPage1.addEventListener("click", function() {
        loadNewPage(1);
    });
}


 // manage button example (manage careplan button, take user to specific carplan when clicked on
var manageButtonItems = document.querySelectorAll('.manageCpButton');  //this is a class
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handleManageItem(itemId);   // this routine is in editFunctions
    });
});
// MANAGE/DISPLAY contact button
var manageButtonItems = document.querySelectorAll('.manageConButton');  //this is a class
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handleConManage(itemId);   // this routine is in editFunctions
    });
});

// COPY contact button
var copyButtonItems = document.querySelectorAll('.copyConButton');  //this is a class
copyButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handleConCopy(itemId);   // this routine is in editFunctions
    });
});

// DELETE contact button
let itemIdToDelete = null;
var deleteButtonItems = document.querySelectorAll('.deleteConButton');  //this is a class
deleteButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        itemIdToDelete = this.getAttribute('data-item-id');
        //handleConDelete(itemId);   // this routine is in editFunctions
    });
});

// Modal DELETE contact button
var modalDeleteConButton = document.getElementById('modalDeleteButton');  // this is id on model del
modalDeleteButton.addEventListener('click', function() {
    if (itemIdToDelete !== null) {
        console.log("deleteing item with id:", itemIdToDelete);
        handleConDelete(itemIdToDelete);
        itemIdToDelete = null;
    }
})


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


