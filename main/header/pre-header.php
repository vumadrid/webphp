
<nav class="navbar navbar-expand-md bg-white navbar-light">
        <div class="container">
            <!-- logo  -->
           <div>
        
           <a class="navbar-brand" href="./index.php" style="color: #CF111A;">
           <img src="logo/computer-store.png" width="70px">
           <b>Computer</b></img></a>
           </div>

            <!-- navbar-toggler  -->
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <!-- form tìm kiếm  -->
                <form action="tongsp.php" class="form-inline ml-auto my-2 my-lg-0 mr-3" method="GET">
                    <div class="input-group" style="width: 520px;">
                        <input type="text" class="form-control" aria-label="Small"
                            name="search"  placeholder="Nhập sách cần tìm kiếm..." value = "<?php if(isset($_GET["search"])) { echo $_GET["search"]; } ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn" style="background-color: #CF111A; color: white;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- ô đăng nhập đăng ký giỏ hàng trên header  -->
                <ul class="navbar-nav mb-1 ml-auto">
                            
                                <div class="dropdown">
                                <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                                
                                <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block"> </a>
                                
                            </li>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a  href="danhsachdathang.php" class="dropdown-item nutdangky text-center mb-2">Đơn hàng của bạn</a>
                                <a  href="doimatkhau.php" class="dropdown-item nutdangky text-center mb-2">Đổi mật khẩu</a>
                                <a  href="logout.php" class="dropdown-item nutdangky text-center mb-2">Đăng xuất</a>
                                
                            </div>


                        <div class="dropdown">
                                <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                                 <a href="#" class="btn btn-secondary rounded-circle">
                                <i class="fa fa-user"></i>
                                </a>
                                <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block"> Tài khoản </a>
                                
                            </li>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a  href="register.php" class="dropdown-item nutdangky text-center mb-2">Đăng ký</a>
                                <a href="login.php" class="dropdown-item nutdangnhap text-center"  >Đăng nhập</a>
                            </div>
                    </div>
                    
                </ul>
                
            </div>
            
        </div>
    </nav>