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
    xhr.open('GET', 'index.php?action=template1/45', true);
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

// this is the same as above, but code to replace the current html/tom in the 'data'
// // Get the button element by its ID
// const manageButtons = document.querySelectorAll('.manageButton');
//
// // Add a click event listener to the button
// manageButtons.forEach(function(button) {
//     button.addEventListener('click', function() {
//         // Get the 'id' from the 'data-id' attribute
//         const id = button.dataset.id;
//
//         // Perform the GET request to send the 'id' to your MVC system
//         // Replace 'your-mvc-endpoint' with the actual URL of your MVC system
//         const url = `/your-mvc-endpoint?id=${id}`;
//         fetch(url)
//             .then(response => response.text())
//             .then(data => {
//                 // Handle the response from your MVC system if needed
//                 console.log(data);
//             })
//             .catch(error => {
//                 // Handle errors if any
//                 console.error(error);
//             })
//     });
// });
// 0729 trial of 2 button types:




// AJAX Calls - give MVC info, return here to manage


const btnPage1 = document.getElementById("btnPage1");
if (btnPage1) {
    btnPage1.addEventListener("click", function() {
        loadNewPage(1);
    });
}


// the above replaces this line which will give error if btnPage1 does not exist:
//    (I may beable to do a for each like in manage buttons above)

// document.getElementById("btnPage1").addEventListener("click", function() {
//     loadNewPage(1);
// });




// document.getElementById("btnPage2").addEventListener("click", function() {
//     loadNewPage(2);
// });
// document.getElementById("btnLoadContent").addEventListener("click", function() {
//     loadContent();
// });

const manageButtonItems = document.querySelectorAll('.manageCpButton');
manageButtonItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the item ID from the "data-item-id" attribute of the clicked list item
        const itemId = this.getAttribute('data-item-id');
        handleManageItem(itemId);
    });
});

// Attach click event listeners to the buttons
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

// Function to handle button click and load the content via fetch
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


// button type: .testButton does editButtons, then performAcdtion - send something to index.php, it will replace item on screen
// Button type: .displayTestButton  does displayButtons, then displayitem - should return HTML to insert
// Button type: .manageButton does displayFullItem, sends URL to index.php and it does url paint
// Button type: fetchButton runs index.php and does full screen return, HTML then inserts it here
// Button type: resultContainer (not really a button) is watched after the fetchButton
//
//  button with "." is an id
//  button without "." is a class
//
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

function displayFullItem(id) {
    // Send the ID to your server using AJAX (e.g., XMLHttpRequest or Fetch API)
    // Example using Fetch API:
    fetch('index.php?controller=careplans_manage&function=display&id=' + id, {
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

// this wiil be used to pick up HTML from server and display on the screen:
// document.addEventListener('DOMContentLoaded', function () {
//     const fetchButton = document.getElementById('fetchButton');
//     const resultContainer = document.getElementById('resultContainer');
//
//     fetchButton.addEventListener('click', function () {
//         // Fetch the HTML content from the server using the Fetch API
//         fetch('index.php?controller=careplans_manageB&function=display')
//             .then(response => response.text())
//             .then(html => {
//                 // Display the received HTML content in the resultContainer
//                 // resultContainer.innerHTML = html;
//                 // I replaced rusultContainer.innerHtml with code to reload entire page:
//                 document.open();
//                 document.write(html);
//                 document.close();
//             })
//             .catch(error => {
//                 console.error('Error fetching HTML:', error);
//                 resultContainer.innerHTML = '<p>Error fetching HTML content.</p>';
//             });
//     });
// });

function performAJAXRequest(url, callback) {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful
                callback(null, xhr.responseText);
            } else {
                // Request failed
                callback(new Error(`AJAX request failed with status: ${xhr.status}`));
            }
        }
    };

    xhr.open('GET', url);
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