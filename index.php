<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css">
</head>

<body>
    <div class="container-fluid">
        <div class="creditCardForm">
            <div class="heading">
                <h1>Register</h1>
            </div>
                <?php if(!empty($_POST['errors']))
                { ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                           <?php foreach ($_POST['errors'] as$e){
                               echo "<li>".$e."</li>";
                           } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if(!empty($_POST['success']))
                { ?>
                    <div class="alert alert-success" role="alert">
                          Welcome, <?php echo $_POST['name']?>.
                    </div>
                <?php }else{ ?>
                    <div class="payment">
                        <form method="post" action="route.php?path=user-save" id="register-form"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="mb-3 name">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" required class="form-control" name="name" id="name">
                                </div>
                                <div class="mb-3 birthdate">
                                    <label for="birthdate" class="form-label">BirthDate</label>
                                    <input type="date" required class="form-control" name="birthdate" id="birthdate">
                                </div>
                                <div class="mb-3 address">
                                    <label for="address" class="form-label">Complete Address</label>
                                    <input type="text" required class="form-control" name="address" id="address">
                                </div>
                                <div class="mb-3 picture">
                                    <label for="img" class="form-label">Profile Picture</label>
                                    <input type="file" accept="image/*" class="form-control" name="img" id="picture">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group owner">
                                    <label for="owner">Card Owner</label>
                                    <input type="text" class="form-control" id="owner">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select>
                                        <option value="01">January</option>
                                        <option value="02">February </option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select>
                                        <option value="16"> 2016</option>
                                        <option value="17"> 2017</option>
                                        <option value="18"> 2018</option>
                                        <option value="19"> 2019</option>
                                        <option value="20"> 2020</option>
                                        <option value="21"> 2021</option>
                                        <option value="21"> 2022</option>
                                    </select>
                                </div>
                                <div class="form-group" id="credit_cards">
                                    <img src="assets/images/visa.jpg" id="visa">
                                    <img src="assets/images/mastercard.jpg" id="mastercard">
                                    <img src="assets/images/amex.jpg" id="amex">
                                </div>
                                <div class="alert alert-danger hidden" id="credit-card-error" role="alert">
                                </div>
                            </div>
                            <div class="form-group" id="pay-now">
                                <button type="button" class="btn btn-default" id="confirm-purchase">Submit</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>