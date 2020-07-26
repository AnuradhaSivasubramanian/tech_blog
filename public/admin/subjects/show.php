<?php
require_once('../../../private/initialize.php')
?>

<?php

$id = $_GET['id'] ?? '1';

echo "Page ID: " . h($id);

?>
<br />
<a href="<?php echo url_for('/admin/subjects/index.php'); ?>">Back to list</a>