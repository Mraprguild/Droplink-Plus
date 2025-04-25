<?php

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
ul.wpsafmenu{background:#000000;padding:10px 10px;color: white;margin-bottom: 20px;margin-top: 10px;
        border-radius: 9px; /
}
ul.wpsafmenu li{list-style:none;display:inline-block;margin:0 5px 0 0;}
ul.wpsafmenu li span{font-size:14px;padding:10px 15px;text-decoration:none;display:block;outline:0;cursor:pointer;
  -webkit-border-radius:9px;-moz-border-radius:9px;border-radius:9px 9px 0 0;margin-bottom:-1px}
ul.wpsafmenu li span.actived{background:#2C18B4;font-weight:bold;  border: 1px solid #ffffff;border-radius: 9px;}
	.button1{
		background:#2C18B4;font-weight:bold;border-radius: 9px;
	}
ul.wpsafmenu li a:active{outline:none;}  
ul.wpsafmenu li #human{position:relative;padding-top:5px;}
ul.wpsafmenu li strong{position:absolute;left:0px;bottom:-2px;font-size:10px;color:red;}
a:active {
    outline: none;
}
@keyframes rotateColor {
    0% {
        box-shadow: 0 3px 8px 0 rgb(150, 0, 0); 
    }
    25% {
        box-shadow: 0 3px 8px 0 rgb(0, 150, 0); 
    }
    50% {
        box-shadow: 0 3px 8px 0 rgb(0, 0, 150); 
    }
    75% {
        box-shadow: 0 3px 8px 0 rgb(150, 150, 0); 
    }
    100% {
        box-shadow: 0 3px 8px 0 rgb(150, 0, 0); 
    }
}

ul.wpsafmenu {
    background: #000000;
    padding: 10px 10px;
    color: white;
    margin-bottom: 20px;
    margin-top: 10px;
    border-radius: 9px;
    animation: rotateColor 5s infinite; 
}


input[type="color"], input[type="date"], input[type="datetime-local"], input[type="datetime"], input[type="email"], input[type="month"], input[type="number"], input[type="password"], input[type="search"], input[type="tel"], input[type="text"], input[type="time"], input[type="url"], input[type="week"], select, textarea {
min-height: 36px !important;
border: 1px solid #fae4be!important;
border-radius: 9px!important;
background-color: #fff;
box-shadow: inset 0 1px 3px 0 rgba(115,144,198,.34)!important;
padding-left: 20px!important;
padding-right: 25px !important;
}

.wp-core-ui select{
  line-height: 2.4!important;
}
.wp-core-ui .button-primary-disabled,  .wp-core-ui .button-primary[disabled],.wp-core-ui .button-primary-disabled:hover,  .wp-core-ui .button-primary[disabled]:hover{
   background: #17b042!important;
  color:#fff !important;
}
.wp-core-ui .button-primary,.wp-core-ui .button, .button-secondary {
    color:#fff!important;
    text-decoration: none;
    text-shadow: none;
    background: #2C18B4!important;
    min-width: 150px !important;
    box-shadow: 0 3px 9px 0 rgba(71,134,255,.5)!important;
    border: none!important;
    font-size: 14px!important;
    font-weight: 600!important;
    border-radius: 9px!important;
	vertical-align: none;
    line-height:  2.3 !important;
	margin-top: 3px;
  margin-bottom: 10px;
  margin-right: 15px;
  margin-left: 15px;
}
.wp-core-ui .button-primary.active, .wp-core-ui .button-primary.active:focus, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary:active,
.wp-core-ui .button-secondary.active, .wp-core-ui .button-secondary.active:focus, .button-secondary:hover, .button-secondary:active
{
 background: #fa3939!important;color:#fff!important;border: none!important;
}

	.rtg{
	font-weight:bold;
	border:2px;
	background:#2C18B4;
	border-radius: 9px;
	line-height:  2.3 !important;
    margin-top: 10px;
    margin-bottom: 10px;
    padding: 0 10px;
    text-align: center;
	color: white;
    box-shadow:  0 3px 8px 0 rgba(0, 0, 0, 0);

	}
#footer-left,#footer-upgrade,.admin-notification {
    display: none;
}

#safe_lists {
  width: 100%;
  border-collapse: collapse;
  table-layout: auto;
  font-family: Arial, sans-serif;
  margin: 20px 0;
  color: #333;
}

#safe_lists th, #safe_lists td {
  padding: 12px 15px;
  text-align: left;
  border: 1px solid #ddd;
}

