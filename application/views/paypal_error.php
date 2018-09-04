		<?php $this->load->view('header')?>
		<?php
		foreach($errors as $error) {
			echo '<p>';
			echo '<strong>Error Code:</strong> ' . $error[0]['L_ERRORCODE'];
			echo '<br /><strong>Error Message:</strong> ' . $error[0]['L_LONGMESSAGE'];
			echo '</p>';
		}
		?>
		<?php $this->load->view('footer')?>