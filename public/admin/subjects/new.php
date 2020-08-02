<?php
require_once('../../../private/initialize.php');


$subject_count = Subject::rows_count() + 1;


$subject = [];
$subject['position'] = $subject_count;

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/admin/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Subject</h1>

        <form action="<?php echo url_for("/admin/subjects/create.php") ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for ($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($subject["position"] === $i) {
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
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>