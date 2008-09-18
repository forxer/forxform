<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of forxForm.
#
# Copyright (c) 2008 Vincent Garnier and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------


# Inclusion des fichiers requis
require dirname(__FILE__).'/../lib/class.forxform.php';
require dirname(__FILE__).'/../lib/interface.rendeforxform.php';
require dirname(__FILE__).'/../lib/lib.formfield.php';

require dirname(__FILE__).'/../renderer/class.form.php';

# Instanciation d'un objet
$form = new form('example.php');

# Peuplement du formulaire
$form

	# ouverture d'un fieldset
	->openFieldset(array('legend'=>'Text fields'))

		# ajout d'un champ texte
		->text(array('label'=>'A text field','id'=>'f1'))

		# ajout d'un autre champ texte
		->text(array('label'=>'Another text field','id'=>'f2'))

		# ajout d'un champs mot de passe
		->password(array('label'=>'Password field','id'=>'f3'))

		# ajout d'un champs fichier
		->file(array('label'=>'File field','id'=>'f4'))

	# fermeture du fieldset
	->closeFieldset()

	# bouton de soumission
	->submit(array('value'=>'Send'))
;

# Affichage
echo $form->render();

?>