


</script>
<?php for($i = 0; $i < $count; $i++): ?>
	<br><label>Введите вариант ответа</label><br>
	<p>
		<input type="text" class="reg-auth-field" placeholder="Введите вариант ответа..." name="Questions_Model[answers][<?=$i ?>]" required>
		<?php if($input_type == 'radio'):?>
			<label><input type="radio" class="radiobutton" name="Questions_Model[is_correct]" value="<?=$i?>">Ответ корректный</label>
		<?php elseif($input_type == 'checkbox'):?>
			<label><input type="checkbox" name="Questions_Model[is_correct][<?= $i?>]" value="1">Ответ корректный</label>
		<?php endif;?>
	</p>
<?php endfor;?>