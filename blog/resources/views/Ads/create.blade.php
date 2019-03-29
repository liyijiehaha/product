<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公告管理</p><br>
    	<form action="/Ads/store" method="post" enctype="multipart/form-data">
    		<table border=1>
    			@csrf
    			<tr>
    				<td>标题</td>
    				<td>
    					<input type="text" name='ads_name'>
    					<span>
    					@if ($errors->any())
							@foreach ($errors->get('ads_name') as $error)
							<font color="red">{{ $error }}</font>
							@endforeach
						@endif
						</span>
					</td>
    			</tr>
    			<tr>
    				<td>关键词</td>
    				<td>
    					<input type="text" name='ads_ci'>
    					<span>
    					@if ($errors->any())
							@foreach ($errors->get('ads_ci') as $error)
							<font color="red">{{ $error }}</font>
							@endforeach
						@endif
						</span>
    				</td>
    			</tr>
    			<tr>
    				<td>内容</td>
    				<td>
    					<textarea name="ads_desc" id="" cols="30" rows="10"></textarea>
    				</td>
    			</tr>
    			<tr>
    				<td>图片</td>
    				<td>
    					<input type="file" name='ads_logo'>
    				</td>
    			</tr>
    			<tr>
    				<td>是否展示</td>
    				<td>
    					<input type="radio" name='ads_show' value="1">是
    					<input type="radio" name='ads_show' value="2">否
    				</td>
    			</tr>
    			<tr>
    				<td colspan=2 align="center"><button>添加</button></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>