<?php
// this file contains the contents of the popup window
	$source = "insert";
	$title = "Insert Button";
	$insert_text = "Insert";
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
<script language="javascript" type="text/javascript" src="../../../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<link rel="stylesheet" href="../../css/button-styles.css" />
<script src="jquery.minicolors.min.js"></script>
<link rel="stylesheet" href="jquery.minicolors.css">
<link rel="stylesheet" href="popup.css">
<script type="text/javascript">
var source = "<?php echo $source; ?>"; 
</script>
<script type="text/javascript" src="popup.js"></script>
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
									<option value="fasc-type-flat rounded">Flat Rounded</option>
									<option value="fasc-type-glossy">Glossy</option>
									<option value="fasc-type-glossy rounded">Glossy Rounded</option>
									<option value="fasc-type-popout">Pop out</option>
									<option value="fasc-type-popout rounded">Pop out Rounded</option>
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
							<option value="left"=>Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div id="tab-2-content" class="fasc-tab-content">
				<div class="inputrow">
					<label><strong>Position</strong></label>
					<div class="inputwrap">
					
						<label><input type="radio" name="fasc-ico-position" value="none" class="fasc-ico-position" checked="checked" /> None</label>
						<label><input type="radio" name="fasc-ico-position" value="before" class="fasc-ico-position" /> Before</label>
						<!--<label><input type="radio" name="fasc-ico-position" value="after" /> After</label>
						<label><input type="radio" name="fasc-ico-position" value="center" /> Center</label>-->
						
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="ico-grid">
					<input type="hidden" value="" id="fasc-ico-val" name="fasc-ico-val" />
					<?php require_once("dashicons-grid.php"); ?>
				</div>
			</div>
			<div id="fasc-footer">	
				<a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" id="insert" style="display: block; line-height: 24px;"><?php echo $insert_text; ?></a>
			</div>
			
			
		</form>
	</div>
	
</body>
</html>