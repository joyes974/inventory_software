<html>
    <head>
        <title><?=$page_title?></title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <link type="text/css" rel="stylesheet" href="<?=base_url()?>style/print_style.css">
        
    
   
    </head>
    <body>
        <div class="">
          
            <?php if($dir=='') {
                $dir='home';
            } if

            ($page=='') {
                $page='index';
}?>
            <div class="pad_10 m_height">
                <h1><?=$page_title?></h1>
<?php include_once $dir.'/'.$page.'.php';?>
            </div>
            <div style="float:left;margin-top:20px;">
		Printed By................................
            </div>
            <?php if($tsign){
                echo '<div style="float:left;margin-top:20px;text-align:center;width:450px;">Teacher Signature...................................</div>';
            }?>
             <?php if($acc_sign){
                echo '<div style="float:left;margin-top:20px;text-align:center;width:450px;">Signature 1: .................................. Signature 2: ................................</div>';
            }?>
            <div style="float:right;text-align:right;margin-top:20px;">
		Date......................................
            </div>
            <div class="clear"></div>
            <input type="button" name="print" value="Print" id="jprintbutton" class="print" onClick="window.print()"/>
        </div>
    </body>
</html>