<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filename = $_POST["filename"];
    $tag_lama = $_POST["tag_lama"];
    $tag_baru = $_POST["tag_baru"];
    $output = strtoupper($_POST["output"]);

    if (!file_exists($filename)) {
        echo "<p style='color:red;'>File <strong>$filename</strong> tidak ditemukan!</p>";
    } else {
        $content = file_get_contents($filename);

        // Ganti tag pembuka dan penutup
        $content = str_replace("<$tag_lama>", "<$tag_baru>", $content);
        $content = str_replace("</$tag_lama>", "</$tag_baru>", $content);

        if ($output == "O") {
            file_put_contents($filename, $content);
            echo "<p>Perubahan disimpan ke file yang sama: <strong>$filename</strong></p>";
        } elseif ($output == "N") {
            $new_filename = preg_replace("/\.html$/", "-new.html", $filename);
            file_put_contents($new_filename, $content);
            echo "<p>Perubahan disimpan ke file baru: <strong>$new_filename</strong></p>";
        } else {
            echo "<p style='color:red;'>Tipe keluaran tidak valid (harus O atau N).</p>";
        }
    }
} else {
    echo "<p>Akses tidak valid. Silakan isi form dari <a href='form.html'>form.html</a>.</p>";
}
?>
