<?php

/**
 * Causes the EXIF "desc" field to be moved to the IPTC image caption field (so
 * long as this field is empty) to allow use as the zenphoto description.
 *
 * <b>Note:</b> this will happen whenever the image metadata is updated and only
 * when the metadata is updated.
 *
 * @author Stephen Billard (sbillard)
 *
 * @package plugins
 * @subpackage media
 * @category package
 *
 * Copyright 2014 by Stephen L Billard for use in {@link https://github.com/ZenPhoto20/ZenPhoto20 ZenPhoto20}
 */
$plugin_is_filter = 1000 | CLASS_PLUGIN;
$plugin_description = gettext('Use the EXIF "desc" field for zenphoto titles');
$plugin_author = "Stephen Billard (sbillard)";

zp_register_filter('image_metadata', 'exifDescIsZPdesc');

function exifDescIsZPdesc($image) {
	$desc = $image->get('EXIFDescription');
	if ($desc) {
		$image->set('EXIFDescription', '');
		if (!$image->get('IPTCImageCaption'))
			$image->set('IPTCImageCaption', $desc);
	}
}
