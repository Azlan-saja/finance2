<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document</title>
    <style>
     body {
        font-family: "Times New Roman", Times, serif;
        font-size: 0.5em;
    }

    .pdf-content {
        margin: 0px;
        padding: 0px;
    }

    h2 {
        color: #333;
        margin: 0px;
        padding: 0px;
    }

    p {
        color: #666;
        margin: 0px;
        padding: 0px;
        font-size:11px;
    }

    .table-container {
        width: 100%;
        margin: 0px;
        padding:0px;        
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table{
        border-collapse: collapse !important;
        border: 1px solid #2A3547;
        width: 100%;
        
    }
    /* Style for the table header */
    .table-container thead {
        background-color: #2A3547;
        color: #fff;
    }

    /* Style for the table header cells */
    .table-container th {
        padding: 10px;
        text-align: left;
        vertical-align: middle;
        /* font-size:12px; */
    }

    /* Style for the table body rows */
    .table-container tbody tr:nth-child(even) {
        background-color: #EAEDF4;
    }

    /* Style for the table body cells */
    .table-container td {
        padding: 10px;
        border: 1px solid #EBF1F6;
        text-align: left;
        vertical-align: top;
    }

    /* Hover effect on table rows */
    .table-container tbody tr:hover {
        background-color: #e0e0e0;
    }

    .table-container {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container th,
    .table-container td {
        padding: 10px;
        text-align: left;
        word-wrap: break-word;
        /* or overflow-wrap: break-word; */
    }

    .page-number {
        text-align: center;
        margin-top: 20px;
    }

    .table-unit {
        width: 100%;
        margin: 0px;
        padding:0px;        
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    /* Style for the table header */
    .table-unit thead {
        background-color: #DDEBFF;
        color: black;
    }
    .table-unit thead tr:nth-child(even)  {
        font-size:0.7em;
    }

    /* Style for the table header cells */
    .table-unit th {
        padding: 0px 10px 3px 10px;
        text-align: left;
        vertical-align: top;
    }
    .page-break {
        page-break-after: always;
    }
    .smooth-rule {
        height: 1px; /* Set the height of the line */
        background-color: #2A3547; /* Set the color of the line */ /* Create a gradient for the line */
        border: none; /* Remove any border */
        margin: 2px 0 0 0; /* Add some spacing above and below the line */
        padding: 0; /* Add some spacing above and below the line */
    }
    </style>
</head>   
<body>
    <div class="pdf-content">
        <table style="border:1px;">
            <tr>
                <td> 
                    <img src="{{ public_path('assets/logo.jpg') }}" alt="logo">                   
                </td>
                <td  style="width:50%;vertical-align: bottom;">
                    <h1>YSPDI ROBBANI</h1>
                </td>
                <td  style="width:100%;text-align:right;vertical-align: bottom;"> 
                    <h2>{{ $title }}</h2>
                    <p>{{ date('d M Y')}}</p>
                </td>
            </tr>
        </table> 
        <div class="smooth-rule"></div>              
    </div>