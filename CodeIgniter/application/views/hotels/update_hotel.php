<script>
		var currentRow = 0;

		function add_room() {	
			var col1 = '<input type=\"text\" name=\"room_code[]\" />';
			var col2 = '<input type=\"text\" name=\"room_type[]\" />';
			var col3 = '<input type=\"text\" name=\"room_comfort[]\" />';
			var col4 = '<input type=\"text\" name=\"room_price[]\" />';
			var col5 = '<a onclick=\"delete_room(' + ('\'' + currentRow + '\'') + ')\"><i class="icon-trash"></i></a>';

			$('#rooms_div > tbody:last').append('<tr id=\"room' + currentRow +'\">' + 
					'<td>' + col1 + '</td>' +
					'<td>' + col2 + '</td>' +
					'<td>' + col3 + '</td>' + 
					'<td>' + col4 + '</td>' +
					'<td>' + col5 + '</td>' + '</tr>');
			currentRow++;
		}

		function delete_room(row_id) {
			$('#room'+row_id).remove();
		}

		$(document).ready(function(){
			currentRow = <?php echo count($rooms_code); ?>;
			for (var i = currentRow; i < 5; i++) {
				add_room();
			}
		});
</script>

<div class="container content">
	<h1>Update A Hotel</h1>
	<?php echo form_open('/hotels/update/'.$hotel_code['value'], array('class'=>'form-horizontal')); ?>
	<div class="control-group">
		<label class="control-label" for="hotel_code">Hotel Code</label>
		<div class="controls">
			<?php echo form_input($hotel_code); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<?php echo form_input($name); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="location">Location</label>
		<div class="controls">
			<?php echo form_input($location); ?>
		</div>
	</div>

	<div>
		<table id="features_div" class="table table-condensed">
			<thead>
				<tr>
					<th>Choose</th>
					<th>Feature Code</th>
					<th>Feature Name</th>
					<th>Feature Description</th>
				</tr>
			</thead>

			<tbody>
				<?php
				for ($i = 0; $i < count($features); $i++) {
					$row = $features[$i];
					echo "<tr>";

					echo "<td>";
					// $format = "<input type=\"checkbox\" name=\"features[]\" value=\"%d\"><br>";
					// echo sprintf($format, $i);
					echo form_checkbox('features[]', $row->id, $checkbox[$i]);
					echo "</td>";

					echo "<td>".$row->id."</td>";
					echo "<td>".$row->name."</td>";
					echo "<td>".$row->description."</td>";

					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<div>
		<table id="rooms_div" class="table table-condensed">
			<thead>
				<tr>
					<th>Room Code</th>
					<th>Room Type</th>
					<th>Comfort Level</th>
					<th>Price</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				<?php
				for ($i = 0; $i < count($rooms_code); $i++) {
					$room_code = $rooms_code[$i];
					$room_type = $rooms_type[$i];
					$room_comfort = $rooms_comfort[$i];
					$room_price = $rooms_price[$i];
					echo '<tr id="room'.$i.'">';

					echo "<td>";
					echo form_input('room_code[]', $room_code);
					echo "</td>";

					echo "<td>";
					echo form_input('room_type[]', $room_type);
					echo "</td>";

					echo "<td>";
					echo form_input('room_comfort[]', $room_comfort);
					echo "</td>";

					echo "<td>";
					echo form_input('room_price[]', $room_price);
					echo "</td>";

					echo "<td>";
					echo '<a onclick=delete_room(' .('\''.$i.'\'').')><i class="icon-trash"></i></a>';
					echo "</td>";

					echo '</tr>';
				}
				?>
			</tbody>
		</table>
	</div>

	<div class="control-group">
		<div class="controls">
			<?php $js = 'onClick="add_room()"'; ?>
			<?php echo form_button('add_room_btn', 'Add a room', $js); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<?php echo form_submit($hotel_submit); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>