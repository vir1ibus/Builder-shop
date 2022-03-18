<section class="container flex-grow-1 col-xxl-8 px-4 py-5">
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Персональные данные</h4>
            <form class="needs-validation" novalidate="">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="login" class="form-label">
                            Имя пользователя
                        </label>
                        <input type="text" class="form-control" id="login" readonly value="">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               readonly
                               value="">
                    </div>

                </div>
            </form>

            <form class="card p-2 my-5"
                  action="/pages/auth/logout.php"
                  method="post">
                <button class="btn btn-secondary" type="submit">
                    Выйти
                </button>
            </form>
        </div>

        <div class="col-md-5 col-lg-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">
          В корзине
        </span>
                <span class="badge bg-primary rounded-pill">

        </span>
            </h4>
            <ul class="list-group mb-3">
                <
                    <a href="/pages/details.php?id="
                       class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">

                            </h6>
                            <small class="text-muted">

                            </small>
                        </div>
                        <form action="/pages/cart/remove.php" method="post">
                            <span class="text-muted"></span>
                            <span class="text-muted">₽</span>

                            <input type="hidden" name="purchase_id" value="" />
                            <button class="btn btn-light ms-1" type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Итого</span>
                        <strong>₽</strong>
                    </li>
            </ul>
            <form class="card p-2" action="/pages/cart/pay.php" method="post">
                <button class="w-100 btn btn-primary btn-lg" type="submit">
                    Оформить заказ
                </button>
            </form>
        </div>

    </div>
</section>