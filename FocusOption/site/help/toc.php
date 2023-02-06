﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Affiliate Buddies - User Manual- Table of Contents</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="generator" content="HelpNDoc Personal Edition 4.8.0.849">
	<link type="text/css" rel="stylesheet" media="all" href="css/reset.css" />
	<link type="text/css" rel="stylesheet" media="all" href="css/silver-theme/jquery-ui-1.8.12.custom.css" />
	<link type="text/css" rel="stylesheet" media="all" href="css/dynatree/chm/ui.dynatree.css" />
	<link type="text/css" rel="stylesheet" media="all" href="css/base.css" />
	<link type="text/css" rel="stylesheet" media="all" href="css/hnd.css" />
    <link type="text/css" rel="stylesheet" media="all" href="css/toc.css" />
	<!--[if lte IE 8]>
		<link type="text/css" rel="stylesheet" media="all" href="css/ielte8.css" />
	<![endif]-->
	<style type="text/css">
		#tabs .ui-widget-header
		{
			background-color: #EFEFEF;
		}
	</style>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.dynatree.min.js"></script>
	<script type="text/javascript" src="js/hndjsse.js"></script>
	<script type="text/javascript">
	
		window.bSearchDataLoaded = false;
		var sHelpIdToActivate = '';
	
		$(document).ready(function()
		{
			var sAnchorName = '';
			try { sAnchorName = top.location.href.substring(top.location.href.lastIndexOf("#") + 1, top.location.href.length); }
			catch(err) { sAnchorName = ''; }
			var nSelectedTab = 0;
			if (sAnchorName == '_index') nSelectedTab = 1
			else if (sAnchorName == '_search') nSelectedTab = 2;			
			$("#tabs").tabs({
				selected: nSelectedTab,
				select: function(event, ui) { HideKwPopup(); }
			});
			
			// Toc
			if ($("#tab-toc").length) {
				$("#tab-toc").dynatree({
					clickFolderMode: 1,
					debugLevel: 0,
					imagePath: 'css/dynatree/chm/',
					onActivate: function(node){
						if ($("#tab-keywords").length && $("#tab-keywords").dynatree && $("#tab-keywords").dynatree("getTree") && $("#tab-keywords").dynatree("getTree").activateKey)
							$("#tab-keywords").dynatree("getTree").activateKey(null);
						if(node.data.href && node.data.href != '#'){
							window.open(node.data.href, node.data.target);
						}
					}
				});
				// Expand all nodes if required
				$("#tab-toc").dynatree("getRoot").visit(function(node){
						node.expand(true);
					});
				// Select the active help id
				if (sHelpIdToActivate != '') $("#tab-toc").dynatree("getTree").activateKey(sHelpIdToActivate);
			}
			
			// Keywords
			
			if ($("#tab-keywords").length) {
				$("#tab-keywords").dynatree({
					clickFolderMode: 1,
					debugLevel: 0,
					imagePath: 'css/dynatree/chm/',
					onClick: function(node, event){
						HideKwPopup();
						if (node.data && node.data.click)
						{
							var aRefList = null;
							eval('aRefList=' + node.data.click);
							if (ShowKwPopup(node.li, aRefList))
							{
								if ($("#tab-toc") && $("#tab-toc").dynatree && $("#tab-toc").dynatree("getTree") && $("#tab-toc").dynatree("getTree").activateKey)
									$("#tab-toc").dynatree("getTree").activateKey(null);
								if(node.data.href && node.data.href != '#'){
									window.open(node.data.href, node.data.target);
								}
							}
						}
					}
				});
				// Expand all nodes if required
				$("#tab-keywords").dynatree("getRoot").visit(function(node){
						node.expand(true);
					});
				}
			
			// Load search data
			(function() {
				var se = document.createElement('script'); se.type = 'text/javascript'; se.async = true;
				se.src = 'js/hndsd.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(se, s);
			})();
		});
		
		$('body').click(function() {
			HideKwPopup();
		});
		
		function SelectTocItem(sHelpId)
		{
			if ($("#tab-toc").length && $("#tab-toc").dynatree && $("#tab-toc").dynatree("getTree") && $("#tab-toc").dynatree("getTree").getNodeByKey) {
				$("#tab-toc").dynatree("getTree").getNodeByKey(sHelpId).activateSilently();
			}
			else {
				sHelpIdToActivate = sHelpId;
			}
		}
		
		function HideKwPopup()
		{
			if($("#popupMenu")) $("#popupMenu").remove();
		}
		
		function ShowKwPopup(oSender, aLinks)
		{
			HideKwPopup();
			if (!aLinks || !aLinks.length || aLinks.length == 0) return false
			else if (aLinks.length == 1) return true
			else
			{
				var oParentDiv = document.createElement("DIV");
				oParentDiv.id = "popupMenu";
				var oLink = null;
				// Close button
				oLink = document.createElement("SPAN");
				oLink.className = "close-button";
				oLink.innerHTML = "X";
				oLink.href = "#";
				oLink.onclick = HideKwPopup;
				oParentDiv.appendChild(oLink);
				// Items
				for (var nCnt=0; nCnt<aLinks.length; nCnt++)
				{
					oLink = document.createElement("A");
					oLink.innerHTML = aLinks[nCnt][0];
					oLink.href = aLinks[nCnt][1];
					oLink.target = "FrameMain";
					oLink.onclick = HideKwPopup;
					oParentDiv.appendChild(oLink);
				}
				document.body.appendChild(oParentDiv);
				var pos = $(oSender).offset(); 
				var height = $(oSender).height();
				$(oParentDiv).css({
					"left": (pos.left+20) + "px",
					"top": (pos.top + height + 5) + "px"
				});
				$(oParentDiv).show();
				return false;
			}
		}
		
		function PerformSearch()
		{
			if (!window.bSearchDataLoaded) {
				$("#search_results").html("Search engine data hasn't been fully loaded yet or an error occurred while loading it. This usually happens when documentation is browsed locally.");
				return;
			}
			sValue = $("#search_value").val();
			$("#search_results").html('Searching...');
			var oSearchEngine = new HndJsSe;
			oSearchEngine.ParseInput(sValue);			
			oSearchEngine.PerformSearch();
			if (!oSearchEngine.aResults || !oSearchEngine.aResults.length)
			{
				$("#search_results").html('No results found.');
			}
			else
			{
				$("#search_results").html('<div id="search_results_content"></div>');
				var oUl = $("#search_results_content").append("<ul id='lr'></ul>").find("ul");
				for (var nCnt = 0; nCnt < oSearchEngine.aResults.length; nCnt++)
				{
					if (oSearchEngine.aResults[nCnt][0] < aTl.length)
					{
						oUl.append("<li><a href='" + aTl[oSearchEngine.aResults[nCnt][0]][0] + "?search=" + escape(sValue) + "' target='FrameMain'>" + unescape(aTl[oSearchEngine.aResults[nCnt][0]][1]) + "</a></li>");
					}
				}
				// Tree
				$("#search_results_content").dynatree({
					clickFolderMode: 1,
					debugLevel: 0,
					imagePath: 'css/dynatree/chm/',
					onActivate: function(node){
						if ($("#search_results_content") && $("#search_results_content").dynatree && $("#search_results_content").dynatree("getTree") && $("#search_results_content").dynatree("getTree").activateKey)
							$("#search_results_content").dynatree("getTree").activateKey(null);
						if(node.data.href && node.data.href != '#'){
							window.open(node.data.href, node.data.target);
						}
					}
				});
			}
		}
	</script>
	
	<link type="text/css" rel="stylesheet" media="all" href="css/int.css">
