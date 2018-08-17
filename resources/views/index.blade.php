<html>
<h1>Gmail API Reporting Page</h1>
<div class="container">
<div class="col-sm-8">
<form action="/blog/public/test" method="GET">
	<button type="submit">Get Emails</button>
</form>
</div>
<div class="col-sm-8">
<form action="/blog/public/userreport" method="GET">
<button type="submit">Get Reports</button>
</form>
<div class="col-sm-8">
	<form action="/blog/public/getdatereport" method="GET">
	  <select class="form-control" name="item_id">
    @foreach($dates as $date)
      <option value="{{$date->date}}">{{$date->date}}</option>
    @endforeach
  </select>
  <button type="submit">Search</button>
 </div>
</form>
 <div class="col-sm-8">
	<form action="/blog/public/getnamereport" method="GET">
	  <select class="form-control" name="names">
    @foreach($names as $name)
      <option value="{{$name->name}}">{{$name->name}}</option>
    @endforeach
  </select>
  <button type="submit">Search</button>
</form>
<div class="col-sm-8">
	<form action="/blog/public/getnamedatereport" method="GET">
	  <select class="form-control" name="date">
    @foreach($dates as $date)
      <option value="{{$date->date}}">{{$date->date}}</option>
    @endforeach
  </select>
  <button type="submit">Search</button>
	<form action="/blog/public/getnamereport" method="GET">
	  <select class="form-control" name="name">
    @foreach($names as $name)
      <option value="{{$name->name}}">{{$name->name}}</option>
    @endforeach
  </select>
  <button type="submit">Search</button>
</form>




<hr>
<form action="/blog/public/refresh" method="GET">
	<button type="submit">Refresh</button>
</form>

</div>

</html>