#safe_lists th {
    background-color: #000000;
    color: white;
    font-weight: bold;
}

#safe_lists td {
  background-color: #f4f9f4;
}

#safe_lists tr:nth-child(even) {
  background-color: #e0f4e0;
}

#safe_lists tr:hover {
  background-color: #B22222;
}

@media (max-width: 768px) {
  #safe_lists thead {
    display: none;
  }

  #safe_lists tr {
    display: block;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
  }

  #safe_lists td {
    display: block;
    text-align: right;
    padding-left: 50%;
    position: relative;
    border: none;
    padding: 5px;
  }

  #safe_lists td::before {
    content: attr(data-label);
    position: absolute;
    left: 10px;
    font-weight: bold;
    color: #2C18B4;
    text-transform: uppercase;
    font-size: 14px;
  }

  #safe_lists td:nth-child(1)::before {
    content: "Date Added";
  }

  #safe_lists td:nth-child(2)::before {
    content: "Long Link";
  }

  #safe_lists td:nth-child(3)::before {
    content: "Short Link";
  }

  #safe_lists td:nth-child(4)::before {
    content: "Target URL";
  }

  #safe_lists td:nth-child(5)::before {
    content: "View";
  }

  #safe_lists td:nth-child(6)::before {
    content: "Click";
  }

  #safe_lists td:nth-child(7)::before {
    content: "Action";
  }

  #safe_lists td a {
    word-wrap: break-word;
    color: #2C18B4;
    text-decoration: none;
  }

  #safe_lists td a:hover {
    color: ##2C18B4!important;
  }
}

#safe_lists a {
  text-decoration: none;
  color: #2C18B4;
}

#safe_lists a:hover {
  color: #2C18B4!important;
}

#safe_lists td a {
    color: #000000;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}
    </style>

