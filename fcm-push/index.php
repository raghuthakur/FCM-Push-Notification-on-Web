<!DOCTYPE html>
<html>
<head>
  <title>Web Push Notification in PHP/MySQL using FCM</title>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="manifest" href="manifest.json">
<script>
  // Initialize Firebase
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

	// Retrieve Firebase Messaging object.
	const messaging = firebase.messaging();
	messaging.requestPermission()
	.then(function() {
	  console.log('Notification permission granted.');
	  // TODO(developer): Retrieve an Instance ID token for use with FCM.
	  if(isTokenSentToServer()) {
	  	console.log('Token already saved.');
	  } else {
	  	getRegToken();
	  }

	})
	.catch(function(err) {
	  console.log('Unable to get permission to notify.', err);
	});

	function getRegToken(argument) {
		messaging.getToken()
		  .then(function(currentToken) {
		    if (currentToken) {
		      saveToken(currentToken);
		      console.log(currentToken);
		      setTokenSentToServer(true);
		    } else {
		      console.log('No Instance ID token available. Request permission to generate one.');
		      setTokenSentToServer(false);
		    }
		  })
		  .catch(function(err) {
		    console.log('An error occurred while retrieving token. ', err);
		    setTokenSentToServer(false);
		  });
	}

	function setTokenSentToServer(sent) {
	    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
	}

	function isTokenSentToServer() {
	    return window.localStorage.getItem('sentToServer') == 1;
	}

	function saveToken(currentToken) {
		$.ajax({
			url: 'action.php',
			method: 'post',
			data: 'token=' + currentToken
		}).done(function(result){
			console.log(result);
		})
	}

	messaging.onMessage(function(payload) {
	  console.log("Message received. ", payload);
	  notificationTitle = payload.data.title;
	  notificationOptions = {
	  	body: payload.data.body,
	  	icon: payload.data.icon,
	  	image:  payload.data.image
	  };
	  var notification = new Notification(notificationTitle,notificationOptions);
	});
</script>
</head>
<body>
<center>
  <h1>FCM Web Push Notification in PHP/MySQL from localhost</h1>
  <h2>Part 5: Send and Receive Push Notifications in background</h2>
</center>
</body>
