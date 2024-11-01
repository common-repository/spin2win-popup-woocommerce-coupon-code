<?php 
/**
 * Text Domain: spin2win
 * Restricting user to access this file directly (Security Purpose).
**/
  if( ! defined( 'ABSPATH' ) ) {
    die( "Sorry You Don't Have Permission To Access This Page"  );
    exit;
  }
  
/********* Plugin Setting Template ********/

if( isset($_GET['settings-updated']) ) { ?>
<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
  <p><strong>Settings saved.</strong></p>
  <button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button>
</div><?php } ?>
<div class="clear clearfix"></div>
<h2 class="screen-reader-text">Filter posts list</h2>
<?php $spin2winp_option = get_option( SPIN2WINP_TEXT_DOMAIN );
// echo "<pre>"; 
// print_r($spin2winp_option); exit;
?>
<div id="spin2win-admin">
    <div id="tabs">
      <ul>
        <li><a href="#views" class="button"><?php echo esc_html__("View", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#settings" class="button"><?php echo esc_html__("Settings", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#prizes" class="button"><?php echo esc_html__("Prizes", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#animation" class="button"><?php echo esc_html__("Animation", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#mailchimp"class="button"><?php echo esc_html__("MailChimp", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#spin2wincss"class="button"><?php echo esc_html__("CSS", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
        <li><a href="#spin2winDisplay"class="button"><?php echo esc_html__("Display", SPIN2WINP_TEXT_DOMAIN); ?></a></li>
      </ul>
      <form method="post" action="options.php" id="spin2WinSettingsForm">
        <?php settings_fields( SPIN2WINP_TEXT_DOMAIN ); ?>
        <div id="views">
          <h2><?php esc_html_e("Front End View text and HTML", SPIN2WINP_TEXT_DOMAIN); ?></h2>
            <table class="form-table">
              <tr>
                  <th><?php esc_html_e("Spin Button Text", SPIN2WINP_TEXT_DOMAIN); ?></th>
                  <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_view_btn_text]" value="<?php echo $spin2winp_option['spin2win_view_btn_text']; ?>"/></td>
              </tr>
              <tr>
                <th>
                  <?php esc_html_e("Spin Button Color", SPIN2WINP_TEXT_DOMAIN); ?>
                </th>
                <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[spin2win_view_btn_color]" value="<?php echo $spin2winp_option['spin2win_view_btn_color'];?>"/></td>
              </tr>
              <tr>
                <th>
                  <?php esc_html_e("Spin Button Backgorund Color", SPIN2WINP_TEXT_DOMAIN); ?>
                </th>
                <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[spin2win_view_btn_bg_color]" value="<?php echo $spin2winp_option['spin2win_view_btn_bg_color'];?>"/></td>
              </tr>
              
              <tr>
                  <th>
                      <?php esc_html_e("Result View", 'spin2win'); ?>
                      <p>To display dynamic result on result view. place "{{prize}}" inside the text. eg. You own {{prize}}.</p>
                  </th>
                  <td><textarea rows="10" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_result_view]"><?php echo $spin2winp_option['spin2win_result_view']; ?></textarea></td>
              </tr>
              
              <tr>
                  <th>
                      <?php esc_html_e("Result After Submit", 'spin2win'); ?>
                  </th>
                  <td><textarea rows="8" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_result_after_submit]"><?php echo $spin2winp_option['spin2win_result_after_submit']; ?></textarea></td>
              </tr>
              
              <tr>
                <th>
                  <?php esc_html_e("Spiner Backgorund Image", SPIN2WINP_TEXT_DOMAIN); ?>
                </th>
                <td>
                  <input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_background_img]" value="<?php echo $spin2winp_option['spin2win_background_img'];?>" class="upload-image" />
                  <img id="spin2winBackImg" src="<?php echo $spin2winp_option['spin2win_background_img'];?>" style="width:100%" class="<?php if( $spin2winp_option['spin2win_background_img'] == '') echo 'hidden'; ?>"/>
                </td>
              </tr>
          </table>
          <?php submit_button(); ?>
      </div>
      
      
        <div id="settings">
        <h3><?php esc_html_e("Settings for Spin2Win popup", SPIN2WINP_TEXT_DOMAIN); ?></h3>
        <table class="form-table" id="">
          <tr valign="top">
              <th scope="row"><?php esc_html_e("Enable", SPIN2WINP_TEXT_DOMAIN); ?></th>
              <td><input type="checkbox" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[enable]" value="1" <?php checked( $spin2winp_option['enable'], 1 ); ?>/></td>
          </tr>
          
          <tr>
              <th colspan=2 style="margin:0;padding:0">
                  <h3 style="margin:0; padding:0"><?php esc_html_e("Spinner Settings", SPIN2WINP_TEXT_DOMAIN); ?></h3>
              </th>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Inner Radius", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="number" min="0" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][innerRadius]" value="<?php echo $spin2winp_option['settings']['innerRadius']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Outer Radius", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="number" min="0" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][outerRadius]" value="<?php echo $spin2winp_option['settings']['outerRadius']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Line Width", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="number" min="0" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][lineWidth]" value="<?php echo $spin2winp_option['settings']['lineWidth']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Stroke Style", SPIN2WINP_TEXT_DOMAIN); ?>
                  <p><?php esc_html_e("Segment line colour. Again segment lines only drawn if this is specified.", SPIN2WINP_TEXT_DOMAIN); ?></p>
              </th>
              <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][strokeStyle]" value="<?php echo $spin2winp_option['settings']['strokeStyle']; ?>"/></td>
          </tr>
          
          <tr>
              <th>
                  <?php esc_html_e("Text FontFamily", SPIN2WINP_TEXT_DOMAIN); ?>
                  <p><?php esc_html_e("Segment text font, you should use web safe fonts.", SPIN2WINP_TEXT_DOMAIN); ?></p>
              </th>
              <td>
                  <select name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textFontFamily]" id="textFontFamily">
                      <option value="Arial" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Arial" ); ?>>Arial</option>
                      <option value="Georgia" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Georgia" ); ?>>Georgia</option>
                      <option value="Verdana" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Verdana" ); ?>>Verdana</option>
                      <option value="Times" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Times" ); ?>>Times</option>
                      <option value="Impact" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Impact" ); ?>>Impact</option>
                      <option value="Courier" <?php selected( $spin2winp_option['settings']['textFontFamily'], "Courier" ); ?>>Courier</option>
                  </select>
              </td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text FontWeight", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td>
                  <select name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textFontWeight]" id="textFontWeight">
                      <option value="normal" <?php selected( $spin2winp_option['settings']['textFontWeight'], "normal" ); ?>>Normal</option>
                      <option value="bold" <?php selected( $spin2winp_option['settings']['textFontWeight'], "bold" ); ?>>Bold</option>
                      <option value="bolder" <?php selected( $spin2winp_option['settings']['textFontWeight'], "bolder" ); ?>>Bolder</option>
                      <option value="lighter" <?php selected( $spin2winp_option['settings']['textFontWeight'], "lighter" ); ?>>Lighter</option>
                      <option value="1200" <?php selected( $spin2winp_option['settings']['textFontWeight'], "1200" ); ?>>1200</option>
                  </select>
              </td>
          </tr>
          
          <tr>
              <th>
                  <?php esc_html_e("Text Orientation", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td>
                  <select name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textOrientation]" id="textOrientation">
                      <option value="horizontal" <?php selected( $spin2winp_option['settings']['textOrientation'], "horizontal" ); ?>>Horizontal</option>
                      <option value="vertical" <?php selected( $spin2winp_option['settings']['textOrientation'], "vertical" ); ?>>Vertical</option>
                      <option value="curved" <?php selected( $spin2winp_option['settings']['textOrientation'], "curved" ); ?>>Curved</option>
                      
                  </select>
              </td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text Alignment", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td>
                  <select name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textAlignment]" id="textAlignment">
                      <option value="center" <?php selected( $spin2winp_option['settings']['textAlignment'], "center" ); ?>>Center</option>
                      <option value="inner" <?php selected( $spin2winp_option['settings']['textAlignment'], "inner" ); ?>>inner</option>
                      <option value="outer" <?php selected( $spin2winp_option['settings']['textAlignment'], "outer" ); ?>>outer</option>
                      
                  </select>
              </td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text Direction", SPIN2WINP_TEXT_DOMAIN); ?>
                  <p>Either normal or reversed. In normal mode for horizontal text in segment at 3 o'clock is correct way up, in reversed text at 9 o'clock segment is correct way up.</p>
              </th>
              <td>
                  <select name="<?php SPIN2WINP_TEXT_DOMAIN;?>[settings][textDirection]" id="textDirection">
                      <option value="normal" <?php selected( $spin2winp_option['settings']['textDirection'], "normal" ); ?>>Normal</option>
                      <option value="horizontal" <?php selected( $spin2winp_option['settings']['textDirection'], "horizontal" ); ?>>horizontal</option>
                  </select>
              </td>
          </tr>
          
          <tr>
              <th>
                  <?php esc_html_e("Font Size", SPIN2WINP_TEXT_DOMAIN); ?>
                  <p><?php esc_html_e("Size of the segment text.", SPIN2WINP_TEXT_DOMAIN); ?></p>
              </th>
              <td><input type="number" min="12" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textFontSize]" value="<?php echo $spin2winp_option['settings']['textFontSize']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text Margin", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="number" min="0" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textMargin]" value="<?php echo $spin2winp_option['settings']['textMargin']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text FillStyle", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textFillStyle]" value="<?php echo $spin2winp_option['settings']['textFillStyle']; ?>"/></td>
          </tr>
          
          <tr>
              <th>
                  <?php esc_html_e("Text StrokeStyle", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textStrokeStyle]" value="<?php echo $spin2winp_option['settings']['textStrokeStyle']; ?>"/></td>
          </tr>
          <tr>
              <th>
                  <?php esc_html_e("Text LineWidth", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><input type="number" min="0" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][textLineWidth]" value="<?php echo $spin2winp_option['settings']['textLineWidth']; ?>"/></td>
          </tr>
        </table>
        <?php submit_button(); ?>
      </div>
      
        <div id="prizes">
          <h3><?php esc_html_e("Segement Settings for prize", SPIN2WINP_TEXT_DOMAIN); ?></h3>
          <table class="form-table" id="spin2winSettingTbl">
            <tr>
              <th>
                  <?php esc_html_e("No of Segment", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td>
                <input id="spin2winNoSegment" readonly type="number" min="1" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[settings][numSegments]" value="<?php echo $spin2winp_option['settings']['numSegments']; ?>"/>
                <div class="spinner"></div>
                <p style="color:red"> <?php esc_html_e("For Increase Number of Segment Go to Pro Version", SPIN2WINP_TEXT_DOMAIN); ?></p>
              </td>
            </tr>
            <tr>
                <td>
                    <?php esc_html_e("Fill Style", SPIN2WINP_TEXT_DOMAIN); ?> 
                </td>
                <td>
                    <?php esc_html_e("Text", SPIN2WINP_TEXT_DOMAIN); ?>
                    <p style="color:red"> <?php esc_html_e("You can use image as segment Pro Version", SPIN2WINP_TEXT_DOMAIN); ?></p>
                </td>
            </tr>
            <script type="text/template" id="segementTemplate">
                <tr class="segmentRow add">
                  <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[segments][{{numSegment}}][fillStyle]"/></td>
                  <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[segments][{{numSegment}}][text]"/></td>
                </tr>
            </script>
          <?php 
              $segements = $spin2winp_option['segments'];
              ksort( $segements);
              if( is_array($segements)){
                $i = 0; 
                foreach ($segements as $key => $val ) { ?>
                  <tr class="segmentRow">
                      <td><input type="text" class="spin2winColorpicker" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[segments][<?php echo $key; ?>][fillStyle]" value="<?php echo $val['fillStyle']; ?>"/></td>
                      <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN;?>[segments][<?php echo $key; ?>][text]" value="<?php echo $val['text']; ?>"/></td>
                  </tr>        
                <?php  $i++;
                }
                
              }
          ?>
            
          </table>
          <?php submit_button(); ?>
        </div>
      
      
        <!--MailChimp Settings-->
        <div id="mailchimp">
        <h2><?php esc_html_e("MailChimp Settings", SPIN2WINP_TEXT_DOMAIN); ?></h2>
        <p><?php echo __("You can enable mailchimp subscription. <br/> Enter MailChimp api key here", SPIN2WINP_TEXT_DOMAIN); ?></p>
        <table class="form-table">
          <tr>
              <th><?php esc_html_e("Enable", SPIN2WINP_TEXT_DOMAIN); ?></th>
              <td><input type="checkbox" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_mailchimp][enable]" value="1" <?php checked( $spin2winp_option['spin2win_mailchimp']['enable'], 1 ); ?>/></td>
          </tr>
          <tr>
            <th>
              <?php esc_html_e("MailChimp API Key", SPIN2WINP_TEXT_DOMAIN); ?>
              <p>Find Mailchimp <a target="_blank" href="http://kb.mailchimp.com/integrations/api-integrations/about-api-keys" /> API KEY </a></p>
            </th>
            <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_mailchimp][api_key]" value="<?php echo $spin2winp_option['spin2win_mailchimp']['api_key']; ?>"/></td>
          </tr>
          <tr>
            <th>
              <?php esc_html_e("MailChimp List ID", SPIN2WINP_TEXT_DOMAIN); ?>
              <p> Find MailChimp <a href="http://kb.mailchimp.com/lists/manage-contacts/find-your-list-id" target="_blank" >List ID </a></p>
            </th>
            <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_mailchimp][list_id]" value="<?php echo $spin2winp_option['spin2win_mailchimp']['list_id']; ?>"/></td>
          </tr>
          
        </table>
        <?php submit_button(); ?>
      </div>
      
        <div id="animation">
        <h2><?php esc_html_e("Spinnner Animation", SPIN2WINP_TEXT_DOMAIN); ?></h2>
        <table class="form-table">
          <tr>
            <th><?php esc_html_e("Duration", SPIN2WINP_TEXT_DOMAIN); ?>
            <p>'duration' : 5 Duration in seconds.</p>
            </th>
            <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[animation][duration]" value="<?php echo $spin2winp_option['animation']['duration']; ?>"/></td>
          </tr>
          <tr>
            <th><?php esc_html_e("Spins", SPIN2WINP_TEXT_DOMAIN); ?>
            <p>'spins' : 4 Number of complete spins.</p>
            </th>
            <td><input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[animation][spins]" value="<?php echo $spin2winp_option['animation']['spins']; ?>"/></td>
          </tr>
        </table>
        <?php submit_button(); ?>
      </div>
      
        <div id="spin2wincss">
          <h2><?php esc_html_e("Custom CSS", SPIN2WINP_TEXT_DOMAIN); ?></h2>
          <table class="form-table">
            <tr>
              <th><?php esc_html_e("CSS", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td><textarea name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[spin2win_custom_css]"><?php echo $spin2winp_option['spin2win_custom_css']; ?></textarea></td>
            </tr>
          </table>
          <?php submit_button(); ?>  
        </div>
        <div id="spin2winDisplay">
          <h2><?php esc_html_e("Popup Display", SPIN2WINP_TEXT_DOMAIN); ?></h2>
          <table class="form-table">
            <tr>
              <th><?php esc_html_e("Exit Intent", SPIN2WINP_TEXT_DOMAIN); ?>
              </th>
              <td>
                <input type="checkbox" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[display][exit_intent]" value="1" <?php checked( $spin2winp_option['display']['exit_intent'], 1 ); ?> />
              </td>
            </tr>
            <tr>
              <th>
                  <?php esc_html_e("Display In Min", SPIN2WINP_TEXT_DOMAIN); ?>
                  <p><?php echo esc_html__("Display popup after your time. time in min", SPIN2WINP_TEXT_DOMAIN); ?></p>
              </th>
              <td>
                <input type="text" name="<?php echo SPIN2WINP_TEXT_DOMAIN; ?>[display][time]" value="<?php echo $spin2winp_option['display']['time']; ?>" />
              </td>
            </tr>
          </table>
          <?php submit_button(); ?>  
        </div>
    </form>
  </div>
  
  
  <!-- Right Side Images display-->
  <div class="info">
    <div class="first">
      <table cellpadding="0" cellspacing="0" border="0">
				<tr>

					<td width="438" height="582" class="the_wheel" align="center" valign="center">
						<canvas id="canvas" width="434" height="434">
							<p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
						</canvas>
					</td>
				</tr>
			</table>
					
    </div>
  </div>
</div>

<style type="text/css">
.the_wheel {
    /*background: url(http://dougtesting.net/elements/images/examples/wheel_back.png) 50% 50% no-repeat;*/
}
</style>