$j(document).ready(function(){
    validator.init();
    common.init();
    $j('button.button,input[type="button"].button,input[type="submit"].button,input[type="reset"].button,button.cancel,input[type="button"]').button();
    $j(".tooolbars #add").button({
            icons: {
                primary: 'ui-icon-plus'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-pencil'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-info'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-link'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-trash'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-refresh'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-disk'
            }
        }).next().button({
            icons: {
                primary: 'ui-icon ui-icon-disk'
            }
        });
    $j('ul.sf-menu').superfish();
});

var common={
    init:function(){
        $j('.jadd_button').click(function(){
            common.add_content(this);
        });
        $j('.jedit_button').click(function(){
            common.edit_content(this);
        });
        $j('.jdelete_button').click(function(){
            common.delete_content(this);
        });
        $j('.jstatus_button').click(function(){
            common.status_content(this);
        });
   $j('.main_category').change(function(){
     id = $j('.main_category').val();
            $j.ajax({
            type:'POST',
            url:base_url+'sale/get_products',
            data:{
              
                id:id
             
            },
            success:function(html){
            
       $j('.replace').html(html);
               
            },
            error:function(e,m,s)
            {

            }
        });
     
        });
        
    
    },
	
    add_content:function(obj){
        var url=$j(obj).attr('title');
        window.location=base_url+url;
    },
    edit_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];
        var url=$j(obj).attr('title');
        window.location=base_url+url+'/'+id;
         return false;
    },
    delete_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];
        if(confirm('Are you sure want to delete the content?')){
            var url=$j(obj).attr('title');
            window.location=base_url+url+'/'+id;
        }

        return false;
    },
    status_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];
        var url=$j(obj).attr('title');
        window.location=base_url+url+'/'+id;
        return false;
    }
}

$j(document).ready(function(){

 
    $j('ul.sf-menu').superfish();
    $j(".date_picker").datepicker({
        dateFormat:'yy-mm-dd',
        showOn:'button',
        buttonImage:base_url+'images/calendar.gif',
        buttonImageOnly:true,
        changeYear:true
    });
   
   
    
   
    
    
    
   
});

