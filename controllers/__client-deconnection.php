
<?php

if (isset($_SESSION['client'])){ // If session client exists, restore object
	unset($client);
	unset($_SESSION['client']);
	// session_destroy(); // The session is closed
}