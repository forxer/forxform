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
 * Interface pour le rendu des formulaires forxForm
 *
 * @package 		forxForm
 * @author			Vincent Garnier
 * @copyright		2008 Vincent Garnier
 * @version 		$Revision$
 * @date				$Date$
 * @editor			$Author$
 * @filesource
 */
interface iRenderForxForm
{
	/**
	 * Render extra HTLM
	 */
	public static function renderExtraHtml($str);

	/**
	 * Render a group of hiddens fields
	 *
	 * @param array $hiddens
	 */
	public static function renderHiddens($hiddens);

	/**
	 * Render an opening fieldset
	 *
	 * @return string
	 */
	public static function renderOpenFieldset();

	/**
	 * Render a closing fieldset
	 *
	 * @return string
	 */
	public static function renderCloseFieldset();

	/**
	 * Render a text field
	 *
	 * @return string
	 */
	public static function renderText();

	/**
	 * Render a password field
	 *
	 * @return string
	 */
	public static function renderPassword();

	/**
	 * Render a file field
	 *
	 * @return string
	 */
	public static function renderFile();

	/**
	 * Render a select field
	 *
	 * @return string
	 */
	public static function renderSelect();

	/**
	 * Render a textarea field
	 *
	 * @return string
	 */
	public static function renderTextarea();

	/**
	 * Render a radio button
	 *
	 * @return string
	 */
	public static function renderRadio();

	/**
	 * Render a checkbox button
	 *
	 * @return string
	 */
	public static function renderCheckbox();

	/**
	 * Render a submit button
	 *
	 * @return string
	 */
	public static function renderSubmit();

} # interface
