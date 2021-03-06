<script type="text/javascript">
	function opQuestion(stt, msg='', target='') {
		if (stt === 'open') {
			$('#question-popup').show();
			$('#question-popup #message').html(msg);
			$('#question-popup #btn-yes').attr('onclick', target);
		} else {
			$('#question-popup').hide();
		}
	}
</script>
<div class="content-popup" id="question-popup">
	<div class="place-popup question-popup">
		<div class="pos top">
			Message
		</div>
		<div class="pos mid">
			<div id="message">
				Message will be in here
			</div>
		</div>
		<div class="pos bot">
			<input type="button" name="yes" class="btn btn-grey-color" value="No" id="btn-no" onclick="opQuestion('hide')">
			<input type="button" name="yes" class="btn btn-main-color" value="Yes" id="btn-yes">
		</div>
	</div>
</div>