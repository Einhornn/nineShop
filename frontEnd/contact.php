<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Liên hệ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../assets/css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <header class="header_area header_three">
        <div class="header_top">
                <div class="header_center">
                    <p>Tưng bừng khai trương giảm giá lên tới 70%</p>
                </div>
        </div>
        <div class="header_middel">
            <div class="container-fluid">
                <div class="middel_inner">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="logo">
                                <a href="index.php"><img src="../assets/img/logo/1.logo.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="main_menu_inner">
                            <div class="main_menu"> 
                                <nav>  
                                    <ul>
                                        <li class="active"><a href="index.php">Trang chủ </a></li>
                                        <li><a href="#">Danh mục <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="#">Áo</a></li>
                                                <li><a href="#">Quần</a></li>
                                                <li><a href="#">Áo khoác</a></li>
                                                <li><a href="#">Đồ lót</a></li>
                                                <li><a href="#">Phụ kiện khác</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop_category.php">Sản phẩm </a></li>
                                        <li><a href="about.php">About us</a></li>
                                        <li><a href="contact.php">Liên hệ</a></li>
                                    </ul>   
                                </nav> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!--header area end-->
 
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area other_bread">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li>/</li>
                            <li>Liên hệ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    
    <!--contact area start-->
    <div class="contact_area">
        <div class="container">   
            <div class="row">
                <div class="col-lg-6 col-md-12">
                   <div class="contact_message content">
                        <h3>Liên hệ</h3>    
                         <p>Bạn có hài lòng về chất lượng phục vụ của Nine Shop? Gửi cảm nhận của bạn cho chúng tôi ngay nhé!</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Địa chỉ: 63 Dương Bá Trạc, phường Rạch Ông, Quận 8</li>
                            <li><i class="fa fa-envelope-o"></i> <a href="index.php">nineshop@gmail.com</a></li>
                            <li><i class="fa fa-phone"></i> 0945 313 640</li>
                        </ul>             
                    </div> 
                </div>
                <div class="col-lg-6 col-md-12">
                   <div class="contact_message form">
                        <h3>Đánh giá</h3>   
                        <form id="contact-form" method="POST"  action="../assets/mail.php">
                            <p>  
                               <label> Tên</label>
                                <input name="Tên^" placeholder="Tên " type="text"> 
                            </p>
                            <p>       
                               <label>  Email</label>
                                <input name="Email*" placeholder="Email " type="email">
                            </p>
                            <p>          
                               <label>  Tựa đề</label>
                                <input name="subject*" placeholder="Tựa đề " type="text">
                            </p>    
                            <div class="contact_textarea">
                                <label>  Lời nhắn</label>
                                <textarea placeholder="Lời nhắn" name="message"  class="form-control2" ></textarea>     
                            </div>   
                            <button type="submit"> Gửi
                            </button>  
                            <p class="form-messege"></p>
                        </form> 

                    </div> 
                </div>
            </div>
        </div>    
    </div>
    <?php include 'footer.php'; ?>