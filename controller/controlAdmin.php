<?php
    if(isset($_GET["act"])){
        switch ($_GET["act"]) {
            //* DASHBOARD
            case 'dashboard':
                include_once("./layouts/Dashboard/index.php");
                break;

            //* ORDER
            case 'order':
                include_once("./layouts/order/index.php");
                break;

            //* POSTS
            case 'posts':
                include_once("./layouts/posts/index.php");
                break;

            //* COMMENT
            case 'comment':
                include_once("./layouts/comment/index.php");
                break;

            //* CATEGORY
            case 'category':
                $cate = getAllCate();
                include_once("./layouts/category/index.php");
                break;
            case 'addCate':
                if(isset($_POST['addCate']) && ($_POST['addCate'])){
                    $name_cate = $_POST['nameCate'];
                    $status_cate = $_POST['statusCate'];
                    addCate($name_cate, $status_cate);
                    header("location: {$_SERVER['PHP_SELF']}?act=category");
                }
                break;
            case 'deleteCate':
                if (isset($_GET['idCate'])) {
                    $id_cate = $_GET['idCate'];
                    deleteCate($id_cate);
                    header("location: {$_SERVER['PHP_SELF']}?act=category");
                }
                break;
            case 'editCate':
                if (isset($_GET['idCate'])) {
                    $id_cate = $_GET['idCate'];
                    $cate = getOneCate($id_cate);
                    include_once("./layouts/Category/index.php");
                }
                if(isset($_POST['editCate']) && ($_POST['editCate'])){
                    $name_cate = $_POST['nameCate'];
                    $status_cate = $_POST['statusCate'];
                    $id_cate = $_POST['idCate'];
                    editCate($name_cate, $id_cate, $status_cate);
                    $cate = getOneCate($id_cate);
                    include_once("./layouts/Category/index.php");
                }
                break;

            //* PRODUCT
            case 'product':
                $cate = getAllCate();
                $pro = getAllProduct();
                include_once("./layouts/product/index.php");
                break;
            case 'addPro':
                if (isset($_POST['addPro']) && ($_POST['addPro'])) {
                    $name_pro = $_POST['namePro'];
                    $price_pro = $_POST['pricePro'];
                    $name_cate = $_POST['nameCate'];
                    $date_add = date("Y-m-d");
                    $img_pro = $_FILES['imgPro']['name'];
                    $imgPath = "../upload/imgProduct/";
                    $target_file = $imgPath.str_replace(" ", "-", basename($img_pro));
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES['imgPro']['tmp_name'], $target_file);    
                    $newImgPro = "pottery-ware-".str_replace(" ", "-", $name_pro).".jpg";
                    rename($target_file, $imgPath.$newImgPro);
                    addProduct($name_pro, $price_pro, $name_cate, $newImgPro, $date_add);
                    header("location: {$_SERVER['PHP_SELF']}?act=product");
            }
                break;
            case 'editPro':
                if (isset($_GET['idPro'])) {
                    $id_pro = $_GET['idPro'];
                    $cate = getAllCate();
                    $pro = getOneProduct($id_pro);
                    include_once("./layouts/product/index.php");
                }
                if(isset($_POST['editPro']) && ($_POST['editPro'])){
                    $cate = getAllCate();
                    $id_pro = $_POST['idPro'];
                    $name_pro = $_POST['namePro'];
                    $price_pro = $_POST['pricePro'];
                    $del = $_POST['delPro'];
                    $name_cate = $_POST['nameCate'];
                    $status_pro = $_POST['statusPro'];
                    $date_add = date("Y-m-d");
                    $img_pro = $_FILES['imgPro']['name'];
                    if ($_FILES['imgPro']['name'] == null) {
                        $newImgPro = $_POST['nameImgPro'];
                    }
                    else{
                        $imgPath = "../upload/imgProduct/";
                        $imgPathPro = "../upload/imgProduct/".$_POST['nameImgPro'];
                        if (file_exists($imgPathPro)) {
                            unlink($imgPathPro);
                        }
                        $target_file = $imgPath.str_replace(" ", "-", basename($img_pro));
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES['imgPro']['tmp_name'], $target_file);    
                        $newImgPro = "pottery-ware-".str_replace(" ", "-", $name_pro).".jpg";
                        rename($target_file, $imgPath.$newImgPro);
                    }
                    editProduct($id_pro, $name_pro, $price_pro, $del, $name_cate, $newImgPro, $status_pro, $date_add);
                    $pro = getOneProduct($id_pro);
                    include_once("./layouts/product/index.php");
                }
                break;
            case 'deletePro':
                if (isset($_GET['idPro'])) {
                    $id_pro = $_GET['idPro'];
                    $imgPathPro = "../upload/imgProduct/".$_GET['imgPro'];
                    deleteProduct($id_pro);
                    if (file_exists($imgPathPro)) {
                        unlink($imgPathPro);
                    }
                    header("location: {$_SERVER['PHP_SELF']}?act=product");
                }
                break;

            //* CHARTS
            case 'charts':
                include_once("./layouts/charts/index.php");
                break;

            //* NOTIFICATION
            case 'notification':
                include_once("./layouts/notification/index.php");
                break;

            //* SENDMAIL
            case 'sendmail':
                include_once("./layouts/sendmail/index.php");
                break;

            
            default:
                
                break;
        }
    }
?>