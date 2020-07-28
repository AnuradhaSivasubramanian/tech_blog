<?php
require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/admin/pages/index.php'));
}

$id = $_GET['id'];


if (is_post_request()) {
    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';
    $result = update_page($page);
    redirect_to(url_for('/admin/pages/show.php?id=' . $id));
} else {
    //Get the page info
    $page = find_a_page($id);
    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);



    //get the list of subject id with names for the select tag
    $subject_nameset = find_all_subject_names();
}
// Handles values obtained in new.php

?>

<?php $page_title = 'Edit page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="a_link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="Page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/admin/pages/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo $page['menu_name'] ?>"
                        class="form-input-name" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position" class="form-select">
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($page['position'] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject" class="form-select-name ">
                        <?php
                        while ($subject = mysqli_fetch_assoc($subject_nameset)) {
                            echo "<option  value=\"{$subject['id']}\"";
                            if ($page['subject_id'] == $subject['id']) {
                                echo " selected";
                            }
                            echo ">{$subject['menu_name']}</option>";
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
                        <?php echo is_checkbox_checked($page['visible']) ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><textarea type="text" name="content" value=""
                        class="form-select-content"><?php echo $page['content'] ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>