<!DOCTYPE html>
<html lang="en"><head>
      <title>FLONS API</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Free and Libre Open Networks">
        <meta name="author" content="Andreas Bräu" >

        <!-- Le styles -->
                      <link href="/inc/css/flons.css" rel="stylesheet">
          <link href="inc/css/bootstrap.min.css" rel="stylesheet"> 


          <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>
              <script src="/bower_components/bootstrap/assets/js/html5shiv.js"></script>
                <script src="/bower_components/bootstrap/assets/js/respond.min.js"></script>
                <![endif]-->

                <!-- Le fav and touch icons -->
                <link rel="apple-touch-icon" href="http://twitter.github.com/bootstrap/examples/images/apple-touch-icon.png">
                <link rel="apple-touch-icon" sizes="72x72" href="http://twitter.github.com/bootstrap/examples/images/apple-touch-icon-72x72.png">
                <link rel="apple-touch-icon" sizes="114x114" href="http://twitter.github.com/bootstrap/examples/images/apple-touch-icon-114x114.png">
                  <script src="/inc/sorttable.js"></script>
                      <link href="/inc/css/jquery.loadmask.css" rel="stylesheet">
</head>

<body> 
<div class="container">
    <div class="row">
        <div class="col-sm-6">
          <h2>The FLONS API</h2>
        </div>
        <div class="col-sm-3">
          <h2>News</h2>
          <?php include("./inc/allnews.inc.php") ?>
        </div>
        <div class="col-sm-3">
          <h2>Events</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
<h2>List of communities</h2>
<table class="router table table-striped sortable community-popup">
    <thead>
        <tr>
            <th title="Name of the community" class="sorttable_sorted">Name<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
            <th title="Country">Country</th>
      <th title="Firmwares used" class="sorttable_numeric">Firmware</th>
      <th title="Routing protocols in use">Routing</th>
      <th title="Number of nodes">Nodes</th>
      <th title="How to contact the communities">Contact</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
    </div>
</div>

<script src="/inc/underscore.js"></script>

<script type="text/html" id='table-data'>
    
    <% _.each(items,function(item,key,list){ %>
    <tr>
        <td ><%= item.name  %></td>
    <% if (item.country) {%> 
        <td><a href="#" data-toggle="modal" data-target="#info<%= key %>"><%= item.country %></a></td>
        </a><% } else { %>
      <td>
    <% } %>
  </td>

    <% if (item.techDetails.firmware) {%> 
      <td>
        <% } else { %>
      <td>
    <% } %>
  </td>
  <td><%= item.techDetails.routing %></td>
  <td><%= item.state.nodes   %></td>
  <td><ul class="contacts" style="height:<%- Math.round(_.size(item.contact)/6+0.4)*30+10  %>px; width: <%- 6*(30+5)%>px;">
    <% _.each(item.contact, function(contact, index, list) { %>
      <li class="contact">
        <a href="<%- contact %>" class="button <%- index %>" target="_window"></a>
      </li>
    <% }); %>
    </ul>
  </td>
    
    </tr>
    <% }) %>
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://www.weimarnetz.de/bower_components/bootstrap/assets/js/jquery.js"></script>
<script src="http://www.weimarnetz.de/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script  type="text/javascript">
var tableTemplate = $("#table-data").html();
var infoBoxes = $("#info-data").html();
test = function(){
url = "jsonp.php";
$.ajax({
url: url,
dataType: 'jsonp',
success: ( function(Response){
  delete Response["myhostname"]; 
  console.log(26, 'responseis: ', Response);
  var rows = Response;
  //rows = rows.sort(function(a,b) { return b.name - a.name;}); 
  _.sortBy(Response, 'name');
  console.log(26, 'sorted: ', rows);
  $("table.router tbody").html(_.template(tableTemplate,{items:Response}));
} ),
error: function(XMLHttpRequest, textStatus, errorThrown){alert("Error");
}
});
};
test()

</script>
<script src="/inc/jquery.loadmask.js"></script>
<script src="/inc/bootstrap-remote-tabs.js"></script>

</body></html>

