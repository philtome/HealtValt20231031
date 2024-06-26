// After an event occurs
// the event detecing programs end info here to execute


// this sends URL to index.php to load new page
function handleCreateItem(itemController, itemAction) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/" + itemController + "s/create";
    window.location.href = fetchUrl;
}

function handleManageEditItem(itemController, itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/" + itemController + "s/manage/" + itemId;
    window.location.href = fetchUrl;
}

function handleXXXXXManageItem(itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    window.location.href = "../index.php/careplans_manage/1";
}

function handleCopyItem(itemController, itemId) {
    const fetchUrl = "/index.php/" + itemController + "s/copy/" + itemId;
    fetch(fetchUrl, {
        method: 'POST',
    })
        .then(response => {
            console.log('Data Copy set kup successfully');
        })
        .then(responseData => {
            returnUrlUpOne(window.location.href);
        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error setting up copy data:', error);
        });
}

function handlePrintItem(itemController, itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/" + itemController + "s/print/" + itemId;
    window.location.href = fetchUrl;
}

// ******* WORKING HERE ON assessment for participant diplay
function handlesubListItem(itemController, itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/assessments/display/" + itemId + "/" + itemController + "s";
    window.location.href = fetchUrl;
//    window.location.href = "../index.php/careplans_manage/1";
}




function handleInactivesList(itemController, itemAction, isChecked) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/" + itemController + "s/display/" + itemAction + "/" + isChecked;
    window.location.href = fetchUrl;
//    window.location.href = "../index.php/careplans_manage/1";
}


function handleList(itemController, itemAction, isChecked = null) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    let fetchUrl = "/index.php/" + itemController + "s/" + itemAction + "/" + isChecked;
    window.location.href = fetchUrl;
//    window.location.href = "../index.php/careplans_manage/1";
}


function setErrorMessage(message) {
    // Assuming you have an HTML element with the id "error-message" to display the error
    var errorMessageElement = document.getElementById('error-message');

    if (errorMessageElement) {
        errorMessageElement.textContent = message;
    }
}

function handleSaveItem(itemController, id = null, returnToPrevious = null) {
    const itemForm = document.getElementById(itemController + "_details_form");
    const itemFormData = new FormData(itemForm);
    var fetchUrl = 'create';
    if (id) {
        fetchUrl = 'update/'.concat(id);
    } else {
        fetchUrl = 'manage/update/';
    }
    fetch(fetchUrl, {
        method: 'POST',
        body: itemFormData
    })
        .then(response => {
            console.log('Data Saved successfully');
        })
        .then(responseData => {
            if (returnToPrevious === null) {
                window.history.back();}
            else { window.location.href = returnToPrevious }
            //window.location.reload()
            //returnUrlUpOne(window.location.href);
        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error saving data:', error);
        });
}
function handleDeleteItem(itemController, itemId) {

    var fetchUrl = itemController + 's/delete/' + itemId;
//"I use the s here because my controller is looking for contacts or participants"
    fetch(fetchUrl, {  // NOTE This is Data Contact expected I will call fetch type 1
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Handle server-side error
                console.error('Server Error:', data.error);
                // Display the error message to the user, e.g., in an alert or on the webpage
                setErrorMessage(data.error);
                var modal = new bootstrap.Modal(document.getElementById('display-error-modal'));
                modal.show();
            } else {
                // Handle successful response, if needed
                // for example purposes, I am leaving 'response' and 'messagge' here as examples
                // in the future I may want to pop up a message, others I may want to act on response
                //    like adding/removing or changing a line
                if (data.response) {
                    //console.log('Received response:', data.response); - for trouble shooting
                    returnUrlUpOne(window.location.href);
                    //I eventually want to just remove the line of code here
                }
                else if (data.message) {
                    //console.log('Received response:', data.message);  - for trouble shooting
                    returnUrlUpOne(window.location.href);
                }
            }
        })
        .catch(error => {
            // Handle other errors (e.g., network errors or request issues)
            console.error('Error deleting data:', error);

            // Display an error message to the user
            setErrorMessage('An error occurred while deleting data.');
            var modal = new bootstrap.Modal(document.getElementById('display-error-modal'));
            modal.show();
        });
}
function handleParticipantCopy(id) {
    const fetchUrl = 'participants/copy/' + id;
    fetch(fetchUrl, {
        method: 'POST',
    })
        .then(response => {
            console.log('Data Copy set kup successfully');
        })
        .then(responseData => {
            returnUrlUpOne(window.location.href);
        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error setting up copy data:', error);
        });
}

