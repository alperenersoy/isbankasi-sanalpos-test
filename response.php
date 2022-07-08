<?php

echo "<textarea style='width:100%;height:100%;'>";
echo json_encode($_POST, JSON_PRETTY_PRINT);
echo "</textarea>";