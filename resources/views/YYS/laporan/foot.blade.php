    <table style="border:1px;text-align:center;">
        <tr>
            <td style="width:50%"></td>
            <td style="width:50%"> Rantau Prapat, {{ date('d M Y')}}</td>
        </tr>
        <tr style="vertical-align:top;">
            <td style="padding-bottom: 40px;width:50%">Divalidasi Oleh,</td>
            <td style="padding-bottom: 40px;width:50%">Diserahkan Oleh,</td>
        </tr>        
        <tr>
            <td style="width:50%">__________________________</td>
            <td style="width:50%"><u>{{ Auth()->user()->name }}</u></td>
        </tr>           
    </table> 
</body>
</html>
