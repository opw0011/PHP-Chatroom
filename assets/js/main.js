function current_page_offset(offset_temp) {
    new_page = current_page + offset_temp;
    if (new_page < 1) {
        //disable "previous"
        return false;
    } else if (new_page > total_pages) {
        //disable "next"
        return false;
    } else {
        // update page
        current_page = new_page;
        offset = (current_page - 1) * limit;
        // update the total pages
        total_pages = Math.ceil(num_all_msg / limit);
        update_msg();
        return true;
    }
}

function load_more() {

    if (limit <= num_all_msg)
        limit += 10; // 10 -> should be # of message added
    else
        alert('No more message');
    update_msg();
}

function change_limit() {
    //alert($("input:radio[name='radio_msg_display']:checked").val());
    var num = $("input:radio[name='radio_msg_display']:checked").val();
    limit = (num == 'all') ? num_all_msg : num;
    current_page = 1; // go back to page 1 after the limit is changed
    offset = 0;
    total_pages = Math.ceil(num_all_msg / limit);
    update_msg();
}

function change_email_visibility() {
    if ($('#check_show_email')[0].checked)
        hide_msg_email = true;
    else
        hide_msg_email = false;

}

function page_refresh() {
    current_page = 1; // redict to first page
    offset = 0;
    update_msg();
}

function update_avatar_num() {
    //alert($('input:radio[name="avatar"]:checked').val());        
    user_avatar_num = $('input:radio[name="avatar"]:checked').val();
    //alert(user_avatar_num);
    // POST the new message 
    var url = site_url + 'config/change_avatar';
    $.ajax({
        url: url,
        type: "POST",
        data: {
            avatar_num: user_avatar_num,
            username: username
        },
        success: function(data) {
            // show the success alert for 2s
            //change user icon on the top right
            update_avatar();

        }
    });
}

function update_avatar() {
    // check the radio box according to avatar num
    $("#avatar" + user_avatar_num).prop("checked", true);
    var url = site_url + 'assets/images/avatars/avatar_' + user_avatar_num + '.png';
    $("#avatar_nav").attr("src", url);
}

function update_callback() {
    // update hide email
    //alert(hide_msg_email);        
    if (hide_msg_email)
        $('.span_email').hide()
    else
        $('.span_email').show();

    // different user with different colors
    // var $row = $('#msg_main').find("tr"),       // Finds the closest row <tr> 
    //     $tds = $row.find("td");             // Finds all children <td> elements
    //     alert($tds.text());
    var $username_cell = $('#msg_main .span_username');
    var $username_arr = [];
    $.each($username_cell, function() { // Visits every single <td> element
        //console.log($(this).text());        // Prints out the text within the <td>
        var $username = $(this).text();
        // push username without duplicate
        if ($.inArray($username, $username_arr) == -1) {
            $username_arr.push($username);
        }
    });

    //alert($username_arr);
    $.each($username_arr, function(index, value) {
        // generate random color
        //var hue = 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')';
        //$('#msg_main .span_username.' + value).css("color",hue);  
        //$('#msg_main .span_email.' + value).css("color",hue);  
        // user hash function to hash the username into num 
        var color = "hsl(" + Math.abs(value.hashCode()) % 360 + ", 70%, 40%)";
        //console.log(value + ":" + Math.abs(value.hashCode()) % 360);
        $('#msg_main .msg_row.' + value).css("color", color);
    });

    //alert($username_arr);





}


// main function to update the message, page numbers 
function update_msg() {
    // document.getElementById("txtHint").innerHTML="";   

    // update the limit according to user's option
    //limit = document.getElementById("select_msg_display").value;      

    //show total number of pages in the pager
    document.getElementById("total_pages").innerHTML = total_pages;

    //show the current pages number in the pager
    document.getElementById("current_page").innerHTML = current_page;



    // update newer and older buttons
    if (current_page < total_pages)
        document.getElementById("next_page").style.visibility = "visible";
    else
        document.getElementById("next_page").style.visibility = "hidden";

    if (current_page > 1)
        document.getElementById("previous_page").style.visibility = "visible";
    else
        document.getElementById("previous_page").style.visibility = "hidden";


    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // display the messages in the msg_main div
            document.getElementById("msg_main").innerHTML = xmlhttp.responseText;
            // $( '#wrapper_msg_table' ).animate({ scrollTop: $('#wrapper_msg_table' )[0].scrollHeight }, "slow");  // msg scroll to buttom of the page                
            update_callback();

            $('#wrapper_msg_table').animate({
                scrollTop: $('#wrapper_msg_table')[0].scrollHeight
            }, "fast"); // msg scroll to buttom of the page

        }
    }

    //chat/show_msg/[offset]/[limit]
    xmlhttp.open("POST", site_url + 'chat/show_msg' + '/' + offset + '/' + limit, true);
    xmlhttp.send();

}

