<?php
require_once('../../../private/initialize.php');
?>
<?php
$page_count = Page::rows_count() + 1;
$page = [];
$page['position'] = $page_count;


//get the list of subject id with names for the select tag
$subjects = Subject::find_all();
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="pages new">
        <h1>Create pages</h1>

        <form action="<?php echo url_for("/admin/pages/create.php") ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd> <select name="subject" class="form-select-name ">
                        <?php
                        foreach ($subjects as $subject) {
                            echo "<option  value=\"{$subject->id}\"";
                            echo ">{$subject->menu_name}</option>";
                        }
                        ?>
                    </select></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($page["position"] === $i) {
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
            <dl>
                <dt>Content</dt>
                <dd><textarea type="text" name="content" value=""></textarea></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create page" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>