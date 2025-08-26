document.addEventListener('DOMContentLoaded', function() {

    // --- Splash Screen Logic ---
    const splashScreen = document.getElementById('splash-screen');

    // Check if the splash screen has already been shown in this session
    if (sessionStorage.getItem('splashShown')) {
        // If it has, hide it immediately
        if (splashScreen) {
            splashScreen.style.display = 'none';
        }
        return; // Stop the rest of the script from running
    }

    // If the splash screen element exists, handle the video
    if (splashScreen) {
        const splashVideo = document.getElementById('splash-video');

        // Check if the video element exists
        if (splashVideo) {
            // Attempt to play the video
            splashVideo.play().catch(error => {
                // Autoplay was prevented. This can happen in some browsers.
                // In this case, we'll just hide the splash screen immediately.
                console.warn("Splash video autoplay was prevented:", error);
                hideSplashScreen();
            });

            // Add an event listener for when the video ends
            splashVideo.addEventListener('ended', hideSplashScreen);
        } else {
            // If there's no video, just hide the splash screen right away
            hideSplashScreen();
        }
    }

    function hideSplashScreen() {
        // Add the 'hidden' class to trigger the fade-out transition
        splashScreen.classList.add('hidden');

        // Set a flag in session storage so it doesn't show again
        sessionStorage.setItem('splashShown', 'true');

        // Optional: After the transition ends, set display to none so it doesn't occupy space
        splashScreen.addEventListener('transitionend', function() {
            splashScreen.style.display = 'none';
        });
    }

});