function handleLogoff() {
    let fetchUrl = "sessions/logout/";
    fetch(fetchUrl, {
        method: 'POST',
        body: null
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Convert the response to text
        })
        .then(responseData => {
//            document.body.innerHTML = responseData;
            window.location.href = '/index.php';
//            window.history.replaceState(null, '', window.location.origin);

        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error saving data:', error);
        });
}

function handleLogon(itemController) {
    const itemForm = document.getElementById(itemController + "_login_form");
    const itemFormData = new FormData(itemForm);
    const fetchUrl = "sessions/login/";

    fetch(fetchUrl, {    //NOTE this is HTML context expected I will call fetch type 2
        method: 'POST',
        body: itemFormData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                // Handle server-side errors
                console.error('Server Error:', data.error);
                // Display the error message to the user, e.g., in an alert or on the webpage
                setErrorMessage(data.error);
                var modal = new bootstrap.Modal(document.getElementById('display-error-modal'));
                modal.show();
            } else if (data.redirect) {
                // Handle redirection provided by the server
                window.location.href = data.redirect; // Redirect to the provided URL
            } else {
                // Handle other successful response data
            }
        })
        .catch(error => {
            // Handle network-related errors
            console.error('Error saving data:', error);
        });
}
// function handleLogon(itemController) {
//     const itemForm = document.getElementById(itemController + "_login_form");
//     const itemFormData = new FormData(itemForm);
//     const fetchUrl = "sessions/login/";
//
//     fetch(fetchUrl, {    //NOTE this is HTML context expected I will call fetch type 2
//         method: 'POST',
//         body: itemFormData
//     })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text(); // Convert the response to text
//         })
//         .then(responseData => {
//             document.body.innerHTML = responseData;
//
//         })
//         .catch(error => {
//             // Handle any errors that occurred during the request
//                  //console.error('Error saving data:', error);
//             setErrorMessage(data.error);
//             var modal = new bootstrap.Modal(document.getElementById('display-error-modal'));
//             modal.show();
//         });
// }
function displayitem(id) {
    // Send the ID to your server using AJAX (e.g., XMLHttpRequest or Fetch API)
    // Example using Fetch API:
    fetch('index.php?controller=careplans&function=display&id=' + id, {
        method: 'GET', // Change to the appropriate HTTP method (GET, POST, etc.)
        headers: {
            'Content-Type': 'application/json'
        },
        // Add any additional data as needed (e.g., JSON data)
        // body: JSON.stringify({ /* Your data here */ })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // or response.json() if your server returns JSON data
        })
        .then(responseData => {
            // Handle the AJAX response here
            // The responseData should be the rendered HTML or JSON data from the server
            // Update your page content or perform other actions based on the responseData
            // temp remove this:document.getElementById('result-container').innerHTML = responseData;
            document.open(); // Clear the current document
            document.write(responseData); // Write the new content
            document.close(); // Close the documentfet
        })
        .catch(error => {
            // Handle errors if any
            console.error(error);
        });
}

// this will do an ajax call to index.php, and return HTML to do something with, example would be edit a line
// and the do something with is document.documentElement.innerHTML = data - this replaces entire screen
//    *note 'method' is not specified, thus GET is assumed
function loadNewPage(pageNumber) {
    fetch(`index.php/careplansB`)
        //fetch(`index.php?page=${pageNumber}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.documentElement.innerHTML = data; // Replace the entire HTML content with the received data
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

// this will do an ajax call to index.php, and return HTML to do something with, example would be edit a line
// and the do something with is document.getElementById("contentContainer").innerHTML - it will insert HTML data there
function loadContent() {
    fetch('index.php?action=load_content')
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("contentContainer").innerHTML = data;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

// here is a post example of an AJAX fetch call, not sher what to really do on the .then(function(data)
//  I amd guessing put something out there like 'updated', or return to previous screen or display
function performAction(id) {
    // Send the ID to your server using AJAX (e.g., XMLHttpRequest or Fetch API)
    // Example using Fetch API:
    //temp fetch('index.php?controller=template1&function=display&id=' + id, {
    fetch('index.php?controller=careplansB&function=display&id=' + id, {
        method: 'POST', // Change to the appropriate HTTP method (GET, POST, etc.)
        headers: {
            'Content-Type': 'application/json'
        },
        // Add any additional data as needed (e.g., JSON data)
        // body: JSON.stringify({ /* Your data here */ })
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            // Handle the response from the server (if needed)
            console.log('Response from server:', data);
        })
        .catch(function (error) {
            console.error('Error performing action:', error);
        });
}

