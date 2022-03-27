<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td align="center">
                    <div style="max-width:500px;margin:0 auto">
                        <div
                            style="vertical-align:top;text-align:left;font-family:tahoma;font-size:14px;font-weight:400;color:#091e42;line-height:20px">
                            <div style="padding-top:30px;padding-bottom:10px;vertical-align:top;text-align:center">
                                <a href="#" target="_blank">
                                    <img src="{{asset('frontend')}}/images/logo_mail.png" width="30%" alt="Fpt POlytechnic" style="border:0"
                                        class="CToWUd">
                                </a>
                            </div>
                            <hr style="margin-top:24px;margin-bottom:24px;border:0;border-bottom:1px solid #c1c7d0">
                            <div style="padding:0 16px">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <div style="max-width:470px;margin:0 auto">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                        align="left" style="margin:16px 0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="left" rowspan="1" colspan="1">
                                                                    <p>Dear {{$student}} !</p>
                                                                    <p
                                                                        style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:16px;font-weight:500;color:#172b4d;line-height:20px;margin-top:20px;padding:0">
                                                                       Sản Phẩm Của Bạn Đã BỊ Xóa 
                                                                    </p>
                                                                    
                                                                    <p   style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:16px;font-weight:500;color:#172b4d;line-height:20px;margin-top:20px;padding:0">
                                                                     Lý Do Từ Chối :
                                                                    </p>
                                                                    <p>
                                                                       Sản Phẩm Trùng Lặp
                                                                    </p>
                                                                    <hr>
                                                                    <b>Thông tin dự án:</b>
                                                                    <p>Tên dự án: <b>{{$productName}}</b></p>
                                                                    <p>Tên môn: <b>{{$codeSubject}} - {{$codeName}}</b></p>
                                                                    <p style="text-align: end;">Trân trọng cảm ơn !</p>
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                        align="left" style="table-layout:fixed">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="left" rowspan="1" colspan="2">
                                                                    <hr
                                                                        style="margin-top:24px;margin-bottom:24px;border:0;border-bottom:1px solid #c1c7d0">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" align="left" rowspan="1" colspan="2">
                                                                    <p
                                                                        style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:14px;font-weight:400;color:#091e42;line-height:20px;margin:8px 0">
                                                                        Dưới đây là trang của chúng tôi
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" align="left" rowspan="1" colspan="2">
                                                                    <div
                                                                        style="height:50px;display:inline-block;margin:8px 0">
                                                                        <div style="float:left;margin-right:8px">
                                                                            <a
                                                                                href="{{route('home')}}"
                                                                                style="text-decoration:none"
                                                                                target="_blank">
                                                                                <img
                                                                                    src="{{asset('frontend')}}/images/logo_mail.png"
                                                                                    width="100%" height="60" border="0"
                                                                                    role="presentation"
                                                                                    alt="Logo Fptpolytecnic">
                                                                                </a>
                                                                        </div>
                                                                        <div
                                                                            style="display:inline-block;vertical-align:middle;width:175px">
                                                                            <a href="#"
                                                                                style="text-decoration:none"
                                                                                target="_blank">
                                                                                <div
                                                                                    style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:14px;font-weight:normal;color:#172b4d;line-height:20px">
                                                                                    Sản phẩm Foly
                                                                                </div>
                                                                                <div
                                                                                    style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:11px;font-weight:400;color:#6b778c;line-height:16px">
                                                                                    Nơi trưng bày dự án tốt nghiệp
                                                                                </div>
                                                                                <div
                                                                                    style="border:none;background:transparent;color:#0052cc;text-decoration:none;font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                                                    Poly.com
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr style="margin-top:24px;margin-bottom:24px;border:0;border-bottom:1px solid #c1c7d0">
                            <div style="text-align:center;margin-bottom:16px">
                                <div
                                    style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Fira Sans,Droid Sans,Helvetica Neue,sans-serif;font-size:14px;font-weight:normal;color:#172b4d;line-height:20px;margin:16px 0">
                                    Tin nhắn này đã được gửi cho bạn bởi phòng đào tạo 
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
