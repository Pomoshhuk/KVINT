//Админ
//Заполнение полей по кнопке изменить
$(function(){

    $('#right-column-button-re').click(function(){
        if (tr_id !== undefined) { 
          Show_float_window();
          //console.log($('form').attr('id'));
          
       }  
      });
  });

//Заполнение полей по кнопке изменить
function change(){
        
        $('tr[data-value='+tr_id+'][data-value-help="'+tr_help+'"]').find('td').each(function(key,val){
          if ($('form *[name=d'+key+'][type=date]').length==1){
            var text = $(val).text();
            var vars = text.split(".");
            var date1=new Date();
            date1 = vars[2]+"-"+vars[1]+"-"+vars[0];
            $('form input[name=d'+key+'][type=date]').val(date1);
            //console.log($(val).text()+" "+key);

          } else 
          if ($('form select[name=d'+key+']').length==1){
              
              if (codetable!=='5')
              {
                $('form select[name=d'+key+'] option')
                  .each(function(k,v){
                    if ($(v).text()==$(val).text()) {
                      $(v).attr('selected',true);
                    }
                });
              }
          } else {

          $('form *[name=d'+key+']').val($(val).text());
          
          }
          //select для 5 таблицы
          if (codetable=='5' && key==1)
            var id=$(this).parent().attr('data-value');
            $.ajax({
                  url: '../php/rating-select.php',
                  type: 'GET',
                  data:{
                    'cognac_id':id
                  },
                  success:function(data){
                    $('form select[name=d6] option').each(function(k,v){
                      
                        if ($(v).attr('value')==data)
                        {
                          $(v).attr('selected',true);
                        }
                    }); 
                  }
            });
            if (codetable=='3') {
              if(key==0) prize_place=$(val).text();
              if(key==1) prize_group=$(val).parent().attr('data-value');
            }
        });
}