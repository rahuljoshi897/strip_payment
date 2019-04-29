function activateMenu(item){
    $("#mymenu li").each(function(){
        $(this).removeClass("m-menu__item--active");
        $("#mymenu li[menu-name='"+item+"']").addClass('m-menu__item--active');
    });
}

function updateValueFromSelect(element){
    v1 = $(element).val();
  
     $(element+" option[value='"+v1+"']").text();
     
}

function setSelect2Value(element,placeholder){
    
    var info = $(element).val();
    $(element).select2({
            placeholder:placeholder
    }).val(info).trigger('change');

    
}

function cleanOnModal(element){
   
    $(element+" input,"+element+" textarea").val('');
    
}

function getInfoForModal(element="#tt"){
   
    var container =   $(element).closest("tr");
    var result = [];
    $.each(container.find('td'), function(){
          result.push($(this).text().trim());
    });
    return result;
  }

