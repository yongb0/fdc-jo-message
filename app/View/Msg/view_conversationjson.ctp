<?php
header('Content-type: application/json');
echo json_encode(array_column($theConvo, 'messages'));