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
 * Classe pour la génération de formulaires dans FluxBB 1.2 beta 2
 *
 * @package 		forxForm
 * @author			Vincent Garnier
 * @copyright		2008 Vincent Garnier
 * @version 		$Revision$
 * @date			$Date$
 * @editor			$Author$
 * @filesource
 */
class fluxbbForm extends forxForm implements iRenderForxForm
{
	public static $group_count = 0;
	public static $item_count = 0;
	public static $fld_count = 0;
	public static $multi = false;

	/**
	 * Constructor.
	 *
	 * @param string $action
	 * @param string $method
	 * @param string $id
	 * @param string $class
	 */
	public function __construct($action,$method='post',$id='',$class='frm-form')
	{
		parent::__construct($action,$method,$id,$class);

		$this->setRenderer('fluxbbForm');
	}

	public static function handleOptions($params,&$nid,&$name,&$id,&$label,&$value,&$default,&$desc,&$class,&$tabindex,&$disabled,&$extra_html)
	{
		$name = isset($params['name']) ? $params['name'] : '';
		$id = isset($params['id']) ? $params['id'] : 'fld'.self::$fld_count;
		$nid = array($name,$id);
		$label = isset($params['label']) ? $params['label'] : '';
		$value = isset($params['value']) ? $params['value'] : '';
		$default = isset($params['default']) ? $params['default'] : '';
		$desc = isset($params['desc']) ? $params['desc'] : '';
		$class = isset($params['class']) ? $params['class'] : '';
		$tabindex = isset($params['tabindex']) ? (integer)$params['tabindex'] : '';
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
		$str = "\t".'<div class="hidden">'."\n";

		foreach ($hiddens as $hidden) {
			$str .= "\t\t".formField::hidden($hidden['nid'],$hidden['value'])."\n";
		}

		$str .= "\t".'</div>'."\n";

		return $str;
	}

