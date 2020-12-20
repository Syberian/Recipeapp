$(document).ready(function(){

    if( $('#loggedAs').html().trim().length < 1 )
    {
        $('#loginBlockade').show();
    }
    else
    {
        $('#recipeContent').show();
    }

});
function deleteRecipe(param)
{
    $.ajax
    ({
        url:"index.php",
        type:"post",
        data: {ondelete: param},
        success:function()
        {
            window.location.reload();
        }
    });
}

function modifyRecipe(id, title, opis)
{
    $.ajax
    ({
        url:"index.php",
        type:"post",
        data: {onmodify: id},
        success:function()
        {
            $('#tempId').val(id);
            $('#titleToModify').val(title);
            $('#recipeToModify').val(opis);
        }
    });
}