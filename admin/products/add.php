<?php
include "../../init.php";
include '../includes/header.php';

$db = Database::instance();

$categories = $db->getAllCategories();
if (isset($_POST['publish'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    // $image = $_FILE['image'];
    //validation , then ->
    $product = $db->addProduct($title, $category_id, $price, $quantity, $description);
}
?>

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Product
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">


                <div class="col-md-8">

                    <div class="form-group">
                        <label for="product-title">Product Title </label>
                        <input type="text" name="id" class="hidden" value="">
                        <input type="text" name="title" class="form-control" value="">
                    </div>


                    <div class="form-group">
                        <label for="product-title">Product Description</label>
                        <textarea name="description" id="" cols="30" rows="12"
                                  class="form-control"></textarea>
                    </div>


                    <!--            <div class="form-group">-->
                    <!--                <label for="product-title">Product Short Description</label>-->
                    <!--                <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"></textarea>-->
                    <!--            </div>-->


                </div><!--Main Content-->


                <!-- SIDEBAR-->


                <aside id="admin_sidebar" class="col-md-4">


                    <!-- Product Categories-->

                    <div class="form-group">
                        <label for="product-title">Product Category</label>

                        <select name="category_id" id="" class="form-control">
                            <option value="" disabled>Select Category</option>
                            <?php
                            foreach ($categories as $category) {
                                $categories_display = <<<CATEGORIES

                                <option>$category->title</option>
CATEGORIES;
                                echo $categories_display;

                            }

                            ?>
                        </select>
                    </div>


                    <!-- Product Brands-->


                    <div class="form-group">
                        <label for="product-title">Product Quantity</label>
                        <input type="number" name="quantity" class="form-control" min="0"
                               value="">
                        <h6 class="text-danger"><?php ?></h6>
                    </div>

                    <div class="form-group ">

                        <label for="product-price">Product Price</label>
                        <input type="number" name="price" class="form-control" size="60" step="any"
                               value="">
                        <h6 class="text-danger"><?php ?></h6>

                    </div>


                    <!-- Product Tags -->


                    <!--  <div class="form-group">
                           <label for="product-title">Product Keywords</label>
                           <hr>
                         <input type="text" name="product_tags" class="form-control">
                     </div>
                  -->
                    <!-- Product Image -->
                    <div class="form-group">
                        <img src=""
                             alt="" width="294px;">
                    </div>
                    <div class="form-group">
                        <label for="product-title">Product Image</label>
                        <input type="file" name="file">
                        <hr>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="draft" class="btn btn-warning btn-sm" value="Draft">
                        <input type="submit" name="publish" class="btn btn-primary btn-sm" value="Publish">
                    </div>


                </aside><!--SIDEBAR-->

            </form>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>