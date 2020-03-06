<?php
echo '<pre>';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__ . '/../vendor/autoload.php';
echo 'Your code must starts here... Create CSV-report for task with ID = ' . getenv('TASK_ID') . '.';
define('ROOT_DIR', __DIR__.'/../');
require ROOT_DIR.'/src/Cache.class.php';
require ROOT_DIR.'/src/Pdo.class.php';
$pdo = PDO_CLASS::getPDO();
$maxID = $pdo->query('SELECT max(id) as MAX_ID FROM parser_results')->fetchColumn();
$cMaxID = new Cache('maxID.tmp');
$cResArr = new Cache('resultArr.tmp');
$cacheMaxID = $cMaxID->read();
if($cacheMaxID != $maxID) { // Если добавились записи в parser_results
    $cMaxID->delete();// Очищаем Кеш
    $cResArr->delete();
    $resultArr = getResultMin();
    $cResArr->write($resultArr);
    $cMaxID->write($maxID);

} else { // Иначе берем результат с кеша
    $resultArr = $cResArr->read();
}
function getResultMin($countMin = 3) {
    try {
        $pdo = PDO_CLASS::getPDO();
        $stmt = $pdo->query('SELECT model FROM parser_results GROUP BY model');
        $threeMin = [];
        while ($model = $stmt->fetch()) {
            $AllProducts = [];
            $stmt2 = $pdo->query('SELECT * FROM parser_results WHERE  model = "' . $model['model'] . '"');
            while ($result = $stmt2->fetch()) {
                if($result['result']) {
                    $products = unserialize($result['result']);
                    $AllProducts = array_merge($AllProducts, $products);
                }
            }
            $AllProductsUnique = array_map("unserialize", array_unique(array_map("serialize", $AllProducts)));// Удалить дублирующие результаты
            $threeMin[$model['model']] = getMinByArr($AllProductsUnique, $countMin);
        }
        return $threeMin;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}



function cmp($a, $b)
{
    return ($a['price'] + $a['shipping']) - ($b['price'] + $b['shipping']); // Сортировка с учетом доставки
}
function getMinByArr($arr, $countMin = 3) {
    usort($arr, "cmp");
    return array_slice($arr, 0, $countMin, true);
}

require 'table.view.php';
