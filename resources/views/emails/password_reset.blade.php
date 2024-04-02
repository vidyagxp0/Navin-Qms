<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Set Password</title>
</head>

<body>
  <div>

    <table align="center" width="700" cellspacing="0" cellpadding="0" style="font-size: 13px; font-family: 'Nunito Sans', sans-serif; margin: 20px auto; border: 1px solid rgb(221, 221, 221); line-height: 19px;">
      <tbody>
        <tr>
          <td colspan="6" style="color: white; font-size: 25px; font-weight: bold; text-align: left; background-color: #1c4e81; width: 50%; padding: 15px 20px; border-bottom: 1px solid #bbbbbb;">
            <img src="" style="width: 203px;" />
          </td>
        </tr>


        <tr style="background-color: #1c4e810d;">
          <td colspan="6" style="color: #8cc540; font-size: 24px; font-weight: 700; padding: 35px 20px 0; text-align: center;">Set Password</td>
        </tr>
        <tr style="background-color: #1c4e810d;">
          <td colspan="6" style="font-size: 13px; font-weight: 700; vertical-align: top; width: 100%; padding: 30px 20px 0px; ">
            <h2>Hello <span style="color: #1c4e81;font-weight: 600;font-family: 'Montserrat', sans-serif;">{{$employee}}!</span></h2>
            <p style="font-weight: 300;font-size: 15px;line-height: 1.5;text-align: justify;">Set Password Link is given below.</p>
            <p style="font-weight: 300;font-size: 15px;line-height: 1.5;text-align: justify;">Click here to re-set your password
              <a style="background-color: #1c4e81;color: #fff;padding: 5px 10px;border-radius: 50px;text-decoration: none;" href="{{url('/reset-password/'.$token)}}">
                Reset Password</a>
               
               
              This link is valid for <span style="color: #f7895e;">1 Hour.</span> After it expires, you can request a new one.
            </p>
          </td>
        </tr>



        <tr bgcolor="#1c4e81" style="margin-top: 20px;">
          <td colspan="6" style="color: white; font-size: 12px; text-align: center; padding: 8px; line-height: 20px;">
          QMS © 2024 Mydemosoftware Pvt. Ltd.<br aria-hidden="true" />
      </tr> 
      </tbody>
    </table>
  </div>
</body>

</html>