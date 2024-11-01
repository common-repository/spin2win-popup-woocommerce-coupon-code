<audio id="myAudio">

	<source src="<?php echo SPIN2WINP_PLUGIN_URL; ?>audio/wheel_tick.mp3" type="audio/mpeg">
		Your browser does not support the audio element.
</audio>
<?php $spin2winp_option = get_option( SPIN2WINP_TEXT_DOMAIN );?>
<div align="center" id="sparkle_spin2win">
	<div id="firstModel" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">>
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<!-- Modal -->
				<div class="modal-body">
					<button class="spinBtn" onClick="startSpin();"><?php echo esc_attr($spin2winp_option['spin2win_view_btn_text']); ?></button>
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
	</div>
	<!-- Second Modal for email-->
	<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<p id="resultText">Some text in the modal.</p>
					<div class="content">
						<?php if( $spin2winp_option['spin2win_mailchimp']['enable'] == 1) { ?>
							<div class="row">
								<div class="col-sm-12">
									<div id="mc_embed_signup">
										<form onsubmit="submitEmailForm()" action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate inputField">
											<?php wp_nonce_field( 'tokenvalue' ); ?>
											<div class="form-group inputField">
											    <label for="email">Email address:</label>
											    <input type="email" class="form-control" id="emailSub">
										  	</div>
										  	<button type="button" class="btn btn-default inputField submitBtn" onClick="submitEmailForm()">Subscribe</button>
										</form>
									</div>
									
									<button id="closeAllModel" onClick="closeAllModel();" type="button" class="btn btn-default hidden" data-dismiss="modal">Close</button>
									
								</div>
							</div>
						<?php }else{ ?>
							<button id="closeAllModel" onClick="closeAllModel();" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						<?php } ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

 <style type="text/css">
/*spin2win*/
#sparkle_spin2win button.spinBtn {
    width: 80%;
    top: 3px;
    max-width: 400px;
    padding: 13px;
    font-weight: 700;
    font-size: 32px;
    color: <?php echo $spin2winp_option['spin2win_view_btn_color']; ?>;
    background-color: <?php echo $spin2winp_option['spin2win_view_btn_bg_color']; ?>;
    border-radius: 6px;
    border: none;
    box-shadow: 0 2px 0 <?php echo $spin2winp_option['spin2win_view_btn_bg_color']; ?>;
    cursor: pointer;
    font-family: "Fjalla One",Helvetica,Arial,sans-serif;
}

#sparkle_spin2win .the_wheel {
    background: url(<?php echo $spin2winp_option['spin2win_background_img'];?> ) 50% 50% no-repeat;
}

#sparkle_spin2win #canvas {
}
#sparkle_spin2win table td {
	border:none;
}
#sparkle_spin2win .modal-body {
    position: relative;
    padding: 15px;
    width: 600px;
}
#sparkle_spin2win table{
	width: 0;
}

#resultText {
    padding: 21px 0;
}
<?php echo $spin2winp_option['spin2win_custom_css']; ?>
 </style>