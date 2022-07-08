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
                           <?php
                           if(!isset($_SESSION)) session_start();

                           $_SESSION['token'] = md5(uniqid(mt_rand(), true));
                           ?>
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <div class="row">
                                <div class="mb-3 name">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" required class="form-control" name="name" id="name"  value="<?php echo !empty($_POST['name'])?$_POST['name']:"" ?>">
                                </div>
                                <div class="mb-3 birthdate">
                                    <label for="birthdate" class="form-label">BirthDate</label>
                                    <input type="date" required class="form-control" name="birthdate" id="birthdate"  value="<?php echo !empty($_POST['birthdate'])?$_POST['birthdate']:"" ?>">
                                </div>
                                <div class="mb-3 address">
                                    <label for="address" class="form-label">Complete Address</label>
                                    <input type="text" required class="form-control" name="address" id="address" value="<?php echo !empty($_POST['address'])?$_POST['address']:"" ?>">
                                </div>
                                <div class="mb-3 picture">
                                    <label for="img" class="form-label">Profile Picture</label>
                                    <input type="file" accept="image/*" class="form-control" name="img" id="picture">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group owner">
                                    <label for="owner">Card Owner</label>
                                    <input type="text" class="form-control" name="credit_card_name" id="owner" value="<?php echo !empty($_POST['credit_card_name'])?$_POST['credit_card_name']:"" ?>">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" name="credit_card_cvv"  id="cvv"  value="<?php echo !empty($_POST['credit_card_cvv'])?$_POST['credit_card_cvv']:"" ?>">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" name="credit_card_number" id="cardNumber" value="<?php echo !empty($_POST['credit_card_number'])?$_POST['credit_card_number']:"" ?>">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select id="expiry_month" name="credit_card_expiration_month">
                                        <option value="01"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="01"?"selected":"" ?>>January</option>
                                        <option value="02"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="02"?"selected":"" ?>>February </option>
                                        <option value="03"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="03"?"selected":"" ?>>March</option>
                                        <option value="04"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="04"?"selected":"" ?>>April</option>
                                        <option value="05"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="05"?"selected":"" ?>>May</option>
                                        <option value="06"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="06"?"selected":"" ?>>June</option>
                                        <option value="07"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="07"?"selected":"" ?>>July</option>
                                        <option value="08"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="08"?"selected":"" ?>>August</option>
                                        <option value="09"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="09"?"selected":"" ?>>September</option>
                                        <option value="10"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="10"?"selected":"" ?>>October</option>
                                        <option value="11"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="11"?"selected":"" ?>>November</option>
                                        <option value="12"  <?php echo !empty($_POST['credit_card_expiration_month'])&&$_POST['credit_card_expiration_month']=="12"?"selected":"" ?>>December</option>
                                    </select>
                                    <select id="expiry_year"  name="credit_card_expiration_year">
                                        <option value="22" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="22"?"selected":"" ?>> 2022</option>
                                        <option value="23" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="23"?"selected":"" ?>> 2023</option>
                                        <option value="24" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="24"?"selected":"" ?>> 2024</option>
                                        <option value="25" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="25"?"selected":"" ?>> 2025</option>
                                        <option value="26" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="26"?"selected":"" ?>> 2026</option>
                                        <option value="27" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="27"?"selected":"" ?>> 2027</option>
                                        <option value="28" <?php echo !empty($_POST['credit_card_expiration_year'])&&$_POST['credit_card_expiration_year']=="28"?"selected":"" ?>> 2028</option>
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
<!--
examples:
Visa 			 4716108999716531 257
Master Card		 5281037048916168 043
American Express 342498818630298  3156
-->
</html>