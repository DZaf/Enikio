<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input name="upload[]" type="file" multiple="multiple" />
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>