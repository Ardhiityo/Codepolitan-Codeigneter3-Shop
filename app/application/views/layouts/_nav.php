<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container"> <a class="navbar-brand" href="/">Shop</a> <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Manage
                    </button>
                    <div class="dropdown">
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/category">Kategori</a></li>
                            <li><a class="dropdown-item" href="/product">Produk</a></li>
                            <li><a class="dropdown-item" href="/order">Order</a></li>
                            <li><a class="dropdown-item" href="/user">Pengguna</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Cart (<?= getCart() ? getCart() : 0 ?>)
                    </a>
                </li>
                <?php if ($this->session->userdata('is_login')) : ?>
                    <li class="nav-item">
                        <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?= $this->session->userdata('name') ?>
                        </button>
                        <div class="dropdown">
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <?php if ($this->session->userdata('role') == 'member') : ?>
                                    <li><a class="dropdown-item" href="/myorder">Orders</a></li>
                                <?php endif ?>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php endif ?>
            </ul>
            </ul>
        </div>
    </div>
</nav>