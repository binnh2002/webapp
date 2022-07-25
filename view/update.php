<?php
        require '../model/product.php'; 
        session_start();             
        $sporttb=isset($_SESSION['producttbl0'])?unserialize($_SESSION['producttbl0']):new Product();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Product</h2>
                    </div>
                    <p>Please fill this form and submit to add sports record in the database.</p>
                    <form action="../index.php?act=update" method="post" >
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $producttb->id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $producttb->name; ?> ">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $producttb->price; ?> ">
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <input type="text" name="details" class="form-control" value="<?php echo $producttb->details; ?> ">
                        </div>
                        <div class="form-group">
                            <label>Image 1</label>
                            <input type="file" name="image1" class="form-control" value="<?php echo $producttb->image1; ?> ">
                        </div>
                        <div class="form-group">
                            <label>Producer</label>
                            <input type="text" name="producer" class="form-control" value="<?php echo $producttb->$producerID; ?> ">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $sporttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>