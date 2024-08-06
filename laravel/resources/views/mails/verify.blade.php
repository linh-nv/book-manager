<section style="
    background-color: aquamarine;
    padding: 50px;
    color: black;
">
    <div style="
        display: grid; 
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center; /* Căn giữa nội dung theo chiều ngang */
    ">
        <h1>Xác thực tài khoản của bạn</h1>
        <p>Vui lòng nhấn vào nút bên dưới để xác thực tài khoản của bạn</p>
        <a href="{{route('confirm_email_verification' , $token)}}" style="
            background-color: coral; 
            color: aliceblue; 
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin: auto; /* Căn giữa theo cả hai chiều */
        ">
            Xác nhận
        </a>
    </div>
</section>
