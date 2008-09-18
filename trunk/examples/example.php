<?php
require dirname(__FILE__).'/../lib/class.forxform.php';
require dirname(__FILE__).'/../lib/interface.rendeforxform.php';
require dirname(__FILE__).'/../lib/lib.formfield.php';

require dirname(__FILE__).'/../renderer/class.form.php';

$form = new form('example.php');
$form
	->openFieldset(array('legend'=>'Text fields'))
		->text(array('label'=>'A text field','id'=>'f1'))
		->text(array('label'=>'Another text field','id'=>'f2'))
		->password(array('label'=>'Password field','id'=>'f3'))
		->file(array('label'=>'File field','id'=>'f4'))
	->closeFieldset()

	->submit(array('value'=>'Send'));

echo $form->render();

?>