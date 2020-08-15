<?php
class Game 
{
    private $phrase;
    private $lives = 5;

    public function __construct($phrase) 
    {
        $this->phrase = $phrase;
    }

    public function checkForWin() {
        if (count(array_intersect($this->phrase->selected, $this->phrase->getLetterArray())) == count($this->phrase->getLetterArray())) {
          return true;
        } else {
          return false;
        }
        
      }

    public function displayKeyboard() {
        $keyboard = '<form action="play.php" method="post">';
                        $keyboard .= '<div id="qwerty" class="section">';
                            $keyboard .= '<div class="keyrow">';
                            $keyboard .= $this->letterKeyHandler('q');
                            $keyboard .= $this->letterKeyHandler('w');
                            $keyboard .= $this->letterKeyHandler('e');
                            $keyboard .= $this->letterKeyHandler('r');
                            $keyboard .= $this->letterKeyHandler('t');
                            $keyboard .= $this->letterKeyHandler('y');
                            $keyboard .= $this->letterKeyHandler('u');
                            $keyboard .= $this->letterKeyHandler('i');
                            $keyboard .= $this->letterKeyHandler('o');
                            $keyboard .= $this->letterKeyHandler('p');   
                            $keyboard .= '</div>';

                            $keyboard .= '<div class="keyrow">';
                            $keyboard .= $this->letterKeyHandler('a');
                            $keyboard .= $this->letterKeyHandler('s');
                            $keyboard .= $this->letterKeyHandler('d');
                            $keyboard .= $this->letterKeyHandler('f');
                            $keyboard .= $this->letterKeyHandler('g');
                            $keyboard .= $this->letterKeyHandler('h');
                            $keyboard .= $this->letterKeyHandler('j');
                            $keyboard .= $this->letterKeyHandler('k');
                            $keyboard .= $this->letterKeyHandler('l');
                            $keyboard .= '</div>';

                            $keyboard .= '<div class="keyrow">';
                            $keyboard .= $this->letterKeyHandler('z');
                            $keyboard .= $this->letterKeyHandler('x');
                            $keyboard .= $this->letterKeyHandler('c');
                            $keyboard .= $this->letterKeyHandler('v');
                            $keyboard .= $this->letterKeyHandler('b');
                            $keyboard .= $this->letterKeyHandler('n');
                            $keyboard .= $this->letterKeyHandler('m');
                            $keyboard .= '</div>';
                        $keyboard .= '</div>';
                    $keyboard .= '</form>';
        return $keyboard;
    }

    public function displayScore() {
        $scores = '<div id="scoreboard" class="section">';
            $scores .= '<ol>';
            for ($x=1; $x <= $this->phrase->numberLost(); $x++) {
            $scores .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
            }
            for ($x=1; $x <= ($this->lives - $this->phrase->numberLost()); $x++) {
            $scores .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
            }
            $scores .= '</ol>';
        $scores .= '</div>';
        return $scores;
    }

    public function letterKeyHandler($letter) {
        if(!in_array($letter, $this->phrase->selected)) {
            return "<input id=\"" . $letter . "\" type=\"submit\" button name=\"key\"value=\"" . $letter . "\" class=\"key\" ></button>";
        } else if($this->phrase->checkLetter($letter)) {
            return "<input id=\"" . $letter . "\" type=\"submit\" button name=\"key\"value=\"" . $letter . "\" class=\"key correct\" disabled ></button>";
        } else {
            return "<input id=\"" . $letter . "\" type=\"submit\" button name=\"key\"value=\"" . $letter . "\" class=\"key incorrect\" disabled ></button>";
        }
    }

    public function checkForLoss() {
        if($this->phrase->numberLost() >= $this->lives) {
            return true;
        } else {
            return false;
        }
    }

    public function gameOver() {
        if($this->checkForLoss() == true) {
            return '<div id="overlay" class="lose">' .
            '<h2 class="header" style="color:white;">Phrase Hunter</h2>' .
            '<h1 id="game-over-message">The phrase was: ' . $this->phrase->currentPhrase . '. Better luck next time!</h1></d>' .
            '<form action="play.php" method="post">' .
            '<input id="btn__reset" type="submit" name="start" value="Try Again?" />' .
            '</form></div>';
        } else if($this->checkForWin() == true) {
            return '<div id="overlay" class="win">' .
            '<h2 class="header" style="color:white;">Phrase Hunter</h2>' .
            '<h1 id="game-over-message">Congratulations!: ' . $this->phrase->currentPhrase . '. You are correct.</h1></d>' .
            '<form action="play.php" method="post">' .
            '<input id="btn__reset" type="submit" name="start" value="Play again?" />' .
            '</form></div>';
        }
    }
}
?>