<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <link rel="stylesheet" href="/css/page.css">
         <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公告展示</p><br>
    	<form action="">
    		<input type="text" name='ads_name'>
			<button>搜索</button>
    	</form>
    	<table border=1>
    		<thead>
    			<th>ID</th>
                <th>标题</th>
    			<th>关键词</th>
    			<th>内容</th>
    			<th>公告图片</th>
    			<th>是否展示</th>
    			<th>操作</th>
    		</thead>
    		<tbody>
    			@foreach($data as $key=>$val)
    			<tr ads_id={{$val->ads_id}}>
	    			<td>{{$val->ads_id}}</td>
	    			<td>{{$val->ads_name}}</td>
	    			<td>{{$val->ads_ci}}</td>
	    			<td>{{$val->ads_desc}}</td>
	    			<td width="70" height="70"><img src="http://adslogo.gxd.com/{{$val->ads_logo}}"></td>
	    			<td>
	    				@if ($val->ads_show ==1)
						 是
						@else
						 否
						@endif
					</td>
					<td>
	    				<a href="/Ads/destroy?ads_id={{$val->ads_id}}">删除||</a>
	    				<a href="/Ads/edit?ads_id={{$val->ads_id}}">||修改</a>
					</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    	{{ $data->appends($query)->links()}}
    </body>
</html>