<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SysHG - Orçamento</title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}
    </style>
</head>
<body yahoo bgcolor="#f6f8f1">
<table border="0" cellpadding="0" cellspacing="" width="100%" bgcolor="F9F9F9" align="center" style="font-family:Verdana;">
    <tr>
        <td style="padding:10px 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="FFFFFF" align="center" style="border:1px solid #f1f1f1">
                <tr>
                    <td style="padding:5px 10px;">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="F9F9F9" style="padding:10px;">
                            <tr>
                                <td>
                                    <p style="font-size:12px;color:#999">
                                        Olá,<br><br>
                                        Você nos informou que perdeu a senha, clique no botão aqui em baixo para gerar uma nova senha.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ $link = url('password/reset', $token) . '?email=' . urlencode($user->getEmailForPasswordReset()) }}" style="background:#709FF5;color:#fff;text-decoration:none;padding:13px 5px;display:block;width:160px;text-align: center;margin:20px 0 0;font-size:12px;text-transform:uppercase;">Gerar nova senha</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px 10px 10px;">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="F9F9F9" style="padding:10px;">
                            <tr>
                                <td>
                                    <p style="font-size:11px;color:#999">
                                        Enviado em {{ \Carbon\Carbon::now()->format('d/m/Y \à\s H:i:s') }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

