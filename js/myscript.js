//Add brand product
$('.productbrand').click(function(e){
            e.preventDefault();
           $.get('productbrand',function(data){
                $('#productbrand').modal('show')
                    .find('#productbrandContent')
                    .html(data);
        });
    });

//Add delivery
$('.delivery').click(function(e){
            e.preventDefault();
           $.get('delivery',function(data){
                $('#delivery').modal('show')
                    .find('#deliveryContent')
                    .html(data);
        });
    });

//Add payment methods
$('.methods').click(function(e){
            e.preventDefault();
           $.get('methods',function(data){
                $('#methods').modal('show')
                    .find('#methodsContent')
                    .html(data);
        });
    });
//Add color product
$('.productcolor').click(function(e){
            e.preventDefault();
           $.get('productcolor',function(data){
                $('#productcolor').modal('show')
                    .find('#productcolorContent')
                    .html(data);
        });
    });

//Add uom
$('.productuom').click(function(e){
            e.preventDefault();
           $.get('productuom',function(data){
                $('#productuom').modal('show')
                    .find('#productuomContent')
                    .html(data);
        });
    });

//Add categories
$('.categories').click(function(e){
            e.preventDefault();
           $.get('categories',function(data){
                $('#categories').modal('show')
                    .find('#categoriesContent')
                    .html(data);
        });
    });

/*//Add deposit
$('.deposit').click(function(e){
            e.preventDefault();
           $.get('deposit',function(data){
                $('#deposit').modal('show')
                    .find('#depositContent')
                    .html(data);
        });
    });

$(document).ready(function() {
  $('.deposit').click(function (e) {
    e.preventDefault();
    var transAmount = $(this).attr('val');
    $.get('deposit?transAmount='+transAmount, function (data) {
        $('#deposit').modal('show')
            .find('#depositContent')
            .html(data);
    });
});
});
*/
//addtocart
 $('.addtocart').click(function(e){
    e.preventDefault();
    var productid = $(this).attr('productid');
    var userid = $(this).attr('userid');
    var baseUrl = $(this).attr('baseUrl');
    var quantity = $("#quantity_"+productid).val();
    
    $.ajax({
        url: baseUrl+"/product/addtocart?productid="+productid+"&userid="+userid+"&quantity="+quantity,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            alert(res);
        }
    });
    
    alert(productid+' and '+userid+' and '+quantity);
 });


//addorder
$('.addorder').click(function(e){
    e.preventDefault();
    var productid = $(this).attr('productid');
    var userid = $(this).attr('userid');
    var total = $(this).attr('total');
    var baseUrl = $(this).attr('baseUrl');
    
    $.ajax({
        url: baseUrl+"/product/addorder?productid="+productid+"&userid="+userid+"&total="+total,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            alert(res);
        }
    });
    
    alert(' Save order with Total: '+total);
 });

//stepper wizzard
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});