</head>

<body>
	<div style="    height: 90px;    z-index: 1000000;    position: relative;    margin-left: 24px;    margin-top: 3px;" ><img src="http://www.affiliatebuddies.com/images/logo.png"/>
	<span style="    top: 7px;    position: relative;    font-size: 18px;">Affiliate Program Software V2.4</span></div>
	<div style="clear:both;"></div>
	<!--div id="tabs-container" style="    margin-top:-70px!important;    position: relative;"-->
	<div id="tabs" style="       position: relative;
    height: 1000px;">
	
		<ul>
			<li><a href="#tab-toc">Contents</a></li>
			<!--li><a href="#tab-keywords">Index</a></li-->
			<li><a href="#tab-search">Search</a></li>
			</ul>
		<div id="tab-toc">
			<ul id="toc" class="">

				<li class="" id="Overview" data="">
							<a
							href="Overview.php"
							target="FrameMain">
								Overview</a>

				</li><li class="" id="Dashboard" data="">
							<a
							href="Dashboard.html"
							target="FrameMain">
								Dashboard</a>

				</li><li class="folder" id="AffiliateManagement" data="">
							<a
							href="AffiliateManagement.html"
							target="FrameMain">
								Affiliate Management</a>

				<ul><li class="" id="AddingNewAffiliate" data="">
							<a
							href="AddingNewAffiliate.html"
							target="FrameMain">
								Adding New Affiliate</a>

				</li><li class="" id="WorkingWithPixels" data="">
							<a
							href="WorkingWithPixels.html"
							target="FrameMain">
								Working With Pixels</a>

				</li></ul></li><li class="folder" id="AddingMarketingTools" data="">
							<a
							href="AddingMarketingTools.html"
							target="FrameMain">
								Adding Marketing Tools</a>

				<ul><li class="" id="AddingMarketingTools1" data="">
							<a
							href="AddingMarketingTools1.html"
							target="FrameMain">
								Adding Marketing Tools</a>

				</li><li class="" id="Sendmarketingtoolstoaffiliate" data="">
							<a
							href="Sendmarketingtoolstoaffiliate.html"
							target="FrameMain">
								Send marketing tools to affiliate</a>

				</li></ul></li><li class="folder" id="Reports" data="">
							<a
							href="Reports.html"
							target="FrameMain">
								Reports</a>

				<ul><li class="" id="CreativeReport" data="">
							<a
							href="CreativeReport.html"
							target="FrameMain">
								Creative Report</a>

				</li><li class="" id="TraderReport" data="">
							<a
							href="TraderReport.html"
							target="FrameMain">
								Trader Report</a>

				</li><li class="" id="TradersStatsReports" data="">
							<a
							href="TradersStatsReports.html"
							target="FrameMain">
								Trader's Stats Reports</a>

				</li><li class="" id="AffiliateReport" data="">
							<a
							href="AffiliateReport.html"
							target="FrameMain">
								Affiliate Report</a>

				</li><li class="" id="GroupReport" data="">
							<a
							href="GroupReport.html"
							target="FrameMain">
								Group Report</a>

				</li><li class="" id="ProfileReport" data="">
							<a
							href="ProfileReport.html"
							target="FrameMain">
								Profile Report</a>

				</li></ul></li><li class="folder" id="ManagementPermissions" data="">
							<a
							href="ManagementPermissions.html"
							target="FrameMain">
								Management &amp; Permissions</a>

				<ul><li class="" id="AddingNewAdmin" data="">
							<a
							href="AddingNewAdmin.html"
							target="FrameMain">
								Adding New Admin</a>

				</li><li class="" id="AddingNewAffiliateManager" data="">
							<a
							href="AddingNewAffiliateManager.html"
							target="FrameMain">
								Adding New Affiliate Manager</a>

				</li><li class="folder" id="GroupManagementandaffiliatestatu" data="">
							<a
							href="GroupManagementandaffiliatestatu.html"
							target="FrameMain">
								Group Management and affiliate status</a>

				<ul><li class="" id="Groups" data="">
							<a
							href="Groups.html"
							target="FrameMain">
								Groups</a>

				</li><li class="" id="AffiliateStatus" data="">
							<a
							href="AffiliateStatus.html"
							target="FrameMain">
								Affiliate Status</a>

				</li></ul></li></ul></li><li class="folder" id="Communication" data="">
							<a
							href="Communication.html"
							target="FrameMain">
								Communication</a>

				<ul><li class="" id="Createemailtemplate" data="">
							<a
							href="Createemailtemplate.html"
							target="FrameMain">
								Create e-mail template</a>

				</li><li class="" id="TicketsystemStayconnect" data="">
							<a
							href="TicketsystemStayconnect.html"
							target="FrameMain">
								Ticket system – Stay connect</a>

				</li><li class="" id="Chatthirdpartysolution" data="">
							<a
							href="Chatthirdpartysolution.html"
							target="FrameMain">
								Chat third party solution</a>

				</li></ul></li><li class="folder" id="CRM" data="">
							<a
							href="CRM.html"
							target="FrameMain">
								CRM</a>

				<ul><li class="" id="CRMdashboard" data="">
							<a
							href="CRMdashboard.html"
							target="FrameMain">
								CRM dashboard</a>

				</li><li class="" id="Addanoteandupdatestatus" data="">
							<a
							href="Addanoteandupdatestatus.html"
							target="FrameMain">
								Add a note and update status</a>

				</li></ul></li><li class="" id="Billing" data="">
							<a
							href="Billing.html"
							target="FrameMain">
								Billing</a>

				</li><li class="" id="Lastbutnoleast" data="">
							<a
							href="Lastbutnoleast.html"
							target="FrameMain">
								Last but no least</a>

				</li></ul>
		</div>
		
		<div id="tab-keywords">
			<ul id="keywords">

				</ul>
		</div>
		
		<div id="tab-search">
			<form onsubmit="PerformSearch(); return false;">
				<label for="search_value">Search:</label>
				<input id="search_value" name="search_value"></input>
				<input type="submit" value="Search"/>
			</form>
			<div id="search_results"></div>
		</div>
		
		</div>
    
</body>

</html>

<?php 
//$_SESSION["page"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//var_dump($_SESSION);
//http://dev.rightcommission.com/help/player.php?player=Affiliate_Buddies-Dashboard
?>