function validateForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let crime_type = document.getElementById("crime_type").value;
    let description = document.getElementById("description").value;

    if (name === "" || email === "" || phone === "" || crime_type === "" || description === "") {
        alert("All fields are required!");
        return false;
    }

    if (phone.length !== 10 || isNaN(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    const crimeType = document.getElementById('crime_type').value;
    const userId = generateUserId(crimeType);
    document.getElementById('user_id').value = userId;

    // Display success card with user details
    document.getElementById('user-id').innerText = userId;
    document.getElementById('user-name').innerText = document.getElementById('name').value;
    document.getElementById('crime-type').innerText = crimeType;
    document.getElementById('success-card').style.display = 'block';

    // Reset the form
    document.querySelector('form').reset();

    return false; // Prevent actual form submission
}

function showSuccessCard(details) {
    document.getElementById('user-id').innerText = details.userId;
    document.getElementById('user-name').innerText = details.name;
    document.getElementById('crime-type').innerText = details.crimeType;
    document.getElementById('success-card').style.display = 'block';
    document.getElementById('success-card').style.border = '1px solid #4CAF50';
    document.getElementById('success-card').style.padding = '20px';
    document.getElementById('success-card').style.marginTop = '20px';
    document.getElementById('success-card').style.backgroundColor = '#dff0d8';
    document.getElementById('success-card').style.color = '#3c763d';
    document.getElementById('success-card').style.borderRadius = '5px';
}

function generateUserId(crimeType) {
    const prefix = {
        'Robbery': 'rob',
        'Assault': 'ass',
        'Fraud': 'frd',
        'Cyber Crime': 'cyb',
        'Other': 'oth'
    }[crimeType] || 'oth';

    const randomNumber = Math.floor(1000 + Math.random() * 9000);
    return `${prefix}${randomNumber}`;
}