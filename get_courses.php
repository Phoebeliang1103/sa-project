<?php
$link = mysqli_connect('localhost','root');
    mysqli_select_db($link,"sa");
    mysqli_set_charset($link,'utf8mb4');

$date = $_GET['date'];
$dayOfWeek = date('w', strtotime($date));

$sql = "SELECT * FROM information WHERE week = '$dayOfWeek'";
$result = mysqli_query($link, $sql);

$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<tr>';
    $output .= '<td><input type="checkbox" class="check-all" value="check-all"></td>'; 
    $output .= '<td>' . $row['class_name'] . '</td>';
    $output .= '<td>' . $row['class_teacher'] . '</td>';

    $class_id = $row['class_id'];
    $sql_info = "SELECT D FROM perid WHERE class_id='$class_id'";
    $result_info = mysqli_query($link, $sql_info);
    $D_count = mysqli_num_rows($result_info); 
    $output .= '<td>';
    mysqli_data_seek($result_info, 0);

    for ($i = 1; $i <= $D_count; $i++) {
        $row_info = mysqli_fetch_assoc($result_info);
        $D = $row_info['D'];
        $output .= '<input type="checkbox" id="time_' . $i . '" name="time_' . $i . '" value="' . $D . '">&nbsp;' . $D . '&nbsp;';
    }
    $output .= '</td>';

    $output .= '</tr>';
}

echo $output;

mysqli_close($link);
?>
<script>
    const timeCheckboxes = document.querySelectorAll('.time-checkbox');

    const checkAllCheckbox = document.querySelector('.check-all');

    checkAllCheckbox.addEventListener('change', function() {
        timeCheckboxes.forEach(function(checkbox) {
            checkbox.checked = checkAllCheckbox.checked;
        });
    });
</script>