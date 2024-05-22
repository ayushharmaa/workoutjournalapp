function showRegistrationForm() {
    document.getElementById('loginForm').style.display = "none";
    document.getElementById('registrationForm').style.display = "";
}

function showLoginForm() {
    document.getElementById('loginForm').style.display = "";
    document.getElementById('registrationForm').style.display = "none";
}

function redirectToReadJournal() {
    window.location.href = 'read-journal.php';
}

function redirectToWriteJournal() {
    window.location.href = 'write-journal.php';
}

function addActivity() {
    // Clone the template for additional activities
    var template = document.querySelector('.additional-activity');
    var clone = template.cloneNode(true);

    // Clear the values in the cloned fields
    var inputs = clone.querySelectorAll('input');
    inputs.forEach(function (input) {
        input.value = '';
    });

    // Append the cloned fields to the table body
    document.querySelector('#additionalActivities tbody').appendChild(clone);
}

function removeInputs() {
    var tableBody = document.querySelector('#additionalActivities tbody');
    var rows = tableBody.querySelectorAll('.additional-activity');

    // Ensure there is at least one row
    if (rows.length > 1) {
        // Remove the last row
        tableBody.removeChild(rows[rows.length - 1]);
    }
}