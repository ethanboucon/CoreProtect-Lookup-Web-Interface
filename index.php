<?php include "settings.php"?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CorePortect Lookup Web Interface &bull; by SimonOrJ</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="res/bootstrap-v4.0.0-alpha.2-overstyles.css">
</head>
<body>
<div class="container">
<h1>CoreProtect Lookup Web Interface</h1>
<p class="second">by SimonOrJ</p>
<p>This project is still undergoing alpha testing.  Please report any problems or feedback to the <a href="https://github.com/SimonOrJ/CoreProtect-Lookup-Web-Interface">GitHub project page</a>.  Thank you for testing! ~SimonOrJ</p>
<div id="test"></div>
<div id="debug"></div>

<!--
- time(t) in seconds and t2
- block(b)
- chat/command/sign search (keyword)
- exclude (e) players or blocks.

a inputs:
'block','chat','click','command','container','kill','session','username'
-->
<div id="lookupForm" class="card">
<div class="card-header"><span class="h4 card-title">Make a Lookup</span></div>
<form id="lookup" class="card-block" role="form" method="get" action="./">
<div class="form-group row">
  <div class="col-lg-2 form-control-label">Actions</div>
  <div class="dtButtons btn-group col-lg-10">
    <label class="btn btn-secondary" for="abl"><input type="checkbox" id="abl" name="a[]" value="block" checked>Block</label>
    <label class="btn btn-secondary" for="acl"><input type="checkbox" id="acl" name="a[]" value="click">Click</label>
    <label class="btn btn-secondary" for="acn"><input type="checkbox" id="acn" name="a[]" value="container">Container</label>
    <label class="btn btn-secondary" for="ach"><input type="checkbox" id="ach" name="a[]" value="chat">Chat</label>
    <label class="btn btn-secondary" for="acm"><input type="checkbox" id="acm" name="a[]" value="command">Command</label>
    <label class="btn btn-secondary" for="aki"><input type="checkbox" id="akl" name="a[]" value="kill">Kill</label>
    <label class="btn btn-secondary" for="ass"><input type="checkbox" id="ass" name="a[]" value="session">Session</label>
    <label class="btn btn-secondary" for="aus"><input type="checkbox" id="aus" name="a[]" value="username">Username</label>
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-2 form-control-label">Toggle</div>
  <div class="col-lg-10">
    <button class="btn btn-secondary" type="button" id="rcToggle">Radius/Corners</button>
    <span class="dtButtons btn-group">
    <label class="btn btn-success-outline" for="rbt"><input type="radio" id="rbt" name="rollback" value="1"><span class="glyphicon glyphicon-ok"></span></label>
    <label class="btn btn-secondary active" for="rb"><input type="radio" id="rb" name="rollback" value="" checked>Rollback</label>
    <label class="btn btn-secondary-outline" for="rbf"><input type="radio" id="rbf" name="rollback" value="0"><span class="glyphicon glyphicon-minus"></span></label>
    </span>
  </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 form-control-label" for="x1" id="corner1">Center / Corner 1</label>
    <div class="input-group col-lg-4 col-sm-10 groups-line" id="c1">
      <input class="form-control" type="number" id="x1" name="xyz[]" placeholder="x">
        <span class="input-group-btn" style="width:0"></span>
      <input class="form-control" type="number" id="y1" name="xyz[]" placeholder="y">
        <span class="input-group-btn" style="width:0"></span>
      <input class="form-control" type="number" id="z1" name="xyz[]" placeholder="z">
    </div>
    <label class="col-sm-2 form-control-label" for="x2" id="corner2">Radius / Corner 2</label>
    <div class="input-group col-lg-4 col-sm-10" id="c2">
      <input class="form-control" type="number" id="x2" name="xyz2[]" placeholder="Radius or x">
      <span class="input-group-btn c2" style="width:0"></span>
      <input class="form-control c2" type="number" id="y2" name="xyz2[]" placeholder="y">
      <span class="input-group-btn c2" style="width:0"></span>
      <input class="form-control c2" type="number" id="z2" name="xyz2[]" placeholder="z">
    </div>
</div>
<div class="form-group row">
  <label class="col-xs-2 form-control-label" for="wid">World</label>
  <div class="col-xs-10"><input class="form-control" type="text" id="wid" name="wid" placeholder="world"></div>
</div>
<div class="form-group row">
  <label class="col-lg-2 form-control-label" for="usr">Users</label>
  <div class="input-group col-lg-10" >
    <span class="dtButtons input-group-btn"><label class="btn btn-secondary" for="eus"><input type="checkbox" id="eus" name="e[]" value="u">Exclude</label></span>
    <input class="form-control" type="text" pattern="((#[a-zA-Z_]+)|([a-zA-Z0-9_]{2,16}))(,\s?((#[a-zA-Z_]+)|([a-zA-Z0-9_]{2,16})))*" id="usr" name="u" placeholder="Separate by single comma(,)">
  </div>