// Reload msg every 5 seconds

function reload_msg() {
  $.ajax({
    type: "POST",
    url: site_url + 'chat/show_msg' + '/' + offset + '/' + limit,
    success: function(data) {
      //console.log('msg reloaded');                  
      $('#msg_main').html(data);
      update_callback();
    }
});

}


// JQuery BELOW


$(document).ready(function() {
    //hide the alerts first 
    $("#alert_msg_sent,#alert_main").hide();
    $('#alert_main span.hint').html('Welcome ' + username + ' !');
    $("#alert_main").show().delay(2000).fadeOut();

    // enabling popover
    $("[data-toggle=popover]").popover();

    // popover smiley table
    $('#popover_smileys').popover({
        html: true,
        title: "Insert Smileys",
        placement: "top",
        content: function() {
            return $('#popover_hidden_content').html();
        }
    });


    window.setInterval(function(){
      /// call your function here
      reload_msg();
    }, 5000);




    // set the height of the panel to full height of the windows 
    // var new_wm_height = $(window).height() - $('#nav_top').height() - $('#nav_bottom').height();
    // $('#wrapper_main').height(new_wm_height);

    // var new_wmt_height = $('#wrapper_main').height() - $('#panel_header').height() - $('#panel_footer').height();
    // $('#panel_body').height(new_wmt_height);


    // previous page button
    $("#btn_load_more").click(function() {
        load_more();
    });

    // previous page button
    $("#previous_page").click(function(e) {
        e.preventDefault();
        current_page_offset(-1)
    });

    // next page button
    $("#next_page").click(function(e) {
        e.preventDefault();
        current_page_offset(1)

    });

    // change setting button
    $("#btn_save").click(function() {
        change_limit();
        change_email_visibility();
        update_avatar_num();

        var url = site_url + 'config/change_avatar/';

        $.ajax({
            type: "POST",
            url: url,
            data: $("#form_msg").serialize(), // serializes the form's elements.
            success: function(data) {
                update_msg();
                //clear the input text
                $('#input_msg').val('');
                // show the success alert for 2s
                // $("#alert_msg_sent").show().delay(2000).fadeOut();                

            }
        });

        // return false; // avoid to execute the actual submit of the form.


        $('#alert_main span.hint').html('The new setting has been applied!');
        $("#alert_main").show().delay(3000).fadeOut();
    });


    // refresh button
    $("#btn_refresh").click(function() {
        page_refresh();
        $('#alert_main span.hint').html('All the message are up-to-date!');
        $("#alert_main").show().delay(3000).fadeOut();
    });

    // submit message button
    $("#form_msg").submit(function() {

        // POST the new message 
        var url = site_url + 'chat/post_msg';

        $.ajax({
            type: "POST",
            url: url,
            data: $("#form_msg").serialize(), // serializes the form's elements.
            success: function(data) {
                update_msg();
                //clear the input text
                $('#input_msg').val('');
                // show the success alert for 2s
                // $("#alert_msg_sent").show().delay(2000).fadeOut();                

            }
        });

        return false; // avoid to execute the actual submit of the form.
    });

});



// HELPER FUNCTIONS

//hash function
String.prototype.hashCode = function() {
  var hash = 0, i, chr, len;
  if (this.length == 0) return hash;
  for (i = 0, len = this.length; i < len; i++) {
    chr   = this.charCodeAt(i);
    hash  = ((hash << 5) - hash) + chr;
    hash |= 0; // Convert to 32bit integer
  }
  return hash;
};

