<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/page.css">
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<form action="">
    <input type="text" name='goods_name'>
    <button>搜索</button>
</form>
<table border=1>
    <thead>
    <th>ID</th>
    <th>名称</th>
    <th>价格</th>
    <th>内容</th>
    </thead>
    <tbody>
    @foreach($data as $key=>$val)
        <tr ads_id={{$val->ads_id}}>
            <td>{{$val->goods_id}}</td>
            <td>{{$val->goods_name}}</td>
            <td>{{$val->self_price}}</td>
            <td>{{$val->goods_desc}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $data->appends($query)->links()}}
</body>
</html>