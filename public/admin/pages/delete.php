<?php

require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/admin/pages/index.php'));
}
$id = $_GET['id'];



if (is_post_request()) {
    $result = Page::delete($id);
    redirect_to(url_for("admin/pages/index.php"));
} else {
    $page = Page::find_by_id($id);
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="page delete">
        <h1>Delete Page</h1>
        <p>Are you sure you want to delete this page?</p>
        <p class="item"><?php echo htmlspecialchars($page->menu_name); ?></p>

        <form action="<?php echo url_for('/admin/pages/delete.php?id=' . htmlspecialchars(urlencode($page->id))); ?>"
            method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Page" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>