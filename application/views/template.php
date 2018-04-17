<?php
$Header = "header.php";
$Footer = "footer.php";
$this->load->view($Header); ?>
<?php echo (isset($content) && !empty($content)) ? $content :'' ?>
<?php $this->load->view($Footer); ?>

