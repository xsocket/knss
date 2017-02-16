<?php
/**
 * Kunena Component
 * @package     Kunena.Template.Crypsis
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2016 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<ul class="nav navbar-nav pull-right">
	<li class="dropdown mobile-user">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="klogin">
			<?php echo KunenaIcons::user();?>
			<span class="login-text"><?php echo JText::_('JLOGIN');?></span>
		</a>
		<ul class="dropdown-menu card card-container dropdown-menu-right" id="userdropdownlogin" role="menu">
			<form action="<?php echo JRoute::_('index.php?option=com_kunena'); ?>" method="post" class="form-inline form-signin">
				<input type="hidden" name="view" value="user" />
				<input type="hidden" name="task" value="login" />
				<?php echo JHtml::_('form.token'); ?>

				<div class="center">
					<a href="#" class="thumbnail">
						<?php echo KunenaIcons::members(); ?>
				 </a>
				</div>
					<input id="login-username" type="text" name="username" class="form-control input-sm" tabindex="1"
					size="18" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" />
					<input id="login-passwd" type="password" name="password" class="form-control input-sm" tabindex="2"
					size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" required/>
				<?php $login = KunenaLogin::getInstance(); ?>
				<?php if ($login->getTwoFactorMethods() > 1) : ?>
						<input id="k-lgn-secretkey" type="text" name="secretkey" class="input-large" tabindex="3"
							size="18" placeholder="<?php echo JText::_('COM_KUNENA_LOGIN_SECRETKEY'); ?>" />
						<?php echo JText::_('COM_KUNENA_LOGIN_SECRETKEY'); ?>
				<?php endif; ?>
					<div id="remember" class="checkbox">
						<label>
							<input id="login-remember" type="checkbox" name="remember" class="inputbox" value="yes" />
							<?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?>
						</label>
					</div>
					<button class="btn btn-primary" type="submit">Sign in</button>
					<?php if ($this->resetPasswordUrl) : ?>
						<a href="<?php echo $this->resetPasswordUrl; ?>" rel="nofollow">
							<?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_PASSWORD'); ?>
						</a>
						<br />
					<?php endif ?>

					<?php if ($this->remindUsernameUrl) : ?>
						<a href="<?php echo $this->remindUsernameUrl; ?>" rel="nofollow">
							<?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_USERNAME'); ?>
						</a>
						<br />
					<?php endif ?>

					<?php if ($this->registrationUrl) : ?>
						<a href="<?php echo $this->registrationUrl; ?>" rel="nofollow">
							<?php echo JText::_('COM_KUNENA_PROFILEBOX_CREATE_ACCOUNT'); ?>
						</a>
					<?php endif ?>
			</form>
			<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_login'); ?>
		</ul>
	</li>
</ul>
