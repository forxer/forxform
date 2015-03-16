# Utilisation de base #

  * Inclusion des fichiers requis
  * Instanciation de la classe
  * Peuplement du formulaire
  * Affichage


## Inclusion des fichiers requis ##

Avant de pouvoir utiliser le forxForm vous devez inclure les fichiers de la librairie (répertoire /lib) ainsi qu'une classe de rendu.

```
require './lib/class.forxform.php';
require './lib/interface.rendeforxform.php';
require './lib/lib.formfield.php';

require './renderer/class.form.php';
```

Évidement la meilleure solution est d'utiliser [l'autoload de PHP](http://www.php.net/autoload).


## Instanciation de la classe ##

Ensuite on initialise la classe de rendue choisie.

```
$form = new form('example.php');
```


## Peuplement du formulaire ##

Une fois l'objet créé, on peut l'utiliser pour peupler le formulaire.

```
$form
	->openFieldset(array('legend'=>'Text fields'))
		->text(array('label'=>'A text field','id'=>'f1'))
		->text(array('label'=>'Another text field','id'=>'f2'))
		->password(array('label'=>'Password field','id'=>'f3'))
		->file(array('label'=>'File field','id'=>'f4'))
	->closeFieldset()
	->submit(array('value'=>'Send'));
```


## Affichage ##

Enfin viens le temps de l'affichage :

```
echo $form->render();
```