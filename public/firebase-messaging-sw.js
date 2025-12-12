importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js');

firebase.initializeApp({
    apiKey: "AIzaSyA9xlYpx5_pTSO3YYfQ5pLnwAUeirhUm8M",
    authDomain: "buildhomemart-e75df.firebaseapp.com",
    projectId: "buildhomemart-e75df",
    storageBucket: "buildhomemart-e75df.firebasestorage.app",
    messagingSenderId: "61632533562",
    appId: "1:61632533562:web:afb80047e0b4c9683a9103",
    measurementId: "G-YKNTEPC0TV"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    return self.registration.showNotification(payload.data.title, {
        body: payload.data.body || '',
        icon: payload.data.icon || ''
    });
});