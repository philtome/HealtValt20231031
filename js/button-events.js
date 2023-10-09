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

// COPY Item buttont
var copyButtonItems = document.querySelectorAll('.copy');  //this is a class ******
copyButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        const itemController = this.getAttribute('data-sa-object');
        handleCopyItem(itemController,itemId);
    });
});


var createButtonItems = document.querySelectorAll('.create');  //this is a class
createButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        var itemController = this.getAttribute('data-sa-object');
        var itemAction = this.getAttribute('data-sa-action')
        handleCreateItem(itemController,itemAction);   // this routine is in editFunctions
    });
});

// MANAGE or EDIT Buttons
var manageButtonItems = document.querySelectorAll('.manageEdit');  //this is a class
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        const itemController = this.getAttribute('data-sa-object');
        handleManageEditItem(itemController,itemId);   // this routine is in editFunctions
    });
});

var printButtonItems = document.querySelectorAll('.print');  //this is a class
printButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        const itemController = this.getAttribute('data-sa-object');
        handlePrintItem(itemController,itemId);   // this routine is in editFunctions
    });
});

// SUBList Display Buttons
var subListButton = document.querySelectorAll('.listAssessments');  //this is a class
subListButton.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        const itemController = this.getAttribute('data-sa-object');
        handlesubListItem(itemController,itemId);   // this routine is in editFunctions
    });
});


// SAVE any Item button on individual edit/manage screens
var btnSaveItem = document.querySelector("#btn_save");  // this is an id
if (btnSaveItem) {
    btnSaveItem.addEventListener('click', function(event){
        event.preventDefault();

        const itemElement = btnSaveItem.closest('.saveButton');
        const itemId = itemElement.dataset.itemId;
        const itemController = this.getAttribute('data-sa-object');

        // Get the item ID from the "data-item-id" attribute of the clicked list item
        // how to check for id, on edit...const itemId = this.getAttribute('data-item-id');
        handleSaveItem(itemController, itemId);   // add itemID when save is edit (handleSaveContact(itemID)
        // this routine is in editFunctions
    });
}
// CANCEL Item button - cancel from individual edit/manage screens
var btnCancelItem = document.getElementById("btn_cancel");  // this is an id
if (btnCancelItem) {
    btnCancelItem.addEventListener('click', function(event){
        event.preventDefault();
        returnUrlUpOne(window.location.href);
    });
}


if (btnPage1) {
    btnPage1.addEventListener("click", function() {
        loadNewPage(1);
    });
}

// DELETE contact button it runs this then opens Confirm Delete Modal
let itemIdToDelete = null;
let typeToDelete = null;
var deleteButtonItems = document.querySelectorAll('.deleteItemButton');  //this is a class
deleteButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        itemIdToDelete = this.getAttribute('data-item-id');
        typeToDelete = this.getAttribute('data-item-type');
        //handleConDelete(itemId);   // this routine is in editFunctions
    });
});

// Modal DELETE contact button
var modalDeleteConButton = document.getElementById('modalDeleteButton');  // this is id on model del
modalDeleteButton.addEventListener('click', function() {
    if (itemIdToDelete !== null) {
        console.log("deleteing item with id:", itemIdToDelete);
        handleConDelete(itemIdToDelete, typeToDelete);
        itemIdToDelete = null;
    }
})

// Modal DELETE PARTICIPANT  button  &&&&&&&&&  FINISH THIS UP, AND THE MODEL
//  I MAY WANT TO MAKE THAT MODAL A :DO YOU AENT TO DELETE: TWIG ALL ITS ON
var modalDeletePrticipantButton = document.getElementById('modalDeleteButton2222');  // this is id on model del
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


