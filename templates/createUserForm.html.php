<?php
require 'admin.nav.html.php';
?>

<div class="container">
    <form action="" method="post">
        <input type="hidden" name="user[id]" value='<?= $user->id ?? '' ?>' />
        <div class="form-group mt-5">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="user[title]" id="title" placeholder="Mr" value="<?= $user->title ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="user[firstname]" id="firstname" placeholder="Firstname" value="<?= $user->firstname ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" name="user[surname]" id="surname" placeholder="Surname" value="<?= $user->surname ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="contactAddress">Contact Address</label>
            <input type="text" class="form-control" name="user[contactAddress]" id="contactAddress" placeholder="Address" value="<?= $user->contactAddress ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="telephoneNumber">Telephone Number</label>
            <input type="text" class="form-control" name="user[telephoneNumber]" id="telephoneNumber" placeholder="Telephone Number" value="<?= $user->telephoneNumber ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="user[status]">
                <?php
                $status = ['BUYER', 'SELLER', 'JOINT', 'ADMIN'];
                foreach ($status as $row) {
                    if ($user->status == $row) {
                        echo '<option value="' . $row . '" selected="selected">' . $row . '</option>';
                    } else {
                        echo '<option option value="' . $row . '">' . $row . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="buyerApprovedStatus">Approved Buyer</label>
            <select class="form-control" id="buyerApprovedStatus" name="user[buyerApprovedStatus]">
                <?php
                $status = ['NO', 'YES'];
                foreach ($status as $row) {
                    if ($user->buyerApprovedStatus == $row) {
                        echo '<option value="' . $row . '" selected="selected">' . $row . '</option>';
                    } else {
                        echo '<option option value="' . $row . '">' . $row . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bankAccountNumber">Bank Account No</label>
            <input type="text" class="form-control" name="user[bankAccountNumber]" id="bankAccountNumber" placeholder="Bank Account Number" value="<?= $user->bankAccountNumber ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="bankSortCode">Bank Sort Code</label>
            <input type="text" class="form-control" name="user[bankSortCode]" id="bankSortCode" placeholder="Sort Code" value="<?= $user->bankSortCode ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="user[email]" id="email" placeholder="Enter Email" value="<?= $user->email ?? '' ?>" />
        </div>
        <?php
        if (isset($_GET['id'])) { } else {
            ?>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="user[password]" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" name="password[confirm_password]" id="confirm_password" placeholder="Password">
            </div>
        <?php
    }
    ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php
        foreach ($errors as $error) echo $error
        ?>
    </form>
</div>