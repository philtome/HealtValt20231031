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
    fetch('index.php?controller=template1&function=display&id=' + id, {
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