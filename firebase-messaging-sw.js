importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');
/*Update this config*/
var config = {
    apiKey: "AIzaSyCZzw4RTesKrY3EqqPHSZ080EwZri9hUr0",
    authDomain: "sterkla-8961c.firebaseapp.com",
    databaseURL: "https://sterkla-8961c.firebaseio.com",
    projectId: "sterkla-8961c",
    storageBucket: "sterkla-8961c.appspot.com",
    messagingSenderId: "452039076434",
    appId: "1:452039076434:web:17819d0acd2a73c0"
  };
  firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
// [END background_handler]