</div>
<div class="form-group row">
  <label class="col-lg-2 form-control-label" for="blk">Blocks</label>
  <div class="input-group col-lg-10">
    <span class="dtButtons input-group-btn"><label class="btn btn-secondary" for="ebl"><input type="checkbox" id="ebl" name="e[]" value="b">Exclude</label></span>
    <input class="form-control" type="text" pattern="([^:]+:[^:,]+)+" id="blk" name="b" placeholder="minecraft:<block> - Separate by single comma(,)">
  </div>
</div>
<div class="form-group row">
  <label class="col-sm-2 form-control-label" for="kwd">Keyword</label>
  <div class="col-sm-10"><input class="form-control" type="text" id="kwd" name="keyword" placeholder="Coming in v0.6.x-alpha!" disabled></div>
</div>
<div class="form-group row">
  <label class="col-sm-2 form-control-label" for="date">Date/Time</label>
  <div class="input-group col-lg-4 col-sm-10 groups-line">
    <span class="dtButtons input-group-btn">
      <label class="btn btn-secondary" for="trv"><input type="checkbox" id="trv" name="asendt">Reverse</label>
    </span>
    <input class="form-control" type="datetime-local" id="date" name="t" placeholder="--/--/---- --:-- --">
  </div>
  <input type="hidden" name="unixtime" value="on">
  <label class="col-sm-2 form-control-label" for="lim">Limit</label>
  <div class="col-lg-4 col-sm-10">
    <input class="form-control" type="number" id="lim" name="lim" min="1" placeholder="30">
  </div>
</div>
<div class="row">
  <div class="col-sm-offset-2 col-sm-10">
    <input class="btn btn-secondary" type="submit" value="Make a Lookup">
  </div>
</div>
</form>
</div>
</div>
<div class="container-fluid">
<table id="output" class="table table-sm table-striped">
  <caption id="genTime"></caption>
  <thead class="thead-inverse">
  <tr><th>Time</th><th>User</th><th>Action</th><th>Coordinates / World</th><th>Block/Item:Data</th><th>Amount</th><th>Rollback</th></tr>
  </thead>
  <tbody id="mainTbl"><tr><td colspan="7">Please submit a lookup.</td></tr></tbody>
</table>
</div>
<form class="container" id="loadMore" action="">
<div class="row">
  <div class="col-sm-offset-2 col-sm-8 form-group input-group">
    <label class="input-group-addon" for="moreLim">load next </label><input class="form-control" type="number" id="moreLim" name="lim" min="1" placeholder="10">
  </div>
</div>
<input type="hidden" id="SQL" name="SQL">
<input type="hidden" id="SQLqs" name="SQLqs">
<input type="hidden" id="offset" name="offset">
<div class="form-group row">
  <div class="col-sm-offset-2 col-sm-8">
    <input class="btn btn-secondary" id="loadMoreBtn" type="submit" value="Load more">
  </div>
</div>
</form>
<script>
// Quick Styling for JS-enabled browser
document.getElementById("corner1").innerHTML = "Center";
document.getElementById("corner2").innerHTML = "Radius";
document.getElementById("c2").className = "col-lg-4 col-sm-10";
a = document.getElementsByClassName("c2");
for(var i = 0; i < a.length; i++) a[i].style.display = "none";
a = document.getElementsByClassName("dtButtons");
for(var i = 0; i < a.length; i++) a[i].setAttribute("data-toggle","buttons");
document.getElementById("x2").setAttribute("placeholder","Radius");
document.getElementById("date").setAttribute("type","text");
document.getElementById("date").removeAttribute("name");
document.getElementById("loadMoreBtn").setAttribute("disabled","");
$dateFormat = "<?=$dateFormat?>";
$timeFormat = "<?=$timeFormat?>";
$timeDividor = "<?=$timeDividor?>";
$dynmapURL = "<?=$dynmapURL?>";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="res/out-table.js"></script>
<div class="container">
<p>Index last updated  Jan 25, 2016.  Version 0.6.0-alpha</p>
<p>This web app utilizes <a href="http://v4-alpha.getbootstrap.com/">Bootstrap v4</a> and <a href="https://eonasdan.github.io/bootstrap-datetimepicker/"> Bootstrap Datepicker v4</a>.<br>COLWI &copy; SimonOrJ, 2015-<?=date("Y")?>.  All Rights Reserved.</p>
</div>
</body>
</html>