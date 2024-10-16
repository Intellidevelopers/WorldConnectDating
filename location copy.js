
    // Automatically get the user's location when the page loads
    window.onload = function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById('location').innerText = "Geolocation is not supported by this browser.";
        }
    };

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        // Optionally, you can reverse geocode using a free API (e.g., OpenCageData)
        reverseGeocode(lat, lon);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById('location').innerText = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById('location').innerText = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                document.getElementById('location').innerText = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById('location').innerText = "An unknown error occurred.";
                break;
        }
    }

    function reverseGeocode(lat, lon) {
        const apiKey = 'ecf02c517f714576bf138abddb097dcb'; // Replace with your OpenCage API key
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lon}&key=${apiKey}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    const { city, state } = data.results[0].components;
                    document.getElementById('location').innerText += `\n${city}, ${state}`;
                } else {
                    document.getElementById('location').innerText += `\nCity/State not found.`;
                }
            })
            .catch(error => console.error('Error:', error));
    }