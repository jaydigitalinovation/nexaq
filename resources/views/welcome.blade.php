<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="icon" type="text/css" href="images/fevicon.png">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
</head>
<body style="overflow: hidden;">

    <form method="post">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-lg-12">
                <div class="exp-name">
                    <input type="name" name="name" value="" placeholder="name" id="name">
                    <span class="text-danger error-text name_err"></span>
            <br>
                   
                </div>
            </div>
            <div class="col-lg-12">
                <div class="exp-name">
                    <input type="email" name="email" value="" placeholder="email" id="email">
                    <span class="text-danger error-text email_err"></span>
            <br>
                   
                </div>
            </div>
            <div class="col-lg-12">
                <div class="exp-name">
                    <input type="number" name="mobile_no" value="" id="phone_no">
                    <span class="text-danger error-text mobile_code_err"></span>
            <br>
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="exp-name">
                    <input type="text" name="university" value="" placeholder="university" id="university">
                    <span class="text-danger error-text university_err"></span>
            <br>
                    
                </div>
            </div>

            <div class="exp-btn">
                <button type="submit" id="submit1">
                    submit
                </button>
            </div>
        </div>
    </form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#submit1").click(function(e){

                e.preventDefault();

                var _token=$("input[name='_token']").val();

                var name = $("#name").val();

                var email=$("#email").val();

                var phone_no=$("#phone_no").val();

                var university=$("#university").val();


                alert(name);
                alert(email);
                alert(phone_no);
                alert(university);


                $.ajax({

                    url:"/submit_form",
                    type:'POST',
                    data:{_token:_token , name:name , email:email , phone_no:phone_no , university:university ,},
                    success:function(data){

                        console.log(data.error)
                        if($.isEmptyObject(data.error)){

                            alert("success");
                        }

                        else{

                            alert("error");
                        }
                    }

                });
            });
        });

    </script>
</body>
</html>