<?php
$dossier="dossierOF";
$ouverture=opendir($dossier);
while ($fichier=readdir($ouverture)) {
unlink("$dossier/$fichier");
}
closedir($ouverture);
?>
