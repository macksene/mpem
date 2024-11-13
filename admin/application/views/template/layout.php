<?php
    $this->load->view('template/header');
    ?>
<body class="jumping">

<!-- PAGE CONTAINER -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div id="root" class="root mn--max hd--expanded">
<section id="content" class="content">
    
    <?php
        $this->load->view('template/right_content');
        $this->load->view('template/footer_insert'); 
    ?>
</section>

    <?php        
        $this->load->view('template/top_bar');
        $this->load->view('template/left_sidebar');
    ?>

    <?php $this->load->view('template/footer');?>
</div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

 