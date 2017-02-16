<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Online Chatroom</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=site_url('assets/css/bootstrap.min.css')?>">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- icons font -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="<?php echo site_url('assets/css/chat_main.css') ?>">    

    </head>

    <body>

     <!-- nav -->
     <nav class="navbar navbar-default navbar-fixed-top" id="nav_top">
      <div class="container-fluid">

       <!-- nav header -->
       <div class="navbar-header">
        <!-- button to toggle collapse -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main_nav">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">Chatroom v1.7</a>
      </div>

      <!-- nav body -->
      <div class="collapse navbar-collapse" id="main_nav">
        <ul class="nav navbar-nav">
         <li class="active"><a href="#">Room #1</a></li>
         <!-- <li class=""><a href="#">Room #2 (coming soon..)</a></li> -->
       </ul>

       <!-- right aligned -->
       <ul class="nav navbar-nav navbar-right">        
        <li> <span class="navbar-text hidden-xs" > Hello, <?=$username?></span></li>
        
        <li><img id="avatar_nav" class="img-circle" style="max-width:35px; margin-top: 10px;"> </li>
        
        <li><a href="<?php echo site_url('chat/logout');?>">Sign out</a></li>
      </ul>
    </div>


  </div>
</nav>

<!-- main body -->

<!-- alert box -->
<div class="container-fluid" style="margin: 65px 0 0 0; padding: 0; "> 

  <div class="alert alert-success alert-dismissible" role="alert" id="alert_main" style="position: absolute; width: 100%; padding: 5px 20px 5px 20px;overflow: hidden;text-align: center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 22px; padding-right: 20px;">&times;</span></button>
    <span class="hint">TEXT HERE</span>
  </div> 

</div>


<div class="container" style="margin-top:40px; overflow-y:auto;" id="wrapper_main">  

  <!-- panel -->

  <div class="panel panel-default">

    <!-- panel header -->
    <div class="panel-heading clearfix" id="panel_header">
      <!-- <h3 class="panel-title">Panel title</h3> -->
      <!-- <button type="button" id="btn_load_more" class="btn btn-default">Load more...</button> -->
      <h4 class="panel-title pull-left">Messages</h4>
      <div class="btn-group pull-right" role="group">      
        <a href="#" class="btn btn-default btn-xs" id="btn_refresh"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh</a>
        <a href="#" class="btn btn-default btn-xs" id="btn_option" data-toggle="modal" data-target="#modal_option"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Option</a>
        <!--    <button type="button" class="btn btn-primary" id="btn_refresh"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh</button> -->
      </div>   

    </div>


    <!-- panel body -->
    <div class="panel-body" id="panel_body">   
      <!-- msg main -->

      <div id="wrapper_msg_table" style="height: 55vh; overflow-y: auto;">
        <div id="msg_main">     

          <!-- message will be displayed using AJAX -->
        </div>
      </div>


    </div> <!-- end of panel body -->

    <!-- panel footer -->
    <div class="panel-footer " id="panel_footer" style="padding: 2px 10px 1px 10px">

      <nav>
        <ul class="pager">
          <li class="previous" id="previous_page"><a href="#" ><span aria-hidden="true">&larr;</span> Newer</a></li>
          <li><span>Page <span id="current_page">#</span> of <span id="total_pages">#</span><span></li>
          <li class="next" id="next_page"><a href="#">Older <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
      </nav>

    </div> <!-- end of panel footer -->

  </div>

</div><!-- end of container -->

<div class="navbar navbar-default navbar-fixed-bottom" style="min-height:35px" id="nav_bottom">
  <div class="container-fluid">
    <!-- input msg box -->

    <form role="form" id="form_msg">

      <div class="input-group" 
      style="-webkit-box-shadow: 0px -3px 5px 0px rgba(173,173,173,0.25);
      -moz-box-shadow: 0px -3px 5px 0px rgba(173,173,173,0.25);
      box-shadow: 0px -3px 5px 0px rgba(173,173,173,0.25);">

      <span class="input-group-addon hidden-xs"><i class="fa fa-pencil-square-o fa-lg"></i></span>
      <!-- <span class="input-group-addon glyphicon glyphicon-pencil hidden-xs " aria-hidden="true" ></span> -->
      <input type="text" class="form-control" placeholder="Write your message here..." id="input_msg" name="msg" maxlength="250" required>


      <span class="input-group-btn">
        <a href="#" class="btn btn-default" id="popover_smileys">
          <i class="fa fa-smile-o fa-lg"></i>
        </a>
        <button class="btn btn-primary" type="submit" style="">SEND</button>
      </span>
    </div>
  </form>     
