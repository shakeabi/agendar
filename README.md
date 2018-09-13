# Agendar

Agendar is a simple web app to make and track events.

## Features

* Secure login and sign up options. Each user has his own calendar and appointments.
* Each event consists of a title, description, start, and end time.
* Clicking on a date shows the events for that date.
* Users can schedule meetings with others. This will send an invite to the other user and let them add it to their own calendars.
* Invites page will update with any new notifications without having to refresh.
* Sign up process with dynamic username availability and a Captcha.

----


## Setting up

**Connecting to database**
* Replace "Your-Username" and "Your-Password" with your username and password of mySQL database manager.
```html
define ('DB_USER','Your-username');
```
```html
define ('DB_PASSWORD','Your-password');
```
----

**Setting up reCaptcha**

* Please add your private and public key of reCaptcha in config.php.
```html
$privateKey = "private_key";
```
```html
$publicKey = "public_key";
```

----
## Built using

* [HTML](https://www.w3.org/html/)
* [CSS](https://www.w3.org/Style/CSS/)
* [Vanilla JS](http://vanilla-js.com/)
* [PHP](http://php.net/)
* [AJAX](https://www.w3schools.com/xml/ajax_intro.asp)
* [reCaptcha API](https://www.google.com/recaptcha/)
