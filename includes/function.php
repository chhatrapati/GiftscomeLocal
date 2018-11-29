<?php
function toPublicId($id){
	return ($id*7765677)+5466;
}
function toInternalId($id){
	return ($id-5466)/7765677;
}

?>