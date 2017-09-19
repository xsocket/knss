<?php
/**
 * @version    2.7.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<?php if(JRequest::getInt('print')==1): ?>
<!-- Print button at the top of the print page only -->
<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
	<span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
</a>
<?php endif; ?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<div id="k2Container" class="itemView<?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">


	<div class="itemHeader">
		<?php if($this->item->params->get('itemTitle')): ?>
		<!-- Item title -->
		<h2 class="itemTitle">
			<?php if(isset($this->item->editLink)): ?>
			<!-- Item edit link -->
			<span class="itemEditLink">
				<a data-k2-modal="edit" href="<?php echo $this->item->editLink; ?>"><?php echo JText::_('K2_EDIT_ITEM'); ?></a>
			</span>
			<?php endif; ?>

			<?php echo $this->item->title; ?>

			<?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
			<!-- Featured flag -->
			<span>
				<sup>
					<?php echo JText::_('K2_FEATURED'); ?>
				</sup>
			</span>
			<?php endif; ?>
		</h2>
		<?php endif; ?>
	</div>
	<!-- /.itemHeader -->

	<?php if(
		$this->item->params->get('itemDateCreated') ||
		$this->item->params->get('itemFontResizer') ||
		$this->item->params->get('itemPrintButton') ||
		$this->item->params->get('itemEmailButton') ||
		$this->item->params->get('itemSocialButton') ||
		($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)) ||
		($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)) ||
		($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && $this->item->params->get('comments'))
	): ?>
	<div class="itemToolbar">
		<!-- Date created -->
		<span class="itemDateCreated">
			<i class="fa fa-calendar"></i>
			<?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
		</span>

		<ul>
			<?php if($this->item->params->get('itemFontResizer')): ?>
			<!-- Font Resizer -->
			<li>
				<span class="itemTextResizerTitle"><?php echo JText::_('K2_FONT_SIZE'); ?></span>
				<a href="#" id="fontDecrease">
					<span><?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?></span>
				</a>
				<a href="#" id="fontIncrease">
					<span><?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
			<!-- Print Button -->
			<li>
				<a class="itemPrintLink" rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
					<span><?php echo JText::_('K2_PRINT'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
			<!-- Email Button -->
			<li>
				<a class="itemEmailLink" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
					<span><?php echo JText::_('K2_EMAIL'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))): ?>
			<!-- Item Social Button -->
			<li>
				<?php echo $this->item->params->get('socialButtonCode'); ?>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
			<!-- Anchor link to item video below - if it exists -->
			<li>
				<a class="itemVideoLink k2Anchor" href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('K2_MEDIA'); ?></a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
			<!-- Anchor link to item image gallery below - if it exists -->
			<li>
				<a class="itemImageGalleryLink k2Anchor" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('K2_IMAGE_GALLERY'); ?></a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
			<!-- Anchor link to comments below - if enabled -->
			<li>
				<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
				<!-- K2 Plugins: K2CommentsCounter -->
				<?php echo $this->item->event->K2CommentsCounter; ?>
				<?php else: ?>
				<?php if($this->item->numOfComments > 0): ?>
				<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
					<span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
				</a>
				<?php else: ?>
				<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor"><?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?></a>
				<?php endif; ?>
				<?php endif; ?>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<div class="itemBody">
		<?php if($this->item->params->get('itemImage') && !empty($this->item->image)): ?>
		<!-- Item Image -->
		<div class="itemImageBlock">
			<span class="itemImage">
				<a data-k2-modal="image" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>">
					<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />
				</a>
			</span>

			<?php if($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
			<!-- Image caption -->
			<span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
			<?php endif; ?>

			<?php if($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
			<!-- Image credits -->
			<span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
			<?php endif; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(!empty($this->item->fulltext)): ?>

		<?php if($this->item->params->get('itemIntroText')): ?>
		<!-- Item introtext -->
		<div class="itemIntroText">
			<?php echo $this->item->introtext; ?>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemFullText')): ?>
		<!-- Item fulltext -->
		<div class="itemFullText">
			<?php echo $this->item->fulltext; ?>
		</div>
		<?php endif; ?>

		<?php else: ?>

		<!-- Item text -->
		<div class="itemFullText">
			<?php echo $this->item->introtext; ?>
		</div>

		<?php endif; ?>

		<div class="clr"></div>

		<?php if($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
		<!-- Item extra fields -->
		<div class="itemExtraFields">
			<h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
			<ul>
				<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value != ''): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<?php if($extraField->type == 'header'): ?>
					<h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
					<?php else: ?>
					<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span>
					<span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
					<?php endif; ?>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
<!--
		<?php if($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
		<div class="itemContentFooter">

			<?php if($this->item->params->get('itemHits')): ?>
			<span class="itemHits">
				<?php echo JText::_('K2_READ'); ?> <b><?php echo $this->item->hits; ?></b> <?php echo JText::_('K2_TIMES'); ?>
			</span>
			<?php endif; ?>

			<?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0): ?>
			<span class="itemDateModified">
				<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
			</span>
			<?php endif; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>
-->
		<!-- Plugins: AfterDisplayContent -->
		<?php echo $this->item->event->AfterDisplayContent; ?>

		<!-- K2 Plugins: K2AfterDisplayContent -->
		<?php echo $this->item->event->K2AfterDisplayContent; ?>

		<div class="clr"></div>

	</div>

	<?php if(
		$this->item->params->get('itemCategory') ||
		$this->item->params->get('itemTags') ||
		$this->item->params->get('itemAttachments')
	): ?>
	<div class="itemLinks">

		<?php if($this->item->params->get('itemCategory')): ?>
		<!-- Item category -->
		<div class="itemCategory">
			<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
		<!-- Item tags -->
		<div class="itemTagsBlock">
			<span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
			<ul class="itemTags">
				<?php foreach ($this->item->tags as $tag): ?>
				<li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemAttachments') && count($this->item->attachments)): ?>
		<!-- Item attachments -->
		<div class="itemAttachmentsBlock">
			<span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
			<ul class="itemAttachments">
				<?php foreach ($this->item->attachments as $attachment): ?>
				<li>
					<a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
					<?php if($this->item->params->get('itemAttachmentsCounter')): ?>
					<span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<div class="clr"></div>
	</div>
	<?php endif; ?>


	<?php
	/*
	A note regarding 'Related Items'...
	If you add:
	- the CSS rule 'overflow-x:scroll;' in the element div.itemRelated {…} in the k2.css
	- the class 'k2Scroller' to the ul element below
	- the classes 'k2ScrollerElement' and 'k2EqualHeights' to the li element inside the foreach loop below
	- the style attribute 'style="width:<?php echo $item->imageWidth; ?>px;"' to the li element inside the foreach loop below
	...then your Related Items will be transformed into a vertical-scrolling block, inside which, all items have the same height (equal column heights). This can be very useful if you want to show your related articles or products with title/author/category/image etc., which would take a significant amount of space in the classic list-style display.
	*/
	?>

	<?php if($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
	<!-- Related items by tag -->
	<div class="itemRelated">
		<h3><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></h3>
		<ul>
			<?php foreach($this->relatedItems as $key=>$item): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?>">

				<?php if($this->item->params->get('itemRelatedTitle', 1)): ?>
				<a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedCategory')): ?>
				<div class="itemRelCat"><?php echo JText::_("K2_IN"); ?> <a href="<?php echo $item->category->link ?>"><?php echo $item->category->name; ?></a></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedAuthor')): ?>
				<div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author" href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedImageSize')): ?>
				<img style="width:<?php echo $item->imageWidth; ?>px;height:auto;" class="itemRelImg" src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedIntrotext')): ?>
				<div class="itemRelIntrotext"><?php echo $item->introtext; ?></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedFulltext')): ?>
				<div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedMedia')): ?>
				<?php if($item->videoType=='embedded'): ?>
				<div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
				<?php else: ?>
				<div class="itemRelMedia"><?php echo $item->video; ?></div>
				<?php endif; ?>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedImageGallery')): ?>
				<div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
			<li class="clr"></li>
		</ul>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<div class="clr"></div>

	<?php if($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
	<!-- Item image gallery -->
	<a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
	<div class="itemImageGallery">
		<h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
		<?php echo $this->item->gallery; ?>
	</div>
	<?php endif; ?>

	<?php if($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
	<!-- Item navigation -->
	<div class="itemNavigation">
		<span class="itemNavigationTitle"><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>

		<?php if(isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">&laquo; <?php echo $this->item->previousTitle; ?></a>
		<?php endif; ?>

		<?php if(isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>"><?php echo $this->item->nextTitle; ?> &raquo;</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="clr"></div>

</div>
<!-- End K2 Item Layout -->
