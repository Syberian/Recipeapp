$(document).ready(function(){

    if( $('#loggedAs').html().trim().length < 1 )
    {
        $('#main').show();
        $('#logoutButton').hide();
        $('#registerButton').show();
		$('#addRecipe').hide();
    }
    else
    {
        $('#registerButton').hide();
        $('#logoutButton').show();
		
    }

    $('#yourRecipes').click(function(){

        $('#main').hide();
        $('#recipeContent').show();
        $('#addRecipe').show();

    });

    $("#allRecipes").click(function(){

        $('#main').show();
        $('#recipeContent').hide();
        $('#addRecipe').hide();

    });

    $('#logoutButton').click(function(){

        $.ajax
        ({
            url:"index.php",
            type:"post",
            data: {"logged": "param"},
            dataType: 'text',
            success:function()
            {
            }

        });

    });
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

function modifyRecipe(id, title, opis, image)
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
            $('#modifyRecipeImage').attr("src", "images/"+image);
        }
    });
}