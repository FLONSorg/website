<!DOCTYPE html>
<html lang="en"><head>
<title>FLONS API</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Free Libre Open Networks">
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
<h2>The <b>F</b>ree <b>L</b>ibre <b>O</b>pen <b>N</b>etwork<b>s</b> API</h2>
<h3>Idea</h3>
<p>flons.org is an information hub for people to easily find communities, that are working on <b>F</b>ree <b>L</b>ibre <b>O</b>pen <b>N</b>etwork<b>s</b> all over the world. </p>
<p>The FLONS API aggregates the decentralized metadata from the communities in a simple way. It's represented by a json file hosted by the communities themselves and listed in <a href="https://github.com/FLONSorg/directory/blob/master/directory.json" target="_blank">the API directory</a>. We provide some tools to collect all files from communities to aggregate information like rss feeds and calendars.</p>
<p>Interested people can access information how to get in contact, where groups do meet and how to donate and participate.</p>
<p>We would like to invite you to use the collected data to do your own visualizations and services. Please feel free to contribute to the <a href="https://github.com/FLONSorg" target="_blank">FLONSorg repositories</a></p>
<p>To create your own API file please <a href="//api.flons.org">follow our step-by-step guide</a>.</p>
<h3>What is a Free Libre Open Network?</h3>
<p>Any computer network that allows free local transit, which is following the guidelines of our peering agreement. By "transit", we refer to information flowing through the network. Most of the communities specialize in wireless networking, but a FLON can be built using ethernet, fiber optics, or any other kind of networking technology. FLONs are defined by what its users can do with it, rather than the particular technology it is built on.</p>
<p>The groups are volunteer cooperative associations dedicated to education, collaboration and inclusion. We aim to promote open networks and encourage people to learn about the benefits that free & open networks provide. FLONS do provide resources to learn about technologies used to build these networks. You can show solidarity and support the cause by building a network that follows our peering guidelines.</p>
<p>Free Networkers have been meeting since 2000 to organize, share information, and pool resources to find the best way to build community networks. Our activists include community advocates, system administrators, RF engineers, writers, lawyers, programmers, designers and many others who want to help build FLONS in their local communities.</p>
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
<div class="row">
<div class="col-sm-12">
<p><small><a href="imprint.php">Imprint</a></small></p>
</div>
</div>
</div>

<script src="/inc/underscore.js"></script>

<script type="text/html" id='table-data'>

<% _.each(items,function(item,key,list){ %>
		<tr>
		<td ><% if (item.url) {%>
			<a href="<%= item.url%>" target="_blank"><%= item.name %>
		<% } else { %>
			<%= item.name  %>
		<% } %></td>
		<% if (item.location.country) {%> 
		<td><%= item.location.country %>
		</a><% } else { %>
		<td>
		<% } %>
		</td>

		<% if (item.techDetails.firmware && item.techDetails.firmware.name) {%> 
		<td><%= item.techDetails.firmware.name %>
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
	_.sortBy(rows, 'name');
	_.each(rows, function(item, key, list) {
		if (item.url && !item.url.match(/^http([s]?):\/\/.*/)) { 
      			item.url = "http://" + item.url; 
		}
		if (item.contact.ml && !item.contact.ml.match(/^mailto:.*/) && item.contact.ml.match(/.*\@.*/)) {
			item.contact.ml = "mailto:" + item.contact.ml;
    		} else if (item.contact.ml && !item.contact.ml.match(/^http([s]?):\/\/.*/) ) {
			item.contact.ml = "http://" + item.contact.ml;
		}
		if (item.contact.email && !item.contact.email.match(/^mailto:.*/)) {
			item.contact.email = "mailto:" + item.contact.email;
    		}
    		if (item.contact.twitter && !item.contact.twitter.match(/^http([s]?):\/\/.*/)) {
      			item.contact.twitter = "https://twitter.com/" + item.contact.twitter;
    		}
    		if (item.contact.irc && !item.contact.irc.match(/^irc:.*/)) {
      			item.contact.irc = "irc:" + item.contact.irc;
    		}
    		if (item.contact.jabber && !item.contact.jabber.match(/^jabber:.*/)) {
      			item.contact.jabber = "xmpp:" + item.contact.jabber;
    		}
    		if (item.contact.identica && !item.contact.identica.match(/^identica:.*/)) {
      			item.contact.identica = "identica:" + item.contact.identica;
    		}
	});
	$("table.router tbody").html(_.template(tableTemplate,{items:rows}));
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
	var options = {title: "Community events", limit: "8", order: "oldest-first"};
$('#timeline-id').communityTimeline(options);
</script>
<script>
var url = 'http://api.flons.org/feed/feed.php?items=7';
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
rssfeed.append('<div class="rss-header"><div class="rss-title">Community feed</div></div>');
var rssfeedList = rssfeed.append('<div class="rss-body"><div id="mCSB_1" class="rss-news mCustomScrollbar _mCS_1 mCS-autoHide"><div id="mCSB_1_container" class="mCustomScrollBox mCS-light-3 mCSB_vertical">').find('.rss-news');
if (items.length > 0) {
console.log('There are some items');
items.each(function(k, item) {
	pubDate = new Date($(item).find('pubDate').text());
	var blogLink = rssfeedList.append('<div class="rss-newsitem"><a class="bloglink" target="_blank">' + $(item).find('title').text() + '</a></br><small>' + pubDate.toLocaleDateString() + ' by ' + $(item).find('source').last().text() + '</small>'
		+ '</div>').find('a').last();
	blogLink.attr('href', $(item).find('link').text());
	});
}
},
timeout: 20000
});
</script>
</body></html>

