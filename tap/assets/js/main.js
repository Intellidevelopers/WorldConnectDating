const body = document.body;
const image = body.querySelector('#coin');
const h1 = body.querySelector('h1');

let coins = localStorage.getItem('coins');
let total = localStorage.getItem('total');
let power = localStorage.getItem('power');
let count = localStorage.getItem('count');

if (coins == null) {
    localStorage.setItem('coins', '0');
    h1.textContent = '0';
} else {
    h1.textContent = Number(coins).toLocaleString();
}

if (total == null) {
    localStorage.setItem('total', '500');
    body.querySelector('#total').textContent = '/500';
} else {
    body.querySelector('#total').textContent = `/${total}`;
}

if (power == null) {
    localStorage.setItem('power', '500');
    body.querySelector('#power').textContent = '500';
} else {
    body.querySelector('#power').textContent = power;
}

if (count == null) {
    localStorage.setItem('count', '1');
}

// Add event listener for touch events (multi-touch support)
image.addEventListener('touchstart', (e) => {
    e.preventDefault(); // Prevent default zoom on double tap or other touch gestures

    const touches = e.touches.length; // Number of fingers used
    if (touches > 0 && touches <= 2) { // If 1 or 2 fingers are touching
        let coins = Number(localStorage.getItem('coins'));
        let power = Number(localStorage.getItem('power'));

        if (power > 0) {
            let increment = touches; // Increment by the number of fingers (1 or 2)
            localStorage.setItem('coins', `${coins + increment}`);
            h1.textContent = (coins + increment).toLocaleString();

            // Decrease power based on the number of taps
            localStorage.setItem('power', `${power - increment}`);
            body.querySelector('#power').textContent = `${power - increment}`;

            // Update progress bar
            body.querySelector('.progress').style.width = `${(100 * (power - increment)) / total}%`;

            // Apply coin animation based on the touch position (first touch point)
            const x = e.touches[0].clientX - image.offsetLeft;
            const y = e.touches[0].clientY - image.offsetTop;

            applyCoinAnimation(x, y);

            navigator.vibrate(10); // Vibration feedback (adjust duration as needed)
        }
    }
});

// Function to animate the coin
function applyCoinAnimation(x, y) {
    if (x < 150 && y < 150) {
        image.style.transform = 'translate(-0.25rem, -0.25rem) skewY(-10deg) skewX(5deg)';
    } else if (x < 150 && y > 150) {
        image.style.transform = 'translate(-0.25rem, 0.25rem) skewY(-10deg) skewX(5deg)';
    } else if (x > 150 && y > 150) {
        image.style.transform = 'translate(0.25rem, 0.25rem) skewY(10deg) skewX(-5deg)';
    } else if (x > 150 && y < 150) {
        image.style.transform = 'translate(0.25rem, -0.25rem) skewY(10deg) skewX(-5deg)';
    }

    setTimeout(() => {
        image.style.transform = 'translate(0px, 0px)';
    }, 100);
}

// Restore power over time
setInterval(() => {
    let count = Number(localStorage.getItem('count'));
    let power = Number(localStorage.getItem('power'));
    let total = Number(localStorage.getItem('total'));

    if (total > power) {
        localStorage.setItem('power', `${power + count}`);
        body.querySelector('#power').textContent = `${power + count}`;
        body.querySelector('.progress').style.width = `${(100 * (power + count)) / total}%`;
    }
}, 1000);
