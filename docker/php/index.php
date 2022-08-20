<!DOCTYPE html>
<html>
<body>
<?php
echo "Hello World";
?>

<?php phpinfo() ?>

docker run --rm \
  -v $(pwd)/docker/php/index.php \
  php:7 \
  php $(pwd)/docker/php/index.php
</body>
</html>