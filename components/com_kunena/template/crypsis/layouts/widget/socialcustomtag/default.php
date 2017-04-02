<?php
/**
 * Kunena Component
 * @package     Kunena.Template.Crypsis
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$this->ktemplate = KunenaFactory::getTemplate();
$socialsharetag = $this->ktemplate->params->get('socialsharetag');
?>

<div id="share"><?php echo JHtml::_('content.prepare', $socialsharetag); ?></div>
