<?php 
session_start();

include 'inc/Game.php';
include 'inc/Phrase.php';

if(isset($_POST['start'])) {
	unset($_SESSION['phrase']);
	unset($_SESSION['selected']);
}

if(!isset($_POST['key'])) {
	$_SESSION['phrase'] = new Phrase(); 
	$_SESSION['game'] = new Game($_SESSION['phrase']);
} else {
	$selected = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
	//$_SESSION['selected'][] = $selected;
	$_SESSION['phrase']->selected[] = $selected;
	$_SESSION['phrase'] = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
	$_SESSION['game'] = new Game($_SESSION['phrase']);
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body>
		<div class="main-container">
			<h2 class="header">Phrase Hunter</h2>
			<?php 
			echo $_SESSION['phrase']->addPhraseToDisplay(); 
            echo $_SESSION['game']->displayKeyboard();
			echo $_SESSION['game']->displayScore();
            ?>
		</div>

	</body>
</html>

