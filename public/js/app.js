// When the user clicks on the submit button
$('#submit-json').on('click', function () {
    // Get the JSON input
    let input = $('#json-input').val();

    // Make an AJAX request to /api/sorting
    $.ajax({
        url: '/api/sorting',
        method: 'POST',
        data: JSON.stringify(input),
        success: function (response) {
            console.log(response);
            displayBuses(response.garage);
            document.getElementById('TODOBUSSES').innerText = response;
        }
    });
});

function createParkingSpots(garage) {
    const parkingLot = document.getElementById('parking-lot');
    parkingLot.innerHTML = ''; // Clear previous parking spots

    ['groot', 'medium', 'klein'].forEach(size => {
        const spots = garage[size];
        spots.forEach(spot => {
            const spotElement = document.createElement('div');
            spotElement.classList.add('parking-spot');
            spotElement.textContent = `Bus ${spot.bus} - ${spot.type}`;
            parkingLot.appendChild(spotElement);
        });
    });
}


function displayBuses(garage) {
    const parkingLotElement = document.getElementById('parking-lot');
    parkingLotElement.innerHTML = ''; // Clear previous entries

    // Function to create bus elements and append to the parking lot
    const appendBuses = (buses, size) => {
        buses.forEach(bus => {
            const busElement = document.createElement('div');
            busElement.classList.add('bus', size);
            busElement.textContent = `Bus ${bus.bus} - ${bus.type}`;
            parkingLotElement.appendChild(busElement);
        });
    };

    // Assuming 'groot' corresponds to large, 'medium' to medium, and 'klein' to small
    appendBuses(garage.groot, 'large');
    appendBuses(garage.medium, 'medium');
    appendBuses(garage.klein, 'small');
}

/*

document.getElementById('startSorting').addEventListener('click', function() {
    fetch('/api/sorting', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        displayBuses(data.garage); // Function to display buses
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});



*/
