<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/Ads/update" method="post" enctype="multipart/form-data">
    		<table border=1>
    			@csrf
    			<input type="hidden" name='ads_id' value="{{$data['ads_id']}}">

    			<tr>
    				<td>标题</td>
    				<td>
    					<input type="text" name='ads_name' value="{{$data['ads_name']}}">
					</td>
    			</tr>
    			<tr>
    				<td>关键词</td>
    				<td>
    					<input type="text" name='ads_ci' value="{{$data['ads_ci']}}">
    				</td>
    			</tr>
    			<tr>
    				<td>内容</td>
    				<td>
    					<textarea name="ads_desc" id="" cols="30" rows="10"  >{{$data['ads_desc']}}</textarea>
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
    					@if($data['ads_show']==1)
	    					<input type="radio" name='ads_show' value='1' checked>是
	    					<input type="radio" name='ads_show' value='2'>否
    					@else
	    					<input type="radio" name='ads_show' value='1' >是
	    					<input type="radio" name='ads_show' value='2' checked>否
    					@endif
    				</td>
    			</tr>
    			<tr>
    				<td colspan=2 align="center"><button>修改</button></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>