<div class="wrap">
<h1 style="font-weight: bold;text-align: center;">Droplink Modify - Made With <i class="fa fa-heart" style="font-size:20px;color:#2C18B4;"></i> By Mraprguild</h1>
	<ul class="wpsafmenu">
	    <center>
		<li><span id="generate" <?php if ($_GET['tb'] == '') echo 'class="actived"'; ?>>Generate Link</span></li>
		<li><span id="setting" <?php if ($_GET['tb'] == 'setting') echo 'class="actived"'; ?>>Settings</span></li>
		<li><span id="human" <?php if ($_GET['tb'] == 'human') echo 'class="actived"'; ?>>Theme Header and Footer Code</span></li>
		<li><span id="campaign" <?php if ($_GET['tb'] == 'campaign') echo 'class="actived"'; ?>>Advertisements</span></li>
		<li><span onclick="window.open('https://t.me/aprfilestorebot', '_blank')">Support</span></li>
		</center>
	</ul>
	</div>
	<div id="generate" <?php if ($_GET['tb'] != '') echo 'style="display:none"'; ?> class="tabcon">
		<div class="wp-pattern-example">
			<h3>Generate Link</h3>
			<form action="?page=droplink" method="post">
				<table class="form-table">
					<tbody>
						<tr>
							<td><input value="" type="text" size="70" name="linkd" placeholder="https://www.google.com" />
								<input name="generate" type="submit" class="button button-primary button-large" value="Generate" />
							</td>
						</tr>
						<?php if ($generated3 != '') { ?>
							<tr>
								<td>
									<p><br />Target Link : <code>
											<a href="<?php _e($linkd); ?>" target="_blank"><?php _e($linkd); ?></a></code></p>
									<p>Your Safelink : <code>
											<a href="<?php _e($generated3); ?>" target="_blank"><?php _e($generated3); ?></a></code>
										<b>OR</b> <code><a href="<?php _e($generated2); ?>" target="_blank"><?php _e($generated2); ?></a></code></p>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</form>
			<div style="width:auto;padding:15px;margin:10px 0;background:#fff;">
				<table id="safe_lists" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="15%">Date Added</th>
							<th width="35%">Safelink (long)</th>
							<th width="20%">Safelink (sort)</th>
							<th width="20%">Target URL</th>
							<th width="5%">View</th>
							<th width="5%">Click</th>
							<th width="1%"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($safe_lists as $d) {
							if ($wpsaf->permalink == 1) {
								$safelink_link = home_url() . '/' . $wpsaf->permalink1 . '/' . $d['safe_id'];
								$safelink_links = home_url() . '/' . $wpsaf->permalink1 . '/' . base64_encode($d['link']);
							} else if ($wpsaf->permalink == 2) {
								$safelink_link = home_url() . '/?' . $wpsaf->permalink2 . '=' . $d['safe_id'];
								$safelink_links = home_url() . '/?' . $wpsaf->permalink2 . '=' . base64_encode($d['link']);
							} else {
								$safelink_link = home_url() . '/?' . $d['safe_id'];
								$safelink_links = home_url() . '/?' . base64_encode($d['link']);
							}
							echo '<tr>
					<td>' . date('Y-m-d H:i', strtotime($d['date'])) . '</td>
					<td>' . ($d['safe_id'] != "" ? "<a class='elips' href='" . $safelink_links . "' target='_blank'>" . $safelink_links . "</a>" : "") . '</td> 
					<td>' . ($d['safe_id'] != "" ? "<a class='elips' href='" . $safelink_link . "' target='_blank'>" . $safelink_link . "</a>" : "") . '</td> 
					<td>' . ($d['link'] != "" ? "<a class='elips' href='" . $d['link'] . "' target='_blank'>" . $d['link'] . "</a>" : "") . '</td> 
					<td style="text-align:center">' . $d['view'] . '</td>
					<td style="text-align:center">' . $d['click'] . '</td>
					<td style="text-align:center"><a href="?page=droplink&delete=' . $d['ID'] . '">delete</a></td>
					</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="?page=droplink" method="post">

		<div id="human" <?php if ($_GET['tb'] != 'human') echo 'style="display:none"'; ?> class="tabcon">
			<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
			<input name="reset" type="submit" class="button button-large" value="Reset" />
			<h3>To Use Safelink Paste This Codes</h3>
			
			<p><strong>1.</strong> Paste this code above on your website : <code>&lt;?php if(function_exists('newwpsafelink_top')) newwpsafelink_top();?&gt;</code></p>
			<p><strong>2.</strong> Paste this code bellow on your website : <code>&lt;?php if(function_exists('newwpsafelink_bottom')) newwpsafelink_bottom();?&gt;</code></p>

		</div>
		<div class="wp-pattern-example">
			<div id="setting" <?php if ($_GET['tb'] != 'setting') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" />
				<h3>Permalink</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><strong>Permalink</strong></td>
							<td>
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 1) echo "checked"; ?> value="1" id="permalink1">
								1.<label for="permalink1"><code><?php _e(home_url()); ?>/</code><input style="text-align:center" value="<?php echo $wpsaf->permalink1; ?>" type="text" size="12" name="wpsaf[permalink1]" />
									<code>/safelink_code</code></label><br />
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 2) echo "checked"; ?> value="2" id="permalink2">
								2.<label for="permalink2"><code><?php _e(home_url()); ?>/?</code><input style="text-align:center" value="<?php echo $wpsaf->permalink2; ?>" type="text" size="12" name="wpsaf[permalink2]" />
									<code>=safelink_code</code></label><br />
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 3) echo "checked"; ?> value="3" id="permalink3">
								3.<label for="permalink3"><code><?php _e(home_url()); ?>/?safelink_code</code></label>
							</td>
						</tr>
					</tbody>
				</table>
				<h3>Content </h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="top" width="200px"><strong>Content</strong></td>
							<td><select name="wpsaf[content]" id="cont">
									<?php
									$conts = array('Random All Posts', 'Random Spesific Post by Id');
									foreach ($conts as $n => $c) {
										$s = $n == $wpsaf->content ? 'selected' : '';
										echo '<option value="' . $n . '" ' . $s . '>' . $c . '</option>';
									}
									?>
								</select><br />
								<div id="contentidt" <?php if ($wpsaf->content != 1) echo 'style="display:none"'; ?>>Post ID (Separated by commas): <code>Eg: 1,20,34,45</code> <br />
									<input name="wpsaf[contentid]" size="30" type="text" value="<?php echo $wpsaf->contentid; ?>"></div>
							</td>
						</tr>
					</tbody>
				</table>
				
				<h3>Template </h3>
				<table class="form-table">
					<tbody>
<tr>
							<td width="200px"><strong>Template</strong></td>
							<td><select name="wpsaf[template]">
									<?php $temps = glob(WPSAF_DIR . 'template/*.php');
									foreach ($temps as $t) {
										$t = explode('/', $t);
										$t = $t[count($t) - 1];
										$t = str_replace('.php', '', $t);
										$s = $wpsaf->template == $t ? 'selected' : '';
										echo '<option value="' . $t . '" ' . $s . '>' . $t . '</option>';
									}
									?></select>
							</td>
						</tr>


						<tr>
							<td><strong>Time Delay</strong></td>
							<td><input value="<?php echo $wpsaf->delay; ?>" type="number" min="0" max="99" name="wpsaf[delay]" /> Secs</td>
						</tr>
