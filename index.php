<?php
print_r(apache_get_modules());
in_array('mod_rewrite', apache_get_modules());
?>
