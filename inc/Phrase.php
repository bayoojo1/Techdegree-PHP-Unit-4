<?php 
class Phrase
{
    public $currentPhrase;
    public $selected = [];
    public $phrase = [

      'Boldness be my friend',
      'Leave no stone unturned',
      'Broken crayons still color',
      'The adventure begins',
      'Dream without fear',
      'Love without limits',
      'Live and let live',
      'It is well with my soul',
      'A friend in need is a friend indeed',
      'As clear as crystal'
];

    public function __construct($phrase = null, $selected = null) {
        if(!empty($phrase)) {
            $this->currentPhrase = $phrase;   
        } else if(!isset($phrase)) {
          $randPhrase = array_rand($this->phrase);
          $this->currentPhrase = $this->phrase[$randPhrase];
        }
        if(!empty($selected)) {
          $this->selected = $selected;
        }

    }

    public function addPhraseToDisplay()
    {
      $characters = str_split(strtolower($this->currentPhrase));
      $splitchar = "<div id='phrase' class='section'>
    <ul>";
      foreach($characters as $char){
        if($char == " "){
          $splitchar .= "<li class='hide space'> </li>";
        } else{
          if(in_array($char,$this->selected)){
          $splitchar .="<li class='show letter'>$char</li>";
          } else {
          $splitchar .="<li class='hide letter'>$char</li>";
          }
        }
      }
          $splitchar .= "</ul>
      </div>";
      return $splitchar;
    }

    public function getLetterArray() {
      return array_unique(str_split(str_replace(
        ' ',
        '',
        strtolower($this->currentPhrase)
        )));
    }
    
    public function checkLetter($letter) {
      if (in_array($letter, $this->getLetterArray())) {
        return true;
      } else {
        return false;
      }
    }

    public function numberLost()
    {
      return count(array_diff($this->selected, $this->getLetterArray()));
    }
    
}
?>