<style>
    #preview-logo {
        background-color: #2C18B4; 
        border-radius: 4px;
        padding: 5px;
    }
</style>
    <tr>
        <td></td>
        <td>
            <img src="<?php _e($wpsaf->logo); ?>" 
                 style="max-width:300px; max-height:100px;" 
                 id="preview-logo">
        </td>
    </tr>
							<tr>
							<td><b>Logo Image</b></td>
							<td>
								<input type="text" value="<?php echo $wpsaf->logo; ?>" name="wpsaf[logo]" id="logo" class="regular-text">
								<input type="button" name="upload-btn" id="upload-logo" class="logo button-secondary" value="Upload Image">
							</td>
						</tr>
					</tbody>
				</table>
				<h3>Adlinkfly Integration</h3>
				<p>You can enable this feature when you want to integrate adlinkfly. You can also use this to integration of 2 Blog to adlinkfly</p>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="" width="200px"><b>Enable Adlinkfly Integration</b></td>
							<td>
								<input <?php if ($wpsaf->adlinkfly_enable == 1) echo 'checked'; ?> type="radio" name="wpsaf[adlinkfly_enable]" value="1" id="adlinkfly_enable1"><label for="adlinkfly_enable1">Yes</label>
								<input <?php if (empty($wpsaf->adlinkfly_enable) || $wpsaf->adlinkfly_enable == 2) echo 'checked'; ?> type="radio" name="wpsaf[adlinkfly_enable]" value="2" id="adlinkfly_enable0"><label for="activerecaptcha0">No</label>
							</td>
						</tr>
						<tr>
							<td><b>Your Adlinkfly Domain</b></td>
							<td><input value="<?php echo $wpsaf->adlinkfly_domain; ?>" type="text" placeholder="https://earnfly.net/" size="40" name="wpsaf[adlinkfly_domain]" />
						</tr>
					</tbody>
				</table>
				<table>
				<tbody>
			<h3>To Use Adlinkfly Integration Paste This Codes</h3>
			
<p>Firstly, select Permalink 2 and paste the following code in your AdLinkFly website path: <b><code><strong><mark style="background-color:#fff;">/public_html/plugins/YourTheme/src/Template/Links/view_banner.ctp</mark></strong></code></b></p>
			</br>
            </br>
<pre><code>&lt;?php 
if (!empty($_POST['ref'])) { 
} else {
    $ref = $_SERVER['HTTP_REFERER'] ?? ''; 
    $do = parse_url($ref);
    $refer = $do['host'] ?? ''; 
    if ($refer === "<?php
$home_url = home_url();
$parsed_url = parse_url($home_url);
echo $parsed_url['host'] . $parsed_url['path'];
?>") {
    } else {
        header("Location: <?php echo home_url(); ?>/?<?php echo $wpsaf->permalink2; ?>=$link->alias", true, 307);
        exit(); 
    }
}
?&gt;</code></pre>

					</tbody>
				</table>

				
			</div>
			<div id="campaign" <?php if ($_GET['tb'] != 'campaign') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" />
				<h3>Advertisement</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td><b>Advertisement Top 1</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads1]"><?php _e($wpsaf->ads1); ?></textarea></td>
						</tr>
						<tr>
							<td><b>Advertisement Top 2</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads2]"><?php _e($wpsaf->ads2); ?></textarea></td>
						</tr>
						<tr>
							<td><b>Advertisement Bottom 1</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads3]"><?php _e($wpsaf->ads3); ?></textarea></td>
						</tr>
						<tr>
							<td><b>Advertisement Bottom 2</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads4]"><?php _e($wpsaf->ads4); ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>
		
		</div>
	</form>
</div>
<?php
wp_enqueue_media();
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#safe_lists').DataTable();
	});
</script>
<script>
	jQuery(document).ready(function($) {
		$(".wpsafmenu span").click(function() {
			var idm = $(this).attr('id');
			var idm = idm.replace("#", "");
			$(".wpsafmenu span").removeClass('actived');
			$(".wpsafmenu span#" + idm).addClass('actived');
			$("div.tabcon").hide();
			$("div#" + idm).show();
			return false;
		});
		$('#cont').on('change', function() {
			var va = this.value;
			if (va == 1) {
				$("#contentidt").show();
			} else {
				$("#contentidt").hide();
			}
		})
		$('#upload-btn1').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn2').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn3').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn4').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-logo').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).
