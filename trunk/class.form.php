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
 * Classe pour la génération de formulaires
 *
 * @package 		form
 * @author			Vincent Garnier
 * @copyright		2008 Vincent Garnier
 * @version 		$Revision$
 * @date			$Date$
 * @editor			$Author$
 * @filesource
 */
class form extends forxForm implements iRenderForxForm
{
	/**
	 * Constructor.
	 *
	 * @param string $action
	 * @param string $method
	 * @param string $id
	 * @param string $class
	 * @return void
	 */
	public function __construct($action,$method='post',$id='',$class='frm-form')
	{
		parent::__construct($action,$method,$id,$class);

		$this->setRenderer('form');
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

	/**
	 * Render extra HTLM
	 *
	 * @return string
	 */
	public static function renderExtraHtml($str)
	{
		return $str;
	}

	/**
	 * Render a group of hiddens fields
	 *
	 * @param array $hiddens
	 * @return string
	 */
	public static function renderHiddens($hiddens)
	{
		$str = '';

		foreach ($hiddens as $hidden) {
			$str .= "\t\t".formField::hidden($hidden['nid'],$hidden['value'])."\n";
		}

		return $str;
	}

	/**
	 * Render an opening fieldset
	 *
	 * @return string
	 */
	public static function renderOpenFieldset($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$legend = isset($params['legend']) ? $params['legend'] : '';

		$str = "\t".'<fieldset>'."\n";

		if ($legend != '') {
			$str .= "\t\t".'<legend><span>'.$legend.'</span></legend>'."\n";
		}

		return $str;
	}

	/**
	 * Render a closing fieldset
	 *
	 * @return string
	 */
	public static function renderCloseFieldset($params=array())
	{
		return "\t".'</fieldset>'."\n";
	}

	/**
	 * Render a text field
	 *
	 * @return string
	 */
	public static function renderText($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::text($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	/**
	 * Render a password field
	 *
	 * @return string
	 */
	public static function renderPassword($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::password($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	/**
	 * Render a file field
	 *
	 * @return string
	 */
	public static function renderFile($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::file($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	/**
	 * Render a select field
	 *
	 * @return string
	 */
	public static function renderSelect($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$data = isset($params['data']) ? $params['data'] : array();

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::select($nid,$data,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	public static function renderTextarea($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$cols = isset($params['size']) ? (integer)$params['size'] : 60;
		$rows = isset($params['max']) ? (integer)$params['max'] : 10;

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::textarea($nid,$cols,$rows,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	/**
	 * Render a radio button
	 *
	 * @return string
	 */
	public static function renderRadio($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$str =
		'<p>'.formField::radio($nid,$value,$checked,$class,$tabindex,$disabled,$extra_html).
		'<label for="'.$id.'">'.$label.'</label></p>';

		return $str;
	}

	/**
	 * Render a checkbox button
	 *
	 * @return string
	 */
	public static function renderCheckbox($params=array())
	{
		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		$str =
		'<p>'.formField::checkbox($nid,$value,$checked,$class,$tabindex,$disabled,$extra_html).
		'<label for="'.$id.'">'.$label.'</label>';

		return $str;
	}

	/**
	 * Render a submit button
	 *
	 * @return string
	 */
	public static function renderSubmit($params=array())
	{
		if (empty($param['nid'])) {
			$param['nid'] = array('submit');
		}

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$required,$disabled,$extra_html);

		return '<p>'.formField::submit($nid,$value,$class,$tabindex,$disabled,$extra_html).'</p>';
	}

} #class
