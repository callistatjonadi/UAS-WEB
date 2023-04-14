<?php

require "config.php";


//utk tambah listsaya
if (isset($_POST['id_video_listsaya'])){ //id_video dari jquery di home_video.php
    $video_id = $_POST['id_video_listsaya'];
    $user_id = $_SESSION['user_id']; //dari session login/signup.php

    $sql = "SELECT * FROM listsaya WHERE user_id = '$user_id' AND video_id = '$video_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_listsaya = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0){
        echo "sudah_ada";
    }
    else {
        $sql = "INSERT INTO listsaya (user_id, video_id) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dd", $user_id, $video_id);
        $stmt->execute();
    }
 
}

//utk tambah wishlist
if (isset($_POST['id_video_wishlist'])){
    $video_id = $_POST['id_video_wishlist'];
    $user_id = $_SESSION['user_id']; //dari session login/signup.php

    $sql = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND video_id = '$video_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_listsaya = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0){
        echo "sudah_ada";
    }
    else {
        $sql = "INSERT INTO wishlist (user_id, video_id) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dd", $user_id, $video_id);
        $stmt->execute();
    }
}

//utk hapus listsaya
if (isset($_POST['id_video_hapuslist'])){
    $video_id = $_POST['id_video_hapuslist'];
    $user_id = $_SESSION['user_id']; //dari session login/signup.php

    // $sql = "SELECT * FROM listsaya WHERE user_id = '$user_id' AND video_id = '$video_id'";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $row_listsaya = $result->fetch_assoc();

    $sql = "DELETE FROM listsaya WHERE user_id = ? AND video_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dd", $user_id, $video_id);
    $stmt->execute();
}

//utk hapus wishlist
if (isset($_POST['id_video_hapuswishlist'])){
    $video_id = $_POST['id_video_hapuswishlist'];
    $user_id = $_SESSION['user_id']; //dari session login/signup.php

    // $sql = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND video_id = '$video_id'";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $row_listsaya = $result->fetch_assoc();

    $sql = "DELETE FROM wishlist WHERE user_id = ? AND video_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dd", $user_id, $video_id);
    $stmt->execute();
}
?>