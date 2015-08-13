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
	<link rel="stylesheet" type="text/css" href="inc/tl/malihu-scrollbar/jquery.mCustomScrollbar.min.css" />
	<link rel="stylesheet" type="text/css" href="inc/tl/timeline.css"/>

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
	  <p>An API (application programming interface) is a set of protocols, routines and tools that specifies how software connects to other software. Through these ports, information can be provided from one software component to another.</p>
	  <p>The FLONS API is to collect metadata of FLONS communities in a decentralized way. It's represented by a json file hosted by the communities theirselfes and listed in <a href="">directory</a>. We provide some tools to collect all files from communities, aggregate information like rss feeds and calendars.</p>
        </div>
        <div id="news" class="col-sm-3">
          <h2>News</h2>
	  <p>All feeds of category "blog" and type "rss" will be aggregated into one feed. The origin community will be written to the rss source tag. Subscribe <a href="http://api.flons.org/feed/feed.php?items=100">that feed</a> to get all community news.</p>
        </div>
        <div id="calendar" class="col-sm-3">
          <h2>Calendar</h2>
	  <p>We aggregate community calendars provided by FLONS API files. Subscribe <a href="http://api.flons.org/ics-collector/CalendarAPI.php?fields=start,source,summary,description,url,end,location,sourceurl&source=all&order=oldest-first&format=ics">the calendar</a> to stay informed.</p>
	  <div id="timeline-id"></div>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
<script src="inc/tl/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="inc/tl/timeline.js"></script>
<script>
  var options = {title: "Community events", limit : 10, order: "oldest-first"};
  $('#timeline-id').communityTimeline(options);
</script>
<script>
var url = 'http://api.flons.org/feed/feed.php?limit=3';
    console.log(url);
    $.ajax({
      url: url,
      error: function(err) {
        console.log(err);
      },
      dataType: "jsonp",
      success: function(data) {
        $data = $($.parseXML(data));
        items = $data.find('item');
        var rssfeed = $("#news").append('<div class="rssfeed rss-container">').find('.rssfeed');
        rssfeed.append('<div class="rss-header"><div class="rss-title">Neuigkeiten</div></div>');
        var rssfeedList = rssfeed.append('<div class="rss-body"><div id="mCSB_1" class="rss-news mCustomScrollbar _mCS_1 mCS-autoHide"><div id="mCSB_1_container" class="mCustomScrollBox mCS-light-3 mCSB_vertical">').find('.rss-news');
        if (items.length > 0) {
          console.log('There are some items');
          items.each(function(k, item) {
            var blogLink = rssfeedList.append('<div class="rss-newsitem"><a class="bloglink" target="_blank">' + $(item).find('title').text() + '</a>'
              + '</div>').find('a').last();
            blogLink.attr('href', $(item).find('link').text());
          });
        }
      },
      timeout: 20000
    });
</script>
</body></html>

