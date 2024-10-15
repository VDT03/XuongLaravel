<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>

    <main class="container">
        <h1>Trang chuyển tiền</h1>

        <div class="container mt-4">
            <form method="POST" action="{{ route('transstore') }}">
                @csrf

                <div class="mb-3 row">
                    <label for="depositer_account" class="col-4 col-form-label">Tên tài khoản người gửi</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="depositer_account" id="depositer_account"
                            required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="amount" class="col-4 col-form-label">Số tiền gửi</label>
                    <div class="col-8">
                        <input type="number" class="form-control" name="amount" id="amount"
                            required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="receiver_account" class="col-4 col-form-label">Tên tài khoản người nhận</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="receiver_account" id="receiver_account"
                         required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">
                            Chuyển tiền
                        </button>
                    </div>
                </div>

            </form>

            <a class="btn btn-primary" href="{{ route('index') }}">Trở về trang chủ</a>
        </div>

    </main>

    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
