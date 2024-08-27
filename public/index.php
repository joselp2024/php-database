
<?php

require("../vendor/autoload.php");

use App\Controllers\IncomesController;
use App\Controllers\WithdrawalsController;
use Router\RouterHandler;


// Obtener la URL
$slug = $_GET["slug"] ?? "";
$slug = explode("/", $slug);

// Imprimir el array resultante para depurar
// echo "<pre>";
// var_dump($slug);
// echo "</pre>";

// Logica para manejar la ruta
$resource = $slug[0] ?? "/";
$id = $slug[1] ?? null;


//INstancia del router

$router = new RouterHandler();


switch($resource) {
    case "":
    case "/":
        echo "Estás en la front page";
        break;
    case "incomes":
            $method = $_POST["method"] ?? "get";
            $router->set_method($method);
            $router->set_data($_POST);
            $router->route(IncomesController::class,$id);
            
        break;

    case "withdrawals":
        $method = $_POST["method"] ??"get";
            $router->set_method($method);
            $router->set_method($_POST);
            $router->route(WithdrawalsController::class,$id);
        break;
    default:
        echo "404 NOT FOUND";
        break;
}














































// <?php

// use App\Controllers\IncomesController;
// use App\Controllers\WithdrawalsController;
// use App\Enums\IncomeTypeEnum;
// use App\Enums\PaymentMethodEnum;
// use App\Enums\WithdrawalTypeEnum;

// require ("vendor/autoload.php");

// //ENVIO CON MYSQLI
// // $incomes_controller = new IncomesController();
// // $incomes_controller->store([
// //     "payment_method" => PaymentMethodEnum::BankAccount->value,
// //     "type"=> IncomeTypeEnum::Salary->value,
// //     "date"=> date("Y-m-d H:i:s"),
// //     "amount"=> 10000,
// //     "description" => "pago de salario"

// // ]);


// //insercion de datos

// // $withdrawal_controller = new WithdrawalsController();
// // $withdrawal_controller->store([
// //     "payment_method" => PaymentMethodEnum::CreditCard->value,
// //     "type"=>WithdrawalTypeEnum::Purchase->value,
// //     "time"=> date("Y-m-d H:i:s"),
// //     "amount"=> 130,
// //     "description"=>"Compra super"
// // ]);




// // $withdrawal_controller = new WithdrawalsController();   
// // $withdrawal_controller->index();


// // $withdrawal_controller = new WithdrawalsController();   
// // $withdrawal_controller->show(1);

// // $incomes_controller = new IncomesController();
// // $incomes_controller->index();


// $incomes_controller = new IncomesController();
// $incomes_controller->destroy(1);