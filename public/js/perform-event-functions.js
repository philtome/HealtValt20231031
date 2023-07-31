// After an event occurs
// the event detecing programs end info here to execute


// this sends URL to index.php to load new page
function handleManageItem(itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    window.location.href = "index.php/careplans_manage/1";
}
function handlePartManage(itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    window.location.href = "index.php/participant_manage/" + itemId;
}

function handleConManage(itemId) {
    // Perform any actions needed for the edit, such as opening a modal or navigating to an edit page
    // In this example, we will just log the item ID to the console
    //console.log("Edit item with ID:", itemId);
    window.location.href = "index.php/contacts/manage/" + itemId;
}

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

