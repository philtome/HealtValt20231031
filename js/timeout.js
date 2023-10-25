
    let idleTimer;
    const idleTimeout = 900000; // 15 minutes in milliseconds

    function resetIdleTimer() {
    clearTimeout(idleTimer);
    idleTimer = setTimeout(logoutUser, idleTimeout);
}

    function logoutUser() {
    handleLogoff();
    // Perform your logout or display a timeout message here
    // e.g., redirect to a logout page or show a modal
    alert('You have been logged out due to inactivity.');
    // You can also send an AJAX request to the server to invalidate the session.
}

    // Listen for user activity events, e.g., mousemove, keydown, or click
    window.addEventListener('mousemove', resetIdleTimer);
    window.addEventListener('keydown', resetIdleTimer);
    window.addEventListener('click', resetIdleTimer);

    // Initialize the timer when the page loads
    resetIdleTimer();

