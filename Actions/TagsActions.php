<?php if (!isset($_SESSION))
  {
    session_start();
  }

function modTa($newCat, $oldCat) {
	modTagg($newCat, $oldCat);
}

function deleteTa($newCat, $oldCat) {
	deleteTagg($oldCat);
}

?>
