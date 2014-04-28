<?php
// this file contains the contents of the popup window
	$source = "insert";
	$title = "Insert Button";
	$insert_text = "Insert";
	if(isset($_GET['ver']))
	{
		$fasc_plugin_ver = $_GET['ver'];
	}
	else
	{
		$fasc_plugin_ver = "";
	}
	
	
	if(isset($_GET['source']))
	{
		if($_GET['source']=="click")
		{
			$source = "click";
			$title = "Edit Button";
			$insert_text = "Update";
		}
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../../../../wp-includes/js/tinymce/tiny_mce_popup.js?ver=<?php echo $fasc_plugin_ver; ?>"></script>
<link rel="stylesheet" href="../../css/button-styles.css?ver=<?php echo $fasc_plugin_ver; ?>" />
<link rel="stylesheet" href="../../css/font-awesome.css?ver=<?php echo $fasc_plugin_ver; ?>" />
<script src="jquery.minicolors.min.js?ver=<?php echo $fasc_plugin_ver; ?>"></script>
<link rel="stylesheet" href="jquery.minicolors.css?ver=<?php echo $fasc_plugin_ver; ?>">
<link rel="stylesheet" href="popup.css?ver=<?php echo $fasc_plugin_ver; ?>">
<script type="text/javascript">
var source = "<?php echo $source; ?>"; 
</script>
<script type="text/javascript" src="popup.js?ver=<?php echo $fasc_plugin_ver; ?>"></script>
</head>
<body>

	<!-- http://www.problogdesign.com/wordpress/user-friendly-short-codes-with-tinymce/ -->
	<!-- http://www.tinymce.com/develop/bugtracker_view.php?id=5575 -->
	
	<div id="button-dialog">
		<div class="preview-button-area">
			<div class="centered-button">
				
			</div>
		</div>
		
		<form action="/" method="get" accept-charset="utf-8">
			
			<div id="tab-header">
				<ul>
					<li class="active"><a href="#tab-1-content">Properties</a></li>
					<li><a href="#tab-2-content">Icon</a></li>
					<!--<li><a href="#tab-3-content">My Buttons</a></li>-->
					<!--<li><a href="#tab-4-content"><div data-code="f111" class="dashicons dashicons-admin-generic active"></div></a></li>-->
				</ul><div class="clear"></div>
			</div>
			
			<div id="tab-1-content" class="fasc-tab-content">
				<div class="inputrow main">
					<label for="button-text">Text</label>
					<div class="inputwrap">
						<input type="text" name="button-text" value="" id="button-text" value="" placeholder="Enter your text&hellip;" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="inputrow main">
					<label for="button-url">URL</label>
					<div class="inputwrap">
						<input type="text" name="button-url" value="" id="button-url" /><br />
					</div>
					<div class="inputwrap">
						<label for="new-window"><small>Open link in new window?</small></label> <input type="checkbox" id="new-window" name="new-window" value="1" />
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="inputrow">
					
					<div class="inputcol left">
						<div class="inputrowc">
							<label for="text-color">Text Color</label>
							<div class="inputwrap">
								<input type="text" id="text-color" name="text-color" value="#ffffff" />
							</div>
							<div class="clear"></div>
						</div>
						<div class="inputrowc">
							<label for="button-type">Type</label>
							<div class="inputwrap">
								<select name="button-type" id="button-type">
									<option value="fasc-type-flat" selected="selected">Flat</option>
									<option value="fasc-type-flat fasc-rounded-medium">Flat Rounded</option>
									<option value="fasc-type-glossy">Glossy</option>
									<option value="fasc-type-glossy fasc-rounded-medium">Glossy Rounded</option>
									<option value="fasc-type-popout">Pop out</option>
									<option value="fasc-type-popout fasc-rounded-medium">Pop out Rounded</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="inputcol right">
						
						<div class="inputrowc">
							<label for="button-color">Button Color</label>
							<div class="inputwrap">
								<input type="text" id="button-color" name="button-color" value="#33809e" />
							</div>
							<div class="clear"></div>
						</div>
						<div class="inputrowc">
							<label for="button-size">Size</label>
							<div class="inputwrap">
								<select name="button-size" id="button-size" size="1">
									<option value="fasc-size-xsmall">Extra Small</option>
									<option value="fasc-size-small">Small</option>
									<option value="fasc-size-medium" selected="selected">Medium</option>
									<option value="fasc-size-large">Large</option>
									<option value="fasc-size-xlarge">Extra Large</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="inputrow" style="display:none;">
					<label for="button-align">Alignment</label>
					<div class="inputwrap">
						<select name="button-align" id="button-align" size="1">
							<option value="" selected="selected">None</option>
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div id="tab-2-content" class="fasc-tab-content">
				<div class="inputrow">
					<div class="inputwrap left">
						<select id="icon-type-select">
							<option value="dashicons-grid">Dashicons</option>
							<option value="fa-web-grid">Web</option>
							<option value="fa-media-grid">Media</option>
							<option value="fa-form-grid">Form</option>
							<option value="fa-currency-grid">Currency</option>
							<option value="fa-editor-grid">Editor</option>
							<option value="fa-directional-grid">Directional</option>
							<option value="fa-brand-grid">Brand</option>
							<option value="fa-medical-grid">Medical</option>
						</select>
						</label>
					</div>
					
					<div class="inputwrap right">

						<label><input type="radio" name="fasc-ico-position" value="none" class="fasc-ico-position" checked="checked" /> None</label>
						<label><input type="radio" name="fasc-ico-position" value="before" class="fasc-ico-position" /> Before</label>
						<!--<label><input type="radio" name="fasc-ico-position" value="after" /> After</label>
						<label><input type="radio" name="fasc-ico-position" value="center" /> Center</label>-->
						
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="ico-grid">
					<div class="grid-container" id="dashicons-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("dashicons-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-media-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-media-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-form-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-form-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-web-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-web-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-currency-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-currency-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-editor-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-editor-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-directional-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-directional-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-brand-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-brand-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="grid-container fontawesome" id="fa-medical-grid">
						<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
						<?php require_once("fa-medical-grid.php"); ?>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div id="fasc-footer">	
				<a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" id="insert" style="display: block; line-height: 24px;"><?php echo $insert_text; ?></a>
			</div>
			
			
		</form>
	</div>
	
</body>
</html>