</div>
</div>

<!-- Popover hidden content -->
<div id="popover_hidden_content" style="display: none">
 <div><?php echo $smiley_table; ?></div>
</div>  

<!-- modal     -->
<div class="modal fade" id="modal_option">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Display Settings</h4>
      </div>

      <div class="modal-body">

        <form role="form" id="form_msg">
          <div class="well">
            <label class="control-label">Messages per page</label>
            <br>

            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-success"> <input type="radio" value="10" name="radio_msg_display"/>10</label>
              <label class="btn btn-success"> <input type="radio" value="20" name="radio_msg_display"/>20</label>
              <label class="btn btn-success"> <input type="radio" value="30" name="radio_msg_display"/>30</label>
              <label class="btn btn-success"> <input type="radio" value="40" name="radio_msg_display"/>40</label>    
              <label class="btn btn-success active"> <input type="radio" value="all" name="radio_msg_display" checked/>All</label>    
            </div>
          </div>

          <div class="well">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="check_show_email"> Hide sender's email
              </label>            
            </div>
          </div>           
          
          <div class="cc-selector-2 well">
            <p>Select your avatar </p>
            <div class="container-fluid">
              <input id="avatar1" type="radio" name="avatar" value="1" />
              <label class="drinkcard-cc avatar1" for="avatar1"></label>
              
              <input id="avatar2" type="radio" name="avatar" value="2" />
              <label class="drinkcard-cc avatar2" for="avatar2"></label>

              <input id="avatar3" type="radio" name="avatar" value="3" />
              <label class="drinkcard-cc avatar3" for="avatar3"></label>
            </div>

            <div class="container-fluid">
              <input id="avatar4" type="radio" name="avatar" value="4" />
              <label class="drinkcard-cc avatar4" for="avatar4"></label>

              <input id="avatar5" type="radio" name="avatar" value="5" />
              <label class="drinkcard-cc avatar5" for="avatar5"></label>

              <input id="avatar6" type="radio" name="avatar" value="6" />
              <label class="drinkcard-cc avatar6" for="avatar6"></label>
            </div>
          </div>      
          
        </form>   
      </div>  <!--/.modal-body-->

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>      

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php /*
  <div ng-app="chatApp" ng-controller="msgCtrl" id="msg_main"> 
  TEST{{1+1}} 
  <table class="table table-striped" style="table-layout: fixed; word-wrap: break-word;">

    <tbody>

      <tr ng-repeat="msg in msgs" class="msg_row {{msg.user_name}}" >
        <td class="col-sm-3">
            <strong> <span class="span_username {{msg.user_name}}">{{msg.user_name}}</span></strong> 
            <u> <span class="span_email {{msg.user_name}}">{{msg.user_email}} </span></u>
        </td>

        <!-- display msg -->
        <td class="col-sm-7"> <?=parse_smileys('{{msg.msg}}',site_url('assets/images/smileys'));?>  </td>

        <td class="col-sm-2"> <em class="small text-muted">@{{msg.time}}</em> </td>

      </tr>

    </tbody>

  </table>


</div> */ ?>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- angular js -->
<script src= "https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>

<!-- javascript for the smileys -->
<?php echo smiley_js(); ?>

<!-- main javascript -->
<script src="<?php echo site_url('assets/js/main.js');?>"></script>

<!-- AJAX for displaying messages -->
<script type="text/javascript">      
var limit, current_page, num_all_msg, total_pages;
var hide_msg_email;
var site_url = "<?php echo site_url()?>";
var username = "<?=$username?>";

window.onload = function initialize () {
    // initialize varibles after the window is loaded
    current_page = 1;
    num_all_msg = <?=$num_all_msg?>;
    limit = num_all_msg;  // show all message in one page 
    offset = 0; // show from the first message
    total_pages = Math.ceil(num_all_msg/limit);
    hide_msg_email = false;        
    user_avatar_num = <?=$avatar_num?>; // the number of avatar current user using       
    update_avatar();
    update_msg(); // update message for the first time 

    // EXISTING BUGS: num_all_msg will not update when new msg are posted. i.e. remain the same num!!
  }     
</script>

</body>
</html>