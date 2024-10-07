const APP_ID = '279b4ee2efca4b03ab11f369a80abfd9'; // Replace with your Agora App ID
const TOKEN = 'your-temporary-token'; // Replace with your Agora Token (optional if you haven't enabled tokens)
const CHANNEL_NAME = 'livestream'; // Channel name for the live stream

let client = AgoraRTC.createClient({ mode: 'live', codec: 'vp8' });
let localTracks = { videoTrack: null, audioTrack: null };

// Join the channel and start broadcasting
async function startLiveStream() {
    await client.join(APP_ID, CHANNEL_NAME, TOKEN || null);
    
    // Create and publish local tracks
    localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
    localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
    
    localTracks.videoTrack.play('local-player');
    
    await client.publish(Object.values(localTracks));
    console.log('Live stream started');
}

// Event listener for start button
document.getElementById('start-broadcast').addEventListener('click', () => {
    startLiveStream().catch(error => {
        console.error('Error starting live stream', error);
    });
});

// Optionally handle message sending in the chat
document.getElementById('send-btn').addEventListener('click', () => {
    const messageText = messageInput.value.trim();
    if (messageText) {
        const messageElement = document.createElement('p');
        messageElement.textContent = messageText;
        messageDisplay.appendChild(messageElement);
        messageInput.value = ''; // Clear the input after sending
    }
});
