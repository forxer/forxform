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

/**
 * Classe de génération de formulaires
 *
 * @package 		forxForm
 * @author			Vincent Garnier
 * @copyright		2008 Vincent Garnier
 * @version 		$Revision$
 * @date				$Date$
 * @editor			$Author$
 * @filesource
 */
class forxForm
{
	protected $form = array();

	protected $hiddens = array();

	protected $content = array();

	protected $hasFile = false;

	protected $renderer;

	public function __construct($action,$method='post',$id='',$class='')
	{
		$method = ($method == 'get' ? 'get' : 'post');

		$this->form = array(
			'action' => $action,
			'method' => $method,
			'id' => $id,
			'class' => $class
		);
	}

	/**
	 * Set another renderer for the form
	 *
	 * @param string $class
	 */
	public function setRenderer($class)
	{
		if (class_exists($class)) {
			$this->renderer = $class;
		}
	}

	public static function handleOptions($params,&$nid,&$name,&$id,&$label,&$value,&$default,&$desc,&$class,&$tabindex,&$required,&$disabled,&$extra_html)
	{
		$name = isset($params['name']) ? $params['name'] : '';
		$id = isset($params['id']) ? $params['id'] : '';
		$nid = array($name,$id);
		$label = isset($params['label']) ? $params['label'] : '';
		$value = isset($params['value']) ? $params['value'] : '';
		$default = isset($params['default']) ? $params['default'] : '';
		$desc = isset($params['desc']) ? $params['desc'] : '';
		$class = isset($params['class']) ? $params['class'] : '';
		$tabindex = isset($params['tabindex']) ? (integer)$params['tabindex'] : '';
		$required = isset($params['required']) ? (boolean)$params['required'] : false;
		$disabled = isset($params['disabled']) ? (boolean)$params['disabled'] : false;
		$extra_html = isset($params['extra_html']) ? $params['extra_html'] : '';
	}


	/* Formatting form methods
	----------------------------------------------------------*/

	/**
	 * Add extra HTML
	 *
	 * @param string $html
	 * @return forxForm
	 */
	public function extraHtml($html)
	{
		$this->addContent('renderExtraHtml', array($html));
		return $this;
	}

	/**
	 * Add a content header
	 *
	 * @param string $title
	 * @return forxForm
	 */
	public function hidden($nid,$value)
	{
		$this->hiddens[] = array('nid'=>$nid, 'value'=>$value);
		return $this;
	}

	/**
	 * Add an opening fieldset
	 *
	 * @return forxForm
	 */
	public function openFieldset($params=array())
	{
		$this->addContent('renderOpenFieldset', $params);
		return $this;
	}

	/**
	 * Add a closing fieldset
	 *
	 * @return forxForm
	 */
	public function closeFieldset($params=array())
	{
		$this->addContent('renderCloseFieldset', $params);
		return $this;
	}

	public function text($params=array())
	{
		$this->addContent('renderText', $params);
		return $this;
	}

	public function password($params=array())
	{
		$this->addContent('renderPassword', $params);
		return $this;
	}

	public function file($params=array())
	{
		$this->hasFile = true;
		$this->addContent('renderFile', $params);
		return $this;
	}

	public function select($params=array())
	{
		$this->addContent('renderSelect', $params);
		return $this;
	}

	public function textarea($params=array())
	{
		$this->addContent('renderTextarea', $params);
		return $this;
	}

	public function radio($params=array())
	{
		$this->addContent('renderRadio', $params);
		return $this;
	}

	public function checkbox($params=array())
	{
		$this->addContent('renderCheckbox', $params);
		return $this;
	}

	public function submit($params=array())
	{
		$this->addContent('renderSubmit', $params);
		return $this;
	}

	/**
	 * Render the form
	 *
	 * @return string
	 */
	public function render()
	{
		$form_string = '';

		# début du formulaire
		$form_string =
		'<form action="'.$this->form['action'].'" method="'.$this->form['method'].'" accept-charset="utf-8"'.
		(!empty($this->form['id']) ? ' id="'.$this->form['id'].'"' : '').
		(!empty($this->form['class']) ? ' class="'.$this->form['class'].'"' : '').
		($this->hasFile ? ' enctype="multipart/form-data"' : '').
		'>'."\n";

		# hiddens fields
		$form_string .= call_user_func(array($this->renderer,'renderHiddens'),$this->hiddens);

		# contenu
		foreach ($this->content as $func) {
			$form_string .= call_user_func(array($this->renderer,$func['callback']),$func['args']);
		}

		# fin du formulaire
		$form_string .= '</form>'."\n";

		return $form_string;
	}

	/**
	 * Add callback to render the form
	 *
	 * @param string $method
	 * @param array $args
	 */
	protected function addContent($method,$args=array())
	{
		$this->content[] = array(
			'callback' => $method,
			'args' => $args
		);
	}

} # class
