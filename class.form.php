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
	public static function renderOpenFieldset($legend='')
	{
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
	public static function renderCloseFieldset()
	{
		return "\t".'</fieldset>'."\n";
	}

	/**
	 * Render a text field
	 *
	 * @return string
	 */
	public static function renderText($label, $nid, $size, $max, $default='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

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
	public static function renderPassword($label, $nid, $size, $max, $default='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

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
	public static function renderFile($label, $nid, $size, $max, $default='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

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
	public static function renderSelect($label, $nid, $data, $default='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

		$str =
		'<p><label for="'.$id.'">'.$label.'</label><br />'."\n".
		formField::select($nid,$data,$default,$class,$tabindex,$disabled,$extra_html).
		'</p>';

		return $str;
	}

	public static function renderTextarea($label, $nid, $cols, $rows, $default='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

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
	public static function renderRadio($label, $nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

		$str =
		'<p>'.formField::radio($nid,$value,$checked,$class,$tabindex,$disabled,$extra_html).
		'<label for="'.$id.'">'.$label.'</label>';

		return $str;
	}

	/**
	 * Render a checkbox button
	 *
	 * @return string
	 */
	public static function renderCheckbox($label, $nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		formField::getNameAndId($nid,&$name,&$id);

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
	public static function renderSubmit($nid, $value, $class='', $tabindex='', $disabled=false, $extra_html='')
	{
		return '<p>'.formField::submit($nid,$value,$class,$tabindex,$disabled,$extra_html).'</p>';
	}

} #class
