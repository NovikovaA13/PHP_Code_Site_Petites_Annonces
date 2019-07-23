<form action="" method="POST" enctype="multipart/form-data">
		Category:<br>
	<?php
		if(!empty($select))
		echo $select;
	?>
	</select><br>
	Text:     	<br><textarea  name='text' rows="5" cols="63"><?=$text?></textarea><br>

Your Phone:     <input type='text' name='phone' value="<?=$phone?>"><br><br>

	<input type="file" name="fileToUpload"><br><br>

	<input type="submit" name="submit"><br><br>
</form>

