<?php
require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/admin/subjects/index.php'));
}

$id = $_GET['id'];
$subject = Subject::find_by_id($id);
if ($subject == false) {
    redirect_to(url_for('/admin/subjects/index.php'));
}

if (is_post_request()) {

    $args = [];
    $args['id'] = $id;
    $args['menu_name'] = $_POST['menu_name'] ?? '';
    $args['position'] = $_POST['position'] ?? '';
    $args['visible'] = $_POST['visible'] ?? '';

    $subject->merge_attributes($args);
    $result = $subject->update_a_subject();
    if ($result === true) {
        redirect_to(url_for('/admin/subjects/show.php?id=' . $subject->id));
    };
} else {

    $subject_count = Subject::subject_count();
}

?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="a_link" href="<?php echo url_for('/admin/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

        <form action="<?php echo url_for('/admin/subjects/edit.php?id=' . htmlspecialchars(urlencode($id))); ?>"
            method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo $subject->menu_name ?>"
                        class="form-input-name" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for ($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($subject->position === $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"
                        <?php echo is_checkbox_checked($subject->visible) ?> />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>