	/**
	 * Render an opening fieldset
	 *
	 * @return string
	 */
	public static function renderOpenFieldset($params=array())
	{
		self::$group_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$legend = isset($params['legend']) ? $params['legend'] : '';
		$multiple = isset($params['multiple']) ? true : false;

		if ($multiple) {
			$class = 'mf-set';
		}
		elseif ($class == '') {
			$class = 'frm-group';
		}

		$str = "\t".'<fieldset class="'.$class.' group'.self::$group_count.'">'."\n";

		if ($legend != '')
		{
			if ($multiple) {
				$str .= "\t\t".'<legend><span>'.$legend.'</span></legend>'."\n";
			}
			else {
				$str .= "\t\t".'<legend class="group-legend"><strong>'.$legend.'</strong></legend>'."\n";
			}
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
		self::$item_count = 0;

		return "\t".'</fieldset>'."\n";
	}

	/**
	 * Render a text field
	 *
	 * @return string
	 */
	public static function renderText($params=array())
	{
		self::$item_count++;
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		"\t\t".'<div class="sf-set group-item'.self::$item_count.'">'."\n".
			"\t\t\t".'<div class="sf-box text">'."\n".
				"\t\t\t\t".'<label for="'.$id.'">'."\n".
					"\t\t\t\t\t".'<span>'.$label.'</span>'."\n".
					($desc != '' ? '<small>'.$desc.'</small>' : '').
				"\t\t\t\t".'</label><br />'."\n".
				"\t\t\t\t".'<span class="fld-input">'.
				formField::text($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
				'</span>'."\n".
			"\t\t\t".'</div>'."\n".
		"\t\t".'</div>'."\n";

		return $str;
	}

	/**
	 * Render a password field
	 *
	 * @return string
	 */
	public static function renderPassword($params=array())
	{
		self::$item_count++;
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		"\t\t".'<div class="sf-set group-item'.self::$item_count.'">'."\n".
			"\t\t\t".'<div class="sf-box text">'."\n".
				"\t\t\t\t".'<label for="'.$id.'">'."\n".
					"\t\t\t\t\t".'<span>'.$label.'</span>'."\n".
					($desc != '' ? '<small>'.$desc.'</small>' : '').
				"\t\t\t\t".'</label><br />'."\n".
				"\t\t\t\t".'<span class="fld-input">'.
				formField::password($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
				'</span>'."\n".
			"\t\t\t".'</div>'."\n".
		"\t\t".'</div>'."\n";

		return $str;
	}

	/**
	 * Render a file field
	 *
	 * @return string
	 */
	public static function renderFile($params=array())
	{
		self::$item_count++;
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$size = isset($params['size']) ? (integer)$params['size'] : 50;
		$max = isset($params['max']) ? (integer)$params['max'] : 255;

		$str =
		"\t\t".'<div class="sf-set group-item'.self::$item_count.'">'."\n".
			"\t\t\t".'<div class="sf-box text">'."\n".
				"\t\t\t\t".'<label for="'.$id.'">'."\n".
					"\t\t\t\t\t".'<span>'.$label.'</span>'."\n".
					($desc != '' ? '<small>'.$desc.'</small>' : '').
				"\t\t\t\t".'</label><br />'."\n".
				"\t\t\t\t".'<span class="fld-input">'.
				formField::file($nid,$size,$max,$default,$class,$tabindex,$disabled,$extra_html).
				'</span>'."\n".
			"\t\t\t".'</div>'."\n".
		"\t\t".'</div>'."\n";

		return $str;
	}

	/**
	 * Render a select field
	 *
	 * @return string
	 */
	public static function renderSelect($params=array())
	{
		self::$item_count++;
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$data = isset($params['data']) ? $params['data'] : array();

		$str =
		"\t\t".'<div class="sf-set group-item'.self::$item_count.'">'."\n".
			"\t\t\t".'<div class="sf-box select">'."\n".
				"\t\t\t\t".'<label for="'.$id.'">'."\n".
					"\t\t\t\t\t".'<span>'.$label.'</span>'."\n".
					($desc != '' ? '<small>'.$desc.'</small>' : '').
				"\t\t\t\t".'</label><br>'."\n".
				"\t\t\t\t".'<span class="fld-input">'."\n".
				formField::select($nid,$data,$default,$class,$tabindex,$disabled,$extra_html).
				'</span>'."\n".
			"\t\t\t".'</div>'."\n".
		"\t\t".'</div>'."\n";

		return $str;
	}

	public static function renderTextarea($params=array())
	{
		self::$item_count++;
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		$cols = isset($params['size']) ? (integer)$params['size'] : 60;
		$rows = isset($params['max']) ? (integer)$params['max'] : 10;

		$str =
		"\t\t".'<div class="txt-set group-item'.self::$item_count.'">'."\n".
			"\t\t\t".'<div class="txt-box textarea">'."\n".
				"\t\t\t\t".'<label for="'.$id.'"><span>'.$label.'</span></label>'."\n".
				"\t\t\t\t".'<div class="txt-input"><span class="fld-input">'.
				formField::textarea($nid, $cols, $rows, $default='', $class='', $tabindex='', $disabled=false, $extra_html='').
				'</span></div>'.
			"\t\t\t".'</div>'."\n".
		"\t\t".'</div>'."\n";

		return $str;
	}

	/**
	 * Render a radio button
	 *
	 * @return string
	 */
	public static function renderRadio($params=array())
	{
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		if (self::$multi)
		{
			$str =
			"\t\t\t".'<div class="mf-item">'."\n".
				"\t\t\t\t".'<span class="fld-input">'.
					formField::radio($nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='').
					'</span>'.
				"\t\t\t\t".'<label for="'.$id.'">'.$label.'</label>'."\n".
			"\t\t\t".'</div>'."\n";
		}
		else {
			"\t\t\t".'<div class="sf-set group-item7">'."\n".
				"\t\t\t\t".'<div class="sf-box radio">'."\n".
					"\t\t\t\t\t".'<span class="fld-input">'.
					formField::radio($nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='').
					'</span>'."\n".
					'<label for="'.$id.'"><span>'.$label.'</span>'.($desc != '' ? ' '.$desc : '').'</label>'."\n".
				"\t\t\t\t".'</div>'."\n".
			"\t\t\t".'</div>'."\n";
		}

		return $str;
	}

	/**
	 * Render a checkbox button
	 *
	 * @return string
	 */
	public static function renderCheckbox($params=array())
	{
		self::$fld_count++;

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		if (self::$multi)
		{
			$str =
			"\t\t\t".'<div class="mf-item">'."\n".
				"\t\t\t\t".'<span class="fld-input">'.
					formField::checkbox($nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='').
					'</span>'.
				"\t\t\t\t".'<label for="'.$id.'">'.$label.'</label>'."\n".
			"\t\t\t".'</div>'."\n";
		}
		else {
			"\t\t\t".'<div class="sf-set group-item7">'."\n".
				"\t\t\t\t".'<div class="sf-box checkbox">'."\n".
					"\t\t\t\t\t".'<span class="fld-input">'.
					formField::checkbox($nid, $value, $checked='', $class='', $tabindex='', $disabled=false, $extra_html='').
					'</span>'."\n".
					'<label for="'.$id.'"><span>'.$label.'</span>'.($desc != '' ? ' '.$desc : '').'</label>'."\n".
				"\t\t\t\t".'</div>'."\n".
			"\t\t\t".'</div>'."\n";
		}

		return $str;
	}

	/**
	 * Render a submit button
	 *
	 * @param mixed $nid
	 * @param string $value
	 * @param string $class
	 * @param integer $tabindex
	 * @param boolean $disabled
	 * @param string $extra_html
	 * @return string
	 */
	public static function renderSubmit($params=array())
	{
		if (empty($param['nid'])) {
			$param['nid'] = array('submit');
		}

		self::handleOptions($params,$nid,$name,$id,$label,$value,$default,$desc,$class,$tabindex,$disabled,$extra_html);

		return
		"\t\t".'<div class="frm-buttons">'."\n".
			"\t\t\t".'<span class="submit">'.
			formField::submit($nid,$value,$class,$tabindex,$disabled,$extra_html).
			'</span>'."\n".
		"\t\t".'</div>'."\n";
	}


	/**
	 * Extending default renderer for FLuxBB forms style
	 */

	/**
	 * Add a content header
	 *
	 * @param string $title
	 * @return forxForm
	 */
	public function contentHead($params)
	{
		$this->addContent('renderContentHead', $params);
		return $this;
	}

	/**
	 * Open a group of radio fields
	 *
	 * @return unknown
	 */
	public function openMulti($params)
	{
		$this->addContent('renderOpenMulti',$params);
		return $this;
	}

	/**
	 * Close a group of radio fields
	 *
	 * @return unknown
	 */
	public function closeMulti()
	{
		$this->addContent('renderCloseMulti',array());
		return $this;
	}

	/**
	 * Render a content head
	 *
	 * @param string $title
	 * @return string
	 */
	public static function renderContentHead($params=array())
	{
		if (isset($params['title']))
		{
			return
			"\t".'<div class="content-head">'."\n".
				"\t\t".'<h2 class="hn"><span>'.$params['title'].'</span></h2>'."\n".
			"\t".'</div>'."\n";
		}
	}

	/**
	 * Render an opening radio group
	 */
	public static function renderOpenMulti($params=array())
	{
		self::$multi = true;

		return
		self::renderOpenFieldset(array_merge($params,array('multiple'=>true))).
		"\t\t".'<div class="mf-box">'."\n";
	}

	/**
	 * Render a closing radio group
	 */
	public function renderCloseMulti($params=array())
	{
		self::$multi = false;
				return
		"\t\t".'</div>'."\n".
		self::renderCloseFieldset();
	}

} #class
