// $(document).ready(function () {
//     $('select').material_select();
// });


/*  USER PAGE SCRIPTS   */

// Birthdate picker
const elem = document.querySelector('.datepicker');
const format = 'mmm dd, yyyy';
const instance = M.Datepicker.init(elem, format);

//Show Upload x Cancel buttons on Page:users.php Field:avatar
$(".file-path").on('change', function () {
    //check if user has selected image
    var file_path = document.querySelector('.file-path').value;
    if (file_path !== "") {
        //show upload button
        $("#upload").css("display", "block");
    }
});

//Show Save x Cancel buttons on Page:users.php Field:personal information
// event on typing
$('#personalInfoForm').keypress(function () {
    //show upload button
    $("#updateInfo").css("display", "block");
});
// event on changing
$('#personalInfoForm').change(function () {
    //show upload button
    $("#updateInfo").css("display", "block");
});

//Refresh form and rollback all changes on Page:users.php Field:personal information
// if Cancel button pressed on Avatar form - reload page
$('#cancel , #cancel1').click(function () {
    location.reload();
});

//Change checked property for gender on Page:users.php Field:personal information
//if male selected set as checked and value for POST query
$('#male').change(function () {
    this.setAttribute("checked", "checked");
    this.setAttribute("value", "male");
    $('#female').removeAttr("checked");
    $('#female').removeAttr("value");
});
//if female selected set as checked and value for POST query
$('#female').change(function () {
    this.setAttribute("checked", "checked");
    this.setAttribute("value", "female");
    $('#male').removeAttr("checked");
    $('#male').removeAttr("value");
});

//Change checked property for notify on Page:users.php Field:personal information
//if notifications are canceled set as off(false) othewise as on(true)
$('#notify').change(function () {
    if ($(this).is(':checked')) {
        $(this).removeAttr("checked");
        this.setAttribute("value", false);
    } else {
        this.setAttribute("checked", "");
        this.setAttribute("value", true);
    }
});


/*  SEARCH SCRIPTS   */


//Redirect to products page when Enter pressed on Search field
$('#autocomplete-input').keypress(function (e) {
    // 13 = key Enter
    if (e.which == 13) {
        window.location = "products.php";
    }
});

//Turn off Form  autosubmitting when Enter pressed on Search field
$('#no-submit').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

//Search field on navigation bar
//call function searchNewF for every keypress on search field
const searchNew = document.querySelector("#autocomplete-input");
searchNew.addEventListener('keypress', searchNewF, false);

//function sends typed value and gets matches result from database
function searchNewF() {
    //get typed value from search bar
    var searchInput = searchNew.value;
    //call ajax
    $.ajax({
        url: 'callbacks/ajax_results.php',
        type: 'post',
        //stars for fulltext search by matching typed string
        data: {
            input: "*" + searchInput + "*"
        },
        dataType: 'JSON',
        //callback on success
        success: function (response) {
            //get array' lenght
            var len = response.length;
            //object to send results to the autocomplete dropdown
            var dataProduct = {};
            for (var i = 0; i < len; i++) {
                //property product name
                var product_name = response[i].product_name;
                var product_id = response[i].product_id;
                //adding property to the object
                //null image of product
                dataProduct[product_name] = null;
            }
            //use object to render suggestion from database
            $('input.autocomplete').autocomplete({
                data: dataProduct,
                limit: 5, // the max amount of results that can be shown at once. Default: Infinity.
            });
        }
    });
}


//show modal Please login before submitting a review on Page:product.php Field:new review
//if user not logged in show message

$(document).ready(function () {
    $('.modal').modal();
});


//Show red cursor if user didn't type a review text on Page:product.php Field:new review

    $('.reviewBtn').click(function () {
        if(!$('.textarea1').val()) {
            $('.textarea1').addClass('invalid');
        }
    });

    //if user started to type after got an invalid cursor - remove that cursor
    $('.textarea1').keypress(function () {
        if ($(this).hasClass('invalid')) {
            $(this).removeClass('invalid');
        }
    });


//Prevent form submit if not valid
    function validate () {
        if(!$('.textarea1').val()) {
            return false;
        }
        return true;
    }


//Format review date output from now on Page:product.php Field:product review element
//grab review date
var reviewDate = document.getElementsByClassName("reviewDate");
for (let i = 0; i < reviewDate.length; i++) {
    //format rule
    let momentReviewDate = moment(reviewDate[i].innerHTML, "YYYYMMDD").fromNow();
    //output the result on page
    reviewDate[i].innerHTML= momentReviewDate;
}
