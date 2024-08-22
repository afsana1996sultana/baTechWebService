<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Information Print</title>
</head>
<style>

    *{
        color:#000;
        font-family: 'Calibri';
        font-weight: normal;
        font-style: normal;
    }
    .poppins-regular {
      font-weight: 400;
      font-style: normal;
    }
    ul {
        padding: 0;
    }

    li {
        list-style: none;
    }

    table {
        border-collapse: collapse;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    td,
    th {
        padding: 3px;
    }

    th {
        font-weight: 700;
        font-size: 18px;
    }

    td,
    td,
    td {
        border: 1px solid #000;
    }

    p {
        margin: 0;
    }

    .aditional__info p {
        padding-top: 10px !important;
        font-size: 14px;
        color: #000;
        padding: 0;
    }

    p.najmul {
        padding-top: 0 !important;
    }
    .aditional__info p:last-child{
        border-bottom:none;
    }
    .aditional__info p span {
        color: #5E23A6;
        position: relative;
        top: 3px;
    }

    .product__info table tbody tr th {
        font-size: 15px;
        padding:0;
    }
    .customer__info {
        margin-top: 10px;
    }
    .product__info table tbody tr td {
        font-size: 14px;
    }
    p.najmul a {
        font-weight: 600;
    }

</style>

<body style="width: 175px;margin: auto;">
    @foreach ($informations as $information)
        {{-- <div class="wrapper" style="background-color: white;border: 1px solid #ddd; padding: 10px;height:95vh "> --}}
        <div style="display: flex; justify-content: space-between; height:90vh;">
            <ul class="customer__info" style="margin: 0;">
                <li style="font-size: 16px; font-weight: bold;">{{ $information->ref_no ?? '' }}</li>
                <li style="font-size: 10px;">{{ $information->zonename ?? '' }}</li>
                <li style="font-size: 10px; font-weight: bold;">{{ $information->businame ?? '' }}</li>
                <li style="font-size: 10px; font-weight: bold;">{{ $information->ownername ?? '' }}</li>
                <li style="font-size: 10px;">{{ $information->mob ?? '' }}</li>
                <li style="font-size: 10px;">{{ $information->busiadd ?? '' }}</li>
            </ul>
        </div>
    </div>
    @endforeach
</body>
</html>
<script>
    window.onload = function() {
        window.print();
    };
</script>
