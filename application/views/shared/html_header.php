<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Inventory Management :: Anuborton Pvt Ltd.</title>
    <base href="<?=base_url()?>" />
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link href="style/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="tools/superfish/css/superfish.css" media="screen" />
    <link href="tools/redmond/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="tools/redmond/jquery.ui.dialog.css" rel="stylesheet" type="text/css" />
    <link href="tools/redmond/jquery.ui.button.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="tools/grid/css/ui.jqgrid.css" media="screen" />
	<script type='text/javascript' src='tools/jquery-1.4.2.min.js'></script>
    <script type='text/javascript' src='tools/jquery-ui-1.8.2.custom.min.js'></script>
    <script type='text/javascript' src='tools/grid/grid.locale-en.js'></script>
    <script type='text/javascript' src='tools/grid/jquery.jqGrid.min.js'></script>
    <script type='text/javascript' src='tools/superfish/js/superfish.js'></script>
    <script type='text/javascript' src='tools/jquery.validate.js'></script>
		 <script type='text/javascript' src='tools/jquery.searchabledropdown-1.0.7.min.js'></script>
	 <script type='text/javascript' src='tools/jquery.searchabledropdown-1.0.7.src.js'></script>



 <script type="text/javascript" src="script/script.js"></script>
	
    
    <script type="text/javascript">
        var $j=jQuery.noConflict();
        var base_url="<?=base_url()?>";
	function appendSelectOption(str) {

			$j("select").append("<option value=\"" + str + "\">" + str+ "</option>");
		}
	
	
		$j(document).ready(function() {
		
			$j("select").searchable();
	
	
	
	
	

		function applyOptions() {			  
			$j("select").searchable({
				maxListSize: $("#maxListSize").val(),
				maxMultiMatch: $("#maxMultiMatch").val(),
				latency: $("#latency").val(),
				exactMatch: $("#exactMatch").get(0).checked,
				wildcards: $("#wildcards").get(0).checked,
				ignoreCase: $("#ignoreCase").get(0).checked
			});
	
		
		}
	});
		
  
    </script>

    <script type='text/javascript' src='script/validator.js'></script>
    <script type='text/javascript' src='script/script.js'></script>
    
</head>