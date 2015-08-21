/**
 * Created by Кирилл on 18.08.2015.
 */
$(document).ready(function () {

    $("#myTab a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
    });

    $(function () {
        $("#sortable").sortable({
            cancel: '.empty',
            cursor: 'move',
            stop: function (event, ui) {
                var el = ui.item.context;
                var parentId = $(el).parent().parent().attr('data-id');
                var id = $(el).attr('data-id');

                $(el).attr('data-parent-id', parentId);

                $.ajax({
                    type: "GET",
                    url: 'update_el',
                    data: "id=" + id + "&parent_id=" + parentId,
                    success: function (msg) {
                        //console.log(msg);
                    }
                });


                var all = $(el).parent('#sortable');
                console.log(all.context);
                $(all).each(function () {
                    console.log('123');
                });
            }
        });
        $("#sortable").disableSelection();

        /*$("#sortable_1").sortable({
         connectWith: '#sortable_2',
         connectWith: '#sortable_3'
         });
         $("#sortable_1").disableSelection();*/

        /*$(".sortable").sortable();
         $(".sortable").disableSelection();*/
    });

    $('.imgPrev').on('click', function () {
        var val = $(this).next().val();
        $('#menu-icon').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

});
