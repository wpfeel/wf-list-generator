
<div class="wrap">
    <h1>WF List Generator</h1>
    <nav class="nav-tab-wrapper woo-nav-tab-wrapper">
        <a href="edit.php?post_type=wf-list-generator&page=wflg-settings&tab=general" class="nav-tab nav-tab-active">General</a>
        <a href="edit.php?post_type=wf-list-generator&page=wflg-settings&tab=post" class="nav-tab ">Post</a>
        <a href="edit.php?post_type=wf-list-generator&page=wflg-settings&tab=page" class="nav-tab ">Page</a>
        <a href="edit.php?post_type=wf-list-generator&page=wflg-settings&tab=author" class="nav-tab ">Author</a>
    </nav>

    <form method="post" action="" novalidate="novalidate">
        <table class="fowrm-table" role="presentation">
            <tr>
                <th scope="row"><label for="wflg_layout">Layout</label></th>
                <td>
                    <select name="wflg_layout" id="wflg_layout">
                        <option selected="selected" value="default">Default</option>
                        <option value="classic">Classic</option>
                        <option value="modern">Modern</option>
                    </select>
                    <p class="description"><?php echo sprintf( __('%s', 'wf-list-generator'), 'Select layout design to change the view.'); ?></p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="wflg_gen_entry_perpage">Entry Per Page</label></th>
                <td>
                    <input name="wflg_gen_entry_perpage" type="text" id="wflg_gen_entry_perpage" value="10" class="regular-text">
                    <p class="description"><?php echo sprintf( __('%s', 'wf-list-generator'), 'Number of items will display per page.'); ?></p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="wflg_display_role">Display Role</label></th>
                <td>
                    <select name="wflg_display_role" id="wflg_display_role">
                        <option selected="selected" value="administrator">Administrator</option>
                        <option value="author">Author</option>
                        <option value="contributor">Contributor</option>
                        <option value="editor">Editor</option>
                        <option value="subscriber">Subscriber</option>
                    </select>
                    <p class="description"><?php echo sprintf( __('%s', 'wf-list-generator'), 'Choose capable role to show all list'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="wflg_show_del_btn">Show Delete Button</label></th>
                <td>   i
                    <input name="wflg_show_del_btn" type="checkbox" id="wflg_show_del_btn" value="1">
                    <p class="description"><?php echo sprintf( __('%s', 'wf-list-generator'), 'Select to show delete button in lists.'); ?></p>
                </td>
            </tr>


        </table>

        <?php submit_button('Save Changes', 'button button-primary', 'wflg-settings'); ?>
    </form>
</div>

