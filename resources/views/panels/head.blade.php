<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    @include('panels.style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .btn-back{
            cursor: pointer;
            border-radius: 100px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;

        }
        .btn-back:hover{
            background: #e7e7e7;
            transition: background 0.5s;
        }
    </style>
</head>
