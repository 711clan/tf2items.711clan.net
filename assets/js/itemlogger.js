$(document).ready(function(){
    $('#dropSearchDropDownButton').click(function(){
        if ($(this).hasClass('dropSearchDropped'))
        {
            $(this).removeClass('dropSearchDropped');
            $('#dropSearch').slideUp(500, function(){$('#dropSearchDropDownButton').css('bottom', '20px')})
        }
        else
        {
            $('#dropSearch').slideDown(500)
            $(this).addClass('dropSearchDropped')
            $(this).css('bottom', '23px')
        }
        
    })
    $('#highlightForm>div>input').change(function(e){
        if($(this).attr('checked') == 'checked')
        {
            switch($(this).attr('id'))
            {
                case 'CHWeapon':
                {
                    $('tr.weapon').addClass('rowHighlighted');
                    break;
                }
                case 'CHHat':
                {
                     $('tr.hat').addClass('rowHighlighted');
                     $('tr.haunted_hat').addClass('rowHighlighted');  
                    break;
                }
                case 'CHTool':
                {
                    $('tr.tool').addClass('rowHighlighted'); 
                    break;
                }
                case 'CHCrate':
                {
                    $('tr.supply_crate').addClass('rowHighlighted'); 
                    break;
                }
                case 'CHCraft':
                {
                     $('tr.craft_bar').addClass('rowHighlighted');
                     $('tr.craft_token').addClass('rowHighlighted'); 
                     break;
                }
            }
        }
        else
        {
            switch($(this).attr('name'))
            {
                case 'CHWeapon':
                {
                    $('tr.weapon').removeClass('rowHighlighted');
                    break;
                }
                case 'CHHat':
                {
                     $('tr.hat').removeClass('rowHighlighted');
                     $('tr.haunted_hat').removeClass('rowHighlighted');  
                    break;
                }
                case 'CHTool':
                {
                    $('tr.tool').removeClass('rowHighlighted'); 
                    break;
                }
                case 'CHCrate':
                {
                    $('tr.supply_crate').removeClass('rowHighlighted'); 
                    break;
                }
                case 'CHCraft':
                {
                     $('tr.craft_bar').removeClass('rowHighlighted');
                     $('tr.craft_token').removeClass('rowHighlighted'); 
                     break;
                }
            }
        }
    });
    
    $('#highlightForm>input').each(function(){$(this).change()})
});