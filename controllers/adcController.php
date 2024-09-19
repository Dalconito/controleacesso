<?php
$postData = isset($_POST) ? $_POST : null;
if($postData != null){
echo $postData;
}
else echo "tem alguma porra errada";