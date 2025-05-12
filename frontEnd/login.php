<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "Xin chào, " . htmlspecialchars($_SESSION['user']);
}
?>


<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Đăng nhập/Đăng ký</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
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
    </header>
    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li>/</li>
                            <li>Đăng nhập</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="customer_login">
        <div class="container">
            <div class="auth-container login" id="authContainer">
                <!-- Hiển thị thông báo lỗi hoặc thành công -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <div class="auth-section login">
                    <h2>Đăng nhập</h2>
                    <form action="../backEnd/login-process.php" method="POST" id="loginForm" novalidate>
                        <p>
                            <label>Email <span class="must_have">*</span></label>
                            <input type="email" name="email" id="loginEmail">
                            <span class="error-message" id="loginEmailError">Vui lòng nhập email!</span>
                        </p>
                        <p>
                            <label>Mật khẩu <span class="must_have">*</span></label>
                            <input type="password" name="password" id="loginPassword">
                            <span class="error-message" id="loginPasswordError">Vui lòng nhập mật khẩu!</span>
                        </p>
                        <div class="login_submit">
                            <a href="#">Quên mật khẩu?</a>
                            <button type="submit">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="register-toggle">
                        <a id="showRegister">Chưa có tài khoản? Đăng ký</a>
                    </div>
                </div>
                <div class="auth-section register">
                    <h2>Đăng ký</h2>
                    <form action="../backEnd/register-process.php" method="POST" id="registerForm" novalidate>
                        <p>
                            <label>Họ và tên <span class="must_have">*</span></label>
                            <input type="text" name="name" id="registerName">
                            <span class="error-message" id="registerNameError">Vui lòng nhập họ và tên!</span>
                        </p>
                        <p>
                            <label>Số điện thoại <span class="must_have">*</span></label>
                            <input type="tel" name="phone" id="registerPhone">
                            <span class="error-message" id="registerPhoneError">Vui lòng nhập số điện thoại hợp lệ!</span>
                        </p>
                        <p>
                            <label>Email <span class="must_have">*</span></label>
                            <input type="email" name="email" id="registerEmail">
                            <span class="error-message" id="registerEmailError">Vui lòng nhập email!</span>
                        </p>
                        <p>
                            <label>Địa chỉ<span class="must_have">*</span></label>
                            <textarea name="address" id="registerAddress"></textarea>
                            <span class="error-message" id="registerAddressError">Vui lòng nhập địa chỉ hợp lệ!</span>
                        </p>
                        <p>
                            <label>Mật khẩu <span class="must_have">*</span></label>
                            <input type="password" name="password" id="registerPassword">
                            <span class="error-message" id="registerPasswordError">Vui lòng nhập mật khẩu (tối thiểu 6 ký tự)!</span>
                        </p>
                        <p>
                            <label>Nhập lại mật khẩu <span class="must_have">*</span></label>
                            <input type="password" name="confirm_password" id="registerConfirmPassword">
                            <span class="error-message" id="registerConfirmPasswordError">Mật khẩu không khớp!</span>
                        </p>
                        <div class="login_submit">
                            <button type="submit">Đăng ký</button>
                        </div>
                    </form>
                    <div class="register-toggle">
                        <a id="showLogin">Đã có tài khoản? Đăng nhập</a>
                    </div>
                </div>
                <div class="auth-image" style="background-image: url('../assets/img/about/about1.jpg');"></div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
        const authContainer = document.getElementById('authContainer');
        const showRegister = document.getElementById('showRegister');
        const showLogin = document.getElementById('showLogin');

        showRegister.addEventListener('click', () => {
            authContainer.classList.remove('login');
            authContainer.classList.add('register');
        });

        showLogin.addEventListener('click', () => {
            authContainer.classList.remove('register');
            authContainer.classList.add('login');
        });

        // Validation cho form đăng nhập
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            let isValid = true;
            const email = document.getElementById('loginEmail');
            const password = document.getElementById('loginPassword');
            const emailError = document.getElementById('loginEmailError');
            const passwordError = document.getElementById('loginPasswordError');

            // Reset thông báo lỗi
            emailError.style.display = 'none';
            passwordError.style.display = 'none';

            // Kiểm tra email
            if (!email.value) {
                emailError.style.display = 'block';
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email.value)) {
                emailError.textContent = 'Email không hợp lệ!';
                emailError.style.display = 'block';
                isValid = false;
            }

            // Kiểm tra mật khẩu
            if (!password.value) {
                passwordError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Validation cho form đăng ký
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            let isValid = true;
            const name = document.getElementById('registerName');
            const phone = document.getElementById('registerPhone');
            const email = document.getElementById('registerEmail');
            const password = document.getElementById('registerPassword');
            const confirmPassword = document.getElementById('registerConfirmPassword');
            const nameError = document.getElementById('registerNameError');
            const phoneError = document.getElementById('registerPhoneError');
            const emailError = document.getElementById('registerEmailError');
            const passwordError = document.getElementById('registerPasswordError');
            const confirmPasswordError = document.getElementById('registerConfirmPasswordError');

            // Reset thông báo lỗi
            nameError.style.display = 'none';
            phoneError.style.display = 'none';
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            confirmPasswordError.style.display = 'none';

            // Kiểm tra họ và tên
            if (!name.value) {
                nameError.style.display = 'block';
                isValid = false;
            }

            // Kiểm tra số điện thoại
            if (!phone.value) {
                phoneError.style.display = 'block';
                isValid = false;
            } else if (!/^[0-9]{10,15}$/.test(phone.value)) {
                phoneError.textContent = 'Số điện thoại không hợp lệ!';
                phoneError.style.display = 'block';
                isValid = false;
            }

            // Kiểm tra email
            if (!email.value) {
                emailError.style.display = 'block';
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email.value)) {
                emailError.textContent = 'Email không hợp lệ!';
                emailError.style.display = 'block';
                isValid = false;
            }

            // Kiểm tra mật khẩu
            if (!password.value) {
                passwordError.style.display = 'block';
                isValid = false;
            } else if (password.value.length < 6) {
                passwordError.textContent = 'Mật khẩu phải có ít nhất 6 ký tự!';
                passwordError.style.display = 'block';
                isValid = false;
            }

            // Kiểm tra xác nhận mật khẩu
            if (!confirmPassword.value) {
                confirmPasswordError.style.display = 'block';
                isValid = false;
            } else if (password.value !== confirmPassword.value) {
                confirmPasswordError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('hide');
                }, 3000); // Ẩn sau 3 giây
            });
        });
    </script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>

